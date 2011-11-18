<?php 
include('devpress/header.php'); 
include('nav.php'); 

//Title
echo '<section class="dp-title">';
  echo '<hgroup>';
	echo '<h2>Produkte<a href="produkte.php?action=new" class="add-new-h2">Neuer Eintrag</a></h2>';
  echo '</hgroup>';
echo '</section>';


function editit($data, $thetable){
	echo "<section id='db-edit'>";	
	echo mr_startform($data, $thetable);

		echo "<div class='db-edit-col'>";
		echo '<h4 class="db-edit-title">Infomrationen bearbeiten (self)</h4>';
			echo mr_textfield($data, $thetable, 'Artikelnummer', '#', ' autofocus="autofocus" ');
			echo mr_textfield($data, $thetable, 'name', 'Name', ' autofocus="autofocus" ');
			echo mr_textarea($data, $thetable, 'beschreibung', 'Beschreibung');
			echo mr_textarea($data, $thetable, 'techdata', 'Technische Daten');
			echo mr_textfield($data, $thetable, 'preis_chf', 'Preis');
			echo mr_textfield($data, $thetable, 'roworder', 'Ordnung');
		echo "</div>";

		echo "<div class='db-edit-col'>";
			echo '<h4 class="db-edit-title">Kategorie zuteilung(m2m)</h4>';
			$args = array(
				"table" => "kategorien",
				"original_table" => $thetable,
				"label" => "Kategorie(n)",
				"colvalues" => array("name"),
				"valueseperation" => " "
			);
			echo mr_checkboxes($args, $data);
		echo "</div>";

/*		
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
*/
	
	//$args = array('aktiontitle' => 'Aktionen', 'submit' => 'Übernehmen', 'cancel' => 'Abbrechen', 'delete' => 'Löschen');
	echo mr_endform($data);
	echo "<div class='clear'>&nbsp;</div>";
	echo "</section>";
}


//edit
echo "<section class='db-edit'>";
	$thetable = 'produkte';
	$joins = array('kategorien');
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
			'name' => 'beschreibung',
			'title' => 'Beschreibung',
			'type' => 'field'
		),
	7 => array(
			'name' => 'preis_chf',
			'title' => 'Preis',
			'type' => 'field'
		),
	8 => array(
			'name' => 'kategorien',
			'title' => 'Kategorie(n)',
			'type' => 'm2m',
			'm2mcol' => 'name'
		)
	
);
mr_BuildListTable($data, $constr, $thetable);
echo '</section>';


include('devpress/footer.php'); ?>		