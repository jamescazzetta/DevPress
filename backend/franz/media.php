<?php 
$thetable = 'mediadb';
$thename = 'Media';
$thename_sing = 'Media';
$filename = 'media.php';
$joins = array();

include('../../devpress/header.php'); 
include('nav.php');

function mr_image_preview($data){
	global $root;
	$return = "";
	$ext = pathinfo($data["tmpname"], PATHINFO_EXTENSION);
	if ($ext == 'png' || $ext == 'jpg') {
		$return .= "<div class='image_preview'>";
		$return .= "<a class='fancybox' href='" . $root . '/devpress/uploads/' . $data["tmpname"] . "' target='blank' title='$data[name]'>";
		$return .= "<img src='" . $root . '/devpress/uploads/' . $data["tmpname"] . "' alt='image' style='max-height:100px;max-width:100px;' />";
		$return .= "</a>";
		$return .= "</div>";
	} else {
		$return .= "<div class='image_preview'>No preview possible.</div>";
	}	
	return $return;
}
function editit($data){
	global $thetable;
	global $joins;
	global $thedata;
	global $root;
		echo "<section>";
			echo mr_textfield($data, $thetable, 'name', 'Name', ' autofocus="autofocus" ');
		echo "</section>";
		echo "<section>";
			echo mr_textfield($data, $thetable, 'tmpname', 'Realname', ' disabled ');
		echo "</section>";
		echo "<section>";
			echo "<label>Preview<small>$data[name]</small></label>";
			echo mr_image_preview($data);
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