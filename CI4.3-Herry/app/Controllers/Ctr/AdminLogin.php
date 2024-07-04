<?php

namespace App\Controllers\Ctr;

use App\Controllers\BaseController;
use App\Services\DatabaseService;

class AdminLogin extends BaseController
{
    protected $dbService;
    protected $page;

    public function __construct()
    {
        $this->dbService = new DatabaseService(); 
        $this->page = 'admin_login'; 
    }

    public function index()
    {
        // 檢查檔案是否存在，若是不存在就拋出PageNotFoundException異常
        if (! is_file(APPPATH . 'Views/Admin/' . $this->page . '.php')) {
            throw new PageNotFoundException($this->page);
        }

        return view('Admin/' . $this->page);
    }

    public function Login()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        // 取得使用者密碼
        $user = $this->dbService->getWhereData('admindata',['a_username' => $username]);
        foreach($user as $item){
            $correct_username = $item['a_username'];
            $correct_password = $item['a_password'];
        }
        if ($user && password_verify($password, $correct_password)) {
            $session = session();
            $session->set('username', $correct_username);
            return redirect()->to('BackendPage');

        }else{
            session()->setFlashdata('msg', 'error');
            return redirect()->to('AdminLogin');
            
        }
        
    }

    public function Logout()
    {
        $session = session();
        // 登出時清除資料
        $session->remove('username');
        return redirect()->to('AdminLogin');
    }
    
}