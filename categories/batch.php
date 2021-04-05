<?php
//require $_SERVER['DOCUMENT_ROOT'].'/incl/session.php';
$pageTitle = "Add to Category";
require $_SERVER['DOCUMENT_ROOT'].'/incl/settings.php';
include $appdir.'/incl/header-default.php';
if( isset($_POST['submit_data']) ){
	$category_id = $_POST['category_id'];
	$query_update = "UPDATE price_list SET category_id = '$category_id' WHERE batch == 1";
	$query_clear_batch = "UPDATE price_list SET batch = NULL WHERE batch = 1";
	if( $db->exec($query_update) ){
		echo '<div class="notification is-success">Parts have been added to category.</div>';
		$db->exec($query_clear_batch);
		header( "refresh:0.5;url=/" );
	}else{
		echo '<div class="notification is-danger">Sorry, there was an error.</div>';
	}
}
?>

<h1 class="title is-4"><?php echo $pageTitle; ?></h1>
<div class="columns">
	<div class="column is-one-third">
		<table class="table">
			<tr>
				<th>Parts</th>
			</tr>
			<?php
			$query_price_list = "SELECT * FROM price_list WHERE batch == 1 ORDER BY part ASC";
			$result_price_list = $db->query($query_price_list);
			while($row_price_list = $result_price_list->fetchArray()) {
				echo '<tr><td>'.$row_price_list['part'].'</td></tr>';
			}
			?>	
		</table>
	</div>

	<div class="column is-one-third">
		<?php
		$query_categories = "SELECT * FROM categories WHERE 1 ORDER BY name ASC";
		$result_categories = $db->query($query_categories);
		echo '<form action="" method="post"><div class="select"><select name="category_id">';
		echo '<option value="" selected>None</option>';
		while($row_categories = $result_categories->fetchArray()) {
			echo '<option value="'.$row_categories['id'].'">'.$row_categories['name'].'</option>';
		}
		echo '</select></div><input class="button is-link is-small" name="submit_data" type="submit" value="Submit"></form>';
		?>	
	</div>
</div>

<?php include $appdir.'/incl/footer-default.php'; ?>
