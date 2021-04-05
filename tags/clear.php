<?php
$pageTitle='Clear Print Batch';
$message = "";
require $_SERVER['DOCUMENT_ROOT'].'/incl/settings.php';
include $appdir.'/incl/header-default.php';

// Makes query with post data
$query_price_list = "UPDATE price_list SET tag = NULL WHERE tag = 1";
$query_groups = "UPDATE groups SET tag = NULL WHERE tag = 1";
	
if( $db->exec($query_price_list) && $db->exec($query_groups)  ){
	$message = '<div class="notification is-success">Print batch cleared.</div>';
	header( "refresh:1;url=/" );
}else{
	$message = '<div class="notification is-danger">Sorry, print batch was not cleared.</div>';
}
?>

<h1><?php echo $pageTitle; ?></h1>
<div class="columns">
	<div class="column">
		<?php echo $message;?>
	</div>
	<div class="column">
		&nbsp;
	</div>
</div>

<?php include $appdir.'/incl/footer-default.php'; ?>

