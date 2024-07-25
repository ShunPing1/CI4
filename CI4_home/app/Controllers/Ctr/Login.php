<?php

namespace App\Controllers\Ctr;
use App\Controllers\BaseController;

class Login extends BaseController
{

    public function __construct()
    {
        $this->session = \Config\Services::session();
    }

    public function index(): string
    {
        return view('Pages/loginPage');
    }

    public function receive()
    {   

        if ($_POST) {
            
            $username = $_POST['username'];

            $db = \Config\Database::connect();
            $builder = $db->table('memberdata');
            $builder->select('m_username');
            $builder->where('m_username',$username);
            $query = $builder->get();
            $products_result = $query->getResultArray();
            foreach($products_result as $item){
                $result = $item['m_username'];
            }

            if ($products_result) {
                // echo '登入成功';
                $rememberme = $this->request->getPost('remember');
                if ($rememberme) {
                    // echo "以勾選";
                    $this->response->setCookie('username', $result, 3600);
                }else{
                    $this->response->deleteCookie('username');
                }
                // 將username保存到Session
                $this->session->set('username', $username);
                $data = [
                    'username' => $username
                ];
                return view('Pages/userpage', $data);
            }else{
                echo '登入失敗';
            }


        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return view('Pages/loginPage');
    }
}
