<?php
$pageTitle = "Search Results";
require $_SERVER['DOCUMENT_ROOT'].'/incl/config.php';
include $appdir.'/incl/header-default.php';

// Get search data
if( isset($_POST['search']) ){
	$search_query = $_POST['search_query'];
}
// Database Query
$query = "SELECT * FROM items WHERE name LIKE '%$search_query%' OR description LIKE '%$search_query%' ORDER BY name ASC;";
$results = $db->query($query);

// Get List View
include $appdir.'/helpers/list_view.php';
include $appdir.'/incl/footer-default.php';
?>