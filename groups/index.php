<?php
//require $_SERVER['DOCUMENT_ROOT'].'/incl/session.php';
$pageTitle = "Groups";
require $_SERVER['DOCUMENT_ROOT'].'/incl/config.php';
include $appdir.'/incl/header-default.php';

// Database Query
$query = "SELECT * FROM groups ORDER BY name ASC";
$result = $db->query($query);
?>
	
<div class="columns">
	<div class="column">
		<h1 class="title is-4"><?php echo $pageTitle; ?></h1>
	</div>
	<div class="column is-narrow">
		<a class="button is-link is-small is-outlined" href="/groups/add.php">Add Group</a>
	</div>
</div>

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
	while($row = $result->fetchArray()) {
		echo '<tr><td><a href="/groups/edit.php?id='.$row['id'].'">'.$row['name'].'</a></td>';
		echo '<td>'.$row['description'].'</td>';
		$catno = $row['category_id'];
		$cresult = $db->querySingle("SELECT name FROM categories WHERE id='$catno'");
		echo '<td class="noprint"><a href="/categories/view.php?id='.$catno.'">'.$cresult.'</a></td>';
		$cost = $row['cost'];
		echo '<td>'.$cost.'GW</td>';
		include $appdir.'/helpers/price.php';
		echo '<td>'.$price.'</td>';
		$tag = $row['tag'];
		if ($tag == 1){
			echo '<td class="noprint"><span class="icon"><i class="far fa-check-square"></i></span></td>';
		} else {
			echo '<td class="noprint ">&nbsp</td>';
		}
		echo '<td class="noprint"><a class="button is-outlined is-link is-small" href="/groups/edit.php?id='.$row['id'].'"><span class="icon"><i class="far fa-edit"></i></span></a></td>';
		echo '<td class="noprint"><a class="button is-outlined is-danger is-small" href="/groups/delete.php?id='.$row['id'].'"><span class="icon"><i class="far fa-trash-alt"></i></span></a></td></tr>';
	}
	// close db connection
	$db = NULL;
	?>	
</table>

</article>
</div>

<!-- end content -->

<!-- begin footer -->
<footer>
</footer>
</body>
</html>
<!-- end footer/page -->