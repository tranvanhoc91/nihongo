<?php
class Database {
	public $_link 		= null;
	
	private $_query 	= null;
	
	private $_count		= null;
	
	private $_affected 	= null;
	
	private $_errors	= array();
	
	function __construct($h = 'localhost',$u = 'root', $p = '',$db='japanese'){
		//ket noi du lieu
		$this->_link = mysql_pconnect($h, $u, $p);
		if (!$this->_link){
			die('Connexion impossible : ' . mysql_error());
		}else {
			mysql_select_db($db,$this->_link);
			mysql_query("SET NAMES 'UTF8'");
		}
	}
	//insert into tintuc(id,title,text) VALUES ('','abcdef','Dang's computer ')
	function setQuery($query){
		//loc cac noi dung nguy hai hoac co the tao loi truy van
		$this->_query = $query;
		
		//echo $this->_query;
	}
	//lay ve mang cac doi tuong
	//moi doi tuong tuong ung voi 1 record trong table
	function loadObjectList(){
		if($this->_query){
		$results = mysql_query($this->_query);
		$count = mysql_num_rows($results);
		if($count){
			$this->_count = $count;
			$robj = array();
			while($result = mysql_fetch_assoc($results)){
				$tem = new stdClass();
				foreach($result AS $key=>$value){
					$tem->$key = $value;
				}
				$robj[] = $tem;
			}
			return $robj;
		}
			
		}
		$this->_count = 0;
		return array();
	}
	//lay ve 1 doi tuong, tuong ung voi 1 record trong table
	function loadObject(){
		if($this->_query){
			$result = mysql_query($this->_query);
			$count = mysql_num_rows($result);
			
			/*echo "<pre>";
			var_dump($this->_query);
			echo "</pre>";*/
			
			if($count){
				$this->_count = $count;
				$result = mysql_fetch_assoc($result);
				$robj = new stdClass();
				foreach($result AS $key=>$value){
					$robj->$key = $value;
				}
				return $robj;
			}
		}
		$this->_count = 0;
		return null;
	}
	//select username from user where id = 50
	//lay ve 1 mau du lieu, tuong ung voi du lieu trong 1 o trong table
	function loadResult(){
		if($this->_query){
		$result = mysql_query($this->_query);
		$count = mysql_num_rows($result);
		if($count){
			$this->_count = $count;
			$result = mysql_fetch_assoc($result);
			foreach($result AS $r) 
				return $r;
		    }
		}
		$this->_count = 0;
		return null;
	}
	
	function getQuery(){
		return $this->_query;
	}
	
	//select title from abc where id < 5
	//lay ve mot mang du lieu
	//moi phuan tu tuong ung voi du lieu cua 1 o trong bang
	function loadResultArray(){
	
	}
	
	function query(){
		if($this->_query){
			mysql_query($this->_query);
			$this->_affected = mysql_affected_rows($this->_link);
			if($this->_affected) 
			    return true;
		}
		return false;
	}
}
