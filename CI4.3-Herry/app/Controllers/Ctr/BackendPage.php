<?php

namespace App\Controllers\Ctr;

use App\Controllers\BaseController;
use App\Services\DatabaseService;

class BackendPage extends BaseController
{
    protected $dbService;


    public function __construct()
    {
        $this->dbService = new DatabaseService(); 
    }

    public function index()
    {
        $session = session();
        // 取得當前管理員資料
        $curr_admin_ID =  $session->get('admin_ID');
        if ($curr_admin_ID) {
            // 編輯帳戶頁面
            $admin = $this->dbService->getWhereData('admindata',['a_ID' => $curr_admin_ID]);
            foreach($admin as $row){
                $data['a_email'] = $row['a_email'];
                $data['a_name'] = $row['a_name'];
                $data['a_username'] = $row['a_username'];
                $data['a_ID'] = $row['a_ID'];
            }

            return view('Admin/BackendPage/Backend_tags',$data)
                  .view('Admin/BackendPage/edit_account');
        }else{
            // 查無管理員資料時導至登入介面
            return redirect()->to('AdminLogin');
        }
    }

    public function ChangePassword()
    {
        return view('Admin/BackendPage/Backend_tags')
               .view('Admin/BackendPage/change_password');
    }

    public function Products()
    {
        $db = \Config\Database::connect();

        $pager = service('pager');
        $pager->setPath('/Herry/CI4.3-Herry/BackendPage/Products');
        $product_page = (int) ($this->request->getGet('page') ?? 1);
        $keyword_query = $this->request->getGet('keyword') ?? '';
        $subcategory_type = $this->request->getGet('subcategory_type') ?? '';
        $perPage = 5;
        $offset = ($product_page - 1) * $perPage;

        // 取得products join資料
        $builder = $db->table('products');
        $builder->select('products.*, subcategory.subcategoryName');
        $builder->join('subcategory','products.subcategoryID = subcategory.subcategoryID');

        if ($keyword_query) {
            $builder->like('products.sName', $keyword_query);
        }

        if ($subcategory_type) {
            if ($subcategory_type !== 'all') {
                $builder->where('products.subcategoryID', $subcategory_type);
            }
        }


        $builder->orderBy('products.sSort');
        $query = $builder->get($perPage,$offset);
        $products_data = $query->getResultArray();
        // 搜索時total資料會動態更動
        if($keyword_query || $subcategory_type){
            $builder->resetQuery();
            $builder->select('products.*, subcategory.subcategoryName');
            $builder->join('subcategory','products.subcategoryID = subcategory.subcategoryID');

            if ($keyword_query) {
                $builder->like('products.sName', $keyword_query);
            }
    
            if ($subcategory_type) {
                if ($subcategory_type !== 'all') {
                    $builder->where('products.subcategoryID', $subcategory_type);
                }
            }

            $products_total = $builder->countAllResults();

        }else{
            $products_total = $this->dbService->allDataNum('products');
        }
        $products_links = $pager->makeLinks($product_page, $perPage, $products_total,'default_full');

        // 取得類別名稱
        $subcategory_name = $db->table('subcategory')->select('subcategoryID,subcategoryName')->get()->getResultArray();

        $data = [
            'products' => $products_data,
            'products_total'=> $products_total,
            'products_links' => $products_links,
            'subcategoryNames' => $subcategory_name,
        ];
        return view('Admin/BackendPage/Backend_tags')
           .view('Admin/BackendPage/products_list',$data);

    }

    public function deleteProduct($sId)
    {
        $deleteData = $this->dbService->deleteData('products',['sID' => $sId]);
        if ($deleteData) {
            return redirect()->to('BackendPage/Products');
        }else{
            echo "刪除失敗";
        }
    }

    public function BatchUpdateProducts()
    {
        if ($this->request->getMethod() == 'post') {
            $sID_arr = $this->request->getPost('sID_arr');
            $sort_arr = $this->request->getPost('sort_arr');
            $img_arr = $this->request->getPost('img_arr');
            $name_arr = $this->request->getPost('name_arr');
            $ori_price_arr = $this->request->getPost('ori_price_arr');
            $discount_arr = $this->request->getPost('discount_arr');
            
            for ($i=0; $i < count($sID_arr); $i++) {
                $data = [
                    'sSort' => $sort_arr[$i],
                    'sIMG' => $img_arr[$i],
                    'sName' => $name_arr[$i],
                    'sOri_Price' => $ori_price_arr[$i],
                    'sDiscount' => $discount_arr[$i],
                ];
                $update_state = $this->dbService->updateData('products',['sID' => $sID_arr[$i]],$data);
            }
            echo $update_state?'更新成功':'更新失敗';
        }
    }

    public function Category()
    {
        $pager = service('pager');
        $pager->setPath('/Herry/CI4.3-Herry/BackendPage/Category');
        $category_page = (int) ($this->request->getGet('page') ?? 1);
        $perPage = 3;
        $offset = ($category_page - 1) * $perPage;
        $category_total = $this->dbService->allDataNum('category');
        $category_result = $this->dbService->getData('category',['categorySort' => 'ASC'],[$perPage => $offset]);
        $category_links = $pager->makeLinks($category_page, $perPage, $category_total,'default_full');
        if ($category_result) {
            $data = [
                'category' => $category_result,
                'category_total'=> $category_total,
                'category_links' => $category_links,
            ];
            return view('Admin/BackendPage/Backend_tags')
                  .view('Admin/BackendPage/category_list',$data);

        }else{
            echo "取得失敗";
        }
    }

    public function Subcategory()
    {
        $pager = service('pager');
        $pager->setPath('/Herry/CI4.3-Herry/BackendPage/Subcategory');
        $subcategory_page = (int) ($this->request->getGet('page') ?? 1);
        $perPage = 3;
        $offset = ($subcategory_page - 1) * $perPage;
        $subcategory_total = $this->dbService->allDataNum('subcategory');
        // 取得join資料
        $main_table = 'subcategory';
        $select = 'subcategory.*, category.categoryName';
        $join = ['category' => 'subcategory.categoryID = category.categoryID'];
        $orderBy = ['subcategorySort' => 'ASC'];
        $subcategory_result = $this->dbService->getJoinData($main_table,$select,$join,$orderBy,$perPage,$offset);
        $subcategory_links = $pager->makeLinks($subcategory_page, $perPage, $subcategory_total,'default_full');
        if ($subcategory_result) {
            $data = [
                'subcategory' => $subcategory_result,
                'subcategory_total'=> $subcategory_total,
                'subcategory_links' => $subcategory_links,
            ];
            return view('Admin/BackendPage/Backend_tags')
                  .view('Admin/BackendPage/subcategory_list',$data);

        }else{
            echo "取得失敗";
        }
        return view('Admin/BackendPage/Backend_tags')
               .view('Admin/BackendPage/subcategory_list');
    }

    public function Admin()
    {
        $pager = service('pager');
        $pager->setPath('/Herry/CI4.3-Herry/BackendPage/Admin');
        $admin_page = (int) ($this->request->getGet('page') ?? 1);
        $perPage = 5;
        $offset = ($admin_page - 1) * $perPage;
        $admin_total = $this->dbService->allDataNum('admindata');
        $admin_result = $this->dbService->getData('admindata',['a_ID' => 'DESC'],[$perPage => $offset]);
        $admin_links = $pager->makeLinks($admin_page, $perPage, $admin_total,'default_full');
        if ($admin_result) {
            $data = [
                'admins' => $admin_result,
                'admins_total' => $admin_total,
                'admins_links' => $admin_links,
            ];
            return view('Admin/BackendPage/Backend_tags')
                .view('Admin/BackendPage/admin_list',$data);
        }
    }

    public function Member()
    {
        $pager = service('pager');
        $pager->setPath('/Herry/CI4.3-Herry/BackendPage/Member');
        $member_page = (int) ($this->request->getGet('page') ?? 1);
        $perPage = 5;
        $offset = ($member_page - 1) * $perPage;
        $member_total = $this->dbService->allDataNum('memberdata');
        $member_result = $this->dbService->getData('memberdata',['m_ID' => 'DESC'],[$perPage => $offset]);
        $member_links = $pager->makeLinks($member_page, $perPage, $member_total,'default_full');
        if ($member_result) {
            $data = [
                'members' => $member_result,
                'members_total' => $member_total,
                'members_links' => $member_links,
            ];
            
            return view('Admin/BackendPage/Backend_tags')
                  .view('Admin/BackendPage/member_list',$data);
        }
    }

    public function Order()
    {
        $pager = service('pager');
        $pager->setPath('/Herry/CI4.3-Herry/BackendPage/Order');
        $order_info_page = (int) ($this->request->getGet('page') ?? 1);
        $perPage = 10;
        $offset = ($order_info_page - 1) * $perPage;
        $order_info_total = $this->dbService->allDataNum('order_info');
        // 取得join資料
        $main_table = 'order_info';
        $select = 'order_info.*, memberdata.m_username';
        $join = ['memberdata' => 'order_info.m_ID = memberdata.m_ID'];
        $orderBy = ['oi_ID' => 'DESC'];
        $order_info_result = $this->dbService->getJoinData($main_table,$select,$join,$orderBy,$perPage,$offset);
        $order_info_links = $pager->makeLinks($order_info_page, $perPage, $order_info_total,'default_full');
        if ($order_info_result) {
            $data = [
                'order_info' => $order_info_result,
                'order_info_total' => $order_info_total,
                'order_info_links' => $order_info_links,
            ];
            
            return view('Admin/BackendPage/Backend_tags')
                  .view('Admin/BackendPage/order_list',$data);
        }

    }

    public function Update()
    {
        $session = session();

        if ($this->request->getMethod() === 'post') {
            $a_ID = $this->request->getPost('a_ID');
            $username = $this->request->getPost('a_username');
            $email = $this->request->getPost('a_email');
            $name = $this->request->getPost('a_name');
            $data = [
                'a_email' => $email,
                'a_name' => $name,
                'a_username' => $username,
            ];
            $updateState = $this->dbService->updateData('admindata',['a_ID' => $a_ID],$data);
            if ($updateState) {
                // 更新成功
                session()->setFlashdata('update_msg', 'success');
                return redirect()->to('BackendPage');
            }else{
                // 更新失敗
                session()->setFlashdata('update_msg', 'error');
                return redirect()->to('BackendPage');
            }
        }else{
            echo '尚未收到請求';
        }
    }

    public function UpdatePassword()
    {
        $session = session();

        if ($this->request->getMethod() === 'post') {
            $admin_ID = $this->request->getPost('current_user');
            $old_password = $this->request->getPost('old_password');
            $new_password = $this->request->getPost('new_password');
            $new_pwdCheck = $this->request->getPost('new_pwdCheck');
            // 取得資料表密碼
            $query_result = $this->dbService->getWhereData('admindata',['a_ID' => $admin_ID]);
            foreach($query_result as $item){
                $correct_pwd = $item['a_password'];
            }
            echo $correct_pwd;
            // 新密碼不能輸入空白、單引號與雙引號
            $PasswordValid = !preg_match('/[\s"\'\\\\]/', $new_password);
            // 判斷錯誤情況
            if(!password_verify($old_password, $correct_pwd)){
                session()->setFlashdata('error_msg', '密碼輸入錯誤!');
                return redirect()->to('BackendPage/ChangePassword');
            }elseif($new_password !== $new_pwdCheck){
                session()->setFlashdata('error_msg', '密碼不一致!');
                return redirect()->to('BackendPage/ChangePassword');
            }elseif (!$PasswordValid) {
                session()->setFlashdata('error_msg', '新密碼無效：請勿輸入空格、單引號與雙引號!');
                return redirect()->to('BackendPage/ChangePassword');
            }else{
                $hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);
                $data = [
                    'a_password' => $hashedPassword,
                ];
                $updatePwdState = $this->dbService->updateData('admindata',['a_ID' => $admin_ID],$data);
                if ($updatePwdState) {
                    return redirect()->to('AdminLogin');
                }
            }
        }
    }

    public function OrderDetail($oi_ID)
    {
        $data['oi_ID'] = $oi_ID;
        // 取order_detail table資料
        $main_table = 'order_detail';
        $select = 'order_detail.*,products.sIMG,products.sName';
        $join = ['products' => 'order_detail.sID = products.sID'];
        $orderBy = [];
        $perPage = null;
        $offset = null;
        $where = ['order_id' => $oi_ID];
        $order_detail_result = $this->dbService->getJoinData($main_table,$select,$join,$orderBy,$perPage,$offset,$where);
        if ($order_detail_result) {
            $data['order_detail'] = $order_detail_result;
        }

        // 取order_info table資料
        $order_info_result = $this->dbService->getWhereData('order_info',['oi_ID' => $oi_ID]);
        if ($order_info_result) {
            $data['order_info'] = $order_info_result;
        }
        return view('Admin/BackendPage/BackendPage_order_detail',$data);
    }

    public function UpdateOrderState(){
        if ($this->request->getMethod() == 'post') {
            if (isset($_POST['oi_ID'])) {
                $oi_ID_arr[] = $this->request->getPost('oi_ID');
            }else{
                $oi_ID_arr = $this->request->getPost('oi_ID_arr');
            }
            $order_state = $this->request->getPost('order_state');
            for ($i=0; $i < count($oi_ID_arr); $i++) { 
                $data = [
                    'order_state' => $order_state,
                ];
                $update_result = $this->dbService->updateData('order_info',['oi_ID' => $oi_ID_arr[$i]],$data);
            }

            if (isset($_POST['oi_ID'])) {
                return redirect()->to("BackendPage/Order");
            }else{
                echo '修改完成!';
            }
            
        }
    }

    public function DeleteOrder($oi_ID)
    {
        $delete_order_info = $this->dbService->deleteData('order_info',['oi_ID' => $oi_ID]);
        $delete_order_detail = $this->dbService->deleteData('order_detail',['order_id' => $oi_ID]);
        if ($delete_order_info && $delete_order_detail) {
            return redirect()->to("BackendPage/Order");
        }

    }
    
    
}
?>