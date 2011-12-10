<?php 
$thetable = 'antennen_arte';
$thename = 'Antennen Arte';
$thename_sing = 'Antennen Art';
$filename = 'antennen_arte.php';
$joins = array('antennen');

include('devpress/header.php'); 
include('nav.php');


function editit($data){
	global $thetable;
	global $joins;
	global $thedata;
	

		echo "<section>";
			echo mr_textfield($data, $thetable, 'antennenart_name', 'art', ' autofocus="autofocus" ');
		echo "</section>";
		echo "<section>";
			$args = array(
				"table" => "antennen",
				"original_table" => $thetable,
				"label" => "Verknüpfte Antennen",
				"colvalues" => array("Artikelnummer"),
				"valueseperation" => " "
			);
		if (mr_checkboxes($args, $data)) {
			echo mr_checkboxes($args, $data);
		} else {
			echo "Erstellen Sie ein paar <strong>Bauformen</strong> damit Sie dieses Produkt zuteilen können.";
		}
		echo "</section>";
		
	echo "<div style='clear:both'></div><br>";	
	}
	
	the_form();


//list
$data = data(array('table' => $thetable, 'joins' => $joins));
$constr = array(
	1 => array(
			'name' => 'antennenart_name',
			'title' => 'arten',
			'type' => 'title'
		)
	
);
mr_BuildListTable($data, $constr, $thetable);


include('devpress/footer.php'); ?>		