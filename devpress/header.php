<?php
//session_start();
//include('devpress/xperto_check.php');

//plugins
include('plugins/upload.php');

include('mr_config.php');
include('functions.php');
include('erm_builder.php');
include('data_builder.php');
include('form_builder.php');
include('erm.php');
?>

<!DOCTYPE html>

<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<title>DevPress</title>
	
	<link rel="stylesheet" href="devpress/style.css" type="text/css" media="screen" title="no title" charset="utf-8">

	<!-- = Jquery = -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
	
	<!-- = Uploader = -->
	<script src="js/jquery.imgareaselect.min.js"></script>

	<!-- Colorpicker -->
	<link rel="stylesheet" href="js/colorpicker/css/colorpicker.css" type="text/css" />
	<script src="js/colorpicker/js/colorpicker.js"></script>
	<script charset="utf-8">
		$(function() {

			$('.colorpickerinput').ColorPicker({
				onSubmit: function(hsb, hex, rgb, el) {
					$(el).val(hex);
					$(el).ColorPickerHide();
					$('.collorbox').css('background-color','#' + value);
			      
				},
				onBeforeShow: function () {
					$(this).ColorPickerSetColor(this.value);
				},
				onChange: function (hsb, hex, rgb, el) {
					$(el).next('.collorbox').css('backgroundColor', '#' + hex);
				}
			})
			.bind('keyup', function(){
				$(this).ColorPickerSetColor(this.value);
			});
			
			//$('.colorpickerinput').after('<div class="collorbox" style="height:20px;width:20px">&nbsp</div>');

		});
	</script>


	<!-- input toggle-->
	<link rel="stylesheet" href="js/iphone-style-checkboxes.css" type="text/css" media="screen" title="no title" charset="utf-8">
	<script src="js/iphone-style-checkboxes.js" type="text/javascript"></script>

	
	
	
	
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta name="generator" content="WebMotionUK" />
	



</head>

<body>

<div id='wpbody'>
<div id="wpbody-content">
<div class="wrap">
