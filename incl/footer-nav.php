<div class="columns noprint" style="width: 1024px; padding: 0.1in;">
	<div class="column">&nbsp;</div>
	<div class="column is-two-thirds">
		<ul class="pagination">
			<li><a class="button is-small" href="?pageno=1"><< First</a></li>
			<li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
			    <a class="button is-small" href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">< Prev</a>
			</li>
			<?php
			$pages  = range(2,$total_pages-1);
			foreach ($pages as $page) {
				echo '<li><a class="button is-small" href="?pageno='.$page.'">'.$page.'</a></li>';
			}
			//var_dump($pages);
			?>
			<li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
			    <a class="button is-small" href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next ></a>
			</li>
			<li><a class="button is-small" href="?pageno=<?php echo $total_pages; ?>">Last >></a></li>
		</ul>
		<?php echo '<p style="text-align:center;">Page: '.$pageno.' of '.$total_pages.'</p>'; ?>
	</div>
	<div class="column">&nbsp;</div>
</div>