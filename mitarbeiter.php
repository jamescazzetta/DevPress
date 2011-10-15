<?php 
include('devpress/header.php'); 


//testing github

?>

<?php include('nav.php'); ?>
<section class="dp-title">
  <hgroup>
	<h2>Mitarbeiter<a href="mitarbeiter.php?action=new" class="add-new-h2">Neuer Eintrag</a></h2>
  </hgroup>
</section>


<?php

$thetable = 'mitarbeiter';
$joins = array('gruppen');

//delete
if (array_key_exists('delete', $_GET)) {
	mr_deleteentry($thetable, $_GET['delete']);
	mr_deletetweenentries($thetable, 'gruppen', $_GET['delete']);
}


function saveit($newid = '', $thetable){
	mr_savetextfielddata($thetable, 'vorname', $newid);
	mr_savetextfielddata($thetable, 'nachname', $newid);
	mr_savetextfielddata($thetable, 'funktion', $newid);
	mr_savetextfielddata($thetable, 'email', $newid);
	mr_savetextfielddata($thetable, 'telefon', $newid);
	mr_savetextfielddata($thetable, 'telefax', $newid);
	mr_savetextfielddata($thetable, 'roworder', $newid);
	
	mr_savecheckboxes($thetable, 'gruppen', $newid);
}


function editit($data, $thetable){
	echo "<section id='db-edit'>";	
	echo mr_startform($data, $thetable);

		echo "<div class='db-edit-col'>";
		echo '<h4 class="db-edit-title">Infomrationen bearbeiten</h4>';
			echo mr_textfield($data, $thetable, 'vorname', 'Vorame', ' autofocus="autofocus" ');
			echo mr_textfield($data, $thetable, 'nachname', 'Nachame');
			echo mr_textfield($data, $thetable, 'funktion', 'Funktion');
			echo mr_textfield($data, $thetable, 'email', 'E-mail');
			echo mr_textfield($data, $thetable, 'telefon', 'Telefon');
			echo mr_textfield($data, $thetable, 'telefax', 'Fax');
			echo mr_textfield($data, $thetable, 'roworder', 'Ordnung');
		echo "</div>";

		echo "<div class='db-edit-col'>";
			echo '<h4 class="db-edit-title">Sparten zuteilung</h4>';
			echo mr_checkboxes($data, 'gruppen', 'sparte', 'Sparte(n)');
		echo "</div>";
		
		echo "<div class='db-edit-col'>";
			echo '<h4 class="db-edit-title">Bild</h4>';
			echo mr_self_image($data, $thetable, 'bild', 'Bild');
		echo "</div>";
	
		echo "<div class='db-edit-col'>";
			echo '<h4 class="db-edit-title">Aktionen</h4>';
			echo mr_submitbutton($value = 'Ünbernehmen');
			echo mr_cancelbutton($value = 'Abbrechen');
			
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
	echo "<p>Diese Einträge werden nach <a href='sparten.php' >Sparten</a> geordnet und werden auf der <a href='http://algra.pcardsolution.ch/v3/mitarbeiter.php'>Ansprechspartner</a> Seite angezeigt.</p>";
}
echo "</section>";





//uploads


//list
$data = data(array('table' => $thetable, 'joins' => $joins));
$constr = array(
	1 => array(
			'name' => 'bild',
			'title' => 'Bild',
			'type' => 'image'
		),
	2 => array(
			'name' => 'nachname',
			'title' => 'Nachname',
			'type' => 'title'
		),
	3 => array(
			'name' => 'vorname',
			'title' => 'Vorname',
			'type' => 'field'
		),
	4 => array(
			'name' => 'funktion',
			'title' => 'Funktion',
			'type' => 'field'
		),
	5 => array(
			'name' => 'email',
			'title' => 'E-Mail',
			'type' => 'field'
		),
	6 => array(
			'name' => 'telefon',
			'title' => 'Telefon',
			'type' => 'field'
		),
	7 => array(
			'name' => 'telefax',
			'title' => 'Telefax',
			'type' => 'field'
		),
	8 => array(
			'name' => 'gruppen',
			'title' => 'Sparte',
			'type' => 'm2m',
			'm2mcol' => 'sparte'
		),
	
);
echo '<section class="dp-list">';
mr_BuildListTable($data, $constr);
echo '</section>';


include('devpress/footer.php'); ?>		