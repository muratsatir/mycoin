<?php
session_start();
ob_start();

require_once('./system/startup.php');

if(isset($_SESSION['user_id']) && (int)$_SESSION['user_id']>0){
	$path="index";
	if(isset($_GET['path'])){
		$path=$_GET['path'];
	}
	require_once($path.".php");
}else{
	unset($_SESSION['user_id']);
	$path="login";
	if(isset($_GET['path']) && $_GET['path']=="register"){
		$path="register";
	}
	require_once($path.".php");
}

ob_end_flush();
