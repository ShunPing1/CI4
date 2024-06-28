<?php

namespace App\Controllers\Ctr;

use App\Controllers\BaseController;

class About extends BaseController
{
    public function view(string $page = 'about')
    {
        if (! is_file(APPPATH . 'Views/ctr/' . $page . '.php')) {
            throw new PageNotFoundException($page);
        }

        //創建一個索引值為title的data陣列存放手字大寫的$page變數
        $data['title'] = ucfirst($page);
        $data['content'] = ucfirst($page).'內容';

        return view('templates/header', $data)
            . view('ctr/' . $page)
            . view('templates/footer');
    }
    
}
