<?php

namespace App\Controllers\Ctr;

use App\Controllers\BaseController;
use App\Services\DatabaseService;

class AdminJoin extends BaseController
{
    protected $dbService;
    protected $page;

    public function __construct()
    {
        $this->dbService = new DatabaseService(); 
        $this->page = 'admin_join'; 
    }

    public function index()
    {
        // 檢查檔案是否存在，若是不存在就拋出PageNotFoundException異常
        if (! is_file(APPPATH . 'Views/Admin/' . $this->page . '.php')) {
            throw new PageNotFoundException($this->page);
        }

        return view('Admin/' . $this->page);
    }

    public function Join()
    {
        $username = $this->request->getPost('a_username');
        $password = $this->request->getPost('a_password');
        $email = $this->request->getPost('a_email');
        $name = $this->request->getPost('a_name');
        $join_time = date('Y-m-d H:i:s');
        $user = $this->dbService->getWhereData('admindata',['a_username' => $username]);
        foreach($user as $item){
            $data_username = $item['a_username'];
        }

        // 判斷使用者是否已經註冊
        if (isset($data_username)) {
            echo '使用者已存在';
            session()->setFlashdata('msg', 'error');
            return redirect()->to('AdminJoin');
        }else{

            // 密碼加密
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $insert_arr = [
                'a_username' => $username,
                'a_password' => $hashedPassword,
                'a_email' => $email,
                'a_name' => $name,
                'a_jointime' => $join_time
            ];
            $insertState = $this->dbService->insertData('admindata',$insert_arr);
            if ($insertState) {
                session()->setFlashdata('msg', 'success');
                return redirect()->to('AdminJoin');
            }else{
                echo '註冊失敗';
            }
        }
    }

    
}