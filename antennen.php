<?php 
$thetable = 'antennen';
$thename = 'Antennen';
$thename_sing = 'Antenne';
$filename = 'antennen.php';
$joins = array('antennen_bauformen', 'farben', 'antennen_materialien', 'antennen_arte');

include('devpress/header.php'); 
include('nav.php'); 



function editit($data){
	global $thetable;
	global $joins;
	global $thedata;
	

	echo '<div class="column left">';
		echo "<section>";
			echo mr_textfield($data, $thetable, 'Artikelnummer', 'Artikel Nr.', ' autofocus="autofocus" class="required" ');
		echo "</section>";
		echo "<section>";
			echo mr_textarea($data, $thetable, 'artikeltext', 'Beschreibung', ' class="tags" ');
		echo "</section>";
		echo "<section>";
			echo mr_textfield($data, $thetable, 'durchmesser', 'Durchmesser ⌀');
		echo "</section>";
		echo "<section>";
			echo mr_textfield($data, $thetable, 'gewicht', 'Gewicht');
		echo "</section>";
		echo "<section>";
			echo mr_textfield($data, $thetable, 'preis', 'Preis');
		echo "</section>";
		echo "<section>";
			echo mr_bool($data, $thetable, 'outdoor', 'Outdoor?', 'Ja', 'Nein');
		echo "</section>";
		echo "<section>";
			echo mr_textfield($data, $thetable, 'roworder', 'Ordnung', '', 'number');
		echo "</section>";
	echo "</div>";
	echo '<div class="column right">';
		echo "<section>";
			$args = array(
				"table" => "antennen_bauformen",
				"original_table" => $thetable,
				"label" => "Bauformen",
				"colvalues" => array("bauform_name"),
				"valueseperation" => " "
			);
		if (mr_checkboxes($args, $data)) {
			echo mr_checkboxes($args, $data);
		} else {
			echo "Erstellen Sie ein paar <strong>Bauformen</strong> damit Sie dieses Produkt zuteilen können.";
		}
		echo "</section>";
		echo "<section>";
			$args = array(
				'thetable' => $thetable,
				'target_table' => 'antennen_arte',
				'label' => 'Arte',
				'target_col' => 'antennenart_name',
				'target_col_label' => 'Art'
			);
			if (mr_select($args, $data)) {
				echo mr_select($args, $data);
			} else {
				echo "Erstellen Sie ein paar <strong>Arten</strong> damit Sie dieses Produkt zuteilen können.";
			}
		echo "</section>";
		echo "<section>";
			$args = array(
				"table" => "antennen_materialien",
				"original_table" => $thetable,
				"label" => "Materialien",
				"colvalues" => array("materialien_name"),
				"valueseperation" => " "
			);
			if (mr_checkboxes($args, $data)) {
				echo mr_checkboxes($args, $data);
			} else {
				echo "Erstellen Sie ein paar <strong>Materialien</strong> damit Sie dieses Produkt zuteilen können.";
			}
			
			
		echo "</section>";
		echo "<section>";
			$args = array(
				'thetable' => $thetable,
				'label_sing' => 'Farbe',
				'label_plur' => 'Farben',
				'target_table' => 'farben',
				'target_cols' => array(
					'farben_hex' => 'colorfield',
					'farben_name' => 'textfield'
				),
				'target_cols_labels' => array(
					'farben_hex' => 'Farbe (#Hex)',
					'farben_name' => 'Farben-Namen'
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
	2 => array(
			'name' => 'Artikelnummer',
			'title' => 'Artikelnummer',
			'type' => 'title'
		),
	3 => array(
			'name' => 'artikeltext',
			'title' => 'Beschreibung',
			'type' => 'field'
		),
	4 => array(
			'name' => 'durchmesser',
			'title' => 'Durchmesser ⌀',
			'type' => 'field'
		),
	5 => array(
			'name' => 'gewicht',
			'title' => 'Gewicht',
			'type' => 'field'
		),
	6 => array(
			'name' => 'indooroutdoor',
			'title' => 'Outdoor',
			'type' => 'truefalse'
		),
	7 => array(
			'name' => 'preis',
			'title' => 'Preis',
			'type' => 'field'
		),
	8 => array(
			'name' => 'antennen_bauformen',
			'title' => 'Bauformen',
			'type' => 'm2m',
			'm2mcol' => 'bauform_name'
		)
	
);
mr_BuildListTable($data, $constr, $thetable);

include('devpress/footer.php'); ?>		