<?php
$pageTitle = "Add to Groups";
require $_SERVER['DOCUMENT_ROOT'].'/incl/settings.php';
include $appdir.'/incl/header-default.php';
if( isset($_POST['submit_data']) ){
	$group_id = $_POST['group_id'];
	$query_update = "UPDATE price_list SET group_id = '$group_id' WHERE batch == 1";
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
		echo '<div class="field">Add to <a href="/groups/add.php?batch=true">New Group</a> or</div>';
		$query_groups = "SELECT * FROM groups WHERE 1 ORDER BY name ASC";
		$result_groups = $db->query($query_groups);
		echo '<form action="" method="post">Add to existing group:<div class="select"><select name="group_id">';
		echo '<option value="" selected>None</option>';
		while($row_groups = $result_groups->fetchArray()) {
			echo '<option value="'.$row_groups['id'].'">'.$row_groups['name'].'</option>';
		}
		echo '</select></div><div class="field"><input class="button is-link is-small" name="submit_data" type="submit" value="Submit"></div></form>';
		?>	
	</div>
</div>

<?php include $appdir.'/incl/footer-default.php'; ?>
