<?php 
$thetable = 'media';
$filename = 'uploader.php';
include('../../devpress/init.php'); 
$return_url = $_REQUEST['parent_uri'];
if (array_key_exists('edit_id',$_REQUEST)) {
	$return_url .= '&edit_id=' . $_REQUEST['edit_id'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include('../../devpress/cms_head.php'); ?>
</head>
<body>

		<?php 
			if (array_key_exists('submit', $_POST)){ 
				
				//1. save the new images
					
				//2. retreave the ids of the new images
				
				?>
			<form action="<?php echo $return_url ?>" target="_parent" method="post">
				<?php
				$count = $_POST['uploader_count'];
				echo "<table class='media-items'>";
				echo "<tr>";
					echo "<th>Tmp Name</th>";
					echo "<th>Name</th>";
					echo "<th>Status</th>";
				echo "</tr>";
				for ($i=0; $i < $count; $i++) { 
					
					$tmpname = $_POST['uploader_'.$i.'_tmpname'];
					$name = $_POST['uploader_'.$i.'_name'];
					$status = $_POST['uploader_'.$i.'_status'];
					//saveit
					$id = mr_createentry('mediadb');
					mr_savetextfielddata('mediadb', 'tmpname', $tmpname, $id);
					mr_savetextfielddata('mediadb', 'name', $name, $id);
										
							echo "<tr>";
								echo "<td>".$tmpname."</td>";
								echo "<td>".$name."</td>";
								echo "<td>".$status."</td>";
							echo "</tr>";
							
					//resend material
					$return = "<input type='hidden' name='uploader_{$i}_tmpname' value='$tmpname' />";
					$return .= "<input type='hidden' name='uploader_{$i}_name' value='$name' />";
					$return .= "<input type='hidden' name='uploader_{$i}_status' value='$status' />";
					$return .= "<input type='hidden' name='uploader_{$i}_id' value='$id' />";
					
				}
				echo "</table>";
				
				echo $return;
				echo "<input type='hidden' name='uploader_count' value='".$_POST['uploader_count']."' />";
				echo '<label for="Submit"></label><input type="submit" name="uploadsubmit" value="uploadsubmit" id="submit_upload">';
				?>
			</form>	
				
				<?php
				
			} else {
			?>
	
	<form action="uploader.php?parent_uri=<?php echo $return_url ?>" method="post" id="uploaderform">
		
		<div id="uploader">
			<p>You browser doesn't have Flash, Silverlight, Gears, BrowserPlus or HTML5 support.</p>
		</div>
		<label for="Submit"></label><input type="submit" name="submit" value="submit" id="submit_upload">
		<?php } ?>
	</form>

	<?php
	include('../../devpress/footer_plupload.php');
	?>		


	<script type="text/javascript">
	
	
	
	// Convert divs to queue widgets when the DOM is ready
	$(function() {
		$("#uploader").pluploadQueue({
			// General settings
			runtimes : 'html5,gears,flash,silverlight,browserplus',
			url : '<?php echo $root ?>/devpress/upload.php',
			max_file_size : '10mb',
			chunk_size : '1mb',
			unique_names : true,

			// Resize images on clientside if we can
			resize : {width : 800, height : 800, quality : 90},

			// Specify what files to browse for
			filters : [
				{title : "Image files", extensions : "jpg,gif,png"},
				{title : "Zip files", extensions : "zip"}
			],

			// Flash settings
			flash_swf_url : '<?php echo $root ?>/devpress/plupload/js/plupload.flash.swf',

			// Silverlight settings
			silverlight_xap_url : '<?php echo $root ?>/devpress/plupload/js/plupload.silverlight.xap'
		});

		// Client side form validation
		$('form').submit(function(e) {
	        var uploader = $('#uploader').pluploadQueue();

	        // Files in queue upload them first
	        if (uploader.files.length > 0) {
	            // When all files are uploaded submit form
	            uploader.bind('StateChanged', function() {
	                if (uploader.files.length === (uploader.total.uploaded + uploader.total.failed)) {
	                    $('form')[0].submit();
	                }
	            });
                
	            uploader.start();
	        } else {
	            alert('You must queue at least one file.');
	        }

	        return false;
	    });
	});
	</script>




  </body>
</html>