<?php

namespace App\Controllers;
use App\Controllers\BaseController;

class Welcome extends BaseController
{
    public function index()
    {
        echo view('welcome_message');
    }

    public function hello()
    {
        echo 'hello';
    }
}
