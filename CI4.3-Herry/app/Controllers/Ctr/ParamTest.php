<?php

namespace App\Controllers\Ctr;

use App\Controllers\BaseController;

class ParamTest extends BaseController
{
    //使用固定參數列表
    public function test(...$params)
    {

        for ($i=0; $i < count($params); $i++) { 
            # code...
        }
        $data['title'] = $params[0];


        return view('templates/header', $data)
            . view('ctr/test')
            . view('templates/footer');
    }
    // 搭配Routes設置(:any)達成可變動參數長度
    public function test2(...$params)
    {
        echo $params[0].'<br />' ?? null;
        echo $params[1].'<br />' ?? null;
        echo $params[2].'<br />' ?? null;
    }
    
}
