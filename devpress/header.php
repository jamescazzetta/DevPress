<?php
session_start();
include('devpress/xperto_check.php');

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

	  <style type="text/css" media="screen">


			html,.wp-dialog {background-color:#fff;}
			body{margin: 0px;}


			* html input,* html .widget {border-color:#dfdfdf;}
			textarea,input[type="text"],input[type="password"],input[type="file"],input[type="button"],input[type="submit"],input[type="reset"],select {border-color:#dfdfdf; background-color:#fff;}
			kbd,code {background:#eaeaea;}
			input[readonly] {background-color:#eee;}

			a{color:#21759b; font-family: sans-serif;}
			ol,ul {list-style:none;}
			blockquote,q {quotes:none;}
			blockquote:before,blockquote:after,q:before,q:after {content:''; content:none;}
			ins {text-decoration:none;}
			del {text-decoration:line-through;}
			input[type="text"],input[type="password"],textarea {-moz-box-sizing:border-box; -webkit-box-sizing:border-box; -ms-box-sizing:border-box; box-sizing:border-box;}
			input[type="checkbox"],input[type="radio"] {vertical-align:middle;}
			html,body {height:100%;}
			body,td,textarea,input,select { font-size:13px;}
			body,textarea {line-height:1.4em;}
			input,select {line-height:15px;}
			p {margin:1em 0;}
			blockquote {margin:1em;}
			label {cursor:pointer;}
			li,dd {margin-bottom:6px;}
			p,li,dl,dd,dt {line-height:140%;}
			textarea,input,select {margin:1px; padding:3px;}

			h1,h2,h3,h4,h5,h6{
				font-family: HelveticaNeue-Light, 'Helvetica Neue Light', 'Helvetica Neue', sans-serif;
				color: #464646;
				font-weight: normal;
				text-shadow: white 0px 1px 0px;
			}


			input[type='text']{
				-webkit-appearance: none;
				-webkit-border-horizontal-spacing: 2px;
				-webkit-border-vertical-spacing: 2px;
				-webkit-rtl-ordering: logical;
				-webkit-user-select: text;
				background-color: white;
				border-bottom-color: #DFDFDF;
				border-bottom-left-radius: 3px;
				border-bottom-right-radius: 3px;
				border-bottom-style: solid;
				border-bottom-width: 1px;
				border-collapse: collapse;
				border-left-color: #DFDFDF;
				border-left-style: solid;
				border-left-width: 1px;
				border-right-color: #DFDFDF;
				border-right-style: solid;
				border-right-width: 1px;
				border-top-color: #DFDFDF;
				border-top-left-radius: 3px;
				border-top-right-radius: 3px;
				border-top-style: solid;
				border-top-width: 1px;
				box-sizing: border-box;
				color: black;
				cursor: auto;
				display: inline-block;
				font-family: sans-serif;
				font-size: 12px;
				font-style: normal;
				font-variant: normal;
				font-weight: normal;
				height: 23px;
				letter-spacing: normal;
				line-height: 15px;
				margin-bottom: 1px;
				margin-left: 1px;
				margin-right: 1px;
				margin-top: 1px;
				padding-bottom: 3px;
				padding-left: 3px;
				padding-right: 3px;
				padding-top: 3px;
				text-align: -webkit-auto;
				text-indent: 0px;
				text-shadow: none;
				text-transform: none;
				width: 172px;
				word-spacing: 0px;
			}

			input[type='submit']:hover{
				border-color: #666;

			}


			input[type='submit']{
				text-decoration: none;
				font-size: 12px!important;
				line-height: 13px;
				padding: 3px 8px;
				cursor: pointer;
				border-width: 1px;
				border-style: solid;
				-moz-border-radius: 11px;
				-khtml-border-radius: 11px;
				-webkit-border-radius: 11px;
				border-radius: 11px;
				-moz-box-sizing: content-box;
				-webkit-box-sizing: content-box;
				-khtml-box-sizing: content-box;
				box-sizing: content-box;


				-moz-border-radius-bottomleft: 11px;
				-moz-border-radius-bottomright: 11px;
				-moz-border-radius-topleft: 11px;
				-moz-border-radius-topright: 11px;
				-moz-box-sizing: content-box;
				border-style: solid;
				border-width: 1px;
				cursor: pointer;
				font-size: 11px !important;
				line-height: 16px;
				padding: 2px 8px;
				border-color:#aaa;
				text-decoration: none;
				text-shadow: 0 1px 0 white;
				color: black;
				margin: 1px;
				background: #F2F2F2 url(images/white-grad.png) repeat-x scroll left top;
				text-shadow: rgba(255, 255, 255, 1) 0 1px 0;
			}

			input[type='submit'].important{
				border-color: #298CBA;
				font-weight: bold;
				color: white;
				background: #21759B url(images/button-grad.png) repeat-x scroll left top;
				text-shadow: rgba(0, 0, 0, 0.3) 0 -1px 0;
			}
			
			.linktobutton{
							text-decoration: none;
							font-size: 12px!important;
							line-height: 13px;
							padding: 2px 8px;
							cursor: pointer;
							border-width: 1px;
							border-style: solid;
							-moz-border-radius: 11px;
							-khtml-border-radius: 11px;
							-webkit-border-radius: 11px;
							border-radius: 11px;
							-moz-box-sizing: content-box;
							-webkit-box-sizing: content-box;
							-khtml-box-sizing: content-box;
							box-sizing: content-box;


							-moz-border-radius-bottomleft: 11px;
							-moz-border-radius-bottomright: 11px;
							-moz-border-radius-topleft: 11px;
							-moz-border-radius-topright: 11px;
							-moz-box-sizing: content-box;
							border-style: solid;
							border-width: 1px;
							cursor: pointer;
							font-size: 11px !important;
							line-height: 16px;
							padding: 2px 8px;
							border-color:#aaa;
							text-decoration: none;
							text-shadow: 0 1px 0 white;
							color: black;
							margin: 1px;
							background: #F2F2F2 url(images/white-grad.png) repeat-x scroll left top;
							text-shadow: rgba(255, 255, 255, 1) 0 1px 0;
				
			}

			label{
				-webkit-border-horizontal-spacing: 2px;
				-webkit-border-vertical-spacing: 2px;
				background-attachment: scroll;
				background-clip: border-box;
				background-color: transparent;
				background-image: none;
				background-origin: padding-box;
				border-bottom-color: #3E434A;
				border-bottom-style: none;
				border-bottom-width: 0px;
				border-collapse: collapse;
				border-left-color: #3E434A;
				border-left-style: none;
				border-left-width: 0px;
				border-right-color: #3E434A;
				border-right-style: none;
				border-right-width: 0px;
				border-top-color: #3E434A;
				border-top-style: none;
				border-top-width: 0px;
				color: #3E434A;
				cursor: pointer;
				display: block;
				font-family: sans-serif;
				font-size: 13px;
				font-style: normal;
				font-variant: normal;
				font-weight: normal;
				height: 18px;
				line-height: 18px;
				margin-bottom: 0px;
				margin-left: 0px;
				margin-right: 0px;
				margin-top: 0px;
				outline-color: #3E434A;
				outline-style: none;
				outline-width: 0px;
				padding-bottom: 0px;
				padding-left: 0px;
				padding-right: 0px;
				padding-top: 0px;
				vertical-align: middle;
			}


			ul.ul-disc {list-style:disc outside;}
			ul.ul-square {list-style:square outside;}
			ol.ol-decimal {list-style:decimal outside;}
			ul.ul-disc,ul.ul-square,ol.ol-decimal {margin-left:1.8em;}
			ul.ul-disc>li,ul.ul-square>li,ol.ol-decimal>li {margin:0 0 .5em;}


			div.clear{clear:both;}

			/* db-navigation*/
			#settings{
				display:block;
				position: absolute;
				right:0px;
				padding:50px 0px 0 0px;
				top:0px;
				background-image: url(images/settings24.png);
				background-repeat:no-repeat;
				background-position:30px 8px;
				height:100%;
				width:84px;
				overflow:hidden;
				text-decoration: none;
				font-size: 10px;
				text-align: center;
				color:white;
				border-left:1px solid #bbb;

			}
			#settings:hover{
				background-color: #ddd;
				background-image: url(images/settings24black.png);
				color:black;

			}

			.dp-navigation{
				position: relative;
				background-image:-webkit-linear-gradient(top,#444,#222); 
				padding: 0px;
				height:40px;
				overflow:hidden;
				-webkit-transition:all 1s;
			}
			.dp-navigation:hover{
				height:80px;
			}


			.dp-navigation ul{
				height:0px;
				margin: 0px;
				padding: 0px;
				overflow: hidden;
				position: relative;
				top:0px;
				bottom:0px
			}	

			.dp-navigation:hover ul{
				height:100%;
			}

			.dp-navigation nav{
				height:100%;
				margin: 0px 0px 0px 0px;
				float:left;
				border-right: 1px solid #999;
				border-left: 1px solid #000;

			}

				.dp-navigation nav:hover{
					background-image:-webkit-linear-gradient(top,#555,#222); 
				}


			.dp-navigation h3{
				color: #fff;
				text-shadow: 1px 1px black;
				margin: 0px 0 5px 0 ;
				padding:10px 40px 0px 40px;
				text-align: center;

			}
			.dp-navigation ul li{

				margin: 0 0 0 0;
				padding:0px;
				text-align: center;
			}
			.dp-navigation ul li a{
				display: block;
				padding:3px 40px 5px 40px;
				line-height: 12px;
				color:#bbb;
				text-decoration: none;
				font-size: 11px;

			}

			.dp-navigation ul li a:hover{
				background-color: #ddd;
				color:black;
			}



			/* db-title*/


				.dp-title {
					background-color:#f1f1f1; 
					background-image:-ms-linear-gradient(top,#f9f9f9,#ececec); 
					background-image:-moz-linear-gradient(top,#f9f9f9,#ececec); 
					background-image:-o-linear-gradient(top,#f9f9f9,#ececec); 
					background-image:-webkit-gradient(linear,left top,left bottom,from(#f9f9f9),to(#ececec)); 
					background-image:-webkit-linear-gradient(top,#666,#444); 
					background-image:linear-gradient(top,#eee,#aaa);
					height: 40px;
					padding:0px 20px;

					border-bottom-color: #DFDFDF;
					border-bottom-left-radius: 3px;
					border-bottom-right-radius: 3px;
					border-bottom-style: solid;
					border-bottom-width: 1px;
					border-collapse: separate;
					border-left-color: #DFDFDF;
					border-left-style: solid;
					border-left-width: 1px;
					border-right-color: #DFDFDF;
					border-right-style: solid;
					border-right-width: 1px;
					border-top-color: #DFDFDF;
					border-top-left-radius: 3px;
					border-top-right-radius: 3px;
					border-top-style: solid;
					border-top-width: 1px;
				}

				.dp-title h2{
					color: #fff;
					margin: 0px;
					line-height: 40px;
					font-size: 23px;
					text-shadow: 1px 1px black;
				}

				.dp-title h2 .add-new-h2{
					background-attachment: scroll;
					background-clip: border-box;
					background-color: #F1F1F1;
					background-image: none;
					background-origin: padding-box;
					border-bottom-left-radius: 3px;
					border-bottom-right-radius: 3px;
					border-bottom-width: 0px;
					border-left-width: 0px;
					border-right-width: 0px;
					border-top-left-radius: 3px;
					border-top-right-radius: 3px;
					border-top-width: 0px;
					color: #2173AF;
					cursor: auto;
					display: inline;
					font-family: sans-serif;
					font-size: 12px;
					font-style: normal;
					font-variant: normal;
					font-weight: normal;
					height: 0px;
					line-height: 29px;
					margin-bottom: 0px;
					margin-left: 14px;
					margin-right: 0px;
					margin-top: 0px;
					outline-color: #2173AF;
					outline-style: none;
					outline-width: 0px;
					padding-bottom: 3px;
					padding-left: 8px;
					padding-right: 8px;
					padding-top: 3px;
					position: relative;
					text-decoration: none;
					text-shadow: white 0px 1px 0px;
					top: -3px;
					width: 0px;
				}

			/* db-db-edit*/
			.db-edit{
				background-attachment: scroll;
				background-clip: border-box;
				background-color: #F1F1F1;
				background-image: none;
				background-origin: padding-box;
				border-bottom-color: #DFDFDF;
				border-bottom-style: solid;
				border-bottom-width: 1px;
				border-left-color: #DFDFDF;
				border-left-style: solid;
				border-left-width: 1px;
				border-right-color: #DFDFDF;
				border-right-style: solid;
				border-right-width: 1px;
				border-top-color: #333;
				border-top-style: none;
				border-top-width: 0px;
				color: #333;
				display: block;
				font-family: Arial, sans-serif;
				font-size: 13px;
				font-style: normal;
				font-variant: normal;
				font-weight: normal;
				line-height: 18px;
				margin-bottom: 0px;
				margin-left: 0px;
				margin-right: 2px;
				margin-top: 0px;
				outline-color: #333;
				outline-style: none;
				outline-width: 0px;
				padding-bottom: 12px;
				padding-left: 20px;
				padding-right: 20px;
				padding-top: 8px;
			}

			.db-edit-col{
				float: left;
				margin:0px 5px 10px 5px;
				padding:15px 20px;
				border:1px solid white;
				box-shadow:0px 0px 70px #ddd;
				width:200px;
			}
			.db-edit-col-2{
				width:450px;

			}


			.db-edit-submit{
			}

			.db-edit-title{
				margin-top: 0px;
			}


			/* db-list */

			.dp-list-table .sorting-indicator{display:none;width:7px;height:4px;margin-top:8px;margin-left:7px;background-image:url(images/sort.gif);background-repeat:no-repeat;}

			.dp-list-table thead tr th {background-color:#f1f1f1; background-image:-ms-linear-gradient(top,#f9f9f9,#ececec); background-image:-moz-linear-gradient(top,#f9f9f9,#ececec); background-image:-o-linear-gradient(top,#f9f9f9,#ececec); background-image:-webkit-gradient(linear,left top,left bottom,from(#f9f9f9),to(#ececec)); background-image:-webkit-linear-gradient(top,#f9f9f9,#ececec); background-image:linear-gradient(top,#f9f9f9,#ececec);}
			.dp-list-table {border-color:#dfdfdf; background-color:#f9f9f9;}
			.dp-list-table td,.widefat th {border-top-color:#fff; border-bottom-color:#dfdfdf;}
			.dp-list-table th a {text-shadow:rgba(255,255,255,0.8) 0 1px 0; font-weight: normal; font-family: Georgia, 'Times New Roman', 'Bitstream Charter', Times, serif;}
	}		
			.dp-list-table td {color:#555;}
			.dp-list-table p,.widefat ol,.widefat ul {color:#333;}
			.dp-list-table thead tr th,.widefat tfoot tr th,h3.dashboard-widget-title,h3.dashboard-widget-title span,h3.dashboard-widget-title small,.find-box-head {color:#333;}
			.dp-list-table div.star img {border-left:1px solid #f9f9f9; border-right:1px solid #f9f9f9;}

			.dp-list-table td,.widefat th {border-top-color:#fff; border-bottom-color:#dfdfdf;}
			.dp-list-table th {text-shadow:rgba(255,255,255,0.8) 0 1px 0;}
			.dp-list-table td {color:#555;}
			.dp-list-table p,.widefat ol,.widefat ul {color:#333;}
			.dp-list-table thead tr th,.widefat tfoot tr th,h3.dashboard-widget-title,h3.dashboard-widget-title span,h3.dashboard-widget-title small,.find-box-head {color:#333;}


			.dp-list-table {border-width:1px; border-style:solid; border-spacing:0; width:100%; clear:both; margin:0; -moz-border-radius:3px; -khtml-border-radius:3px; -webkit-border-radius:3px; border-radius:3px;}
			.dp-list-table * {word-wrap:break-word;}
			.dp-list-table a {text-decoration:none;}
			.dp-list-table thead th:first-of-type {-moz-border-radius-topleft:3px; -khtml-border-top-left-radius:3px; -webkit-border-top-left-radius:3px; border-top-left-radius:3px;}
			.dp-list-table thead th:last-of-type {-moz-border-radius-topright:3px; -khtml-border-top-right-radius:3px; -webkit-border-top-right-radius:3px; border-top-right-radius:3px;}
			.dp-list-table tfoot th:first-of-type {-moz-border-radius-bottomleft:3px; -khtml-border-bottom-left-radius:3px; -webkit-border-bottom-left-radius:3px; border-bottom-left-radius:3px;}
			.dp-list-table tfoot th:last-of-type {-moz-border-radius-bottomright:3px; -khtml-border-bottom-right-radius:3px; -webkit-border-bottom-right-radius:3px; border-bottom-right-radius:3px;}
			.dp-list-table td,.widefat th {border-width:1px 0; border-style:solid;}
			.dp-list-table tfoot th {border-bottom:none;}
			.dp-list-table .no-items td {border-bottom-width:0;}
			.dp-list-table td {font-size:12px; padding:4px 7px 2px; vertical-align:top;}
			.dp-list-table td p,.widefat td ol,.widefat td ul {font-size:12px;}
			.dp-list-table th {padding:7px 7px 8px; text-align:left; line-height:1.3em; font-size:14px;}
			.dp-list-table th input {margin:0 0 0 8px; padding:0; vertical-align:text-top;}
			.dp-list-table tbody th.check-column {padding:9px 0 22px;}
			.dp-list-table .num,.column-comments,.column-links,.column-posts {text-align:center;}
			.dp-list-table th#comments {vertical-align:middle;}

			.dp-list-table .column-cb{width:2.2em; padding:11px 0 0 20px; vertical-align:top;}


			#log {
				padding: 0px 10px;
				border: 1px solid #999;
				height: 150px;
				background-color: #eee;
				color: #555;
				font-size: 10px;
				overflow: auto;
				box-shadow:1px 1px 24px #ddd inset;
			}
			#log-wrapper{
				position: relative;

			}
			#log-wrapper:after{
				content: "Console";
				position: absolute;
				display: block;
				top:0px;
				right:0px;
				line-height: 17px;
				background-color: #999;
				color: #fff;
				padding: 2px 10px 2px 15px;
				border-radius:0 0 0 40px;
				font-weight: bold;
				font-size: 10px;

			}
			#log .log_failed{
				color: red;
			}
			#log p{
				margin-bottom: 5px;
			}






	    </style>
		<!-- = Jquery = -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>

	
	
	<!-- = Uploader = -->
	<script src="js/jquery.imgareaselect.min.js"></script>

	
	

	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta name="generator" content="WebMotionUK" />
	



</head>

<body>

<div id='wpbody'>
<div id="wpbody-content">
<div class="wrap">
