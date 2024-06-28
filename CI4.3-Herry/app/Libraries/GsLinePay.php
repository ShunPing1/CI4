<?php namespace App\Libraries;

class GsLinePay
{
//	private $linePayID = '1660962525';
//	private $linePaySecret = '8bc3c977ab0c6427450b3772145c6823';
	
	//測試環境
	private $linePayID = '1660962525';
	private $linePaySecret = '8bc3c977ab0c6427450b3772145c6823';
	
	public function request($orderID)
	{
		$db = \Config\Database::connect();
		
		$orderData = $db->table('order_form')->where('order_id', $orderID)->get(1)->getResult();
		$orderDataItem = $db->table('order_form_item')->where('order_form_id', $orderID)->get()->getResult();
		
//		$url = 'https://api-pay.line.me/v3/payments/request';
		 $url = 'https://sandbox-api-pay.line.me/v3/payments/request';
			
		$linepay = array(
			'amount' => $orderData[0]->total,
			'currency' => 'TWD',
			'orderId' => $orderID
		);
		
		//商品
		$item_total = 0;
		$packagesItem = array();
		foreach($orderDataItem as $value)
		{
			$packagesItem[] = array(
				'name' => $value->product_name,
				'imageUrl' => base_url() .'/'. $value->f1,
				'quantity' => $value->amount,
				'price' => $value->price
			);
			
			$subtotal = $value->amount * $value->price;
			$item_total += $subtotal;
		}
		
		//折扣
		if($orderData[0]->discount > 0)
		{
			$discount = 0 - $orderData[0]->discount;
			$packagesItem[] = array(
				'name' => '折扣',
				'quantity' => 1,
				'price' => $discount
			);
			
			$item_total += $discount;
		}
		
		//運費
		if($orderData[0]->fare > 0)
		{
			$packagesItem[] = array(
				'name' => '運費',
				'quantity' => 1,
				'price' => $orderData[0]->fare
			);
			
			$item_total += $orderData[0]->fare;
		}
		
		//整合成一個類別
		$packages = array();
		$packages[] = array(
			'id' => 'POND'. $orderID,
			'name' => '碰卡',
			'amount' => $item_total,
			'products' => $packagesItem
		);
		
		$linepay['packages'] = $packages;
		
		//回傳設定
		$linepay['redirectUrls'] = array(
			'confirmUrl' => base_url() .'/linepay/do_confirm/' . $orderID,
			'cancelUrl' => base_url() .'/linepay/do_cancel/' . $orderID,
		);
		
		$log['t1'] = 'linepay 付款';
		$log['t2'] = json_encode($linepay);
		$log['datetime'] = date('Y-m-d H:i:s');
		$db->table('log')->insert($log);
		
		$nonce = date('c') . uniqid('-');
		$api_uri = '/v3/payments/request';
		$order_json = json_encode($linepay);
		$key_body = $this->linePaySecret . $api_uri . $order_json . $nonce;
		$key = base64_encode(hash_hmac('sha256', $key_body, $this->linePaySecret, true));

		$header = array(
			'Content-Type: application/json; charset=UTF-8',
			'X-LINE-ChannelId: ' . $this->linePayID,
			'X-LINE-ChannelSecret: '. $this->linePaySecret,
			'X-LINE-Authorization: ' . $key,
			'X-LINE-Authorization-Nonce: ' . $nonce,
		);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $order_json);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$responseJson = curl_exec($ch);

		$response = json_decode($responseJson);

		if (!property_exists($response, 'info')) {
			$log = [
				't1' => 'linePay 付款失敗',
				't2' => $responseJson,
				'datetime' => date('Y-m-d H:i:s')
			];
			$db->table('log')->insert($log);

			$message_data['message'] = 'Line Pay 付款失敗!!';
			$message_data['location'] = base_url();
			echo view('submit', $message_data);
			die();
		}
		
		$location = $response->info->paymentUrl->web; //付款網址

		$message_data['message'] = '即將啟用Line Pay，請稍等\n請勿關閉視窗';
		$message_data['location'] = $location;
		echo view('submit', $message_data);
	}

	public function confirm($transactionId, $orderData)
	{
		$db = \Config\Database::connect();
		
//		$url = 'https://api-pay.line.me/v3/payments/'. $transactionId .'/confirm';
		$url = 'https://sandbox-api-pay.line.me/v3/payments/'. $transactionId .'/confirm';

		$linepay = array(
			'amount' => $orderData[0]->total,
			'currency' => 'TWD',
		);
		
		$secret = $this->linePaySecret;
		$channelId = $this->linePayID;
		$nonce = date('c') . uniqid('-');
		$api_uri = '/v3/payments/'. $transactionId .'/confirm';
		$order_json = json_encode($linepay);
		$key_body = $secret . $api_uri . $order_json . $nonce;
		$key = hash_hmac('sha256', $key_body, $secret, true);
		$key = base64_encode($key);
		
		$header = array(
			'Content-Type: application/json; charset=UTF-8',
			'X-LINE-ChannelId: ' . $channelId,
			'X-LINE-ChannelSecret: '. $secret,
			'X-LINE-Authorization: ' . $key,
			'X-LINE-Authorization-Nonce: ' . $nonce,
		);

		$ch = curl_init();//Initiate cURL.
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);//Tell cURL that we want to send a POST request.
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($linepay));//Attach our encoded JSON string to the POST fields.
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header); //Set the content type to to 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//使回傳值不回直接echo出來
		$responseJson = curl_exec($ch);//Execute the request
		$response = json_decode($responseJson);
		
		$log = [
			't1' => 'linePay 回傳:'. $transactionId,
			't2' => $responseJson,
			'datetime' => date('Y-m-d H:i:s')
		];
		$db->table('log')->insert($log);
		
		//回傳狀態碼
		$code = $response->returnCode; 

		//成功
		if($code == '0000')
		{
			return 'success';
		}
		else
		{
			return 'fail';
		}
	}

	
}