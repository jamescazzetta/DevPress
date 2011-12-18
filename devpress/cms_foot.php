
    <!-- JavaScript -->
    <script src="../../devpress/js/excanvas.js"></script>
    <script src="../../devpress/js/jquery.js"></script>
    <script src="../../devpress/js/jquery.livesearch.js"></script>
    <script src="../../devpress/js/jquery.visualize.js"></script>
    <script src="../../devpress/js/jquery.datatables.js"></script>
    <script src="../../devpress/js/jquery.placeholder.js"></script>
    <script src="../../devpress/js/jquery.selectskin.js"></script>
    <script src="../../devpress/js/jquery.checkboxes.js"></script>
    <script src="../../devpress/js/jquery.wymeditor.js"></script>
    <script src="../../devpress/js/jquery.validate.js"></script>
    <script src="../../devpress/js/jquery.inputtags.js"></script>
	<script src="../../devpress/js/jquery.colorpicker.js"></script>
	<script src="../../devpress/js/jquery.eye.js"></script> <!-- colorpicker -->
	<script src="../../devpress/js/jquery.utils.js"></script> <!-- colorpicker -->
	<script src="../../devpress/js/jquery.easing-1.3.pack.js"></script> <!-- fancybox -->
	<script src="../../devpress/js/jquery.mousewheel-3.0.6.pack.js"></script> <!-- fancybox -->
	<script src="../../devpress/js/jquery.fancybox.js"></script> <!-- fancybox -->
	<script src="../../devpress/js/jquery.fancybox-buttons.js"></script> <!-- fancybox -->
	<script src="../../devpress/js/jquery.fancybox-thumbs.js"></script> <!-- fancybox -->
    <script src="../../devpress/js/notifications.js"></script>
    <script src="../../devpress/js/application.js"></script>
	

<?php if ($build) { ?>
	<script type="text/javascript" charset="utf-8">
		new Notification('<strong>ERM Build</strong> is turned on and will slow down the system.', 'warning');
	</script>
<?php  } ?>
<?php if (array_key_exists('action',$_GET)) : ?>		
	<?php if ($_GET['action'] == "save") { ?>
		<script type="text/javascript" charset="utf-8">
			new Notification('Entrie ID <strong><?php echo $_GET['edit_id'] ?></strong> from table <strong><?php echo $thetable ?></strong> has been saved.', 'saved');
		</script>
	<?php  } ?>
	<?php if ($_GET['action'] == "edit") { ?>
		<script type="text/javascript" charset="utf-8">
			new Notification('You are editing ID <strong><?php echo $_GET['edit_id'] ?></strong> from table <strong><?php echo $thetable ?></strong>.', 'information');
		</script>
	<?php  } ?>
	<?php if ($_GET['action'] == "new") { ?>
		<script type="text/javascript" charset="utf-8">
			new Notification('You are creating a new entrie for the <?php echo $thetable ?></strong> table.', 'information');
		</script>
	<?php  } ?>
<?php endif; ?>

