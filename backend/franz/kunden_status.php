<?php 
$thetable = 'kunden_status';
$thename = 'Kunden Stati';
$thename_sing = 'Kunden Status';
$filename = 'kunden_status.php';
$joins = array('kunden');

include('../../devpress/header.php'); 
include('nav.php');


function editit($data){
	global $thetable;
	global $joins;
	global $thedata;
	

		echo "<section>";
			echo mr_textfield($data, $thetable, 'name', 'art', ' autofocus="autofocus" ');
		echo "</section>";
		echo "<section>";
			$args = array(
				"table" => "kunden",
				"original_table" => $thetable,
				"label" => "Verknüpfte Kunden",
				"colvalues" => array("nachname", "vorname"),
				"valueseperation" => " "
			);
		if (mr_checkboxes($args, $data)) {
			echo mr_checkboxes($args, $data);
		} else {
			echo "Erstellen Sie ein paar <strong>Kunden</strong> damit Sie dieses Produkt zuteilen können.";
		}
		echo "</section>";
		
	echo "<div style='clear:both'></div><br>";	
	}
	
	the_form();


//list
$data = data(array('table' => $thetable, 'joins' => $joins));
$constr = array(
	1 => array(
			'name' => 'name',
			'title' => 'arten',
			'type' => 'title'
		)
	
);
mr_BuildListTable($data, $constr, $thetable);


include('../../devpress/footer.php'); ?>		