<?php
class TableUsers extends Table {
	var $id 					= null;
	var $name					= null;
	var $username				= null;
	var $password 				= null;
	var $email 					= null;
	var $actived				= null;
	var $block					= null;
	var $registerDate			= null;
	var $lastvisitDate			= null;
	var $group_id				= null;
	var $hash					= null;
	
	function __construct(){
		parent::__construct('users','id');	
	}
}