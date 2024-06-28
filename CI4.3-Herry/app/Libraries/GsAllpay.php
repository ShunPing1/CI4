<?php namespace App\Libraries;

use App\Libraries\AllInOne;

class GsAllpay
{
	//歐付寶設定 -- 開始 --
	private $hash_key = 'o96f8zvV6p5cYm8p'; //Hashkey
	private $hash_iv = 'XQ5Y8VPYpbFMirQ0'; //HashIV
	private $merchantID = '3250482'; //MerchantID 商店代號
	
	public function allpay_all_pay_send($order_id)
	{
		$db = \Config\Database::connect();
		
		$order_data = $db->table('order_form')->where('order_id', $order_id)->get()->getResult();
		
		//載入SDK(路徑可依系統規劃自行調整)
		//include('App\ThirdParty\AllInOne.php');
		
		try {
	   
			//equire_once 'App/ThirdParty/AllInOne.php';
    	$obj = new AllInOne();
		
		//$obj = $obj_lib->load();
			//==== 服務參數 - 設定開始 ====
            
            //正式環境：https://payment.ecpay.com.tw/Cashier/AioCheckOut/V5
			
			$obj->ServiceURL  = 'https://payment.ecpay.com.tw/Cashier/AioCheckOut/V5';	//服務位置
			$obj->HashKey     = $this->hash_key;		//Hashkey
			$obj->HashIV      = $this->hash_iv;		    //HashIV
			$obj->MerchantID  = $this->merchantID;		//MerchantID 商店代號
            $obj->EncryptType = '1';                   //CheckMacValue加密類型，請固定填入1，使用SHA256加密
			$obj->Send['ReturnURL']	= base_url() .'allpay/allpay_return';	//付款完成通知回傳的網址
			
			$obj->Send['ClientBackURL'] = base_url();
			
			//交易參數(請依系統規劃自行調整)
			$obj->Send['MerchantTradeNo'] = $order_data[0]->payment_number;	//訂單編號
			
			$order_datetime = str_replace( "-", "/", $order_data[0]->order_datetime);
			$obj->Send['MerchantTradeDate'] = $order_datetime; 	//交易時間
			$obj->Send['TotalAmount']       = $order_data[0]->total;	//交易金額
			$obj->Send['TradeDesc']         = "綠界"; //交易描述
			if($order_data[0]->payment_type == 'CREDIT')
            {
                $obj->Send['ChoosePayment'] = 'Credit' ; 
            }
            elseif($order_data[0]->payment_type == 'ATM')
            { 
                $obj->Send['ChoosePayment'] = 'ATM' ; 
				$obj->SendExtend['PaymentInfoURL']	= base_url() .'allpay/allpay_return_code';	//付款取號通知回傳的網址
            }
            elseif($order_data[0]->payment_type == 'CVS')
            {
                $obj->Send['ChoosePayment'] = 'CVS' ; 
				$obj->SendExtend['PaymentInfoURL']	= base_url() .'allpay/allpay_return_code';	//付款取號通知回傳的網址
            }
            else
            {
                $obj->Send['ChoosePayment'] = 'Credit' ; 
            }
			
			//==== 服務參數 - 設定結束 ====
			
			//訂單的商品資料
			$cart_contents = $db->table('order_form_item')->where('order_form_id', $order_id)->get()->getResult();
			
			//$obj->Send['Items'] = array();
			foreach( $cart_contents as $content )
			{
				$name = $content->product_name;
				$price = $content->price;
				$amount = $content->amount;
				$product_url = base_url() . 'load_page/get_product_content/' . $content->item_id;
				
				array_push($obj->Send['Items'], array('Name' => $name, 'Price' => (int)$price,
					   'Currency' => "元", 'Quantity' => (int)$amount));
			}
			
			if($order_data[0]->fare > 0)
			{
				$name = '運費';
				$price = $order_data[0]->fare;
				$amount = 1;
				$product_url = base_url();
				
				array_push($obj->Send['Items'], array('Name' => $name, 'Price' => (int)$price,
					   'Currency' => "元", 'Quantity' => (int)$amount));
			}
			
			//die(var_dump($obj->Send['Items']));
            
            //die(var_dump($cart_contents));
            
			//產生訂單(auto submit至ECPay)
			$obj->CheckOut();
            
		} catch (Exception $e) {
           echo $e->getMessage() ;
		} 
	}
	
	public function do_check_code()
	{
		$oPayment = new AllInOne();
		/* 服務參數 */
		$oPayment->HashKey = $this->hash_key;
		$oPayment->HashIV = $this->hash_iv;
		$oPayment->MerchantID = $this->merchantID;
		/* 取得回傳參數 */
		$arFeedback = $oPayment->CheckOutFeedback();
		
		return $arFeedback;
	}
}