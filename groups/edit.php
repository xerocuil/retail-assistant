<?php
//require $_SERVER['DOCUMENT_ROOT'].'/incl/session.php';
$pageTitle = "Edit Group";
$message = "";
require $_SERVER['DOCUMENT_ROOT'].'/incl/settings.php';
include $appdir.'/incl/header-default.php';

if( isset($_POST['submit_data']) ){

	// Gets the data from post
	$id = $_POST['id'];
	$name = $_POST['name'];
	$description = $_POST['description'];
	$category_id = $_POST['category_id'];
	$cost = $_POST['cost'];
	$tag = $_POST['tag'];
	// Makes query with post data
	$query = "UPDATE groups SET name = '$name', description = '$description', category_id = '$category_id', cost = '$cost', tag = '$tag' WHERE id = '$id'";
	
	// Executes the query
	// If data inserted then set success message otherwise set error message
	// Here $db comes from "db_connect.php"
	if( $db->exec($query) ){
		echo '<div class="notification is-success">Data has been updated successfully.</div>';
	}else{
		echo '<div class="notification is-danger">Sorry, data has not not updated.</div>';
	}
}
if( isset($_POST['update_cost']) ){

	// Gets the data from post
	$id = $_POST['id'];
	$cost = $_POST['cost'];
	// Makes query with post data
	$query = "UPDATE groups SET cost = '$cost' WHERE id = '$id'";
	
	// Executes the query
	// If data inserted then set success message otherwise set error message
	// Here $db comes from "db_connect.php"
	if( $db->exec($query) ){
		echo '<div class="notification is-success">Data has been updated successfully.</div>';
	}else{
		echo '<div class="notification is-danger">Sorry, data has not not updated.</div>';
	}
}

$id = $_GET['id'];
$query = "SELECT * FROM groups WHERE id = $id";
$result = $db->query($query);
?>

<h1><?php echo $pageTitle; ?></h1>
<div class="columns">
	<div class="column is-one-third">
		<form action="" method="post">
			<?php
			while($row = $result->fetchArray()) { ?>
				<input type="hidden" name="id" value="<?php echo $id; ?>">
				<div class="field">
					<strong>Name:</strong><br>
					<input class="input" type="text" name="name" value="<?php echo $row['name']; ?>">
				</div>
				<div class="field">
					<strong>Description:</strong><br>
					<input class="input" type="text" name="description" value="<?php echo $row['description']; ?>" rows="2">
				</div>
				<div class="field">
					<strong>Category:</strong><br>
					<div class="select">
						<select name="category_id">
							<?php
							$catno = $row['category_id'];
							$cnresult = $db->querySingle("SELECT name FROM categories WHERE id = '$catno'");
							echo '<option value="'.$row['category_id'].'" selected>'.$cnresult.'</option>';
							echo '<option value="">None</option>';
							$query_cat = "SELECT id, name FROM categories WHERE id != '$catno' ORDER BY name ASC";
							$result_cat = $db->query($query_cat);
							while($row_cat = $result_cat->fetchArray()) {
								echo '<option value="'.$row_cat['id'].'">'.$row_cat['name'].'</option>';
							} ?>
						</select>
					</div>
				</div>
				<div class="field" style="width: 72px">
					<strong>Cost:</strong><br>
					<input class="input" type="text" name="cost" value="<?php echo $cost; ?>" size="4">
				</div>
				<div class="field">Add to print batch? &nbsp;
					<?php
					$print=$row['tag'];
					if ($print > 0){
						echo '<input type="checkbox" name="tag" value="1" checked></div>';
					} else {
						echo '<input type="checkbox" name="tag" value="1"></div>';
					}
			}
			?>
			<hr>
			<div class="field">
				<input class="button is-link is-small" name="submit_data" type="submit" value="Submit">
				<a class="button is-danger is-small" href="/groups/">Back</a>
			</div>
		</form>
	</div>

	<?php
	$count = $db->querySingle("SELECT COUNT(*) as count FROM price_list WHERE group_id = $id");
	// add condition for group not over X
	if ($count > 0){
		echo '<div class="column" style="padding-left:32px;">';
	} else {
		echo '<div class="column" style="display:none;visibility:hidden">';
	}
	?>
		<h2>Associated Parts</h2>
		<table>
			<tr>
				<th>Part</th>
				<th>Description</th>
				<th>Qty</th>
				<th>Cost</th>
				<th>&nbsp;</th>
			</tr>
			<?php
			$query_part = "SELECT * FROM price_list WHERE group_id = $id";
			$result_part = $db->query($query_part);
			$sum = 0;
			while($row_part = $result_part->fetchArray()) {
				if ($row_part['qty'] < 1){
					$qty = 1;
				} else {
					$qty = $row_part['qty'];
				}
				$totalCost = round($row_part['cost']*1.03) * $qty;
				$sum +=$totalCost;
				?>
				<tr>
					<td><?php echo $row_part['part']; ?></td>
					<td><?php echo $row_part['description']; ?></td>
					<td><?php echo $qty; ?></td>
					<td> <?php echo $totalCost; ?></td>
					<td class="noprint"><a class="button is-outlined is-link is-small" href="/parts/edit.php?id=<?php echo $row_part['id']; ?>">Edit</a></td>
				</tr>
			<?php } ?>
			<tr>
				<td>&nbsp;</td>
				<td style="text-align:right" colspan="2">Total Cost:</td>
				<td><?php echo $sum; ?></td>
				<td>
					<form action="" method="post">
						<input type="hidden" name="id" value="<?php echo $id; ?>">
						<input type="hidden" name="cost" value="<?php echo $sum; ?>">
						<input  class="button is-link is-small is-outlined" type="submit" name="update_cost" value="Update Cost?">
					</form>
				</td>
			</tr>
		</table>
	</div>
</div>

<?php 
//include $appdir.'/helpers/test.php';
include $appdir.'/incl/footer-default.php'; ?>