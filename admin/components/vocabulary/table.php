<?php
class TableVocabulary extends Table {
	var $v_id 					= null;
	var $v_word					= null;
	var $v_hiragana				= null;
	var $v_mean_kanji			= null;
	var $v_mean_en				= null;
	var $v_mean_vi				= null;
	var $v_lesson_id			= null;
	var $v_note         		= null;
	
	function __construct(){
		parent::__construct('vocabulary','v_id');	
	}
}