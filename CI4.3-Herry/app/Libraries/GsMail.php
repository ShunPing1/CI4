<?php namespace App\Libraries;

class GsMail
{
	public function send_email( $admin_email_address, $message, $message_title )
	{
		$email = service('email');
		
		$config['mailType'] = 'html';
		$email->initialize($config);
		$email->setFrom($_SERVER['GS_ENVIRONMENT']['webEmail'], $_SERVER['GS_ENVIRONMENT']['webName']);
		$email->setTo( $admin_email_address );

		$email->setSubject($message_title);
		$email->setMessage($message); 

		$email->send();
	}
}