<?php
class TableLesson extends Table {
	var $le_id 					= null;
	var $le_title				= null;
	
	function __construct(){
		parent::__construct('lesson','le_id');	
	}
}