<?php namespace App\Libraries;
	use Ecpay\Sdk\Factories\Factory;
	use Ecpay\Sdk\Exceptions\RtnException;

	class ECPayLoad
	{
		public function __construct() { 
//			parent::__construct(); 
		} 
		
		function make_map($hash_key, $hash_iv, $merchantID, $return_url, $payment, $store, $device, $mid, $payment_type)
		{
			try {
				$factory = new Factory([
					'hashKey' => $hash_key,
					'hashIv' => $hash_iv,
					'hashMethod' => 'sha256'
				]);
				$postService = $factory->create('AutoSubmitFormWithAesService');

				$input = [
					'MerchantID' => $merchantID,
					'LogisticsType' => 'CVS',
					'LogisticsSubType' => $store,
					'IsCollection' => $payment,
					'ServerReplyURL' => $return_url,
					'Device' => $device,
					'ExtraData' => $payment .'#$#'. $mid .'#$#'. $payment_type
				];

				//測試位址 https://logistics-stage.ecpay.com.tw/Express/map
				//正式位址 https://logistics.ecpay.com.tw/Express/map
				$action = 'https://logistics.ecpay.com.tw/Express/Map';

				echo $postService->generate($input, $action);
			} catch(Exception $e) {
			   echo '(' . $e->getCode() . ')' . $e->getMessage() . PHP_EOL;
			}
		}
		
		// 超商
		function create_order_by_convenience_store($hash_key, $hash_iv, $merchantID, $return_url, $order_form_data, $return_store_error_url, $payment, $title, $name, $mobile)
		{
			try {
				$factory = new Factory([
					'hashKey' => $hash_key,
					'hashIv' => $hash_iv,
					'hashMethod' => 'md5'
				]);
				$postService = $factory->create('PostWithCmvEncodedStrResponseService');

				$order_datetime = str_replace( "-", "/", $order_form_data[0]->order_datetime);
				
				$input = [
					'MerchantID' => $merchantID,
					'MerchantTradeDate' => $order_datetime,
					'MerchantTradeNo' => $order_form_data[0]->payment_number,
					'LogisticsType' => 'CVS',
					'LogisticsSubType' => $order_form_data[0]->shipping_type,
					'ReceiverStoreID' => $order_form_data[0]->store_id,
					'GoodsAmount' => (int) $order_form_data[0]->total,
					'GoodsName' => $title,
					'SenderName' => $name,
					'SenderCellPhone' => $mobile,
					'ReceiverName' => $order_form_data[0]->receiver_name,
					'ReceiverCellPhone' => $order_form_data[0]->receiver_mobile,
					'ServerReplyURL' => $return_url,
					'IsCollection' => $payment
				];
				
				if($payment == 'Y')
				{
					$input['IsCollection']	= 'Y';//是否有代收貨款 
					$input['CollectionAmount']	= (int) $order_form_data[0]->total;//代收貨款金額
				}

				if($order_form_data[0]->shipping_type == 'UNIMARTC2C')
				{
					$input['LogisticsC2CReplyURL'] = $return_store_error_url;	//店家錯誤通知回傳的網址 尚未製作
				}
//				die(var_dump($input));
				
//				var_dump($input);
				
				$url = 'https://logistics.ecpay.com.tw/Express/Create';

				$response = $postService->post($input, $url);

				$db = \Config\Database::connect();
				
				$updateData = array(
					'AllPayLogisticsID' => $response['1|AllPayLogisticsID'],
					'CVSPaymentNo' => $response['CVSPaymentNo'],
					'CVSValidationNo' => $response['CVSValidationNo'],
				);
				
				$db->table('order_form')->where("order_id",$order_form_data[0]->order_id)->update($updateData);
				
				$insertLog = array(
					't1' => $order_form_data[0]->order_id,
					't2' => json_encode($response),
					'datetime' => date('Y-m-d H:i:s')
				);
				$db->table('log')->insert($insertLog);
		
//				die(var_dump($response));
//				return $response;
				
//				var_dump($response);
			} catch (RtnException $e) {
				echo '(' . $e->getCode() . ')' . $e->getMessage() . PHP_EOL;
			}
		}

		// 宅配
		function create_order_by_freight($hash_key, $hash_iv, $merchantID, $return_url, $order_form_data, $receiver_postal, $distance, $title, $name, $mobile, $postal, $address)
		{
			try {
				$factory = new Factory([
					'hashKey' => $hash_key,
					'hashIv' => $hash_iv,
					'hashMethod' => 'md5'
				]);
				$postService = $factory->create('PostWithCmvEncodedStrResponseService');

				$order_datetime = str_replace( "-", "/", $order_form_data[0]->order_datetime);

				$input = [
					'MerchantID' => $merchantID,
					'MerchantTradeDate' => $order_datetime,
					'MerchantTradeNo' => $order_form_data[0]->payment_number,
					'LogisticsType' => 'Home',
					'LogisticsSubType' => $order_form_data[0]->shipping_type,
					'GoodsAmount' => (int) $order_form_data[0]->total,
					'GoodsName' => $title,
					'SenderName' => $name,
					'SenderCellPhone' => $mobile,
					'ReceiverName' => $order_form_data[0]->receiver_name,
					'ReceiverCellPhone' => $order_form_data[0]->receiver_mobile,
					'ServerReplyURL' => $return_url,
					'SenderZipCode' => $postal,
					'SenderAddress' => $address,//改地址-------------------
					'ReceiverZipCode' => $receiver_postal,
					'ReceiverAddress' => $order_form_data[0]->receiver_address,
					'Temperature' => '0001',
					'Distance' => $distance,
					'Specification' => '0001',
				];

				if($order_form_data[0]->shipping_type == 'ECAN' || $order_form_data[0]->shipping_type == 'TCAT')
				{
					$time = strtotime($order_form_data[0]->order_datetime);
					
					$input['ScheduledDeliveryDate'] = date('Y/m/d', strtotime('+3 day', $time));
				}
				
//				var_dump($input);
				
				$url = 'https://logistics.ecpay.com.tw/Express/Create';

				$response = $postService->post($input, $url);

				$db = \Config\Database::connect();
				
				$updateData = array(
					'AllPayLogisticsID' => $response['1|AllPayLogisticsID'],
					'CVSPaymentNo' => $response['CVSPaymentNo'],
					'CVSValidationNo' => $response['CVSValidationNo'],
				);
				
				$db->table('order_form')->where("order_id",$order_form_data[0]->order_id)->update($updateData);
				
				$insertLog = array(
					't1' => $order_form_data[0]->order_id,
					't2' => json_encode($response),
					'datetime' => date('Y-m-d H:i:s')
				);
				$db->table('log')->insert($insertLog);
		
//				die(var_dump($response));
//				return $response;
				
//				var_dump($response);
			} catch (RtnException $e) {
				echo '(' . $e->getCode() . ')' . $e->getMessage() . PHP_EOL;
			}
		}
	}
?>