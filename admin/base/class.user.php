<?php
class User {
	private  $_username 	= null;
	private  $_password 	= null;
	private  $_user_id 		= null;
	
	var $_repwrd        	= null;
    var $_name           	= null;
    var $_gender            = null;
    var $_birthday          = null;
    var $_address           = null;
    var $_mobile            = null;
    var $_occupation        = null;
    var $_email             = null;
    var $_ssn				= null;
    var $_checkbox 			= null;
    var $_captcha           = null;
    
    //cac bien khi su dung khi thay doi password
    public $_currpwrd 		= null;
    public $_newpwrd		= null;
    public $_renewpwrd 		= null;
    
	
	public $errors 			= array();
	public $numerror 		= 0;

	
	function __construct(){
		if($this->isLogined()){
				@session_start();
				$this->_username = $_SESSION['user']->username;
				$this->_password = $_SESSION['user']->password;
	            $this->_user_id = $_SESSION['user']->id;
		}
	}
/***************************************************************************/
/***************************************************************************/
	function adminCheckLogin(){
		//lay cac thong tin
		$this->_username = addslashes(Request::get('username'));
		if(!isset($this->_username) || $this->_username=='') {
			$this->setError('Cho biết giới tính của bạn', 0);
			return false;	
		}
		
		$this->_password = addslashes(Request::get('password'));		
		if(!isset($this->_password) || $this->_password=='') {
			$this->setError('Cho biết giới tính của bạn', 0);
			return false;	
		}
		
		//truy cap db kiem tra
		global $dbo;
		$dbo->setQuery("SELECT id 
						FROM users 
						WHERE `username`='".$this->_username."' 
						AND `password` = md5('".$this->_password."') 
						AND `block` = '0' AND `actived`='1' 
						AND `group_id` = '1' ");
		$user = $dbo->loadObject();
		
		if($user){
			$session = new Session($user->id);
			$session->store();
			@session_start();
			//luu vao mang $_SESSION
			$_SESSION['au'] = $user;
			return true;
		}else {
			$this->setError('Username or Password do not match', 0);
			return false;
			
		}
	}
	
	function adminIsLogin(){
		@session_start();
		if(isset($_SESSION['au']) && $_SESSION['au']->id) return true;
		return false;
	}
	
	function adminLogout(){
		//Huy $_SESSION tuong ung
		@session_start();
		global $dbo;
		$id = $_SESSION['au']->id;
		$dbo->setQuery("DELETE FROM sessions WHERE user_id = $id ");
		$user = $dbo->query();
		
		$lastvisit = date("Y-m-d H:i:s");
		
		$dbo->setQuery("UPDATE `users` SET `lastvisitDate`='$lastvisit' WHERE id=$id ");
		$user = $dbo->query();
		
		
		$_SESSION['au'] = null;
	}
	
	
/***************************************************************************/
// task = register
	function register(){
		//$actcode = $this->RandomActiveCode();
		
			global $dbo;
			$query = "INSERT INTO `users` SET
                                            `username`    	= 	'{$this->_username}',
                                            `password`    	= 	md5('$this->_password'),
                                            `email`    		= 	'{$this->_email}',
                                            `fullname`    		= 	'{$this->_name}',
                                            `gender`    	= 	'{$this->_gender}',
                                            `birthday`    	= 	'{$this->_birthday}',
                                            `mobile`    	= 	'{$this->_mobile}',
                                            `ssn`    		= 	'{$this->_ssn}',
                                            `occupation`    = 	'{$this->_occupation}',
                                            `address`    	= 	'{$this->_address}',
                                            `activation`    = 	0,
                                            `published`    	= 	0,
                                            `created`    	= 	Now(),
                                            `ugr_id`    	= 	3,
                                            `hash`			= 	'{$this->RandomActiveCode()}',
                                                        
						";
			$dbo->setQuery($query);
			$dbo->query();
				
	}
	
	function checkRegister(){
		$this->_username 		= addslashes(Request::get('username'));
		$this->_password 		= addslashes(Request::get('password'));
		$this->_repwrd 			= addslashes(Request::get('repwrd'));
		$this->_email 			= addslashes(Request::get('email'));
		$this->_name 			= addslashes(Request::get('name'));
		$this->_gender	 		= Request::get('gender');
		$this->_birthday 		= Request::get('year').'-'.Request::get('month').'-'.Request::get('day');
		$this->_mobile 			= addslashes(Request::get('mobile'));
		$this->_ssn 			= addslashes(Request::get('ssn'));
		$this->_ssn 			= addslashes(Request::get('ssn'));
		$this->_occupation 		= addslashes(Request::get('occupation'));
		$this->_address 		= addslashes(Request::get('address'));
		$this->_captcha 		= addslashes(Request::get('captcha'));
		$this->_checkbox 		= Request::get('checkbox');
		
		
		if ($this->checkUsername() == false){
			return false;
		}
		
		if ($this->_password == null){
			$this->setError('Vui lÃ²ng nháº­p máº­t kháº©u', 0);
			return false;
		}
		
		if (strlen($this->_password) < 6){
			$this->setError('Máº­t kháº©u pháº£i cÃ³ Ä‘á»™ dÃ i tá»‘i thiá»ƒu lÃ  6 kÃ­ tá»±. ', 0);
			return false;
		}
		
		if ($this->_repwrd == null){
			$this->setError('Nháº­p láº¡i máº­t kháº©u.', 0);
			return false;
		}
		
		
		if ($this->_repwrd != $this->_password){
			$this->setError('Hai máº­t kháº©u khÃ´ng giá»‘ng nhau.', 0);
			return false;
		}
		
		
		if ($this->_name == null){
			$this->setError('TÃªn tháº­t cá»§a báº¡n lÃ  gÃ¬?',0);
			return false;
		}
		
		if ($this->_gender == null){
			$this->setError('Cho biết giới tính của bạn', 0);
			return false;
		}
		
		if ($this->_birthday == null){
			$this->setError('Please enter birthday', 0);
			return false;
		}
		
		if ($this->_mobile == null){
			$this->setError('Vui lÃ²ng cho biáº¿t sá»‘ Ä‘iá»‡n thoáº¡i cá»§a báº¡n.', 0);
			return false;
		}
		
		if (is_numeric($this->_mobile) == false){
			$this->setError('Sá»‘ Ä‘iá»‡n thoáº¡i khÃ´ng há»£p lá»‡', 0);
			return false;
		}
		
		if ($this->checkEmail() == false){
			return false;
		}
		
		if ($this->_ssn == null){
			$this->setError('Vui lÃ²ng nháº­p sá»‘ CMND', 0);
			return false;
		}
		
		if (is_numeric($this->_ssn) == false){
			$this->setError('Sá»‘ CMND khÃ´ng há»£p lá»‡', 0);
			return false;
		}
		
		if ($this->_occupation == null){
			$this->setError('Vui lÃ²ng cho biáº¿t báº¡n Ä‘ang lÃ m gÃ¬.', 0);
			return false;
		}
		
		if ($this->_address == null){
			$this->setError('Vui lÃ²ng cho biáº¿t Ä‘á»‹a chá»‰ cá»§a báº¡n.', 0);
			return false;
		}
		
		
		if ($this->_captcha == null){
			$this->setError('Vui lÃ²ng nháº­p mÃ£ báº£o vá»‡', 0);
			return false;
		}else {
			@session_start();
            if($this->_captcha != $_SESSION['security_code']){
            	$this->setError('MÃ£ báº£o vá»‡ khÃ´ng Ä‘Ãºng', 0);
				return false;
            }
		}
		
		if ($this->_checkbox == null){
			$this->setError('Chá»�n Ä‘á»“ng Ã½.', 0);
			return false;
		}
		
		
		return true;
	}
	
	
	function checkUsername(){
		if ($this->_username == null){
			$this->setError('Vui lÃ²ng nháº­p tÃªn Ä‘Äƒng nháº­p.', 0);
			return false;
		}
		
		if (preg_match("/[_0-9-]/i", $this->_username)){
			$this->setError('TÃªn Ä‘Äƒng nháº­p khÃ´ng Ä‘Æ°á»£c chá»©a kÃ­ tá»± sá»‘. ', 0);
			return false;
		}
		
		if (strlen($this->_username) <= 3){
			$this->setError('TÃªn Ä‘Äƒng nháº­p pháº£i lá»›n hÆ¡n 3 kÃ­ tá»± . ', 0);
			return false;
		}
		
		if (preg_match("/ /i", $this->_username)){
			$this->setError('TÃªn Ä‘Äƒng nháº­p khÃ´ng Ä‘Æ°á»£c chá»©a kÃ­ tá»± khoáº£ng tráº¯ng. ', 0);
			return false;
		}
		
		global $dbo;
		$dbo->setQuery("SELECT `username`
						FROM `user` 
						WHERE `username` = '$this->_username' ");
		$result = $dbo->loadResult();
		//neu khong co tra ve gia tri null,neu co tri tra ve username can check
		if ($result){
			$this->setError('TÃ i khoáº£n nÃ y Ä‘Ã£ tá»“n táº¡i. ', 0);
			return false; // tuc la chua ton tai username nay
		}
		
		return true;
	}
	
	
	function checkEmail(){
		if ($this->_email == null){
			$this->setError('Vui lÃ²ng nháº­p email.', 0);
			return false;
		}
		
		if (!ereg("^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-])*[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-])*[@]{1}[_a-zA-Z-]*[.]{1}[_a-zA-z-]{2,4}",$this->_email) ){
			$this->setError('Email khÃ´ng há»£p lá»‡.', 1);
			return false;
		}
		
		global $dbo;
		$dbo->setQuery("SELECT `email` 
						FROM `user` 
						WHERE `email` = '$this->_email' ");
		$result = $dbo->loadResult();
		//neu khong co tra ve gia tri null,neu co tri tra ve email can check
		if ($result){
			$this->setError('Email nÃ y Ä‘Ã£ tá»“n táº¡i. ', 0);
			return false; // tuc la chua ton tai email nay
		}
		
		return true;
	}
	
	
	function RandomActiveCode(){
        $string = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVXYZW";
	 	for($i=0; $i <= strlen($string); $i++){
            $possition = mt_rand(0,strlen($string));
            $code    = $code . substr($string,$possition,1);
        }
        return $code;
     }
	

     
/***************************************************************************/
/***************************************************************************/
// task = login
	function login(){
		global  $uob;
		if($uob->isLogined()==false) {
				if($uob->checkLogin()==false) {
					$this->setError('username or password not match', 1);
				}
			}
	}
	
	
	
	
	function checkLogin(){
		//lay cac thong tin
		$this->_username = addslashes(Request::get('username'));
		if(!isset($this->_username) || $this->_username=='' || $this->_username=='TÃªn Ä‘Äƒng nháº­p') {
			$this->setError('Vui lÃ²ng nháº­p tÃªn Ä‘Äƒng nháº­p. ', 0);
			return false;
		}
		
		$this->_password = md5(addslashes(Request::get('password')));
		if(!$this->_password || $this->_password=='') {
			$this->setError('Vui lÃ²ng nháº­p máº­t kháº©u. ', 0);
			return false;	
		}
			
		
		global $dbo;
		$dbo->setQuery("SELECT id,username,
							DATE_FORMAT(`lastvisit` ,'%d/%m/%Y <span>%H:%i</span>' ) as `lastvisit`
						FROM users 
						WHERE `username`='".$this->_username."' 
								AND `password` = '".$this->_password."' 
								AND `published` = '1' AND `activation`='1' 
						");
		$user = $dbo->loadObjectList();
		
		if($user){
			require_once('admincp/class/session.php');
			foreach ($user AS &$u)
			$session = new Session($u->id);
			$session->store();
			
			$user = $dbo->loadObjectList();
		
			foreach ($user AS &$u)
			@session_start();
			$_SESSION['user'] = new stdClass();
			$_SESSION['user']= $u;
			
			return true;
		}else{
			$this->setError('TÃªn Ä‘Äƒng nháº­p hoáº·c máº­t kháº©u khÃ´ng Ä‘Ãºng! ', 0);
			return false;	
		}
		
	}//end function checkLogin()
	
	function isLogined(){
		@session_start();
		if(isset($_SESSION['user']) && $_SESSION['user']->id) return true;
		return false;
	}
	
	
	function logout(){
		//Huy $_SESSION tuong ung
		@session_start();
		global $dbo;
		//$dbo->setQuery("DELETE FROM sessions ");
		//$user = $dbo->query();
		
		$lastvisit =date("Y-m-d H:i:s");
		$id = $_SESSION['user']->id;
		$dbo->setQuery("UPDATE `users` SET `lastvisit`='$lastvisit' WHERE id=$id ");
		$user = $dbo->query();
		$_SESSION['user'] = null;
	}
	
	
	
	/*
	function setError($msg,$type){
		$error 			= new stdClass();
		$error->type 	= $type;
		$error->msg 	= $msg;
		$this->errors[] = $error;
		$this->numerror += 1;
	}
	*/
	
	
/**************************************************************/
/**************************************************************/
//task = change password
	
	function changepassword(&$id,&$username){
		global $dbo;
		$dbo->setQuery("UPDATE `users` SET `password` = md5('{$this->_newpwrd}') WHERE id=$id AND `username`='{$username}' ");
		return $dbo->query();
	}
	
	function checkChangePassword(&$uid,&$uname){
		$this->_currpwrd		= addslashes(Request::get('currentpwrd')) ;
		$this->_newpwrd			= addslashes(Request::get('newpwrd'));
		$this->_renewpwrd		= addslashes(Request::get('re_newpwrd'));
		
		/*
		if ($this->checkCurrentPassword(&$uid,&$uname) == false){
			return false;
		}
		*/
		
		if ($this->_newpwrd == null){
			$this->setError('Nháº­p máº­t kháº©u má»›i', 0);
			return false;
		}
		
		if (strlen($this->_newpwrd) < 6){
			$this->setError('Máº­t kháº©u pháº£i cÃ³ Ä‘á»™ dÃ i tá»‘i thiá»ƒu lÃ  6 kÃ­ tá»±. ', 0);
			return false;
		}
		
		if ($this->_newpwrd != $this->_renewpwrd){
			$this->setError('Hai máº­t kháº©u khÃ´ng giá»‘ng nhau.', 0);
			return false;
		}
		
		return true;
	}
	
	function checkCurrentPassword(&$uid,&$uname){
		if ($this->_currpwrd == null){
			$this->setError('Nháº­p máº­t kháº©u hiá»‡n táº¡i', 0);
			return false;
		}
		
		global $dbo;
		$dbo->setQuery("SELECT `password`
						FROM `users` 
						WHERE `password` = md5('$this->_currpwrd') AND `id`=$uid AND `username`='$uname' ");
		$result = $dbo->loadResult();
		//neu khong co tuc la password hien tai nhap vao khong trung khop voi csdl
		if (!$result){
			$this->setError('Máº­t kháº©u hiá»‡n táº¡i khÃ´ng Ä‘Ãºng. ', 0);
			return false; 
		}
		
		return true;
		
	}

	

/***************************************************************************/
/***************************************************************************/
//function bao loi
	
	function setError($msg,$type){
		$this->errors[] = $msg;
		$this->numerror += 1;
	}
	
	function dumError(){
		if ($this->numerror >0){
			foreach ($this->errors AS &$err){
				return $err.'<br />';
			}
		}
	}
	
	
	
}