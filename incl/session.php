<?php
session_start();
if( !isset($_SESSION['status']) ){
	header("Location: /login.php");
	exit();
}

$time = $_SERVER['REQUEST_TIME'];
$timeout_duration = 7200;

if (isset($_SESSION['LAST_ACTIVITY']) && 
   ($time - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
	unset($_SESSION);
	session_unset();
	session_destroy();
}

$_SESSION['LAST_ACTIVITY'] = $time;
?>