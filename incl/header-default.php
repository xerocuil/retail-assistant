<?php $categories = $db->query('SELECT * FROM categories'); ?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $pageTitle . ' | ' . $APPNAME; ?></title>
	<link href="assets/img/favicon.ico" type="image/x-icon" rel="icon"/>
	<link href="assets/img/favicon.ico" type="image/x-icon" rel="shortcut icon"/>
	<link rel="stylesheet" href="/assets/css/style.css"/>
	<script src="/assets/js/font-awesome.js"></script>
</head>
<body>

<div id="header">
	<div id="header-wrap" class="columns">
		<div id="site-title" class="column is-narrow">
			<a class="title" href="/">Retail Assistant</a>
		</div>

		<div id="header-functions" class="column">
			<div id="search">
				<form action="/search.php" method="post">
					<input class="input is-small" type="text" name="search_query" style="width: 200px;">
					<input class="button is-link is-small" name="search" type="submit" value="Search">
				</form>
			</div>

			<div id="menu">
				<div class="dropdown is-hoverable">
					<div class="dropdown-trigger">
						<div class="button is-small is-link" aria-haspopup="true" aria-controls="dropdown-menu4">
							<span>Inventory </span><span class="icon is-small">
								<i class="fas fa-angle-down" aria-hidden="true"></i>
							</span>
						</div>
					</div>
			
					<div class="dropdown-menu" id="dropdown-menu4" role="menu">
						<div class="dropdown-content">
							<?php
							while($row = $categories->fetchArray()) {
								echo '<a href="/categories/view.php?id=' . $row['id'] . '"><div class="dropdown-item">' . $row['name'] . '</div></a>';
							}
							?>
						</div>
					</div>
				</div>

				<div class="dropdown is-hoverable">
					<div class="dropdown-trigger">
						<div class="button is-small is-link" aria-haspopup="true" aria-controls="dropdown-menu4">
							<span>Control Panel</span><span class="icon is-small">
								<i class="fas fa-angle-down" aria-hidden="true"></i>
							</span>
						</div>
					</div>

					<div class="dropdown-menu" id="dropdown-menu4" role="menu">
						<div class="dropdown-content">
							<a href="/categories/"><div class="dropdown-item">Edit Categories</div></a>
							<a href="/groups/"><div class="dropdown-item">Edit Groups</div></a>
							<a href="/parts/add.php"><div class="dropdown-item">Add Part</div></a>
							<hr class="dropdown-divider">
							
							<?php
							if (!isset($_SESSION["status"])) {
								echo '<a href="#"><div class="dropdown-item">Login</div></a>';
								//header('Location: /workbench');
								//die();
							} else {
								echo '<a href="/logout.php"><div class="dropdown-item">Logout</div></a>';
							}
							?>
								
						</div>
					</div>
				</div>
				<div class="dropdown is-hoverable">
					<div class="dropdown-trigger">
						<div class="button is-small is-link" aria-haspopup="true" aria-controls="dropdown-menu4">
							<span>Tags </span><span class="icon is-small">
								<i class="fas fa-angle-down" aria-hidden="true"></i>
							</span>
						</div>
					</div>
					<div class="dropdown-menu" id="dropdown-menu4" role="menu">
						<div class="dropdown-content">
							<a href="/parts/tagged.php"><div class="dropdown-item">Preview Tags</div></a>
							<a href="/tags/print.php" target="blank"><div class="dropdown-item">Print Tags</div></a>
							<a href="/tags/clear.php"><div class="dropdown-item">Clear Tags</div></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="spacer" class="noprint">&nbsp;</div>
<!-- end header -->

<!-- begin content -->
<div class="content">	
<article class="box">