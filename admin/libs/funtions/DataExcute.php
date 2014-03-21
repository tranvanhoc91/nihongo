<?php
class DataExcute{
	private $_db = null;
	
	function DataExcute($db){
		$this->_db = $db;
	}
	
	
	/**
	 * 
	 * Tra ve so luong record trong table = $table, khong kem dieu kien
	 * @param $table : ten bang
	 */
	function getCountRows($table,$countValule){
		$query = "SELECT COUNT(".$countValule.") FROM ".$table;
		$this->_db->setQuery($query);
		return $this->_db->loadResult();
	}
	
	
	/**
	 * 
	 * Lay du lieu khong kiem dieu kien
	 * @param $table
	 * @param $fieldArr
	 */
	function getAllRows($table,$fieldArr){
		if (is_array($fieldArr)){
			
		}else{
			$query = "SELECT ".$fieldArr."
				   FROM ".$table;
		}
		$this->_db->setQuery($query);
		return $this->_db->loadResult();
	}
	
	
    function getAllRows($table,$fieldArr,$where){
		if (is_array($fieldArr)){ //Neu lay ve nhieu fieldname
			if (is_array($where)){ // neu co nhieu dieu kien
				
			}else {
				
			}
		}else{ //neu chi lay ve 1 fieldnam
			if (is_array($where)){
				
			}else {
				$query = "SELECT ".$fieldArr." FROM ".$table;
			}
		}
		
		$this->_db->setQuery($query);
		return $this->_db->loadResult();
	}
}