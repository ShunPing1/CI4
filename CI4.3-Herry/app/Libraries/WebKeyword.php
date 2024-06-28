<?php

namespace App\Libraries;

class WebKeyword
{	
	public function get( $keyword_array_or_id )
	{
		$db = db_connect();
		
		$defaultKeyword = $db->table('keywords')->where('id', '1')->get()->getResult(); //取得關鍵字預設值
		if( is_string( $keyword_array_or_id ) )
		{
			 //取得鍵字by id
			$keyword = $db->table('keywords')->where('id', $keyword_array_or_id)->get()->getResult();
			//比對是否空值，若空值以預設取代
			if( $keyword[0]->web_title == '' )		$keyword[0]->web_title = $defaultKeyword[0]->web_title;
			if( $keyword[0]->web_keyword == '' )	$keyword[0]->web_keyword = $defaultKeyword[0]->web_keyword;
			if( $keyword[0]->web_description == '' )$keyword[0]->web_description = $defaultKeyword[0]->web_description;
		}
		else
		{
			//直接傳入關鍵字
			$keyword = array();
			$keyword[0] = new keyword();
			//比對是否空值，若空值以預設取代
			$keyword[0]->web_title = ( $keyword_array_or_id[0]->web_title == '' ) ?	$defaultKeyword[0]->web_title : $keyword_array_or_id[0]->web_title;
			$keyword[0]->web_keyword = ( $keyword_array_or_id[0]->web_keyword == '' ) ? $defaultKeyword[0]->web_keyword : $keyword_array_or_id[0]->web_keyword;
			$keyword[0]->web_description = ( $keyword_array_or_id[0]->web_description == '' ) ? $defaultKeyword[0]->web_description : $keyword_array_or_id[0]->web_description;
		}
		return $keyword;
	}
}

class keyword
{
	var $web_title;
	var $web_keyword;
	var $web_description;
}