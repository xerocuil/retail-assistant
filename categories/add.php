<?php
//require $_SERVER['DOCUMENT_ROOT'].'/incl/session.php';
$pageTitle = "Categories";
require $_SERVER['DOCUMENT_ROOT'].'/incl/config.php';
include $appdir.'/incl/header-default.php';

// Database Query
$query = "SELECT * FROM categories ORDER BY name ASC";
$result = $db->query($query);
?>

<div class="columns" style="width: 33%">
	<div class="column">
		<h1 class="title is-4"><?php echo $pageTitle; ?></h1>
	</div>
	<div class="column is-narrow">
		<a class="button is-link is-small is-outlined" href="/categories/add.php">Add Category</a>
	</div>
</div>

<table class="table" style="width: 33%">
	<tr>
		<th>Name</th>
		<th class="actions noprint">Actions</th>
	</tr>
	<?php while($row = $result->fetchArray()) { ?>
	<tr>
		<td><a href="/categories/view.php?id=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></td>
		<td class="noprint">
			<a class="button is-outlined is-link is-small" href="/admin/edit_category.php?id=<?php echo $row['id']; ?>">Edit</a>&nbsp;
			<a class="button is-outlined is-danger is-small" href="/categories/delete.php?id=<?php echo $row['id']; ?>">Delete</a>
		</td>
	</tr>
	<?php
	}
	// close db connection
	$db = NULL;
	?>	
</table>

<?php include $appdir.'/incl/footer-default.php'; ?>
