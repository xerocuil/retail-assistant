<?php
//require $_SERVER['DOCUMENT_ROOT'].'/incl/session.php';
require $_SERVER['DOCUMENT_ROOT'].'/incl/config.php';
$pageTitle = "Preview Price Tags";
include $appdir.'/incl/header-default.php';

$query = "SELECT * FROM items WHERE tag = '1' ORDER BY name ASC";
$query_group = "SELECT * FROM groups WHERE tag = '1' ORDER BY name ASC";

$results = $db->query($query);
$result_group = $db->query($query_group);

include $appdir.'/helpers/list_view.php';
?>
<h2 class="title is-4" >Preview Group Tags</h2>
<table class="table">
	<tr>
		<th>Name</th>
		<th>Description</th>
		<th>Category</th>
		<th>Lot #</th>
		<th>Price</th>
		<th class="noprint">Tag</th>
		<th class="actions noprint" colspan="2">Actions</th>
	</tr>
	<?php
	while($row_group = $result_group->fetchArray()) {
		echo '<tr><td><a href="/groups/edit.php?id='.$row_group['id'].'">'.$row_group['name'].'</a></td>';
		echo '<td>'.$row_group['description'].'</td>';
		$catno = $row_group['category_id'];
		$cresult = $db->querySingle("SELECT name FROM categories WHERE id='$catno'");
		echo '<td class="noprint"><a href="/categories/view.php?id='.$catno.'">'.$cresult.'</a></td>';
		$cost = $row_group['cost'];
		echo '<td>'.$cost.'GW</td>';
		include $appdir.'/helpers/price.php';
		echo '<td>'.$price.'</td>';
		$tag = $row_group['tag'];
		if ($tag == 1){
			echo '<td class="noprint"><span class="icon"><i class="far fa-check-square"></i></span></td>';
		} else {
			echo '<td class="noprint ">&nbsp</td>';
		}
		echo '<td class="noprint"><a class="button is-outlined is-link is-small" href="/groups/edit.php?id='.$row_group['id'].'"><span class="icon"><i class="far fa-edit"></i></span></a></td>';
		echo '<td class="noprint"><a class="button is-outlined is-danger is-small" href="/groups/delete.php?id='.$row_group['id'].'"><span class="icon"><i class="far fa-trash-alt"></i></span></a></td></tr>';
	}
	?>	
</table>

<?php 
include $appdir.'/incl/footer-default.php';
?>
