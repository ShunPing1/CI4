<?php

namespace App\Controllers\Ctr;

use App\Controllers\BaseController;
use App\Services\DatabaseService;

class MemberLogin extends BaseController
{
    protected $dbService;
    protected $page;

    public function __construct()
    {
        $this->dbService = new DatabaseService(); 
        $this->page = 'member_login'; 
    }

    public function index()
    {
        // 檢查檔案是否存在，若是不存在就拋出PageNotFoundException異常
        if (! is_file(APPPATH . 'Views/Member/' . $this->page . '.php')) {
            throw new PageNotFoundException($this->page);
        }

        return view('Member/' . $this->page);
    }

    public function Login()
    {
        
        $session = session();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        // 取得使用者密碼
        $user = $this->dbService->getWhereData('memberdata',['m_username' => $username]);
        foreach($user as $item){
            $correct_username = $item['m_username'];
            $correct_password = $item['m_password'];
        }

        if ($user && password_verify($password, $correct_password)) {

            // 記住帳號密碼
            $rememberState = $this->request->getPost('rememberme');
            if ($rememberState) {
                echo '已勾選';
                $this->response->setCookie('remember_username', $correct_username, 3600);
                $this->response->setCookie('remember_password', $password, 3600);
            }else{
                echo '未勾選';
                if ($this->request->getCookie('remember_username')) {
                    $this->response->deleteCookie('remember_username');
                }
                if ($this->request->getCookie('remember_password')) {
                    $this->response->deleteCookie('remember_password');
                }
            }
            
            $session->set('member_username', $correct_username);
            // 註解時cookie正常
            return redirect()->to('ShoppingStore');
        }else{
            session()->setFlashdata('msg', 'error');
            return redirect()->to('MemberLogin');
            
        }
        
    }

    public function Logout()
    {
        $session = session();
        // 登出時清除資料
        $session->remove('member_username');
        return redirect()->to('MemberLogin');
    }
    
}