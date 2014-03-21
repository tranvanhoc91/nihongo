<?php
require_once('class.table.php');
class Session extends Table {
	var $id 		= null;
	var $user_id 	= null;
	var $ip 		= null;
	var $token 		= null;
	var $time 		= null;
	var $client 	= null;
	
	function __construct($uid=null){
		$this->user_id 		=  $uid;
		$this->time 		= time();
		$this->token		= $this->_randToken();
		$this->ip 			= Request::getServer('REMOTE_ADDR');
		
		parent::__construct('sessions','id');
	}
	
	//phuong thuc rieng cho doi tuong
	private function _randToken(){
		$tem = rand();
		return md5($tem);
	}
}