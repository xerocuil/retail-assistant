<?php
$id = $_GET['id'];
require $_SERVER['DOCUMENT_ROOT'].'/incl/settings.php';
$pageTitle='Delete Group';
$message = "";

include $appdir.'/incl/header-default.php';

$query = "DELETE FROM groups WHERE id = $id";

if( $db->exec($query) ){
	$message = '<div class="notification is-success">Group deleted.</div>';
	header( "refresh:0.5;url=/groups/" );
}else{
	$message = '<div class="notification is-danger">Sorry, group was not deleted.</div>';
}

echo '<h1>'.$pageTitle.'</h1>';
echo '<div class="columns"><div class="column">';
echo $message.'<br>';
echo '</div><div class="column">&nbsp;</div></div>';
include $appdir.'/incl/footer-default.php';
?>