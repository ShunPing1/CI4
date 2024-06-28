<?php

namespace App\Controllers\Ctr;

use App\Controllers\BaseController;

class Home extends BaseController
{
    public function view(string $page = 'home')
    {
        if (! is_file(APPPATH . 'Views/ctr/' . $page . '.php')) {
            throw new PageNotFoundException($page);
        }

        //創建一個索引值為title的data陣列存放手字大寫的$page變數
        $data['title'] = ucfirst($page);

        return view('templates/header', $data)
            . view('ctr/' . $page)
            . view('templates/footer');
    }
    
}
