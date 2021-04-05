<?php
//require $_SERVER['DOCUMENT_ROOT'].'/incl/session.php';
require $_SERVER['DOCUMENT_ROOT'].'/incl/settings.php';
$pageTitle = "Add Group";
$message = "";
include $appdir.'/incl/header-default.php';

// Updating the table row with submited data according to rowid once form is submited 
if( isset($_POST['submit_data']) ){

	// Gets the data from post
	$name = $_POST['name'];
	$description = $_POST['description'];
	$category_id = $_POST['category_id'];
	$cost = $_POST['cost'];
	$tag = $_POST['tag'];

	// Makes query with post data
	$query = "INSERT INTO groups (name, description, category_id, cost, tag) VALUES ('$name', '$description', '$category_id', '$cost', '$tag')";
	
	// Executes the query
	// If data inserted then set success message otherwise set error message
	// Here $db comes from "db_connect.php"
	if( $db->exec($query) ){
		$message = '<div class="notification is-success">Data is updated successfully.</div>';
		if ( isset($_GET['batch'])) {
			header( "refresh:0.5;url=/groups/batch.php" );
		} else {
			header( "refresh:0.5;url=/groups/" );
		}
	}else{
		$message = '<div class="notification is-danger">Sorry, Data is not updated.</div>';
	}
}
?>
<h1><?php echo $pageTitle; ?></h1>
<div class="columns">
	<div class="column">
		<?php echo $message; ?>
		<form action="" method="post">
			<div class="field">
				<strong>Name:</strong><br>
				<input class="input" type="text" name="name">
			</div>
			<div class="field">
				<strong>Description:</strong><br>
				<input class="input" type="text" name="description">
			</div>
			<div class="field">
				<strong>Category:</strong><br>
				<div class="select">
					<select name="category_id">
						<?php
						$query_categories = "SELECT id, name FROM categories WHERE 1 ORDER BY name ASC";
						$result_categories = $db->query($query_categories);
						echo '<option value="0" selected>None</option>';
						while($row_categories = $result_categories->fetchArray()) {
							echo '<option value="'.$row_categories['id'].'">'.$row_categories['name'].'</option>';
						}
						?>
					</select>
				</div>
			</div>
			<div class="field" style="width: 72px">
				<strong>Cost:</strong><br>
				<input class="input" type="number" name="cost" size="4">
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