<?php
$pageTitle='Batch Task';
$message = "";
require $_SERVER['DOCUMENT_ROOT'].'/incl/config.php';
include $appdir.'/incl/header-default.php';

if(isset($_POST['print'])){//to run PHP script on submit
	if(!empty($_POST['id'])){
		// Loop to store and display values of individual checked checkbox.
		foreach($_POST['id'] as $selected){
			$query = "UPDATE items SET tag = 1 WHERE id = $selected";
	
			// Executes the query
			// If data inserted then set success message otherwise set error message
			// Here $db comes from "db_connect.php"
			if( $db->exec($query) ){
				$message = '<div class="notification is-success">Added items to Print Batch successfully.</div>';
				header( "refresh:0.5;url=/" );
			}else{
				$message = '<div class="notification is-danger">Sorry, there was an error.</div>';
			}
		}
	}
}
if(isset($_POST['category'])){
	if(!empty($_POST['id'])){
		foreach($_POST['id'] as $selected){
			$query = "UPDATE price_list SET batch = 1 WHERE id = $selected";
			if( $db->exec($query) ){
				$message = '<div class="notification is-success">Added items to Category Batch successfully.</div>';
				header( "refresh:0.5;url=/categories/batch.php" );
			}else{
				$message = '<div class="notification is-danger">Sorry, there was an error.</div>';
			}
		}
	}
}
if(isset($_POST['delete'])){
	if(!empty($_POST['id'])){
		foreach($_POST['id'] as $selected){
			$query = "DELETE FROM price_list WHERE id = $selected";
			if( $db->exec($query) ){
				$message = '<div class="notification is-success">Items deleted successfully.</div>';
				header( "refresh:0.5;url=/groups/batch.php" );
			}else{
				$message = '<div class="notification is-danger">Sorry, there was an error.</div>';
				header( "refresh:2.5;url=/" );
			}
		}
	}
}
echo $message;
?>