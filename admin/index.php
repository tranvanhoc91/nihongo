<?php
require_once('require.php');

//khoi tao doi tuong ket noi voi database
$dbo = new Database;

//$data = new DataExcute($dbo);

$uo = new User;


$task = Request::get('task');
if ($task =='logout') 
	$uo->adminLogout();
	
if($uo->adminIsLogin()==false) {
	if($uo->adminCheckLogin()==false) {
		header('location:login.php');
	}
}

$whitelist = array('users','lesson','grammar','kanji','listening','reading','question','testtype','vocabulary','cpanel');

//lay doi tuong nguoi dung dang muon thao tac
$component = Request::get('option','cpanel');
//include cac file xay dung man hinh

if($component && in_array($component,$whitelist)){
	require_once('components/'.$component.'/toolbar.'.$component.'.php');
	require_once('components/'.$component.'/admin.'.$component.'.php');
}
require_once(dirname(__FILE__).'/templates/joomlaCMS/index.php');
?>