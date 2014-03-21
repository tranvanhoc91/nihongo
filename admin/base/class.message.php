<?php
	//2 loai thong bao:
	//0: cac thong bao thong thuong (message)
	//1: cac loi xay ra trong qua trinh thuc thi (error)
	class Message{
		static function setMessage($msg, $type=0){
			//them cac message vao trong session
			@session_start();
			//$_SESSION['message']
			$message = new stdClass();
			$message->type = $type;
			$message->msg = $msg;
			$_SESSION['message'][] = $message;
		}
		
		static function getMessage($type=-1){
			//lay ve toan bo loi thuoc loai nao do
			//$type == -1: tra ve ca message va error
			//$type == 0: tra ve message
			//$type == 1: tra ve cac error
			@session_start();
			switch($type){ 
				case 0:
				case 1: 
					$tem = null;
					if(isset($_SESSION['message'])&&count($_SESSION['message']))
					foreach($_SESSION['message'] AS $m){
						if($m->type==$type)
							$tem[] = $m;
					}
					return $tem;
					
				default: return $_SESSION['message'];
			}
				
		}
		
		static function removeAllMessage(){
			@session_start();
			$_SESSION['message'] = null;
		}
				
		static function dumpMessage(){
			//xuat cac message len man hinh
			//xoa cac message khoi session
			//lay ve cac error
			@session_start();
			$error = Message::getMessage(1);
			if(count($error)){
				echo '<div class="notification error png_bg">
						<a href="#" class="close"><img src="templates/joomlaCMS/images/icon/cross_grey_small.png" title="Close this notification" alt="close" /></a>';
						foreach($error AS $er){
									echo '<div>'.$er->msg.'</div>';
								}
				echo '</div>';
			}
			
			//lay ve cac message va xuat ra
			$message = Message::getMessage(0);
			if(count($message)){
				echo '<div class="notification success png_bg">
						<a href="#" class="close"><img src="templates/joomlaCMS/images/icon/cross_grey_small.png" title="Close this notification" alt="close" /></a>';
						foreach($message AS $ms){
								echo '<div>'.$ms->msg.'</div>';
							}
				echo '</div>';
			}
			
			$_SESSION['message'] = null; //huy message
		}
	}
?>
