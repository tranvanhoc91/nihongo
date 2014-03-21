<?php
class TableTesttype extends Table {
	var $t_id 				= null;
	var $t_type				= null;
	function __construct(){
		parent::__construct('testtype','t_id');	
	}
}