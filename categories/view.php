<?php
//require $_SERVER['DOCUMENT_ROOT'].'/incl/session.php';
$id=$_GET['id'];
require $_SERVER['DOCUMENT_ROOT'].'/incl/config.php';

// Database Query
$query = "SELECT * FROM items WHERE category_id = $id ORDER BY name ASC";
$cat_name = $db->querySingle("SELECT name FROM categories WHERE id = $id");
$results = $db->query($query);

// In this page, $pageTitle will come directly from a sqlite query.
$pageTitle = 'Category: '.$cat_name;
include $appdir.'/incl/header-default.php';

include $appdir.'/helpers/list_view.php';
include $appdir.'/incl/footer-default.php';
?>