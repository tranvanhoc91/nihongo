<?php
class Table{
	var $_tb			= null;
	var $_key		= null;
	//var $_errors	= array();
	
	function __construct($table, $pkey){
		$this->_tb 	= $table;
		$this->_key	= $pkey;
	}
	
	//load du lieu cua hang co id duoc truyen vao doi tuong
	function load($id){
		$query = "SELECT * FROM $this->_tb WHERE $this->_key = '$id' ";
		$result = mysql_query($query);
		$record = mysql_fetch_assoc($result);
		foreach($this AS $property=>$value) {
			if($property != '_tb' && $property != '_key') {
				$this->$property = $record[$property];
			}
		}
	}
	
	function delete($id=array()){
		if ($id){
			if (count($id) == 1){
				$query = " DELETE FROM  $this->_tb WHERE $this->_key = $id[0] ";
			}else {
				$query = " DELETE FROM  $this->_tb WHERE $this->_key IN(".implode(',', $id).")";
			}
			mysql_query($query);
		}
		
	}
	
	//lay du lieu $_GET/$_POST vao doi tuong
	function bind(){
		foreach($this AS $property=>&$value) {
			if($property != '_tb' && $property != '_key') {
				$value = Request::get($property);
			}
		}
	}
	
	
	//neu $this->$key co gia tri roi thi ta su dung update
	//neu chua co gia tri ta lam insert
	
	//cap nhat lai gia tri len doi tuong
	//thanh cong tre ve true, that bai tra ve false
	function store(){
		$pkey = $this->_key;
		if($this->$pkey){
			//update
			$query = " UPDATE $this->_tb ";
			$update = array();
			foreach($this AS $property=>$value) {
				if($property != '_tb' && $property != '_key') {
					$update[] = "`".$property."` = '".$value."'";
				}
			}
			
			if(count($update)) {
				$update = implode(',',$update);
				$query .= " SET $update ";	
			}
			
			$query .= " WHERE ".$this->_key." = ".$this->$pkey." ";
		}else {
			//inseret
			$query = " INSERT INTO $this->_tb ";
			
			$field 	= array();
			$data	= array();
			foreach($this AS $property=>$value) {
				if($property != '_tb' && $property != '_key') {
					$field[] 	= "`$property`";
					$data[] 	= "'$value'";
				}
			}
			
			if(count($field)) {
				$field = implode(',',$field);
				$data = implode(',',$data);
				$query .= " ($field) VALUE ($data) ";	
			}
		}
		
		//co cau query cho moi truong hop tuong ung
		//dump($query);
		//print_r($query);
		mysql_query($query);
		global $dbo;
		
		//cap nhat nguoc cac gia tri tu db len doi tuong nay
		if(!$this->$pkey){
			$insert_id = mysql_insert_id($dbo->_link);
			$this->load($insert_id);
		}
		
		$affected = mysql_affected_rows($dbo->_link);
		if($affected) return true;
		else return false;
	}
}
