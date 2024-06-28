<?php namespace App\Libraries;

use App\Libraries\AllInOne;
use App\Libraries\ECPayLoad;

class GsAllpayByLogistics
{
	//歐付寶設定 -- 開始 --
	private $hash_key = 'o96f8zvV6p5cYm8p'; //Hashkey
	private $hash_iv = 'XQ5Y8VPYpbFMirQ0'; //HashIV
	private $merchantID = '3250482'; //MerchantID 商店代號
	private $name = '劉松旺'; //寄件人姓名
	private $mobile = '0912477793'; //寄件人手機
	private $location = '台中市'; //寄件人居住地
	private $postal = '404'; //寄件人居住地
	private $address = '台中市北區博館路87號8樓1室'; //寄件人居住地
	
	//===== 超商地圖 =====
    function select_map($payment, $store, $payment_type, $agent, $mid)
    {
		if($agent->isMobile())
		{
			$device = 1; //手機版
		}
		else
		{
			$device = 0; //電腦版
		}
		
		$return_url = base_url() .'webpay/return_map';
		
		$ecpay_load = new ECPayLoad();
		$ecpay_load->make_map($this->hash_key, $this->hash_iv, $this->merchantID, $return_url, $payment, $store, $device, $mid, $payment_type);
    }

	// 超商訂單
	function create_order_by_convenience_store($order_form_data)
	{
		$return_url = base_url() .'allpay/return_logistics';
		$return_store_error_url = base_url() .'allpay/return_store_error'; //尚未製作
		
		$title = '商品訂單:' . $order_form_data[0]->order_id; //貨品名稱
		$payment = ($order_form_data[0]->payment_type == 'store_pay') ? 'Y' : 'N';
		
		$ecpay_load = new ECPayLoad();
		$ecpay_load->create_order_by_convenience_store($this->hash_key, $this->hash_iv, $this->merchantID, $return_url, $order_form_data, $return_store_error_url, $payment, $title, $this->name, $this->mobile);
	}
	
	// 貨運訂單
	function create_order_by_freight($order_form_data)
	{
		$return_url = base_url() .'allpay/return_logistics';
		
		$title = '商品訂單:' . $order_form_data[0]->order_id; //貨品名稱
		$payment = ($order_form_data[0]->payment_type == 'store_pay') ? 'Y' : 'N';
		
		if (preg_match("/\b".$this->location."\b/i", $order_form_data[0]->receiver_address))
		{
			$distance = '00';//同市區內
		}
		else if (preg_match("/\b金門縣\b/i", $order_form_data[0]->receiver_address))
		{
			$distance = '02';
		}
		else if (preg_match("/\b連江縣\b/i", $order_form_data[0]->receiver_address))
		{
			$distance = '02';
		}
		else if (preg_match("/\b澎湖縣\b/i", $order_form_data[0]->receiver_address))
		{
			$distance = '02';
		}
		else if (preg_match("/\b琉球鄉\b/i", $order_form_data[0]->receiver_address))
		{
			$distance = '02';
		}
		else if (preg_match("/\b蘭嶼鄉\b/i", $order_form_data[0]->receiver_address))
		{
			$distance = '02';
		}
		else if (preg_match("/\b綠島鄉\b/i", $order_form_data[0]->receiver_address))
		{
			$distance = '02';
		}
		else if (preg_match("/\b釣魚台\b/i", $order_form_data[0]->receiver_address))
		{
			$distance = '02';
		}
		else if (preg_match("/\b綠島鄉\b/i", $order_form_data[0]->receiver_address))
		{
			$distance = '02';
		}
		else if (preg_match("/\b東沙群島\b/i", $order_form_data[0]->receiver_address))
		{
			$distance = '02';
		}
		else if (preg_match("/\b南沙群島\b/i", $order_form_data[0]->receiver_address))
		{
			$distance = '02';
		}
		else
		{
			$distance = '01'; 
		}
				
		$ecpay_load = new ECPayLoad();
		$ecpay_load->create_order_by_freight($this->hash_key, $this->hash_iv, $this->merchantID, $return_url, $order_form_data, $order_form_data[0]->receiver_postal, $distance, $title, $this->name, $this->mobile, $this->postal, $this->address);
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