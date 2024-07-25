<?php

namespace App\Controllers\Ctr;
use App\Controllers\BaseController;

class ShowAdmin extends BaseController
{
    public function index()
    {
        echo view('Admin/show_admin');
    }
}
