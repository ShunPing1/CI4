<?php

namespace App\Controllers\Ctr;

use App\Controllers\BaseController;

class TEST extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('admindata');
        $builder->select('admindata.*');
        $query = $builder->get();
        $data['admins'] = $query->getResultArray();
        return view('TEST/test_top')
               .view('TEST/adminPage',$data)
               .view('TEST/test_bottom');
    }

    public function member()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('memberdata');
        $builder->select('memberdata.*');
        $query = $builder->get();
        $data['members'] = $query->getResultArray();
        return view('TEST/test_top')
        .view('TEST/memberPage',$data)
        .view('TEST/test_bottom');
    }

    public function category()
    {
        return view('TEST/test_top')
        .view('TEST/category')
        .view('TEST/test_bottom');
    }

    public function SearchAdmin()
    {
        if (isset($_GET)) {
            $keyword = $_GET['keyword'];
            $db = \Config\Database::connect();
            $builder = $db->table('admindata');
            $builder->select('admindata.*');
            $builder->like('a_username',$keyword);
            $query = $builder->get();
            $data['admins'] = $query->getResultArray();
            return view('TEST/test_top')
                   .view('TEST/adminPage',$data)
                   .view('TEST/test_bottom');

        }
    }
    
}
?>
