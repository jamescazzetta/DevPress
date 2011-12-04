<?php
//session_start();
//include('devpress/xperto_check.php');


//plugins
include('plugins/upload.php');

$root = 'devpress.local';
date_default_timezone_set('Europe/Zurich');

include('../../mr_config.php');
include('../../devpress/functions.php');
include('../../devpress/erm_builder.php');
include('../../devpress/data_builder.php');
include('../../devpress/form_builder.php');
include('erm.php');
?>

<!DOCTYPE html>

<html lang="en">

<head>
	<meta charset="utf-8" />

    <title>Admin Control Panel</title>

    <link rel="stylesheet" href="../../devpress/css/reset.css" />
    <link rel="stylesheet" href="../../devpress/css/visualize.css" />
    <link rel="stylesheet" href="../../devpress/css/datatables.css" />
    <link rel="stylesheet" href="../../devpress/css/buttons.css" />
    <link rel="stylesheet" href="../../devpress/css/checkboxes.css" />
    <link rel="stylesheet" href="../../devpress/css/inputtags.css" />
    <link rel="stylesheet" href="../../devpress/css/main.css" />
	<link rel="stylesheet" href="../../devpress/css/colorpicker.css" />
	<link rel="stylesheet" href="../../devpress/css/custom.css" />
    
    <!--[if lt IE 9]>
    <link rel="stylesheet" href="css/ie.css" />
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>

<body>

  <div id="gradient">
      <div id="stars">
        <div id="container">
		 <header>

		    <!-- Logo -->
		    <h1 id="logo">Admin Control Panel</h1>

		    <!-- User info -->
		    <div id="userinfo">
		      <img src="devpress/img/avatar.png" alt="Bram Jetten" />
		      <div class="intro">
		        Welcome Bram<br />
		        You have <a href="#">3 new messages</a>
		      </div>
		    </div>

		  </header>
		
		<!-- The application "window" -->
          <div id="application">
	
	