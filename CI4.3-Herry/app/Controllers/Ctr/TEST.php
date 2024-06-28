<?php

namespace App\Controllers\Ctr;

use App\Controllers\BaseController;
use App\Models\AdminModel;

class TEST extends BaseController
{
    public function index()
    {
        // 分頁效果
        $model = model(AdminModel::class);
        $page = 2;


        $data = [
            'admins' => $model->paginate(5,'group',$page),
            'pager' => $model->pager,
        ];
        return view("Admin/adminList",$data);
    }
    
}
?>
