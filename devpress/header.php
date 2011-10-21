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
			/*
			$('.colorSelector').ColorPicker({
				onShow: function (colpkr) {
					$(colpkr).fadeIn(500);
					return false;
				},
				onHide: function (colpkr) {
					$(colpkr).fadeOut(500);
					return false;
				},
				onChange: function (hsb, hex, rgb, colpkr) {
					$(colpkr).find('div').css('backgroundColor', '#' + hex);
					$(colpkr).prev().val(hex);
				}
			});
			*/
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
			
			/*
			$(".colorpickerinput").keyup(function () {
			      var value = $(this).val();
			      $(this).next('.collorbox').css('background-color','#' + value)
			    }).keyup();
			*/
		});
	</script>


	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta name="generator" content="WebMotionUK" />
	



</head>

<body>

<div id='wpbody'>
<div id="wpbody-content">
<div class="wrap">
