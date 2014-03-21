<?php
class TableListening extends Table {
	var $li_id 					= null;
	var $li_lesson_id			= null;
	var $li_title				= null;
	var $li_script_jp			= null;
	var $li_script_en			= null;
	var $li_script_vi			= null;
	var $li_track			= null;
	
	function __construct(){
		parent::__construct('listening','li_id');	
	}
}