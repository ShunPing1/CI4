<?php

namespace App\Controllers;

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

            // 將username保存到Session
            $this->session->set('username', $username);

            $data = [
                'username' => $username
            ];

            return view('Pages/userpage', $data);
        }
    }
}
