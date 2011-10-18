<?php 
include('devpress/header.php'); 
include('nav.php');

function saveit($newid = '', $thetable){
	mr_savetextfielddata($thetable, 'sparte', $newid);
	mr_saveparentselect($thetable, $newid);
	
}

function editit($data, $thetable){
	echo "<section id='db-edit'>";
		echo mr_startform($data, $thetable);
	
		echo "<div class='db-edit-col'>";
			echo '<h4 class="db-edit-title">Bearbeiten</h4>';
			echo mr_textfield($data, $thetable, 'sparte', 'Sparte', ' autofocus="autofocus" ');
		echo "</div>";
	
		echo "<div class='db-edit-col'>";
			echo '<h4 class="db-edit-title">Mitarbeiter</h4>';
			$args = array(
				"table" => "mitarbeiter",
				"label" => "Verknüpfte Mitarbeiter",
				"colvalues" => array("vorname", "nachname"),
				"valueseperation" => " "
			);
			echo mr_checkboxes($args, $data);;
		echo "</div>";
		
		echo "<div class='db-edit-col db-edit-submit'>";
			echo '<h4 class="db-edit-title">Aktionen</h4>';
			$args = array(
				"table" => $thetable,
				"label" => "Übergeordnet",
				"colvalues" => array("sparte"),
				"valueseperation" => " "
			);
			echo mr_parentselect($args, $data);
			echo mr_submitbutton($value = 'Apply');
		echo "</div>";
		

			
		echo mr_endform();
	echo "<div class='clear'>&nbsp;</div>";	
	echo "</section>";
}

function uploadit($data, $table){
/*	echo "<table>";
	echo "<tr valign='top'>";
	echo "<td>";
	echo "<h5>Bilder hochladen</h5>";

	ImgUpload($table, 'bild', 'Mitarbeiter Bilder', $data, array(70,70));

	echo "</td>";
	echo "</tr>";
	echo "</table>";
*/
}

?>
<section class="dp-title">
  <hgroup>
	<h2>Sparten<a href="sparten.php?action=new" class="add-new-h2">Neuer Eintrag</a></h2>
  </hgroup>
</section>

<?php

$thetable = 'gruppen';
$joins = array('mitarbeiter');

//delete
if (array_key_exists('delete', $_GET)) {
	mr_deleteentry($thetable, $_GET['delete']);
	mr_deletetweenentries($thetable, 'mitarbeiter', $_GET['delete']);
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
			saveit(mr_createentry($thetable), $thetable);
			$data = data(array('table' => $thetable, 'joins' => $joins), array('ID' => $_GET['edit_id']), 1);
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
	
		default:
			echo "<p>Wählen Sie einen Datensatz unten aus, oder kreieren Sie eine neue um diese dann hier zu bearbeiten.</p>";
		break;
	}
}
echo "</section>";





//uploads


//list
$data = data(array('table' => $thetable, 'joins' => $joins));
$constr = array(
	1 => array(
			'name' => 'sparte',
			'title' => 'Sparte',
			'type' => 'title'
		),
	2 => array(
			'name' => 'parent_id',
			'title' => 'Parent ID',
			'type' => 'normal'
		),
	
);
echo '<section class="dp-list">';
mr_BuildListTable($data, $constr, $thetable);
echo '</section>';


include('devpress/footer.php'); ?>		