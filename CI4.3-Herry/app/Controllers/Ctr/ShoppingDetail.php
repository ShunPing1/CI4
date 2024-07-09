<?php

namespace App\Controllers\Ctr;

use App\Controllers\BaseController;
use App\Services\DatabaseService;

class ShoppingDetail extends BaseController
{
    protected $dbService;

    public function __construct()
    {
        $this->dbService = new DatabaseService(); 
    }

    public function index($sId,string $page = 'shopping_detail')
    {
        // 檢查檔案是否存在，若是不存在就拋出PageNotFoundException異常
        if (! is_file(APPPATH . 'Views/Member/' . $page . '.php')) {
            throw new PageNotFoundException($page);
        }

        $products = $this->dbService->getWhereData('products',['sID' => $sId]);
        $data=[];
        foreach($products as $row){
            $data['sID'] = $row['sID'];
            $data['categoryID'] = $row['categoryID'];
            $data['subcategoryID'] = $row['subcategoryID'];
            $data['sSort'] = $row['sSort'];
            $data['sIMG'] = $row['sIMG'];
            $data['sName'] = $row['sName'];
            $data['sOri_Price'] = $row['sOri_Price'];
            $data['sDiscount'] = $row['sDiscount'];
            $data['sNarrate'] = $row['sNarrate'];
            $data['sContent1'] = $row['sContent1'];
            $data['sContent2'] = $row['sContent2'];
            $data['sContent3'] = $row['sContent3'];
        }

        // 取得類別
        $data['category'] = $this->dbService->getCategory();
        // 取得項目
        $data['subcategory'] = $this->dbService->getSubcategory();
        // 會員登入版
        $session = session();
        if ($session->has('member_username')) {
            $m_username = $session->get('member_username');
            $favourite_result = $this->dbService->getWhereData('favourite',['m_username' => $m_username]);
            if ($favourite_result) {
                $data['favourite'] = $favourite_result;
            }
        }

        return view('Member/header',$data)
            . view('Member/' . $page)
            . view('Member/footer');
    }

    public function cartInsert()
    {
        
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $sc_img = $this->request->getPost('sc_img');
            $sc_name = $this->request->getPost('sc_name');
            $sc_format = $this->request->getPost('sc_format');
            $sc_price = $this->request->getPost('sc_price');
            $sc_amount = $this->request->getPost('sc_amount');
            $m_username = $this->request->getPost('m_username');
            $sID = $this->request->getPost('addCart_productId');
            
            $data = [
                'sc_IMG' => $sc_img,
                'sc_name' => $sc_name,
                'sc_format' => $sc_format,
                'sc_discount' => $sc_price,
                'sc_amount' => $sc_amount,
                'm_username' => $m_username,
                'sID' => $sID,
            ];
            $insert_cart = $this->dbService->insertData('shopping_cart',$data);
            if ($insert_cart) {
                // 更新購物車session
                echo "新增成功";
                $cart_total = $this->dbService->limitDataNum('shopping_cart',['m_username' => $m_username]);
                $session->set('cart_amount',$cart_total);
            }
        }
    }
    
}