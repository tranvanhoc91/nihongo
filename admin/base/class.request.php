<?php
class Request {
		static function get($key, $default=null){
			if(isset($_POST[$key])) return $_POST[$key];
			elseif(isset($_GET[$key])) return $_GET[$key];
			elseif(isset($_FILE[$key])) return $_FILE[$key];
			else return $default;
		}
		
		static function set($key,$value){
			//them du lieu vao mang $_POST hoac $_GET
		}
		
		static function getServer($key,$default=null){
			if ($key && isset($_SERVER[$key])){
				return $_SERVER[$key];
			}
		}
}
?>
