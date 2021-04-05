<?php
$pageTitle = 'Print Part Tags';
require $_SERVER['DOCUMENT_ROOT'].'/incl/config.php';

echo '<!DOCTYPE HTML><html><head>';
echo '<title>'.$pageTitle.'</title>';
echo '<link rel="stylesheet" href="/assets/css/workbench.css"/>';
echo '</head><body><div class="page-wrap">';

$query = "SELECT * FROM items WHERE tag == 1 ORDER BY part ASC";
$result = $db->query($query);
while($row = $result->fetchArray()) {
	$catno = $row['category_id'];
	$cresult = $db->querySingle("SELECT name FROM categories WHERE id='$catno'");
	$cost = round($row['cost']);
	include $appdir.'/helpers/price.php';
	
	echo '<div class="label">';
	echo '<div class="price">'.$price.'</div>';
	echo '<div class="msrp">MSRP</div>';
	$desc = $row['description'];
	if (strlen($desc) > 40)
		$desc = substr("$desc", 0, 40) . '...';
	if ($row['category_id'] == 8) {
		echo '<div class="partno">'.$row['part'].' - '.$desc.'<br /></div></div>';
	} else {
		echo '<div class="partno">'.$row['part'].' - '.$desc.'<br /><span class="lotno">LOT# '.$row['cost'].'GW</span></div></div>';
	}
	
}
$query_groups = "SELECT * FROM groups WHERE tag == 1 ORDER BY name ASC";
$result_groups = $db->query($query_groups);
while($row_groups = $result_groups->fetchArray()) {
	$catno = $row_groups['category_id'];
	$cresult = $db->querySingle("SELECT name FROM categories WHERE id='$catno'");
	$cost = $row_groups['cost'];
	include $appdir.'/helpers/price.php';
	
	echo '<div class="label">';
	echo '<div class="price">'.$price.'</div>';
	echo '<div class="msrp">MSRP</div>';
	$desc = $row_groups['description'];
	if (strlen($desc) > 40)
		$desc = substr("$desc", 0, 40) . '...';

	if ($row_groups['category_id'] == 8) {
		echo '<div class="partno">'.$row_groups['name'].' - '.$desc.'<br /></div></div>';
	} else {
		echo '<div class="partno">'.$row_groups['name'].' - '.$desc.'<br /><span class="lotno">LOT# '.$row_groups['cost'].'GW</span></div></div>';
	}
}
$db=NULL;

echo '</div></body></html>';
?>