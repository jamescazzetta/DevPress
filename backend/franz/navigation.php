<?php 
$thetable = 'navigation';
$thename = 'Navigation';
$thename_sing = 'Navigation Node';
$filename = 'navigation.php';
$joins = array();

include('../../devpress/header.php'); 
include('nav.php'); 



function editit($data){
	global $thetable;
	global $joins;
	global $thedata;

	echo "<section>";
		echo mr_textfield($data, $thetable, 'name', 'Name', ' autofocus="autofocus" class="required" ');
	echo "</section>";
	echo "<section>";
		$args = array(
			'thetable' => $thetable,
			'label' => 'Parent ID',
			'colvalues' => array("name"),
			'valueseperation' => " "
		);
		echo mr_parentselect($args,$data);
	echo "</section>";

	echo "<div style='clear:both'></div><br>";
	}
	
	the_form();


//list
$data = data(array('table' => $thetable, $joins));
$constr = array(
	0 => array(
			'name' => 'name',
			'title' => 'Name',
			'type' => 'title'
		)
);
mr_BuildListTable($data, $constr, $thetable);

include('../../devpress/footer.php'); ?>		