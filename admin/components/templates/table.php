<?php
class TableTemplates extends Table {
	var $id 			= null;
	var $title			= null;
	var $default 		= null;
	var $description	= null;
	
	function __construct(){
		parent::__construct('templates','id');
	}
}