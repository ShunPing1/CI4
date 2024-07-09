<?php

namespace App\Controllers\Ctr;

use App\Controllers\BaseController;
use App\Services\DatabaseService;

class TEST extends BaseController
{
    protected $dbService;

    public function __construct()
    {
        $this->dbService = new DatabaseService(); 
    }

    public function index()
    {
        $data['admins'] = $this->dbService->getAdmindata();
        return view('TEST/test_top')
               .view('TEST/adminPage',$data)
               .view('TEST/test_bottom');
    }

    public function member()
    {
        $data['members'] = $this->dbService->getMemberdata();
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
            $data['admins'] = $this->dbService->getAdmindata($keyword);
            return view('TEST/test_top')
                   .view('TEST/adminPage',$data)
                   .view('TEST/test_bottom');

        }
    }

    
}
?>
