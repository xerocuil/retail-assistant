<?php
// Pagination Settings
if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}
$no_of_records_pp = 50;
$offset = ($pageno-1) * $no_of_records_pp;
$total_rows = $db->querySingle("SELECT COUNT(*) FROM items WHERE category_id != 1");
$total_pages = ceil($total_rows / $no_of_records_pp);
$pagination = 'true';
?>