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
        return view('Member/header')
            . view('Member/MemberCenter/member_center_tags')
            . view('Member/MemberCenter/member_center_order')
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