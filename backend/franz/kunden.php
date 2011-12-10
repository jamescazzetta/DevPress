<?php 
$thetable = 'kunden';
$thename = 'Kunden';
$thename_sing = 'Kunde';
$filename = 'kunden.php';
$joins = array('kunden_status', 'rechnungen', 'mediadb', 'navigation');

include('../../devpress/header.php'); 
include('nav.php'); 



function editit($data){
	global $thetable;
	global $joins;
	global $thedata;
	

	echo '<div class="column left">';
	echo "<section>";
		echo mr_image(array('thetable' => $thetable, 'label' => 'Image Label', 'smalltext' => ''), $data);
	echo "</section>";
		echo "<section>";
			echo mr_colorfield($data, $thetable, 'farbe', 'Farbe', '');
			echo "</section>";
		echo "<section>";
			echo mr_textfield($data, $thetable, 'nachname', 'Nach Name', ' autofocus="autofocus" class="required" ');
		echo "</section>";
		echo "<section>";
			echo mr_textfield($data, $thetable, 'vorname', 'Vor Name');
		echo "</section>";
		echo "<section>";
			echo mr_textfield($data, $thetable, 'strasse', 'Strasse & Nr.');
		echo "</section>";
		echo "<section>";
			echo mr_textfield($data, $thetable, 'zip', 'PLZ');
		echo "</section>";
		echo "<section>";
			echo mr_textfield($data, $thetable, 'ort', 'Ort/Stadt');
		echo "</section>";
		echo "<section>";
			echo mr_bool($data, $thetable, 'active', 'Aktive?', 'Ja', 'Nein');
		echo "</section>";
		echo "<section>";
			echo mr_textarea($data, $thetable, 'informationen', 'Informationen', 'class="tags"');
		echo "</section>";
		echo "<section>";
			echo mr_textfield($data, $thetable, 'roworder', 'Ordnung', '', 'number');
		echo "</section>";
	echo "</div>";
	echo '<div class="column right">';
		echo "<section>";
			$args = array(
				'thetable' => $thetable,
				'target_table' => 'kunden_status',
				'label' => 'Kunden Status',
				'target_col' => 'name',
				'target_col_label' => 'Status'
			);
			if (mr_select($args, $data)) {
				echo mr_select($args, $data);
			} else {
				echo "Erstellen Sie ein paar <strong>Stati</strong> damit Sie dieses Produkt zuteilen können.";
			}
		echo "</section>";
		echo "<section>";
			$args = array(
				'thetable' => $thetable,
				'target_table' => 'navigation',
				'label' => 'Navigation',
				"colvalues" => array("name"), //just for presentation
				"valueseperation" => " " //just for presentation

			);
			if (mr_checkboxes($args, $data)) {
				echo mr_checkboxes($args, $data);
			} else {
				echo "Erstellen Sie ein paar <strong>Stati</strong> damit Sie dieses Produkt zuteilen können.";
			}
		echo "</section>";
		echo "<section>";
			$args = array(
				'thetable' => $thetable,
				'label_sing' => 'Rechnung',
				'label_plur' => 'Rechnungen',
				'target_table' => 'rechnungen',
				'target_cols' => array(
					'ref' => 'textfield',
					'amount' => 'textfield',
					'bank' => 'textfield',
					'konto' => 'textfield',
					'farbe'	=> 'colorfield'
				),
				'target_cols_labels' => array(
					'ref' => 'Referenz Nummer',
					'amount' => 'Betrag',
					'bank' => 'Bankname',
					'konto' => 'Konto Nummer'
				)
			);
			echo multigroup($args, $data);
		echo "</section>";
	echo "</div>";
	echo "<div style='clear:both'></div><br>";
	}
	
	the_form();

//list
$data = data(array('table' => $thetable, $joins));
$constr = array(
	0 => array(
			'name' => 'nachname',
			'title' => 'Nachname',
			'type' => 'title'
		),
	1 => array(
			'name' => 'vorname',
			'title' => 'Vorname',
			'type' => 'field'
		)
	
);
mr_BuildListTable($data, $constr, $thetable);

include('../../devpress/footer.php'); ?>		