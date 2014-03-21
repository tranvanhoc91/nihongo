<?php
class TableReading extends Table {
	var $r_id 					= null;
	var $r_title			= null;
	var $r_content_jp				= null;
	var $r_content_en			= null;
	var $r_content_vi			= null;
	var $r_lesson_id			= null;
	
	function __construct(){
		parent::__construct('reading','r_id');	
	}
}