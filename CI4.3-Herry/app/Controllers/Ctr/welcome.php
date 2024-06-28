<?php

namespace App\Controllers\Ctr;

use App\Controllers\BaseController;

class Welcome extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    }
}
