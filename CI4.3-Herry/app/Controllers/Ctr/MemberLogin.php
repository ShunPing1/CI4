<?php

namespace App\Controllers\Ctr;

use App\Controllers\BaseController;

class MemberLogin extends BaseController
{
    public function index(string $page = 'member_login')
    {
        // 檢查檔案是否存在，若是不存在就拋出PageNotFoundException異常
        if (! is_file(APPPATH . 'Views/Member/' . $page . '.php')) {
            throw new PageNotFoundException($page);
        }

        return view('Member/' . $page);
    }
    
}