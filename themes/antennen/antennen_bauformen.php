<?php  
$thetable = 'antennen_bauformen';
$thename = 'Antennen Bauformen';
$thename_sing = 'Antennen Bauform';
$filename = 'antennen_bauformen.php';
$joins = array('antennen');

include('devpress/header.php'); 
include('nav.php');


function editit($data){
	global $thetable;
	global $joins;
	global $thedata;
	
	//bauform_name
	echo "<section>";
		echo mr_textfield($data, $thetable, 'bauform_name', 'Bauform', ' autofocus="autofocus" ');
	echo "</section>";
	
	//antennen
	echo "<section>";
		$args = array(
			"table" => "antennen",
			"original_table" => $thetable,
			"label" => "Verknüpfte Antennen",
			"colvalues" => array("Artikelnummer"),
			"valueseperation" => " "
		);
		echo mr_checkboxes($args, $data);
	echo "</section>";
	
	//antennen
	echo "<section>";
		$args = array(
			'table' => $thetable,
			'label' => 'Parent Bauform',
			'colvalues' => array("bauform_name"),
			'valueseperation' => " "
		);
		echo mr_parentselect($args, $data);
	echo "</section>";
}
	
	the_form();



//list
$data = data(array('table' => $thetable, 'joins' => $joins));
$constr = array(
	1 => array(
			'name' => 'bauform_name',
			'title' => 'Bauformen',
			'type' => 'title'
		),
	2 => array(
			'name' => 'antennen',
			'title' => 'Antennen',
			'type' => 'm2m',
			'm2mcol' => 'Artikelnummer'
		)
	
);
mr_BuildListTable($data, $constr, $thetable);


include('devpress/footer.php'); ?>		