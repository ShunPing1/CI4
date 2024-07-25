<?php

namespace App\Controllers;
use App\Controllers\BaseController;

class Load_page extends BaseController
{
    public function Home()
    {
        echo view('Home');
    }

    public function hello()
    {
        echo 'hello';
    }

    public function get_shopping_cart()
    {
        echo view('cart_list');
    }
}
