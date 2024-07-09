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




            
    


    //         // 訂單分頁
    //         $order_page = (int) ($this->request->getGet('page') ?? 1);
    //         $perPage = 10;
    //         $offset = ($order_page - 1) * $perPage;
    //         $total = $db->table('order_info')->countAll();
    //         $builder = $db->table('order_info');
    //         $builder->select('order_info.*, memberdata.m_username');
    //         $builder->join('memberdata', 'order_info.m_ID = memberdata.m_ID');
    //         $query = $builder->get($perPage,$offset);
    //         $builder->orderBy('oi_ID', 'DESC');
    //         $order_info_result = $query->getResultArray();
    //         $order_info_links = $pager->makeLinks($order_page, $perPage, $total,'default_full');
    //         $data['order_info'] = $order_info_result;
    //         $data['order_info_total'] = $total;
    //         $data['order_info_links'] = $order_info_links;



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
        $pager = service('pager');
        $pager->setPath('/Herry/CI4.3-Herry/BackendPage/Products');
        $product_page = (int) ($this->request->getGet('page') ?? 1);
        $perPage = 5;
        $offset = ($product_page - 1) * $perPage;
        $products_total = $this->dbService->allDataNum('products');
        // 取得join資料
        $main_table = 'products';
        $select = 'products.*, subcategory.subcategoryName';
        $join = ['subcategory' => 'products.subcategoryID = subcategory.subcategoryID'];
        $orderBy = ['sSort' => 'ASC'];
        $products_data = $this->dbService->getJoinData($main_table,$select,$join,$orderBy,$perPage,$offset);
        $products_links = $pager->makeLinks($product_page, $perPage, $products_total,'default_full');

        if ($products_data) {
            $data = [
                'products' => $products_data,
                'products_total'=> $products_total,
                'products_links' => $products_links,
            ];
            return view('Admin/BackendPage/Backend_tags')
               .view('Admin/BackendPage/products_list',$data);
        }else{
            echo '取得失敗';
        }

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

    

    
    
}
?>