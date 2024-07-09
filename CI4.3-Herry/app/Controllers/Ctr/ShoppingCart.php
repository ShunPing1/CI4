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
        $cart_result = $this->dbService->getWhereData('shopping_cart',['m_username' => $current_user]);
        $member_result = $this->dbService->getWhereData('memberdata',['m_username' => $current_user]);
        if ($cart_result && $member_result) {
            $data=[
                'carts' => $cart_result,
                'member_info' => $member_result,
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

        if($this->request->getMethod() == 'post'){
            $sc_ID = $this->request->getPost('Delete_cart_Id');
            $delete_cart = $this->dbService->deleteData('shopping_cart',['sc_ID' => $sc_ID]);

            // 更新購物車session
            $session = session();
            $curr_user = $session->get('member_username');
            $cart_total = $this->dbService->limitDataNum('shopping_cart',['m_username' => $curr_user]);
            echo $cart_total;
            $session->set('cart_amount',$cart_total);
        }
    }

    public function Insert()
    {
        $session = session();
        $curr_user = $session->get('member_username');

        if($this->request->getMethod() == 'post'){
            // 取得m_ID
            $mID_select = $this->dbService->getWhereData('memberdata',['m_username' => $curr_user]);
            if ($mID_select) {
                foreach($mID_select as $item){
                    $m_ID = $item['m_ID'];
                }
            }
            // 新增至order_info
            $total_price = $this->request->getPost('total_price');
            $order_state = $this->request->getPost('order_state');
            $buy_time = date('Y-m-d H:i:s');
            $send_method = $this->request->getPost('sendMethod');
            $buyer_name = $this->request->getPost('name');
            $buyer_phone = $this->request->getPost('phone');
            $buyer_email = $this->request->getPost('email');
            $buyer_postal = $this->request->getPost('postal');
            $buyer_addr = $this->request->getPost('addr');
            $pay_method = $this->request->getPost('payMethod');
            $data_arr = [
                'm_ID' => $m_ID,
                'total_price' => $total_price,
                'order_state' => $order_state,
                'buy_time' => $buy_time,
                'send_method' => $send_method,
                'buyer_name' => $buyer_name,
                'buyer_phone' => $buyer_phone,
                'buyer_email' => $buyer_email,
                'buyer_postal' => $buyer_postal,
                'buyer_addr' => $buyer_addr,
                'pay_method' => $pay_method,
            ];
            $insert_result = $this->dbService->insertData('order_info',$data_arr);
            if ($insert_result) {
                // 新增成功後取得最後一筆資料
                $getLastOrder = $this->dbService->getData('order_info',['oi_ID' => 'ASC']);
                if ($getLastOrder) {
                    foreach($getLastOrder as $item){
                        $last_ID = $item['oi_ID'];
                    }
                }
            }
            // 新增至order_detail
            $sID_arr = $this->request->getPost('sID_arr');
            $format_arr = $this->request->getPost('format_arr');
            $amount_arr = $this->request->getPost('amount_arr');
            $price_arr = $this->request->getPost('price_arr');
            for ($i=0; $i < count($sID_arr); $i++) { 
                $detail_arr = [
                    'sID' => $sID_arr[$i],
                    'od_price' => $price_arr[$i],
                    'od_quantity' => $amount_arr[$i],
                    'od_format' => $format_arr[$i],
                    'order_id' => $last_ID,
                ];
                $insert_detail = $this->dbService->insertData('order_detail',$detail_arr);
            }
            if ($insert_detail) {
                // 回應前端並導向指定介面
                $response = [
                    'status' => 'success',
                    'redirect' => base_url('ShoppingStore'),
                ];
                return $this->response->setJSON($response);
            }
            
        }
        
    }
    
}