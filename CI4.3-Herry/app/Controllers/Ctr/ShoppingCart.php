<?php

namespace App\Controllers\Ctr;

use App\Controllers\BaseController;
use App\Services\DatabaseService;

class ShoppingCart extends BaseController
{
    protected $dbService;

    public function __construct()
    {
        $this->dbService = new DatabaseService(); 
    }

    public function index()
    {
        $session = session();
        $current_user = $session->get('member_username');
        $cart_quantity = $this->dbService->limitDataNum('shopping_cart',['m_username' => $current_user]);
        $cart_result = $this->dbService->getWhereData('shopping_cart',['m_username' => $current_user]);
        if ($cart_result) {
            $data=[
                'carts' => $cart_result,
                'carts_amount' => $cart_quantity,
            ];
            return view('Member/header',$data)
            .view('Member/shopping_cart')
            .view('Member/footer');
        }else{
            // 如果select結果為空值導向ShoppinStore
            return redirect()->to('ShoppingStore');
        }

    }

    public function delete()
    {
        echo "刪除效果";
        if($this->request->getMethod() == 'post'){
            $sc_ID = $this->request->getPost('Delete_cart_Id');
            echo $sc_ID;
            $delete_cart = $this->dbService->deleteData('shopping_cart',['sc_ID' => $sc_ID]);
        }
    }
    
}