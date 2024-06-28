<?php namespace App\Libraries;

use App\Libraries\AllInOne;

class GsInvoice
{
	//歐付寶設定 -- 開始 --
	private $hash_key = 'o96f8zvV6p5cYm8p'; //Hashkey
	private $hash_iv = 'XQ5Y8VPYpbFMirQ0'; //HashIV
	private $merchantID = '3250482'; //MerchantID 商店代號
	
	//歐付寶設定 測試環境 -- 開始 --
	private $hash_key_demo = 'ejCk326UnaZWKisg'; //Hashkey
	private $hash_iv_demo = 'q9jcZX8Ib9LM8wYk'; //HashIV
	private $merchantID_demo = '2000132'; //MerchantID 商店代號
	
	//正式環境
	function do_invoice($order_form_id)
	{
		$db = db_connect();
		
		try
		{
			$sMsg = '' ;
		// 2.寫入基本介接參數
			$sendURL = 'https://einvoice.ecpay.com.tw/B2CInvoice/Issue'; //正式
			$objARRAY = array(
				'MerchantID' => $this->merchantID,
				'RqHeader' => array(
					'Timestamp' => time(),
					'RqID' => $this->create_guid(),
					'Revision' => '3.0.0',
				)
			);
			
			$order = $db->table('order_form')->where('order_id', $order_form_id)->get()->getResult();
			$order_item = $db->table('order_form_item')->where('order_form_id', $order_form_id)->get()->getResult();
			
		// 3.寫入發票相關資訊
			// 商品資訊
			$obj['Items'] = array();
			
			$total = 0;
			foreach($order_item as $value)
			{
				$name = $value->product_name;
				$amount = $value->amount;
				$price = $value->price;
				$subtotal = $price * $amount;
				$total += $subtotal;
				
				array_push($obj['Items'], array('ItemName' => $name, 'ItemCount' => $amount, 'ItemWord' => '個', 'ItemPrice' => $price, 'ItemTaxType' => 1, 'ItemAmount' => $subtotal, 'ItemRemark' => '' )) ;
			}
			
			if($order[0]->discount > 0)
			{
				$name = '折扣';
				$amount = 1;
				$price = -($order[0]->discount);
				$subtotal = $price * $amount;
				$total += $subtotal;
				
				array_push($obj['Items'], array('ItemName' => $name, 'ItemCount' => $amount, 'ItemWord' => '項', 'ItemPrice' => $price, 'ItemTaxType' => 1, 'ItemAmount' => $subtotal, 'ItemRemark' => '' )) ;
			}
			
			if($order[0]->fare > 0)
			{
				$name = '運費';
				$amount = 1;
				$price = $order[0]->fare;
				$subtotal = $price * $amount;
				$total += $subtotal;
				
				array_push($obj['Items'], array('ItemName' => $name, 'ItemCount' => $amount, 'ItemWord' => '項', 'ItemPrice' => $price, 'ItemTaxType' => 1, 'ItemAmount' => $subtotal, 'ItemRemark' => '' )) ;
			}
			
			$invoice_id = $order[0]->order_number;
			
			$obj['RelateNumber'] 		= $invoice_id;
			$obj['CustomerID'] 			= '';
			$obj['CustomerIdentifier'] 	= '';
			$obj['CustomerName'] 		= $order[0]->name;
			$obj['CustomerAddr'] 		= $order[0]->address;
			$obj['CustomerPhone'] 		= $order[0]->mobile;
			$obj['CustomerEmail'] 		= $order[0]->email;
			$obj['ClearanceMark'] 		= '';
			$obj['Print'] 				= '0';
			$obj['Donation'] 			= '0';
			$obj['LoveCode'] 			= '';
			$obj['CarruerType'] 		= '1';
			$obj['CarruerNum'] 			= '';
			$obj['TaxType'] 			= 1;
			$obj['SalesAmount'] 		= $order[0]->total;
			$obj['InvoiceRemark'] 		= $order[0]->content;	
			$obj['InvType'] 			= '07';
			$obj['vat'] 				= '1';
			
			if($order[0]->invoice == '三聯式')
			{
				$obj['CustomerIdentifier'] 	= $order[0]->invoice_code;
				$obj['CustomerName'] 		= $order[0]->invoice_company;
				$obj['Print'] 				= '1';
			}
			
			//加密
			$encript = json_encode($obj);
			$encript = urlencode($encript);
			$encript = openssl_encrypt($encript, 'aes-128-cbc', $this->hash_key, 0, $this->hash_iv);
			
			$objARRAY['Data']	= $encript;
			
			$Post_parameter = json_encode($objARRAY);
			
			//die(var_dump($Post_parameter));
		// 4.送出
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $sendURL);//Initiate cURL.
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_POSTFIELDS, $Post_parameter);//Attach our encoded JSON string to the POST fields.
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$result = curl_exec($ch);
			curl_close($ch);
			
		// 5.返回
			$msg = json_decode($result);
			
//			die(var_dump($msg));
			
			if($msg->TransCode == 1)
			{
				//解密
				$decrypt = openssl_decrypt($msg->Data, 'aes-128-cbc', $this->hash_key, 0, $this->hash_iv);
				$decrypt = urldecode($decrypt);
				
				$data = json_decode($decrypt);
				
				if($data->RtnCode == 1)
				{
					$insertInvoice = array(
						'order_id' => $order_form_id,
						'invoice_number' => $data->InvoiceNo,
						'ecpay_number' => $invoice_id,
						'invoice_date' => $data->InvoiceDate,
						'invoice_type' => '正常',
					);
					
					$db->table('order_invoice')->insert($insertInvoice);
					
					$db->table('order_form')->where('order_id', $order_form_id)->update(array('invoice_type' => '正常'));
					
					//紀錄
					$log = '新增電子訂單發票-「訂單編號-' . $order_form_id . '」：';
					$log .= '發票類別-「' . $order[0]->invoice . '」。發票總金額(含稅)-「' .  $order[0]->total . '」。';
					
					$logData = array(
						't1' => $order_form_id,
						't2' => $log,
						'datetime' => date('Y-m-d H:i:s')
					);
					
					$db->table('log')->insert($logData);
				}
				else
				{
					$db->table('order_form')->where('order_id', $order_form_id)->update(array('invoice_type' => '異常'));
					
					//紀錄
					$log = '新增電子訂單發票異常-「訂單編號-' . $order_form_id . '」：';
					$log .= $data->RtnMsg;
					
					$logData = array(
						't1' => $order_form_id,
						't2' => $log,
						'datetime' => date('Y-m-d H:i:s')
					);
					
					$db->table('log')->insert($logData);
				}
				
//				echo $data->RtnMsg;
			}
			else
			{
				//紀錄
				$log = '新增電子訂單發票異常-「訂單編號-' . $order_form_id . '」：';
				$log .= $msg->TransMsg;

				$logData = array(
					't1' => $order_form_id,
					't2' => $log,
					'datetime' => date('Y-m-d H:i:s')
				);

				$db->table('log')->insert($logData);
				die($msg->TransMsg);
			}
		}
		catch (Exception $e)
		{
			// 例外錯誤處理。
			$sMsg = $e->getMessage();
		}
	}
	
	//正式環境 作廢
	function do_invalid($invoice_id)
	{
		$db = db_connect();
		$logData = array(
			't1' => '作廢開始',
			't2' => $invoice_id,
			'datetime' => date('Y-m-d H:i:s')
		);

		$db->table('log')->insert($logData);
		
		try
		{
			$sMsg = '' ;
		// 2.寫入基本介接參數
			$sendURL = 'https://einvoice.ecpay.com.tw/B2CInvoice/Invalid'; //正式
			$objARRAY = array(
				'MerchantID' => $this->merchantID,
				'RqHeader' => array(
					'Timestamp' => time(),
					'RqID' => $this->create_guid(),
					'Revision' => '3.0.0',
				)
			);
			
			$invoice = $db->table('order_invoice')->where('invoice_id', $invoice_id)->get()->getResult();
			
		// 3.寫入發票相關資訊
			$obj['MerchantID'] 				= $this->merchantID;
			$obj['InvoiceNo'] 				= $invoice[0]->invoice_number;
			$obj['InvoiceDate'] 			= date('Y-m-d', strtotime($invoice[0]->invoice_date));
			$obj['Reason'] 					= '作廢';
			
			$logData = array(
				't1' => '發票開始作廢_'. $invoice_id,
				't2' => json_encode($obj),
				'datetime' => date('Y-m-d H:i:s')
			);
			$db->table('log')->insert($logData);

			//加密
			$encript = json_encode($obj);
			$encript = urlencode($encript);
			$encript = openssl_encrypt($encript, 'aes-128-cbc', $this->hash_key, 0, $this->hash_iv);
			
			$objARRAY['Data']	= $encript;
			
			$Post_parameter = json_encode($objARRAY);
			
			//die(var_dump($Post_parameter));
		// 4.送出
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $sendURL);//Initiate cURL.
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_POSTFIELDS, $Post_parameter);//Attach our encoded JSON string to the POST fields.
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$result = curl_exec($ch);
			curl_close($ch);
			
		// 5.返回
			$msg = json_decode($result);
			
//			die(var_dump($msg));
			
			if($msg->TransCode == 1)
			{
				//解密
				$decrypt = openssl_decrypt($msg->Data, 'aes-128-cbc', $this->hash_key, 0, $this->hash_iv);
				$decrypt = urldecode($decrypt);
				
				$data = json_decode($decrypt);
				
				if($data->RtnCode == 1)
				{
					$db->table('order_invoice')->where('invoice_id', $invoice_id)->update(array('invoice_type' => '作廢'));
					
					$db->table('order_form')->where('order_id', $invoice[0]->order_id)->update(array('invoice_type' => '作廢'));
					
					//紀錄
					$log = '作廢電子訂單發票-「發票編號-' . $invoice_id . '」';
//					$log .= '發票類別-「' . $order[0]->invoice . '」。發票總金額(含稅)-「' .  $order[0]->total . '」。';
					
					$logData = array(
						't1' => $invoice_id,
						't2' => $log,
						'datetime' => date('Y-m-d H:i:s')
					);
					
					$db->table('log')->insert($logData);
				}
				else
				{
					$db->table('order_invoice')->where('invoice_id', $invoice_id)->update(array('invoice_type' => '作廢失敗'));
					
					$db->table('order_form')->where('order_id', $invoice[0]->order_id)->update(array('invoice_type' => '作廢失敗'));
					
					//紀錄
					$log = '作廢電子訂單發票異常-「訂單編號-' . $invoice_id . '」：';
					$log .= $data->RtnMsg;
					
					$logData = array(
						't1' => $order_form_id,
						't2' => $log,
						'datetime' => date('Y-m-d H:i:s')
					);
					
					$db->table('log')->insert($logData);
				}
				
//				echo $data->RtnMsg;
			}
			else
			{
				//紀錄
				$log = '作廢電子訂單發票異常-「訂單編號-' . $invoice_id . '」：';
				$log .= $msg->TransMsg;

				$logData = array(
					't1' => $order_form_id,
					't2' => $log,
					'datetime' => date('Y-m-d H:i:s')
				);

				$db->table('log')->insert($logData);
				die($msg->TransMsg);
			}
		}
		catch (Exception $e)
		{
			// 例外錯誤處理。
			$sMsg = $e->getMessage();
		}
	}
	
	//測試環境
	function do_invoice_demo($order_form_id)
	{
		$db = db_connect();
		$logData = array(
			't1' => '發票開始',
			't2' => $order_form_id,
			'datetime' => date('Y-m-d H:i:s')
		);

		$db->table('log')->insert($logData);
		
		try
		{
			$sMsg = '' ;
		// 2.寫入基本介接參數
			$sendURL = 'https://einvoice-stage.ecpay.com.tw/B2CInvoice/Issue'; //測試
			$objARRAY = array(
				'MerchantID' => $this->merchantID_demo,
				'RqHeader' => array(
					'Timestamp' => time(),
					'RqID' => $this->create_guid(),
					'Revision' => '3.0.0',
				)
			);
			
			$order = $db->table('order_form')->where('order_id', $order_form_id)->get()->getResult();
			$order_item = $db->table('order_form_item')->where('order_form_id', $order_form_id)->get()->getResult();
			
		// 3.寫入發票相關資訊
			// 商品資訊
			$obj['Items'] = array();
			
			$total = 0;
			foreach($order_item as $value)
			{
				$name = $value->product_name;
				$amount = $value->amount;
				$price = $value->price;
				$subtotal = $price * $amount;
				$total += $subtotal;
				
				array_push($obj['Items'], array('ItemName' => $name, 'ItemCount' => $amount, 'ItemWord' => '個', 'ItemPrice' => $price, 'ItemTaxType' => 1, 'ItemAmount' => $subtotal, 'ItemRemark' => '' )) ;
			}
			
			if($order[0]->discount > 0)
			{
				$name = '折扣';
				$amount = 1;
				$price = -($order[0]->discount);
				$subtotal = $price * $amount;
				$total += $subtotal;
				
				array_push($obj['Items'], array('ItemName' => $name, 'ItemCount' => $amount, 'ItemWord' => '項', 'ItemPrice' => $price, 'ItemTaxType' => 1, 'ItemAmount' => $subtotal, 'ItemRemark' => '' )) ;
			}
			
			if($order[0]->fare > 0)
			{
				$name = '運費';
				$amount = 1;
				$price = $order[0]->fare;
				$subtotal = $price * $amount;
				$total += $subtotal;
				
				array_push($obj['Items'], array('ItemName' => $name, 'ItemCount' => $amount, 'ItemWord' => '項', 'ItemPrice' => $price, 'ItemTaxType' => 1, 'ItemAmount' => $subtotal, 'ItemRemark' => '' )) ;
			}
			
//			$invoice_id = $order[0]->order_number;
			$invoice_id = 'EI'. $this->get_random(8);
			
			$checkType = true;
			while($checkType)
			{
				$invoiceData = $db->table('order_invoice')->where('ecpay_number', $invoice_id)->countAllResults();
				if($invoiceData == 0)
				{
					$checkType = false;
				}
				else
				{
					$invoice_id = 'EI'. $this->get_random(8);
				}
			}
			
			$obj['RelateNumber'] 		= $invoice_id;
			$obj['CustomerID'] 			= '';
			$obj['CustomerIdentifier'] 	= '';
			$obj['CustomerName'] 		= $order[0]->name;
			$obj['CustomerAddr'] 		= $order[0]->address;
			$obj['CustomerPhone'] 		= $order[0]->mobile;
			$obj['CustomerEmail'] 		= $order[0]->email;
			$obj['ClearanceMark'] 		= '';
			$obj['Print'] 				= '0';
			$obj['Donation'] 			= '0';
			$obj['LoveCode'] 			= '';
			$obj['CarruerType'] 		= '1';
			$obj['CarruerNum'] 			= '';
			$obj['TaxType'] 			= 1;
			$obj['SalesAmount'] 		= $order[0]->total;
			$obj['InvoiceRemark'] 		= $order[0]->content;	
			$obj['InvType'] 			= '07';
			$obj['vat'] 				= '1';
			
			if($order[0]->invoice == '三聯式')
			{
				$obj['CustomerIdentifier'] 	= $order[0]->invoice_code;
				$obj['CustomerName'] 		= $order[0]->invoice_company;
				$obj['Print'] 				= '1';
			}
			
			$logData = array(
				't1' => '發票開始發送_'. $order_form_id,
				't2' => json_encode($obj),
				'datetime' => date('Y-m-d H:i:s')
			);
			$db->table('log')->insert($logData);

			//加密
			$encript = json_encode($obj);
			$encript = urlencode($encript);
			$encript = openssl_encrypt($encript, 'aes-128-cbc', $this->hash_key_demo, 0, $this->hash_iv_demo);
			
			$objARRAY['Data']	= $encript;
			
			$Post_parameter = json_encode($objARRAY);
			
			//die(var_dump($Post_parameter));
		// 4.送出
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $sendURL);//Initiate cURL.
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_POSTFIELDS, $Post_parameter);//Attach our encoded JSON string to the POST fields.
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$result = curl_exec($ch);
			curl_close($ch);
			
		// 5.返回
			$msg = json_decode($result);
			
//			die(var_dump($msg));
			
			if($msg->TransCode == 1)
			{
				//解密
				$decrypt = openssl_decrypt($msg->Data, 'aes-128-cbc', $this->hash_key_demo, 0, $this->hash_iv_demo);
				$decrypt = urldecode($decrypt);
				
				$data = json_decode($decrypt);
				
				if($data->RtnCode == 1)
				{
					$insertInvoice = array(
						'order_id' => $order_form_id,
						'invoice_number' => $data->InvoiceNo,
						'ecpay_number' => $invoice_id,
						'invoice_date' => $data->InvoiceDate,
						'invoice_type' => '正常',
					);
					
					$db->table('order_invoice')->insert($insertInvoice);
					
					$db->table('order_form')->where('order_id', $order_form_id)->update(array('invoice_type' => '正常'));
					
					//紀錄
					$log = '新增電子訂單發票-「訂單編號-' . $order_form_id . '」：';
//					$log .= '發票類別-「' . $order[0]->invoice . '」。發票總金額(含稅)-「' .  $order[0]->total . '」。';
					$log .= '發票總金額(含稅)-「' .  $order[0]->total . '」。';
					
					$logData = array(
						't1' => $order_form_id,
						't2' => $log,
						'datetime' => date('Y-m-d H:i:s')
					);
					
					$db->table('log')->insert($logData);
				}
				else
				{
					$db->table('order_form')->where('order_id', $order_form_id)->update(array('invoice_type' => '異常'));
					
					//紀錄
					$log = '新增電子訂單發票異常-「訂單編號-' . $order_form_id . '」：';
					$log .= $data->RtnMsg;
					
					$logData = array(
						't1' => $order_form_id,
						't2' => $log,
						'datetime' => date('Y-m-d H:i:s')
					);
					
					$db->table('log')->insert($logData);
				}
				
//				echo $data->RtnMsg;
			}
			else
			{
				//紀錄
				$log = '新增電子訂單發票異常-「訂單編號-' . $order_form_id . '」：';
				$log .= $msg->TransMsg;

				$logData = array(
					't1' => $order_form_id,
					't2' => $log,
					'datetime' => date('Y-m-d H:i:s')
				);

				$db->table('log')->insert($logData);
				die($msg->TransMsg);
			}
		}
		catch (Exception $e)
		{
			// 例外錯誤處理。
			$sMsg = $e->getMessage();
		}
	}
	
	//測試環境 作廢
	function do_invalid_demo($invoice_id)
	{
		$db = db_connect();
		$logData = array(
			't1' => '作廢開始',
			't2' => $invoice_id,
			'datetime' => date('Y-m-d H:i:s')
		);

		$db->table('log')->insert($logData);
		
		try
		{
			$sMsg = '' ;
		// 2.寫入基本介接參數
			$sendURL = 'https://einvoice-stage.ecpay.com.tw/B2CInvoice/Invalid'; //測試
			$objARRAY = array(
				'MerchantID' => $this->merchantID_demo,
				'RqHeader' => array(
					'Timestamp' => time(),
					'RqID' => $this->create_guid(),
					'Revision' => '3.0.0',
				)
			);
			
			$invoice = $db->table('order_invoice')->where('invoice_id', $invoice_id)->get()->getResult();
			
		// 3.寫入發票相關資訊
			$obj['MerchantID'] 				= $this->merchantID_demo;
			$obj['InvoiceNo'] 				= $invoice[0]->invoice_number;
			$obj['InvoiceDate'] 			= date('Y-m-d', strtotime($invoice[0]->invoice_date));
			$obj['Reason'] 					= '作廢';
			
			$logData = array(
				't1' => '發票開始作廢_'. $invoice_id,
				't2' => json_encode($obj),
				'datetime' => date('Y-m-d H:i:s')
			);
			$db->table('log')->insert($logData);

			//加密
			$encript = json_encode($obj);
			$encript = urlencode($encript);
			$encript = openssl_encrypt($encript, 'aes-128-cbc', $this->hash_key_demo, 0, $this->hash_iv_demo);
			
			$objARRAY['Data']	= $encript;
			
			$Post_parameter = json_encode($objARRAY);
			
			//die(var_dump($Post_parameter));
		// 4.送出
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $sendURL);//Initiate cURL.
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_POSTFIELDS, $Post_parameter);//Attach our encoded JSON string to the POST fields.
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$result = curl_exec($ch);
			curl_close($ch);
			
		// 5.返回
			$msg = json_decode($result);
			
//			die(var_dump($msg));
			
			if($msg->TransCode == 1)
			{
				//解密
				$decrypt = openssl_decrypt($msg->Data, 'aes-128-cbc', $this->hash_key_demo, 0, $this->hash_iv_demo);
				$decrypt = urldecode($decrypt);
				
				$data = json_decode($decrypt);
				
				if($data->RtnCode == 1)
				{
					$db->table('order_invoice')->where('invoice_id', $invoice_id)->update(array('invoice_type' => '作廢'));
					
					$db->table('order_form')->where('order_id', $invoice[0]->order_id)->update(array('invoice_type' => '作廢'));
					
					//紀錄
					$log = '作廢電子訂單發票-「發票編號-' . $invoice_id . '」';
//					$log .= '發票類別-「' . $order[0]->invoice . '」。發票總金額(含稅)-「' .  $order[0]->total . '」。';
					
					$logData = array(
						't1' => $invoice_id,
						't2' => $log,
						'datetime' => date('Y-m-d H:i:s')
					);
					
					$db->table('log')->insert($logData);
				}
				else
				{
					$db->table('order_invoice')->where('invoice_id', $invoice_id)->update(array('invoice_type' => '作廢失敗'));
					
					$db->table('order_form')->where('order_id', $invoice[0]->order_id)->update(array('invoice_type' => '作廢失敗'));
					
					//紀錄
					$log = '作廢電子訂單發票異常-「訂單編號-' . $invoice_id . '」：';
					$log .= $data->RtnMsg;
					
					$logData = array(
						't1' => $order_form_id,
						't2' => $log,
						'datetime' => date('Y-m-d H:i:s')
					);
					
					$db->table('log')->insert($logData);
				}
				
//				echo $data->RtnMsg;
			}
			else
			{
				//紀錄
				$log = '作廢電子訂單發票異常-「訂單編號-' . $invoice_id . '」：';
				$log .= $msg->TransMsg;

				$logData = array(
					't1' => $order_form_id,
					't2' => $log,
					'datetime' => date('Y-m-d H:i:s')
				);

				$db->table('log')->insert($logData);
				die($msg->TransMsg);
			}
		}
		catch (Exception $e)
		{
			// 例外錯誤處理。
			$sMsg = $e->getMessage();
		}
	}
	
	private function create_guid($namespace = '')
	{  
		static $guid = '';
		$uid = uniqid("", true);
		$data = $namespace;
		$data .= $_SERVER['REQUEST_TIME'];
		$data .= $_SERVER['HTTP_USER_AGENT'];
		$data .= $_SERVER['REMOTE_ADDR'];
		$data .= $_SERVER['REMOTE_PORT'];
		$hash = strtoupper(hash('ripemd128', $uid . $guid . md5($data)));
		$guid = 
		substr($hash, 0, 8) .
		'-' .
		substr($hash, 8, 4) .
		'-' .
		substr($hash, 12, 4) .
		'-' .
		substr($hash, 16, 4) .
		'-' .
		substr($hash, 20, 12);
		return $guid;
	}
	
	private function get_random($num_len)
	{
//		$num_len = 5;//字串長度
    	$num = '';
    	$word = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';//字典檔 你可以將 數字 0 1 及字母 O L 排除
    	$len = strlen($word);//取得字典檔長度
 
    	for($i = 0; $i < $num_len; $i++){ //總共取 幾次
        	$num .= $word[rand() % $len];//隨機取得一個字元
    	}
		
    	return $num;//回傳亂數帳號
	}
	
}