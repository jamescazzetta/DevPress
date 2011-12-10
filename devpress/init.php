<?php
//session_start();
//include('devpress/xperto_check.php');


//plugins
//include('plugins/upload.php');


$root = 'devpress.local';
date_default_timezone_set('Europe/Zurich');

include('../../mr_config.php');
include('../../devpress/functions.php');
if ($build) {include('../../devpress/erm_builder.php');}
if ($build) {include('../../devpress/base_erm.php');}
if ($build) {include('erm.php');}
include('../../devpress/data_builder.php');
include('../../devpress/form_builder.php');
?>