<?php 
include('devpress/header.php'); 
include('nav.php'); 
$thetable = 'antennen';
$joins = array('antennen_bauformen', 'farben', 'antennen_materialien', 'antennen_arte');


function saveit($newid = '', $thetable){
	mr_savetextareadata($thetable, 'artikeltext', $newid);
	//mr_truefalse($thetable, 'indooroutdoor', $newid);
	mr_savecheckboxes($thetable, 'antennen_bauformen', $newid);
}


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
	
		echo "<div class='db-edit-col'>";
			echo '<h4 class="db-edit-title">Aktionen</h4>';
			echo mr_submitbutton($value = 'Übernehmen');
			echo mr_cancelbutton($value = 'Abbrechen');
			if ($data) {echo mr_deletebutton($data['id'], $value = 'Löschen');}
			
			
		echo "</div>";
	
	echo mr_endform();
	echo "<div class='clear'>&nbsp;</div>";
	echo "</section>";
}


function uploadit($data, $table){
	echo "<section id='db-edit'>";	
		echo "<div class='db-edit-col db-edit-col-2'>";
			echo '<h4 class="db-edit-title">Bild hochladen</h4>';
			ImgUpload($table, 'bild', 'Mitarbeiter Bilder', $data, array(70,70));
		echo "</div>";
		echo "<div class='clear'>&nbsp;</div>";
	echo "</section>";
}




echo '<section class="dp-title">';
  echo '<hgroup>';
	echo '<h2>Antennen<a href="antennen.php?action=new" class="add-new-h2">Neuer Eintrag</a></h2>';
  echo '</hgroup>';
echo '</section>';

//delete
if (array_key_exists('delete', $_GET)) {
	mr_deleteentry($thetable, $_GET['delete']);
	mr_deletetweenentries($thetable, 'antennen_bauformen', $_GET['delete']);
}

//get data if id is given 
if ( array_key_exists('edit_id', $_GET)) {
		$data = data(array('table' => $thetable, 'joins' => $joins), array('ID' => $_GET['edit_id']), 1);
} else {
	$data = array();
}




echo "<section class='db-edit'>";
if ( array_key_exists('action', $_GET)) {
	switch ($_GET['action']) {
		case 'saveedit':
			saveit('',$thetable);
			$data = data(array('table' => $thetable, 'joins' => $joins), array('ID' => $_GET['edit_id']), 1);
			editit($data, $thetable);
		break;
		case 'savenew':
			$newid = mr_createentry($thetable);
			saveit($newid, $thetable);
			$data = data(array('table' => $thetable, 'joins' => $joins), array('ID' => $newid), 1);
			editit($data, $thetable);
			
		break;
		case 'edit':
			editit($data, $thetable);
		break;
		case 'new':
			editit($data, $thetable);
		break;
		case 'uploadimage':
		$data = data(array('table' => $thetable, 'joins' => $joins), array('ID' => $_GET['edit_id']), 1);
			uploadit($data, $thetable);
		break;
	}
} else {
	//echo "<p>Diese Einträge werden nach <a href='sparten.php' >Sparten</a> geordnet und werden auf der <a href='http://algra.pcardsolution.ch/v3/mitarbeiter.php'>Ansprechspartner</a> Seite angezeigt.</p>";
}
echo "</section>";


//list
$data = data(array('table' => $thetable, 'joins' => array('antennen_bauformen')));
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
echo '<section class="dp-list">';
mr_BuildListTable($data, $constr, $thetable);
echo '</section>';


include('devpress/footer.php'); ?>		