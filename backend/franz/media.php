<?php 
$thetable = 'mediadb';
$thename = 'Media';
$thename_sing = 'Media';
$filename = 'media.php';
$joins = array();

include('../../devpress/header.php'); 
include('nav.php');


function editit($data){
	global $thetable;
	global $joins;
	global $thedata;
	

		echo "<section>";
			echo mr_textfield($data, $thetable, 'name', 'Name', ' autofocus="autofocus" ');
		echo "</section>";
		echo "<section>";
			echo mr_textfield($data, $thetable, 'tmpname', 'Realname', ' autofocus="autofocus" ');
		echo "</section>";
		
	echo "<div style='clear:both'></div><br>";	
	}
	
	the_form();


//list
$data = data(array('table' => $thetable, 'joins' => $joins));
$constr = array(
	1 => array(
			'name' => 'name',
			'title' => 'Name',
			'type' => 'title'
		),
	2 => array(
			'name' => 'tmpname',
			'title' => 'Realname',
			'type' => 'text'
		),
	3 => array(
			'name' => 'tmpname',
			'title' => 'Filepreview',
			'type' => 'filepreview'
	)
	
);
mr_BuildListTable($data, $constr, $thetable);


include('../../devpress/footer.php'); ?>		