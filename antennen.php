<?php 
include('devpress/header.php'); 
include('nav.php'); 
echo "<section id='content'>";
echo '<h2>Antennen<a href="antennen.php?action=new" class="button icon add">Add</a></h2>';


function editit($data, $thetable){
	echo mr_startform($data, $thetable);

	echo '<div class="column left">';
		echo "<section>";
			echo mr_textfield($data, $thetable, 'Artikelnummer', 'Artikel Nr.', ' autofocus="autofocus" ');
		echo "</section>";
		echo "<section>";
			echo mr_textarea($data, $thetable, 'artikeltext', 'Beschreibung');
		echo "</section>";
		echo "<section>";
			echo mr_textfield($data, $thetable, 'durchmesser', '⌀');
		echo "</section>";
		echo "<section>";
			echo mr_textfield($data, $thetable, 'gewicht', 'Gewicht');
		echo "</section>";
		echo "<section>";
			echo mr_textfield($data, $thetable, 'preis', 'Preis');
		echo "</section>";
		echo "<section>";
			echo mr_bool($data, $thetable, 'outdoor', 'Outdoor');
		echo "</section>";
		echo "<section>";
			echo mr_textfield($data, $thetable, 'roworder', 'Ordnung');
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
		echo mr_checkboxes($args, $data);
		echo "</section>";
		echo "<section>";
			$args = array(
				'thetable' => $thetable,
				'target_table' => 'antennen_arte',
				'target_col' => 'antennenart_name',
				'target_col_label' => 'Art'
			);
			echo mr_select($args, $data);
		echo "</section>";
		echo "<section>";
			$args = array(
				"table" => "antennen_materialien",
				"original_table" => $thetable,
				"label" => "Materialien",
				"colvalues" => array("materialien_name"),
				"valueseperation" => " "
			);
			echo mr_checkboxes($args, $data);
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
	echo mr_endform($data);
	
	}


//edit
	$thetable = 'antennen';
	$joins = array('antennen_bauformen', 'farben', 'antennen_materialien', 'antennen_arte');
	form_logic($thetable, $joins);


//list
$data = data(array('table' => $thetable, $joins));
$constr = array(
	2 => array(
			'name' => 'Artikelnummer',
			'title' => '#',
			'type' => 'title'
		),
	3 => array(
			'name' => 'artikeltext',
			'title' => 'Beschreibung',
			'type' => 'field'
		),
	4 => array(
			'name' => 'durchmesser',
			'title' => '⌀',
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


echo "<div style='clear:both'></div>";
echo "</section>";
include('devpress/footer.php'); ?>		