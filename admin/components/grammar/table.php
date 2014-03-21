<?php
class TableGrammar extends Table {
	var $g_id 					= null;
	var $g_title			    = null;
	var $g_mean				    = null;
	var $g_explain			    = null;
	var $g_note			        = null;
	var $g_example_jp			= null;
	var $g_example_en			= null;
	var $g_example_vi			= null;
	var $g_lesson_id			= null;
	
	function __construct(){
		parent::__construct('grammar','g_id');	
	}
}