<?php

namespace App\Controllers\Ctr;

use App\Controllers\BaseController;
use App\Services\DatabaseService;

class MemberCenter extends BaseController
{
    protected $dbService;

    public function __construct()
    {
        $this->dbService = new DatabaseService(); 
    }

    public function index()
    {

        $session = session();
        // 取得當前會員資料
        $curr_username =  $session->get('member_username');
        if ($curr_username) {

            $member = $this->dbService->getWhereData('memberdata',['m_username' => $curr_username]);
            $data=[];
            foreach($member as $row){
                $data['email'] = $row['m_email'];
                $data['name'] = $row['m_name'];
                $data['sex'] = $row['m_sex'];
                $data['birthday'] = $row['m_birthday'];
                $data['phone'] = $row['m_phone'];
                $data['address'] = $row['m_address'];
            }


            return view('Member/header',$data)
                . view('Member/MemberCenter/member_center_tags')
                . view('Member/MemberCenter/member_center_basicInfo')
                . view('Member/footer');

            }else{
            return redirect()->to('MemberLogin');
        }
    }
    
    public function ChangePassword()
    {

        return view('Member/header')
            . view('Member/MemberCenter/member_center_tags')
            . view('Member/MemberCenter/member_center_changePwd')
            . view('Member/footer');

    }

    public function MyFavourite()
    {
        $session = session();
        $curr_username =  $session->get('member_username');
        $pager = service('pager');
        $pager->setPath('/Herry/CI4.3-Herry/MemberCenter/MyFavourite');
        $favourite_page = (int) ($this->request->getGet('page') ?? 1);
        $perPage = 6;
        $offset = ($favourite_page - 1) * $perPage;
        $favourite_total = $this->dbService->limitDataNum('favourite',['m_username' => $curr_username]);
        // 取得最愛資料
        $main_table = 'favourite';
        $select = 'favourite.*, products.*';
        $join = ['products' => 'favourite.sID = products.sID'];
        $where = ['m_username' => $curr_username];
        $orderBy = ['f_ID' => 'ASC'];
        $favourite_result = $this->dbService->getJoinData($main_table,$select,$join,$orderBy,$perPage,$offset,$where);
        $favourite_links = $pager->makeLinks($favourite_page, $perPage, $favourite_total,'default_full');

        if ($favourite_result) {
            $data = [
                'favourite' =>  $favourite_result,
                'favourite_total' => $favourite_total,
                'favourite_links' => $favourite_links
            ];
            return view('Member/header')
            . view('Member/MemberCenter/member_center_tags')
            . view('Member/MemberCenter/member_center_favourite',$data)
            . view('Member/footer');
        }else{
            return view('Member/header')
            . view('Member/MemberCenter/member_center_tags')
            . view('Member/MemberCenter/member_center_favourite')
            . view('Member/footer');
        }

    }

    public function FavouriteState(){
        if($this->request->getMethod() == 'post'){
            $username = $this->request->getPost('memberRecord');
            $products_ID = $this->request->getPost('getProductsID');
            $favourite_state = $this->request->getPost('favouriteState');

            // 根據狀態進行新增予刪除
            if ($favourite_state == 'true') {
                $data = [
                    'm_username' => $username,
                    'sID' => $products_ID
                ];
                $add_favourite = $this->dbService->insertData('favourite',$data);
                echo $add_favourite?'新增成功':'新增失敗';
                
            }else{
                $delete_favourite = $this->dbService->deleteData('favourite',['sID' => $products_ID]);
                echo $delete_favourite?'刪除成功':'刪除失敗';
            }
        }
    }

    public function MyOrder()
    {
        $session = session();
        $curr_username =  $session->get('member_username');
        // 取得m_ID
        $mID_result = $this->dbService->getWhereData('memberdata',['m_username' => $curr_username]);
        if ($mID_result) {
            foreach($mID_result as $item){
                $m_ID = $item['m_ID'];
            }
        }
        // 取得訂單資料
        $db = \Config\Database::connect(); 
        $builder = $db->table('order_info');
        $builder->select('order_info.*, order_detail.*, products.sIMG, products.sName');
        $builder->join('order_detail', 'order_info.oi_ID = order_detail.order_id', 'left');
        $builder->join('products', 'order_detail.sID = products.sID', 'left');
        $builder->where('m_ID', $m_ID);  // 假設使用者ID是12
        $builder->orderBy('oi_ID','DESC');
        $query = $builder->get();
        $result = $query->getResultArray();

        // 整理數據結構
        $orders = [];
        foreach ($result as $row) {
            $orderId = $row['oi_ID'];
            if (!isset($orders[$orderId])) {
                $orders[$orderId] = [
                    'order_info' => [
                        'oi_ID' => $row['oi_ID'],
                        'm_ID' => $row['m_ID'],
                        'total_price' => $row['total_price'],
                        'order_state' => $row['order_state'],
                        'buy_time' => $row['buy_time'],
                        'send_method' => $row['send_method'],
                        'buyer_name' => $row['buyer_name'],
                        'buyer_phone' => $row['buyer_phone'],
                        'buyer_email' => $row['buyer_email'],
                        'buyer_postal' => $row['buyer_postal'],
                        'buyer_addr' => $row['buyer_addr'],
                        'pay_method' => $row['pay_method'],
                    ],
                    'order_details' => []
                ];
            }
            $orders[$orderId]['order_details'][] = [
                'od_id' => $row['od_id'],
                'sID' => $row['sID'],
                'od_price' => $row['od_price'],
                'od_quantity' => $row['od_quantity'],
                'od_format' => $row['od_format'],
                'sIMG' => $row['sIMG'],
                'sName' => $row['sName'],
            ];
        }
        $data['orders'] = $orders;


        
        $order_amount = $this->dbService->limitDataNum('order_info',['m_ID' => $m_ID]);
        $data['order_amount'] = $order_amount;
        return view('Member/header')
        . view('Member/MemberCenter/member_center_tags')
        . view('Member/MemberCenter/member_center_order',$data)
        . view('Member/footer');


    }

    public function Update()
    {
        $session = session();

        if ($this->request->getMethod() === 'post') {
            $username = $this->request->getPost('current_user');
            $email = $this->request->getPost('m_email');
            $name = $this->request->getPost('m_name');
            $sex = $this->request->getPost('m_sex');
            $birthday = $this->request->getPost('m_birthday');
            $phone = $this->request->getPost('m_phone');
            $address = $this->request->getPost('m_address');
            $data = [
                'm_email' => $email,
                'm_name' => $name,
                'm_sex' => $sex,
                'm_birthday' => $birthday,
                'm_phone' => $phone,
                'm_address' => $address,
            ];
            $updateState = $this->dbService->updateData('memberdata',['m_username' => $username],$data);
            if ($updateState) {
                echo 'updata success';
                session()->setFlashdata('update_msg', 'success');
                return redirect()->to('MemberCenter');
            }else{
                echo 'updata failed';
                session()->setFlashdata('update_msg', 'error');
                return redirect()->to('MemberCenter');
            }
        }else{
            echo '尚未收到請求';
        }
    }

    public function UpdatePassword()
    {
        $session = session();

        if ($this->request->getMethod() === 'post') {
            $username = $this->request->getPost('current_user');
            $old_password = $this->request->getPost('old_password');
            $new_password = $this->request->getPost('new_password');
            $new_pwdCheck = $this->request->getPost('new_pwdCheck');
            // 取得資料表密碼
            $query_result = $this->dbService->getWhereData('memberdata',['m_username' => $username]);
            foreach($query_result as $item){
                $correct_pwd = $item['m_password'];
            }
            // 新密碼不能輸入空白、單引號與雙引號
            $PasswordValid = !preg_match('/[\s"\'\\\\]/', $new_password);
            // 判斷錯誤情況
            if(!password_verify($old_password, $correct_pwd)){
                session()->setFlashdata('error_msg', '密碼輸入錯誤!');
                return redirect()->to('MemberCenter/ChangePassword');
            }elseif($new_password !== $new_pwdCheck){
                session()->setFlashdata('error_msg', '密碼不一致!');
                return redirect()->to('MemberCenter/ChangePassword');
            }elseif (!$PasswordValid) {
                session()->setFlashdata('error_msg', '新密碼無效：請勿輸入空格、單引號與雙引號!');
                return redirect()->to('MemberCenter/ChangePassword');
            }else{
                $hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);
                $data = [
                    'm_password' => $hashedPassword,
                ];
                $updatePwdState = $this->dbService->updateData('memberdata',['m_username' => $username],$data);
                if ($updatePwdState) {
                    return redirect()->to('MemberLogin');
                }
            }
        }
    }



    
}