<?php

namespace App\Controllers\Ctr;
use App\Controllers\BaseController;

class Banner extends BaseController
{
    var $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $data['banner'] = $this->db->table('banner')->orderBy('banner_id')->get(1)->getResultArray();
        
        // echo view('ctr/head');
        // echo view('ctr/banner');
        // echo view('ctr/footer');
    }

    public function InsertBanner()
    {
        if (!$this->request->getMethod() == 'post') die('操做失誤');
        $img_path = $this->request->getPost('img');

        $builder = $this->db->table('banner');
        $data = [
            'banner_img' => $img_path,
        ];
        $builder->insert($data);
        return redirect()->to('Ctr/Banner');
    

    }
}
