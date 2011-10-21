<?php 
include('devpress/header.php'); 
include('nav.php'); 

//Title
echo '<section class="dp-title">';
  echo '<hgroup>';
	echo '<h2>Antennen<a href="antennen.php?action=new" class="add-new-h2">Neuer Eintrag</a></h2>';
  echo '</hgroup>';
echo '</section>';


function editit($data, $thetable){
	echo "<section id='db-edit'>";	
	echo mr_startform($data, $thetable);

		echo "<div class='db-edit-col'>";
		echo '<h4 class="db-edit-title">Infomrationen bearbeiten (self)</h4>';
			echo mr_textfield($data, $thetable, 'Artikelnummer', '#', ' autofocus="autofocus" ');
			echo mr_textarea($data, $thetable, 'artikeltext', 'Beschreibung');
			echo mr_textfield($data, $thetable, 'durchmesser', '⌀');
			echo mr_textfield($data, $thetable, 'gewicht', 'Gewicht');
			echo mr_textfield($data, $thetable, 'preis', 'Preis');
			echo mr_textfield($data, $thetable, 'roworder', 'Ordnung');
		echo "</div>";

		echo "<div class='db-edit-col'>";
			echo '<h4 class="db-edit-title">Bauformen zuteilung(m2m)</h4>';
			$args = array(
				"table" => "antennen_bauformen",
				"original_table" => $thetable,
				"label" => "Bauformen",
				"colvalues" => array("bauform_name"),
				"valueseperation" => " "
			);
			echo mr_checkboxes($args, $data);
		echo "</div>";

		echo "<div class='db-edit-col'>";			
			echo '<h4 class="db-edit-title">Art(m2s)</h4>';
			$args = array(
				'thetable' => $thetable,
				'target_table' => 'antennen_arte',
				'target_col' => 'antennenart_name',
				'target_col_label' => 'Art'
			);
			echo mr_select($args, $data);
		echo "</div>";
		
		echo "<div class='db-edit-col'>";
			echo '<h4 class="db-edit-title">Materialien(m2m)</h4>';
			$args = array(
				"table" => "antennen_materialien",
				"original_table" => $thetable,
				"label" => "Materialien",
				"colvalues" => array("materialien_name"),
				"valueseperation" => " "
			);
			echo mr_checkboxes($args, $data);
		echo "</div>";
		
		echo "<div class='db-edit-col'>";
			echo '<h4 class="db-edit-title">Farben(s2m)</h4>';
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
			
		echo "</div>";
	
	//$args = array('aktiontitle' => 'Aktionen', 'submit' => 'Übernehmen', 'cancel' => 'Abbrechen', 'delete' => 'Löschen');
	echo mr_endform($data);
	echo "<div class='clear'>&nbsp;</div>";
	echo "</section>";
}


//edit
echo "<section class='db-edit'>";
	$thetable = 'antennen';
	$joins = array('antennen_bauformen', 'farben', 'antennen_materialien', 'antennen_arte');
	form_logic($thetable, $joins);
echo "</section>";


//list
echo '<section class="dp-list">';
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
echo '</section>';


include('devpress/footer.php'); ?>		