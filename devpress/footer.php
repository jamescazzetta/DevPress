<?php include('echolog.php'); ?>
	<div class="debug">
	<?php
		echo '<h1>$_POST</h1><textarea cols="50" rows="40">';
		print_r($_POST);
		echo '</textarea>';
	?>
	</div>
</div>
</div>
</div>


<!-- = Masonry = -->
<script src="js/jquery-masonry.js"></script>
<script type="text/javascript" charset="utf-8">
	$('#db-edit').masonry({
	  itemSelector: '.db-edit-col',
	  //columnWidth: 300,
	  isAnimated: true
	});
</script>



</body>
</html>