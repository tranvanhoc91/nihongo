<?php
class TableQuestion extends Table {
	var $q_id 					= null;
	var $q_question			= null;
	var $q_anwser1				= null;
	var $q_anwser2			= null;
	var $q_anwser3			= null;
	var $q_anwser4			= null;
	var $q_correct			= null;
	var $q_type			= null;
	
	function __construct(){
		parent::__construct('question','q_id');	
	}
}