<?php 
include('devpress/header.php'); 
include('nav.php');


$thetable = 'partner';
$joins = array();

//delete
if (array_key_exists('delete', $_GET)) {
	mr_deleteentry($thetable, $_GET['delete']);
	//mr_deletetweenentries($thetable, 'gruppen', $_GET['delete']);
}


function saveit($newid = ''){
	mr_savetextfielddata($thetable, 'name', $newid);
	mr_savetextfielddata($thetable, 'land', $newid);
	mr_savetextfielddata($thetable, 'telefon', $newid);
	mr_savetextfielddata($thetable, 'telefax', $newid);
	mr_savetextfielddata($thetable, 'email', $newid);
}

function editit($data){
	echo "<table>";
	echo "<tr valign='top'>";
	echo "<td>";
	echo "<h5>Bearbeiten</h5>";

	echo mr_startform($data, $thetable);
	echo mr_textfield($data, $thetable, 'name', 'Name', ' autofocus="autofocus" ');
	echo mr_textfield($data, $thetable, 'land', 'Land');
	echo "</td><td>";
	echo mr_textfield($data, $thetable, 'telefon', 'Telefon');
	echo mr_textfield($data, $thetable, 'telefax', 'Fax');
	echo mr_textfield($data, $thetable, 'email', 'E-mail');
	echo "</td><td>";
	

	echo '<br />' . mr_submitbutton($value = 'Apply');
	echo mr_endform();

	echo "</td>";
	echo "</tr>";
	echo "</table>";
}

function uploadit($data){
	echo "<table>";
	echo "<tr valign='top'>";
	echo "<td>";
	echo "<h5>Bilder hochladen</h5>";

	//ImgUpload($thetable, 'bild', 'Mitarbeiter Bilder', $data, array(70,70));

	echo "</td>";
	echo "</tr>";
	echo "</table>";
}


//get data if id is given 
if ( array_key_exists('edit_id', $_GET)) {
		$data = data(array('table' => $thetable, 'joins' => $joins), array('ID' => $_GET['edit_id']), 1);
} else {
	$data = array();
}



echo '<h2>Partner <a href="'.$thetable.'.php?action=new" class="add-new-h2">Add New</a> </h2>';
echo "<div id='screen-options-wrap'>";

switch ($_GET['action']) {
	case 'saveedit':
		saveit();
		$data = data(array('table' => $thetable, 'joins' => $joins), array('ID' => $_GET['edit_id']), 1);
		editit($data);
	break;
	case 'savenew':
		saveit(mr_createentry($thetable));
		$data = data(array('table' => $thetable, 'joins' => $joins), array('ID' => $_GET['edit_id']), 1);
		editit($data);
	break;
	case 'edit':
		editit($data);
	break;
	case 'new':
		editit($data);
	break;
//	case 'uploadimage':
//	$data = data(array('table' => $thetable, 'joins' => $joins), array('ID' => $_GET['edit_id']), 1);
//		uploadit($data);
//	break;
	
	default:
		echo "<p>Wählen Sie einen Datensatz unten aus, oder kreieren Sie eine neue um diese dann hier zu bearbeiten.</p>";
	break;
}

echo "</div>";





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
mr_BuildListTable($data, $constr);



include('devpress/footer.php'); ?>	