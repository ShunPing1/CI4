<?php

namespace App\Controllers\Ctr;

use App\Controllers\BaseController;
use App\Services\DatabaseService;

class MemberJoin extends BaseController
{
    protected $dbService;
    protected $page;

    public function __construct()
    {
        $this->dbService = new DatabaseService(); 
        $this->page = 'member_join'; 
    }

    public function index()
    {
        // 檢查檔案是否存在，若是不存在就拋出PageNotFoundException異常
        if (! is_file(APPPATH . 'Views/Member/' . $this->page . '.php')) {
            throw new PageNotFoundException($this->page);
        }

        return view('Member/' . $this->page);
    }

    public function Join()
    {
        $username = $this->request->getPost('m_username');
        $password = $this->request->getPost('m_password');
        $email = $this->request->getPost('m_email');
        $name = $this->request->getPost('m_name');
        $sex = $this->request->getPost('m_sex');
        $birthday = $this->request->getPost('m_birthday');
        $phone = $this->request->getPost('m_phone');
        $address = $this->request->getPost('m_address');
        $join_time = date('Y-m-d H:i:s');
        $user = $this->dbService->getWhereData('memberdata',['m_username' => $username]);
        foreach($user as $item){
            $data_username = $item['m_username'];
        }

        // 判斷使用者是否已經註冊
        if (isset($data_username)) {
            echo '使用者已存在';
            session()->setFlashdata('msg', 'error');
            return redirect()->to('MemberJoin');
        }else{

            // 密碼加密
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $insert_arr = [
                'm_username' => $username,
                'm_password' => $hashedPassword,
                'm_email' => $email,
                'm_name' => $name,
                'm_sex' => $sex,
                'm_birthday' => $birthday,
                'm_phone' => $phone,
                'm_address' => $address,
                'm_jointime' => $join_time
            ];
            $insertState = $this->dbService->insertData('memberdata',$insert_arr);
            if ($insertState) {
                session()->setFlashdata('msg', 'success');
                return redirect()->to('MemberJoin');
            }else{
                echo '註冊失敗';
            }
        }
    }

    
}