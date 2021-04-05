<?php
//require $_SERVER['DOCUMENT_ROOT'].'/incl/session.php';
require $_SERVER['DOCUMENT_ROOT'].'/incl/config.php';
$pageTitle = "Inventory List";
include $appdir.'/incl/header-default.php';
include $appdir.'/helpers/pagination.php';

$query = "SELECT * FROM items WHERE category_id != 1";

if ( !isset($_GET['sort']) ) {
	$query .= " ORDER BY part ASC LIMIT $offset, $no_of_records_pp";
} elseif ( $_GET['sort'] == 'lot' ) {
	$query .= " ORDER BY cost ASC LIMIT $offset, $no_of_records_pp";
}

$results = $db->query('SELECT * FROM items');
include $appdir.'/helpers/list_view.php';

include $appdir.'/incl/footer-default.php';
?>
