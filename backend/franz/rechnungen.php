<?php 
$thetable = 'rechnungen';
$thename = 'Rechnungen';
$thename_sing = 'Kunde';
$filename = 'rechnungen.php';
$joins = array();

include('../../devpress/header.php'); 
include('nav.php'); 



function editit($data){
	global $thetable;
	global $joins;
	global $thedata;
	

		echo "<section>";
			echo mr_textfield($data, $thetable, 'ref', 'Referenz Nummer', ' autofocus="autofocus" class="required" ');
		echo "</section>";
		echo "<section>";
			echo mr_textfield($data, $thetable, 'amount', 'Betrag');
		echo "</section>";
		echo "<section>";
			echo mr_textfield($data, $thetable, 'bank', 'Bankname.');
		echo "</section>";
		echo "<section>";
			echo mr_textfield($data, $thetable, 'konto', 'Konto');
		echo "</section>";
		echo "<section>";
			$args = array(
				'thetable' => $thetable,
				'target_table' => 'kunden',
				'label' => 'Kunde',
				'target_col' => 'nachname',
				'target_col_label' => 'Kunde'
			);
			if (mr_select($args, $data)) {
				echo mr_select($args, $data);
			} else {
				echo "Erstellen Sie ein<strong>J=Kunde</strong> damit Sie diese Rechnung zuteilen können.";
			}
		echo "</section>";
		
	echo "<div style='clear:both'></div><br>";
	}
	
	the_form();


//list
$data = data(array('table' => $thetable, $joins));
$constr = array(
	0 => array(
			'name' => 'ref',
			'title' => 'Referenz Nummer',
			'type' => 'title'
		)
);
mr_BuildListTable($data, $constr, $thetable);

include('../../devpress/footer.php'); ?>		