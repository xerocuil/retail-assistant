<form action="/batch.php" method="post">
	<div class="columns">
		<div class="column">
			<h1 class="title is-4"><?php echo $pageTitle; ?></h1>
		</div>
		<div class="column">
			<div class="noprint dropdown is-hoverable" style="float: right;">
				<div class="dropdown-trigger">
				<div class="button is-small is-link is-outlined" aria-haspopup="true" aria-controls="dropdown-menu5">
		  			<span class="icon"><i class="fas fa-list"></i></span><span class="icon is-small">
		  				<i class="fas fa-angle-down" aria-hidden="true"></i>
		  			</span>
				</div>
				</div>
				<div class="dropdown-menu" id="dropdown-menu5" role="menu">
					<div class="dropdown-content">
			  			<div class="dropdown-item">Selected Items</div>
			  			<div class="dropdown-item">
			  				<input class="button is-link is-small is-outlined" name="print" type="submit" value="Print Batch">
			  			</div>
			  			<div class="dropdown-item">
			  				<input class="button is-link is-small is-outlined" name="delete" type="submit" value="Delete">
			  			</div>
			  			<!--<div class="dropdown-item">
			  				<input class="button is-link is-small is-outlined" name="group" type="submit" value="Group">
			  			</div>
			  			<div class="dropdown-item">
			  				<input class="button is-link is-small is-outlined" name="category" type="submit" value="Category">
			  			</div>-->
					</div>
				</div>
			</div>
		</div>
	</div>

	<table class="table">
		<tr>
			<th>Part</th>
			<th>Description</th>
			<th class="noprint">Category</th>
			<th>Cost</th>
			<th>Price</th>
			<th class="noprint">Tag</th>
			<th class="noprint">Group</th>
			<th class="actions noprint" colspan="3">Actions</th>
			<th></th>
		</tr>

		<?php
		while($row = $results->fetchArray()) {
			$id = $row['id'];
			echo '<tr><td>'.$row['name'].'</td>';   
			echo '<td>'.$row['description'].'</td>';
			$catno = $row['category_id'];
			$cresults = $db->querySingle("SELECT name FROM categories WHERE id='$catno'");
			echo '<td class="noprint"><a href="/categories/view.php?id='.$catno.'">'.$cresults.'</a></td>';
			$cost = round($row['cost']);
			echo '<td>'.$cost.'</td>';
			include $appdir.'/helpers/price.php';
			echo '<td>'.$price.'</td>';
			$tag = $row['tag'];
			if ($tag == 1){
				echo '<td class="noprint"><span class="icon"><i class="far fa-check-square"></i></span></td>';
			} else {
				echo '<td class="noprint ">&nbsp</td>';
			}
			$groupno = $row['group_id'];
			$gresults = $db->querySingle("SELECT name FROM groups WHERE id='$groupno'");
			echo '<td class="noprint"><a href="/groups/edit.php?id='.$groupno.'">'.$gresults.'</a></td>
				<td class="noprint"><a class="button is-outlined is-link is-small" href="/parts/edit.php?id='.$id.'"><span class="icon"><i class="far fa-edit"></i></span></a></td>
				<td class="noprint"><a class="button is-outlined is-danger is-small" href="/parts/delete.php?id='.$id.'"><span class="icon"><i class="far fa-trash-alt"></i></span></a></td>
				<td class="noprint"><input type="checkbox" name="id[]" value="'.$id.'"></td></tr>';
		}
		?>
	</table>
</form>