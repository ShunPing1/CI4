<?php

namespace App\Controllers;
use App\Controllers\BaseController;

class Load_page extends BaseController
{
    public function Home()
    {
        echo view('Home');
    }

    public function hello()
    {
        echo 'hello';
    }

    public function get_shopping_cart()
    {
        echo view('cart_list');
    }

    public function get_upload_page()
    {
        echo view('upload_img');
    }

    public function save_img(){
        if (!$this->request->getMethod('Post')) die('操作錯誤');
        $file = $this->request->getFile('file');
        $file_name = $this->request->getPost('file');
        // $newName = $file->getRandomName();
        $file->move(WRITEPATH . 'uploads', $file_name);
        return redirect()->to(base_url('Load_page/get_upload_page'))->with('success', 'File has been uploaded');
    }
}
