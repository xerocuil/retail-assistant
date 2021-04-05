	</article>
	<!-- End content/begin footer -->
	<footer>

	<div class="column">
		<?php
		if ($db == $appdir.'/db/test.db'){
			echo '<span class="tag is-info">Test Environment</span>';
		}
		?>
	</div>
	
	</footer>
</div><!-- end "content" div -->
<?php
// close db connection
$db = NULL;
?>
</body>
</html>
<!-- end footer/page -->
