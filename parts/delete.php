<?php
//require $_SERVER['DOCUMENT_ROOT'].'/incl/session.php';
$id = $_GET['id'];
$pageTitle='Delete Parts';
$message = "";
require $_SERVER['DOCUMENT_ROOT'].'/incl/settings.php';
include $appdir.'/incl/header-default.php';

$query = "DELETE FROM price_list WHERE id = $id";

if( $db->exec($query) ){
	$message = '<div class="notification is-success">Part deleted.</div>';
	header( "refresh:0.5;url=/" );
}else{
	$message = '<div class="notification is-danger">Sorry, part was not deleted.</div>';
}

echo '<h1>'.$pageTitle.'</h1>';
echo '<div class="columns"><div class="column">';
echo $message.'<br>';
echo '</div><div class="column">&nbsp;</div></div>';
include $appdir.'/incl/footer-default.php';
?>