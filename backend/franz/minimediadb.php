<?php 
$thetable = 'media';
$filename = 'minimediadb.php';
include('../../devpress/init.php'); 
$return_url = $_REQUEST['parent_uri'];
if (array_key_exists('edit_id',$_REQUEST)) {
	$return_url .= '&edit_id=' . $_REQUEST['edit_id'];
}
$current_direct = "";
$current_library = "current";
if (array_key_exists('submit', $_POST)){  
	$current_direct = "current";
	$current_library = "";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include('../../devpress/cms_head.php'); ?>
	<style type="text/css" media="screen">
		#content{
			background: url(../img/bg.png) repeat-x rgb(225, 225, 225);
			box-shadow: 0px 2px 3px 0px #111;
			-webkit-box-shadow: 0px 2px 3px 0px #111;
			-moz-box-shadow: 0px 2px 3px 0px #111;
		}
		.pinkynail{
			max-width:32px;
			max-height:32px;
			float:left;
		}
		.describe-toggle-on, .describe-toggle-off{
			float:right;
			line-height: 36px;
		}
		.filename{
			line-height: 36px;
			padding: 0 10px;
			overflow: hidden;
		}
		.media-item{
			background-color: rgba(255, 255, 255, 0.5);
			margin: 0px -25px 5px -25px;
			padding: 5px 25px;
			border-top: 1px solid rgb(153, 153, 153);
			border-bottom: 1px solid white;
			border: 1px solid rgb(153, 153, 153);
			min-height: 36px;
		}
		.media-item td, th{
			vertical-align: top;
		}
	</style>
	<style type="text/css">@import url(<?php echo $root ?>/devpress/plupload/js/jquery.plupload.queue/css/jquery.plupload.queue.css);</style>
	
</head>
	<body>
		<nav id="secondary">
		  <ul>
		    <li class="<?php echo $current_direct ?>"><a href="#direct">From Computer</a></li>
		    <li class="<?php echo $current_library ?>"><a href="#library">Media Library</a></li>
		  </ul>
		</nav>
		
		<section id="content">
			<!-- =================== -->
			<!-- = Direct download = -->
			<!-- =================== -->
			<div class="tab" id="direct">
			<?php if (array_key_exists('submit', $_POST)){  ?>
				<h2>Just Uploaded</h2>
				<form action="<?php echo $return_url ?>" target="_parent" method="post">
					
					<?php
					$count = $_POST['uploader_count'];
					for ($i=0; $i < $count; $i++) :

						$tmpname = $_POST['uploader_'.$i.'_tmpname'];
						$name = $_POST['uploader_'.$i.'_name'];
						$status = $_POST['uploader_'.$i.'_status'];
						//saveit
						$id = mr_createentry('mediadb');
						mr_savetextfielddata('mediadb', 'tmpname', $tmpname, $id);
						mr_savetextfielddata('mediadb', 'name', $name, $id);
						$newitem = data(array('table' => 'mediadb'), array("ID" => $id), 1);
						?>
		
							<div id="media-item-<?php echo $newitem['id']; ?>" class="media-item">
								<img class="pinkynail toggle" src="<?php echo $root . '/devpress/uploads/' . $newitem["tmpname"] ?>" alt="<?php echo $newitem['name'] ?>" style="margin-top: 3px">
								<input type="hidden" id="type-of-153" value="image">
								<a class="toggle describe-toggle-on" href="#">Show</a>
								<a class="toggle describe-toggle-off" href="#">Hide</a>
								<div class="filename new"><span class="title"><?php echo $newitem['name'] ?></span></div>
								<table class="slidetoggle describe startopen">
										<tr valign="top">
											<td class="A1B1" id="thumbnail-head-153">
												<p>
													<?php echo mr_image_preview($newitem); ?>
												</p>
												<p>
													<input type="submit" class="button" name="uploadsubmit" id="submit_upload" value="Use Image"> 
													<!--<img src="http://musichub.local/wp-admin/images/wpspin_light.gif" class="imgedit-wait-spin" alt="">-->
												</p>
											</td>
											<td>
												<p><strong>File name:</strong> collegehumor.1d44df5ea25b902542b123261ee07793.jpg</p>
												<p><strong>File type:</strong> image/jpeg</p>
												<p><strong>Upload date:</strong> December 10, 2011</p><p><strong>Dimensions:</strong> <span id="media-dims-153">480&nbsp;×&nbsp;527</span> </p>
											</td>
										</tr>
								</table>
								<input type="hidden" name="attachments[153][post_parent]" id="attachments[153][post_parent]" value="155">
	
							</div>
	
						<?php

						//resend material
						$return .= "<input type='hidden' name='uploader_{$i}_tmpname' value='$tmpname' />";
						$return .= "<input type='hidden' name='uploader_{$i}_name' value='$name' />";
						$return .= "<input type='hidden' name='uploader_{$i}_status' value='$status' />";
						$return .= "<input type='hidden' name='uploader_{$i}_id' value='$id' />";

					endfor;

					echo $return;
					echo "<input type='hidden' name='uploader_count' value='".$_POST['uploader_count']."' />";
					echo '<label for="Submit"></label><input type="submit" name="uploadsubmit" value="uploadsubmit" id="submit_upload">';
					
					?>
				</form>	
			<?php } else { ?>
				<h2>Upload a File</h2>
				
				<form action="minimediadb.php?parent_uri=<?php echo $return_url ?>" method="post">
					<div id="uploader">
						<p>You browser doesn't have Flash, Silverlight, Gears, BrowserPlus or HTML5 support.</p>
					</div>
					<label for="Submit"></label><input type="submit" name="submit" value="submit" id="submit_upload">
				</form>
			<?php } ?>
			</div>
			<!-- ============ -->
			<!-- = Media DB = -->
			<!-- ============ -->
			<h2>Media Library</h2>
				<div class="tab" id="library">
					<?php $data = data(array('table' => 'mediadb'));?>
					<?php foreach ($data as $media_item): ?>
						
					<div id="media-item-<?php echo $media_item['id']; ?>" class="media-item">
						<img class="pinkynail toggle" src="<?php echo $root . '/devpress/uploads/' . $media_item["tmpname"] ?>" alt="<?php echo $media_item['name'] ?>" style="margin-top: 3px">
						<input type="hidden" id="type-of-153" value="image">
						<a class="toggle describe-toggle-on" href="#">Show</a>
						<a class="toggle describe-toggle-off" href="#">Hide</a>
						<div class="filename new"><span class="title"><?php echo $media_item['name'] ?></span></div>
						<table class="slidetoggle describe startclosed">
								<tr valign="top">
									<td class="A1B1" id="thumbnail-head-153">
										<p>
											<?php echo mr_image_preview($media_item); ?>
										</p>
										<p>
											<form action="<?php echo $return_url ?>" target="_parent" method="post">
											<?php
												echo "<input type='hidden' name='uploader_0_tmpname' value='$media_item[tmpname]' />";
												echo "<input type='hidden' name='uploader_0_name' value='$media_item[name]' />";
												echo "<input type='hidden' name='uploader_0_status' value='done' />";
												echo "<input type='hidden' name='uploader_0_id' value='$media_item[id]' />";
												echo "<input type='hidden' name='uploader_count' value='1' />";
											?>
											<label for="Submit"></label><input type="submit" name="uploadsubmit" value="Use This">
											</form>
											<!--<img src="http://musichub.local/wp-admin/images/wpspin_light.gif" class="imgedit-wait-spin" alt="">-->
										</p>
									</td>
									<td>
										<p><strong>File name:</strong> collegehumor.1d44df5ea25b902542b123261ee07793.jpg</p>
										<p><strong>File type:</strong> image/jpeg</p>
										<p><strong>Upload date:</strong> December 10, 2011</p><p><strong>Dimensions:</strong> <span id="media-dims-153">480&nbsp;×&nbsp;527</span> </p>
									</td>
								</tr>
						</table>
					</div>
					
					<?php endforeach; ?>
				</div>

	
		</section>
	
			




<?php include('../../devpress/cms_foot.php'); ?>
<?php //include('../../devpress/footer_plupload.php'); ?>
<!-- Load Queue widget CSS and jQuery -->

<!-- Third party script for BrowserPlus runtime (Google Gears included in Gears runtime now) -->
<script type="text/javascript" src="http://bp.yahooapis.com/2.4.21/browserplus-min.js"></script>

<!-- Load plupload and all it's runtimes and finally the jQuery queue widget -->
<script type="text/javascript" src="<?php echo $root ?>/devpress/plupload/js/plupload.full.js"></script>
<script type="text/javascript" src="<?php echo $root ?>/devpress/plupload/js/jquery.plupload.queue/jquery.plupload.queue.js"></script>

<script type="text/javascript" charset="utf-8">
	jQuery(document).ready(function(){
		/* Toggles */
		//start
		$(".slidetoggle.startclosed").toggle();
		$(".slidetoggle.startclosed").siblings('.describe-toggle-off').toggle();
		$(".slidetoggle.startopen").siblings('.describe-toggle-off').toggle();
		$(".slidetoggle.startopen").siblings('.toggle').toggle();
		
		//togglebuttons
		$(".toggle").click(function(){
			$(this).siblings('.slidetoggle').toggle();
			$(this).siblings('.toggle').toggle();
			$(this).toggle();
			
		});
		
		/* Plupload */
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
			$('#uploaderform').submit(function(e) {
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
		
	});
</script>
 	</body>
</html>