<?php
//require $_SERVER['DOCUMENT_ROOT'].'/incl/session.php';
$pageTitle = "Edit Name";
$message = "";
require $_SERVER['DOCUMENT_ROOT'].'/incl/config.php';
include $appdir.'/incl/header-default.php';

// Updating the table row with submited data according to rowid once form is submited 
if( isset($_POST['submit_data']) ){

	// Gets the data from post
	$id = $_POST['id'];
	$name = $_POST['name'];
	$description = $_POST['description'];
	$qty = $_POST['qty'];
	if ($_POST['category_id'] > 0){
		$category_id = $_POST['category_id'];
	} else {
		$category_id = "";
	}
	$cost = $_POST['cost'];
	if ($_POST['group_id'] > 0){
		$group_id = $_POST['group_id'];
	} else {
		$group_id = "";
	}
	$tag = $_POST['tag'];
	// Makes query with post data
	$query = "UPDATE items SET name = '$name', description = '$description', qty = '$qty', cost = '$cost', category_id = '$category_id', group_id = '$group_id', tag = '$tag' WHERE id = '$id'";
	
	// Executes the query
	if( $db->exec($query) ){
		echo '<div class="notification is-success">Data is updated successfully.</div>';
	}else{
		echo '<div class="notification is-danger">Sorry, Data is not updated.</div>';
	}
}

$id = $_GET['id'];
$query = "SELECT * FROM items WHERE id = $id";

$result = $db->query($query);
?>
<h1><?php echo $pageTitle; ?></h1>
<div class="columns">
	<div class="column is-one-third">
		<form action="" method="post">
			<?php while($row = $result->fetchArray()) { ?>
				<input type="hidden" name="id" value="<?php echo $id; ?>">
				<div class="field">
					<strong>Name:</strong><br>
					<input class="input" type="text" name="name" value="<?php echo $row['name']; ?>">
				</div>
				<div class="field">
					<strong>Description:</strong><br>
					<textarea class="textarea" value="<?php echo $row['description']; ?>"></textarea>
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
				<a class="button is-danger is-small" href="/workbench">Back</a>
			</div>
		</form>
	</div>

	<div class="column">
		<div class="field">
			<strong>Group:</strong><br>
			<div class="select">
				<select name="group_id">
					<?php
					$groupno = $row['group_id'];
					$gnresult = $db->querySingle("SELECT name FROM item_groups WHERE id = '$groupno'");
					echo '<option value="'.$row['group_id'].'" selected>'.$gnresult.'</option>';
					echo '<option value="">None</option>';
					$query_group = "SELECT id, name FROM item_groups WHERE id != '$groupno' ORDER BY name ASC";
					$result_group = $db->query($query_group);

					while($row_group = $result_group->fetchArray()) {
						echo '<option value="'.$row_group['id'].'">'.$row_group['name'].'</option>';
					}
					?>
				</select>
			</div>
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
			<input class="input" type="text" name="cost" value="<?php echo $row['cost']; ?>" size="4">
		</div>
		<div class="field" style="width: 72px">
			<strong>Qty:</strong><br>
			<input class="input" type="number" name="qty" size="2" step="1" value="<?php echo $row['qty']; ?>" size="4">
		</div>
	</div>
</div>

<?php include $appdir.'/incl/footer-default.php'; ?>