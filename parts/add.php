<?php
//require $_SERVER['DOCUMENT_ROOT'].'/incl/session.php';
$pageTitle = "New Part";
$message = "";
require $_SERVER['DOCUMENT_ROOT'].'/incl/config.php';
include $appdir.'/incl/header-default.php';

// Updating the table row with submited data according to rowid once form is submited 
if( isset($_POST['submit_data']) ){

	// Gets the data from post
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
	$query = "INSERT INTO price_list (name, description, cost, qty, category_id, group_id, tag) VALUES ('$name', '$description', '$cost', '$qty', '$category_id', '$group_id', '$tag')";
	
	// Executes the query
	// If data inserted then set success message otherwise set error message
	// Here $db comes from "db_connect.php"
	if( $db->exec($query) ){
		$message = '<div class="notification is-success">Data is updated successfully.</div>';
		header( "refresh:0.5;url=/" );
	}else{
		$message = '<div class="notification is-danger">Sorry, Data is not updated.</div>';
	}
}

$query_groups = "SELECT id, name FROM groups WHERE 1 ORDER BY name ASC";
$query_categories = "SELECT id, name FROM categories WHERE 1 ORDER BY name ASC";
$result_groups = $db->query($query_groups);
$result_categories = $db->query($query_categories);
?>
<h1><?php echo $pageTitle; ?></h1>
<div class="columns">
	<div class="column">
		<?php echo $message; ?>
		<form action="" method="post">
			<div class="field">
				<strong>Part:</strong><br>
				<input class="input" type="text" name="name">
			</div>
			<div class="field">
				<strong>Description:</strong><br>
				<input class="input" type="text" name="description" rows="2">
			</div>
			<div class="field">
				<strong>Group:</strong><br>
				<div class="select">
					<select name="group_id">
					<?php
					$groupno = $row['group_id'];
					$gnresult = $db->querySingle("SELECT name FROM groups WHERE id=$groupno"); ?>
					<option value="0" selected>None</option>
					<?php
					while($row_groups = $result_groups->fetchArray()) { ?>
						<option value="<?php echo $row_groups['id']; ?>"><?php echo $row_groups['name']; ?></option>
					<?php } ?>
					</select>
				</div>
			</div>
			<div class="field">
				<strong>Category:</strong><br>
				<div class="select">
					<select name="category_id">
						<?php
						$catno = $row['category_id'];
						$cnresult = $db->querySingle("SELECT name FROM categories WHERE id=$catno");
						echo '<option value="'.$catno.'" selected>'.$cnresult.'</option>';
						echo '<option value="">None</option>';
						while($row_categories = $result_categories->fetchArray()) {
							echo '<option value="'.$row_categories['id'].'">'.$row_categories['name'].'</option>';
						}
						?>
					</select>
				</div>
			</div>
			<div class="field" style="width: 72px">
				<strong>Cost:</strong><br>
				<input class="input" type="text" name="cost" size="4">
			</div>
			<div class="field" style="width: 72px">
				<strong>Qty:</strong><br>
				<input class="input" type="number" name="qty" size="2" step="1" size="4">
			</div>
				
			<div class="field">Add to print Batch? &nbsp;
				<input type="checkbox" name="tag" value="1">
			</div>
			<hr>
			<div class="field">
				<input class="button is-link is-small" name="submit_data" type="submit" value="Submit">
				<a class="button is-danger is-small" href="index.php">Back</a>
			</div>
		</form>
	</div>
	<div class="column">
		
	</div>
</div>

<?php include $appdir.'/incl/footer-default.php'; ?>