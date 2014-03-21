<?php
class TableKanji extends Table {
	var $k_id 					= null;
	var $k_kanji				= null;
	var $k_mean_kanji			= null;
	var $k_mean_en				= null;
	var $k_mean_vi				= null;
	var $k_onyomi			= null;
	var $k_kunyomi			= null;
	var $k_remember			= null;
	var $k_on_ex			= null;
	var $k_kun_ex			= null;
	
	function __construct(){
		parent::__construct('kanji','k_id');	
	}
}