<?php

// ================
// = Form Masters =====================================================================================
// ================
function the_form(){
	global $thetable;
	global $joins;
	global $thedata;
	global $filename;
	global $globalid;
	global $thename;
	
	echo "<h2>$thename</h2>";
	
	$addnewbutton = '<a href="'.$filename.'?action=new" class="button icon add">Add New</a><br><br>';
	if (array_key_exists('action', $_GET)) {
		echo ($_GET['action'] != 'new' ? $addnewbutton : '<p>The completion of this form, will cause a new entry</p>');
	} else {
		echo $addnewbutton;
	}
	
	if ( array_key_exists('edit_id', $_GET)) {
		$data = data(array('table' => $thetable, 'joins' => $joins), array('ID' => $globalid), 1);
	} else {
		$data = array();
	}
	
		//delete
		if (array_key_exists('delete', $_GET)) {
			mr_deleteentry($thetable, $_GET['delete']);
			//mr_deletetweenentries($thetable, 'antennen_bauformen', $_GET['delete']);
		}

		//edit
		if ( array_key_exists('action', $_GET)) {
			echo mr_startform($data, $thetable);
			editit($data);
			echo mr_endform($data);
		} else {
			//echo "<p>Diese Einträge werden nach <a href='sparten.php' >Sparten</a> geordnet und werden auf der <a href='http://algra.pcardsolution.ch/v3/mitarbeiter.php'>Ansprechspartner</a> Seite angezeigt.</p>";
		}
		
		
}

function mr_startform($data, $table){
	global $globalid;
	return '<form  method="post" class="editarea" action="?action=save&edit_id=' . $globalid .'"><input type="hidden" name="id" value="' . $globalid . '"> ';
	
}

function mr_endform($data, $args = array(
		'aktiontitle' => 'Actions', 
		'submit' => 'Save', 
		'cancel' => 'Cancel', 
		'delete' => 'Delete',
		'publish' => 'Publish'
		)
){
	$return = '<p>';
	$return .= '<span class="button-group">';
		//$return .= mr_tf_published($args['publish']);
		$return .= mr_submitbutton($args['submit']);
		if ($data) {$return .= mr_deletebutton($data['id'], $args['delete']);}	
		$return .= mr_cancelbutton($args['cancel']);
	$return .= '</span>';
	$return .= '</p></form>';
	
	return $return;
}


// ===========
// = Buttons ======================================================================================
// ===========
function mr_submitbutton($value){
	return "<input type='submit' name='submit' value='$value' class='button primary submit icon approve'>";
}

function mr_cancelbutton($value){
	return "<a href='".$_SERVER['SCRIPT_NAME']."' class='button'>$value</a>";
}

function mr_deletebutton($id, $value){
	return "<a href='?delete='.$id.'' class='button icon trash danger'>$value</a>";
}

function mr_tf_published($value, $trueval = "public", $falseval = "hidden"){
	$return = "<label for='on_off'>Published<small>The username must consist of at least 3 characters</small></label>";
	$return = '<input type="checkbox" id="on_off" />';
	return $return;
}


// ==========
// = Delete ======================================================================================
// ==========
function mr_deleteentry($table, $id){
	$table = $GLOBALS['tableprefix']."_".$table;
	mysql_query("DELETE FROM $table WHERE $table.id = $id");
	
	// error_log( "<p class='log log_" . (mysql_affected_rows() != -1 ? 'success' : 'failed') . "'><date>[" . date('d-m-Y  G:i:s') . "]</date> All rows with id:<strong>$id</strong> from table <strong>$table</strong> were deleted.</p>", 3, "infos.log");
	
}

function mr_deletetweenentries($table1, $table2, $id){
	
	$table1 = $GLOBALS['tableprefix']."_".$table1;
	$table2 = $GLOBALS['tableprefix']."_".$table2;
	$tables = array($table1,$table2);
	sort($tables);  //sort alphabeticaly to prevent bla2bla confusions
	$tweentable = $tables[0].'2'.$tables[1];
	
	mysql_query("DELETE FROM $tweentable WHERE $table1.{$table1}_id = $id");
	// error_log( "<p class='log log_" . (mysql_affected_rows() != -1 ? 'success' : 'failed') . "'><date>[" . date('d-m-Y  G:i:s') . "]</date> All rows with id:<strong>$id</strong> from table <strong>$tweentable</strong> were deleted.</p>", 3, "infos.log");

}


// ================================
// = Textfield / Area / Colorfield======================================================================================
// ================================
//textfield (self)
function mr_textfield($data = '', $table, $col, $label, $customattr = '', $type = 'text', $smalltext = ""){
	global $globalid;
	// data has been submited
	if ($_POST && !array_key_exists('uploadsubmit' ,$_POST)) {
		$id = ($_GET['edit_id'] == 0 ? $globalid : $data['id']);
		$postname = ($_GET['edit_id'] == 0 ? "field_{$col}_new" : "field_{$col}_{$id}");
		if (array_key_exists($postname,$_POST)) {
			mr_savetextfielddata($table, $col, $_POST[$postname], $id);
		}
		$postname = "field_{$col}_{$id}";
		$data = data(array('table' => $table), array('ID' => $id), 1);
		$value = $data[$col];
	
	// no data has been submited (just new one opened)
	} elseif ($_GET['action'] == 'new') {
		$id = 'new';
		$postname = "field_{$col}_{$id}";
		$value = '';

	
	// no data has been submited (just edit opened)
	} else {
		$id = $data['id'];
		$postname = "field_{$col}_{$id}";
		$value = $data[$col];
	}
	$return = '';
	if ($type != 'hidden') {
		$return .= "<label for='$postname'>$label<small>$smalltext</small></label>";
	}
	$return .= "<div><input id='$postname' type='$type' name='$postname' value='$value' $customattr></div>";
	
	return $return;
}
function mr_savetextfielddata($table, $col, $value, $id){
	$where = " AND id = $id";
	
	//row exists already? then update values
	$sql ="UPDATE {$GLOBALS['tableprefix']}_{$table}
	SET $col = '$value'
	WHERE 0=0 $where";
	mysql_query($sql);
	
	// error_log( "<p class='log log_" . (mysql_affected_rows() != -1 ? 'success' : 'failed') . "'><date>[" . date('d-m-Y  G:i:s') . "]</date> Row <strong>$id</strong> field <strong>$table.$col</strong> updated to <strong>$value</strong></p>", 3, "infos.log");
}

//colorfield (self)
function mr_colorfield($data = '', $table, $col, $label, $customattr = '', $type = 'text', $smalltext = ""){	
	global $globalid;
	// data has been submited
	if ($_POST) {
		$id = ($_GET['edit_id'] == 0 ? $globalid : $data['id']);
		$postname = ($_GET['edit_id'] == 0 ? "field_{$col}_new" : "field_{$col}_{$id}");
		if (array_key_exists($postname,$_POST)) {
			mr_savetextfielddata($table, $col, $_POST[$postname], $id);
		}
		$postname = "field_{$col}_{$id}";
		$data = data(array('table' => $table), array('ID' => $id), 1);
		$value = $data[$col];
	
	// no data has been submited (just new one opened)
	} elseif ($_GET['action'] == 'new') {
		$id = 'new';
		$postname = "field_{$col}_{$id}";
		$value = '';

	// no data has been submited (just edit opened)
	} else {
		$id = $data['id'];
		$postname = "field_{$col}_{$id}";
		$value = $data[$col];
	}
	
	$return = "<label for='$postname'>$label<small>$smalltext</small></label>";
	$return .= "<div class='colorpickerwrapper'><input id='$postname' type='$type' name='$postname' value='$value' class='colorpickerinput'><div class='colorpickerdisplay'>&nbsp;</div></div>";
	
	return $return;
	
}	

//textarea (self)
function mr_textarea($data = '', $table, $col, $label, $customattr = '', $rows = 5, $cols = 20){
	global $globalid;
	// data has been submited
	if ($_POST) {
		$id = ($_GET['edit_id'] == 0 ? $globalid : $data['id']);
		$postname = ($_GET['edit_id'] == 0 ? "field_{$col}_new" : "field_{$col}_{$id}");
		if (array_key_exists($postname,$_POST)) {
			mr_savetextfielddata($table, $col, $_POST[$postname], $id);
		}
		$postname = "field_{$col}_{$id}";
		$data = data(array('table' => $table), array('ID' => $id), 1);
		$value = $data[$col];
	
	// no data has been submited (just new one opened)
	} elseif ($_GET['action'] == 'new') {
		$id = 'new';
		$postname = "field_{$col}_{$id}";
		$value = '';

	// no data has been submited (just edit opened)
	} else {
		$id = $data['id'];
		$postname = "field_{$col}_{$id}";
		$value = $data[$col];
	}

	$return = "<label for='$postname'>$label</label>";
	$return .= "<div><textarea rows='$rows' cols='$cols' id='$postname' type='text' name='$postname' $customattr>$value </textarea></div>";
	
	return $return;
}
function mr_savetextareadata($table, $name, $newid = ''){
	$value = $name;
	$id = ($newid ? $newid : $_POST['id']);
	$where = " AND id = $id";

	//row exists already? then update values
	$sql ="UPDATE {$GLOBALS['tableprefix']}_{$table}
	SET $name = '$_POST[$name]'
	WHERE 0=0 $where";
	mysql_query($sql);
	
	// error_log( "<p class='log log_" . (mysql_affected_rows() != -1 ? 'success' : 'failed') . "'><date>[" . date('d-m-Y  G:i:s') . "]</date> Row <strong>$id</strong> field <strong>$table.$name</strong> updated to <strong>$_POST[$name]</strong></p>", 3, "infos.log");

}




// ========
// = Bool ======================================================================================
// ========
function mr_bool($data, $table, $col, $value = "Or", $trueval = "True", $falseval = "False"){
	global $globalid;
	// data has been submited
		if ($_POST) {
		$id = ($_GET['edit_id'] == 0 ? $globalid : $data['id']);
		$postname = ($_GET['edit_id'] == 0 ? "field_{$col}_new" : "field_{$col}_{$id}");
		if (array_key_exists($postname,$_POST)) {
			//set it to TRUE
			$sql = "UPDATE {$GLOBALS['tableprefix']}_$table SET $col=$_POST[$postname] WHERE id = $id";
			mysql_query($sql);
			// error_log( "<p class='log log_" . (mysql_affected_rows() != -1 ? 'success' : 'failed') . "'><date>[" . date('d-m-Y  G:i:s') . "]</date> Row <strong>$id</strong> field <strong>$table.$col</strong> updated to <strong>$_POST[$postname]</strong></p>", 3, "infos.log");
			

		}
		$postname = "field_{$col}_{$id}";
		$data = data(array('table' => $table), array('ID' => $id), 1);
		$truechecked = ($data[$col] == TRUE ? 'CHECKED' : '');
		$falsechecked = ($data[$col] == FALSE ? 'CHECKED' : '');
	// no data has been submited (just new one opened)
	} elseif (isset($_GET['action']) && $_GET['action'] == 'new') {
		$id = 'new';
		$postname = "field_{$col}_{$id}";
		$truechecked = '';
		$falsechecked = 'CHECKED';

	// no data has been submited (just edit opened)
	} else {
		$id = $data['id'];
		$postname = "field_{$col}_{$id}";
		$truechecked = ($data[$col] == TRUE ? 'CHECKED' : '');
		$falsechecked = ($data[$col] == FALSE ? 'CHECKED' : '');
	}
		
		
	//return '<label>'.$value.'</label><div><input '.$checked.' name="'.$postname.'" type="checkbox" id="'.$postname.'" /><label for="'.$postname.'">Yes/No</label></div>';
	$return = '<label>'.$value.'<small>Bitte auswälen</small></label><div>';
	$return .= '<div class="column left"><input '.$truechecked.' name="'.$postname.'" type="radio" id="'.$postname.'_t" value="TRUE" /><label for="'.$postname.'_t">'.$trueval.'</label></div>';
	$return .= '<div class="column right"><input '.$falsechecked.' name="'.$postname.'" type="radio" id="'.$postname.'_f" value="FALSE" /><label for="'.$postname.'_f">'.$falseval.'</label></div>';
	$return .= '<div class="clear"></div></div>';
	return $return;
}





// ==============
// = Checkboxes ======================================================================================
// ==============

$args = array(
	"thetable" => "antennen",
	"target_table" => "antennen_materialien",
	"label" => "Materialien", //just for presentation
	"colvalues" => array("materialien_name"), //just for presentation
	"valueseperation" => " ", //just for presentation
	"parent_id" => "" //used by the function
);

//checkboxes (m2m) (possibly s2m)
function mr_checkboxes($args, $data){

	$target_table = $GLOBALS['tableprefix'].'_'.$args["target_table"];	
	
	// data has been submited		
	if ($_POST) {
		$id = $data['id'];
		$postname = $target_table;
		if (array_key_exists($postname,$_POST)) {
			mr_savecheckboxes($args['thetable'], $args['target_table'] , $_POST[$postname], $id);
		}
		$data = data(array('table' => $args["thetable"], 'joins' => array($args['target_table'])), array('ID' => $data['id']), 1);
	
	// no data has been submited (just new one opened)
	} elseif ($_GET['action'] == 'new') {
		$id = 'new';
		$postname = $target_table;
		$value = '';

	// no data has been submited (just edit opened)
	} else {
		$id = $data['id'];
	}
	
	if (! array_key_exists('parent_id', $args)) { $args['parent_id'] = 'root';}
	
	$return = "";
	
	//put all connected ids into an array
	$selected = array();
	if (array_key_exists($target_table,$data)) {
		foreach ($data[$target_table] as $key => $value) {
			$selected[] = $value['id'];
		}
	} else {
		$selected = array();
	}
	
	$connectiondata = data( array("table" => $args["target_table"]),  array("parent_id" => $args["parent_id"]) );

	$isroot = FALSE;
	if ($args['parent_id'] == 'root') {
		$isroot = TRUE;
	}
		if ($isroot) {$return .= "<label>$args[label]</label><div>";}
		//$return .= "<label>$args[label]</label><div>";
		if (!empty($connectiondata)) {$return .= "<ul class='".($isroot ? 'parent' : 'child')."'>";} else {return;}
		foreach ($connectiondata as $key => $value) {
			
			$return .= "<li>";
			$checked = (in_array($value['id'], $selected )?' CHECKED ':'');
			$inputtxt = "";
			foreach ($args["colvalues"] as $txt) {
				$inputtxt .= ($inputtxt != "" ? $args["valueseperation"] : "");
				$inputtxt .= $value[$txt]; 
			}
			
			$return .= '<input id="'.$target_table.'_'.$value['id'].'" '.$checked.' type="checkbox" name="'.$target_table.'[]" value="'.$value['id'].'" />';
			$return .= "<label for='{$target_table}_{$value['id']}' >$inputtxt</label>";
			
			//children
			if (has_children($args['target_table'],$value['id'])) {
				$args['parent_id'] = $value['id'];
				$return .= mr_checkboxes($args, $data );
			}
			
			$return .= "</li>";
		}
		$return .= "</ul>";
		if ($isroot) {$return .= "</div>";}
	return $return;
}

function mr_savecheckboxes($sourcetable, $savetable, $values, $id){
	
	//sourcetable
	$prefix_sourcetable =  $GLOBALS['tableprefix'] .'_'. $sourcetable;
	
	//savetable
	$prefix_savetable =  $GLOBALS['tableprefix'] .'_'. $savetable;
	
	//TWEEN TABLE
	$tables = array($prefix_sourcetable,$prefix_savetable);
	sort($tables);  //sort alphabeticaly to prevent bla2bla confusions
	$tweentable = $tables[0].'2'.$tables[1];

	//delete
	mysql_query("DELETE FROM $tweentable WHERE {$prefix_sourcetable}_id = '$id'");
	// error_log( "<p class='log log_" . (mysql_affected_rows() != -1 ? 'success' : 'failed') . "'><date>[" . date('d-m-Y  G:i:s') . "]</date> All rows with id:<strong>$id</strong> from table <strong>$tweentable</strong> were deleted to make room.</p>", 3, "infos.log");

	//insert new
	foreach ($values as $item) {
		$SQL = "INSERT INTO $tweentable ({$prefix_sourcetable}_id, {$prefix_savetable}_id) VALUES ('$id', '$item')";
		$sq = mysql_query($SQL);
		print mysql_error();
		// error_log( "<p class='log log_" . (mysql_affected_rows() != -1 ? 'success' : 'failed') . "'><date>[" . date('d-m-Y  G:i:s') . "]</date> Row <strong>$id</strong> to table <strong>$tweentable</strong> added </p>", 3, "infos.log");	
	}
};




// ===========
// = Selects ======================================================================================
// ===========
//parentselect (self)
/*
$args = array(
	'thetable' => '',
	'label' => 'Label',
	'colvalues' => array("name"),
	'valueseperation' => " "
)	
*/
function mr_parentselect($args, $data){
	global $globalid;

	$postname = $GLOBALS['tableprefix']."_".$args["thetable"]."_parent_id";
	// data has been submited
	// BUG:  the function should fix all of its children when saved
	
	if ($_POST && !array_key_exists('uploadsubmit' ,$_POST)) {
		$id = ($_GET['edit_id'] == 0 ? $globalid : $data['id']);
		$level = 0;
		$sql = "UPDATE {$GLOBALS['tableprefix']}_{$args['thetable']} SET parent_id = $_POST[parent_id] WHERE id = $id";
		$success = mysql_query($sql);
		$data = data(array('table' => $args["thetable"]), array('ID' => $id), 1);
		
		$level = get_hyr_level($data["id"], $args["thetable"], 0);
		$sql = "UPDATE {$GLOBALS['tableprefix']}_{$args['thetable']} SET deep = $level WHERE id = $id";
		$success = mysql_query($sql);
		
		$lineage = get_hyr_lineage($data["id"], $args["thetable"]);
		$lineage = array_reverse($lineage);
		$lineage = implode ( ", " , $lineage );
		$sql = "UPDATE {$GLOBALS['tableprefix']}_{$args['thetable']} SET lineage = '$lineage' WHERE id = $id";
		$success = mysql_query($sql);
		
		//all other items should update their liniage!!!
		
	// no data has been submited (just new one opened)
	} elseif ($_GET['action'] == 'new') {
		$data['id'] = 0;
		$data['parent_id'] ['id'] = 0;
	}
	
	$return = "";
	$return .= "<label>$args[label]</label><div>";
	$return .= "<select name='parent_id'>";
	$return .= "<option value='0'>None</option>";
	
	$optiondatas = data(array('table' => $args['thetable']));
	$select = "";
	foreach ($args["colvalues"] as $col) {
		$select .= "h.".$col;
	}
	$sqltable = $GLOBALS['tableprefix']."_".$args['thetable'];
	$sql = "SELECT 
				$select, 
				h.id, 
				h.deep, 
				h.lineage, 
				h.parent_id, 
				(
					SELECT COUNT(*) 
					FROM $sqltable 
					where $sqltable.lineage LIKE (CONCAT(h.lineage,'%')) 
					AND $sqltable.lineage != h.lineage
				) as child
			FROM 
				{$GLOBALS['tableprefix']}_{$args['thetable']} as h
			order by h.lineage";
			
	$result = mysql_query($sql) or trigger_error("SQL", E_USER_ERROR);
    while ($item = mysql_fetch_array($result)) {
		$current_children = explode(", ", $item["lineage"]);
		if ($data["id"] == $item['id'] || in_array($data["id"], $current_children)) { $disabled = "disabled";} else {$disabled = "";}
			
			$selected = ($item['id'] == $data['parent_id'] ?' SELECTED ':'');
			$return .= "<option $selected $disabled value='$item[id]'>";
			$txt = "";
			foreach ($args["colvalues"] as $col) {
				$txt .= ($txt != "" ? $args["valueseperation"] : "");
				$txt .= $item[$col]; 
			}
			$return .= str_repeat("- ", $item["deep"]) . $txt . '</option>';
		
		
	}

	$return .= "</select></div>";
	
	return $return;
}
function get_hyr_level($theid, $thetable, $levelcount){
	$sql = "SELECT parent_id, id FROM {$GLOBALS['tableprefix']}_{$thetable} WHERE id = $theid";
	$result = mysql_query($sql);
	$theresult = mysql_fetch_array($result);
	$count = $levelcount;
	if ($theresult["parent_id"] != 0) {
		$count++;
		
		$count = get_hyr_level($theresult["parent_id"], $thetable, $count);
	} elseif($levelcount == 20) { //failsave for infinite loops
		return 20;
	}
	return $count;
}

function get_hyr_lineage($theid, $thetable, $ids = array()){
	array_push($ids, $theid);

	$sql = "SELECT parent_id, id FROM {$GLOBALS['tableprefix']}_{$thetable} WHERE id = $theid";
	$result = mysql_query($sql);
	$theresult = mysql_fetch_array($result);
	if ($theresult["parent_id"] != 0) {
		$ids = get_hyr_lineage($theresult["parent_id"], $thetable, $ids);
	}
	return $ids;
}


//select (m2s)
/*
	A simple singular connection to a table 

	$args = array(
		'thetable' => 'materialien',
		'target_table' => 'farben',
		'label' => 'Farben',
		'target_col' => 'material_name',
		'target_col_label' => 'Material'
		);
*/
function mr_select($args, $data){
	global $globalid;
	$postname = $GLOBALS['tableprefix']."_".$args["target_table"]."_id";
	// data has been submited
	if ($_POST && !array_key_exists('uploadsubmit' ,$_POST)) {
		$id = ($_GET['edit_id'] == 0 ? $globalid : $data['id']);
		$sql = "UPDATE {$GLOBALS['tableprefix']}_{$args['thetable']} SET $postname = $_POST[$postname] WHERE id = $id";
		$success = mysql_query($sql);
		$data = data(array('table' => $args["thetable"]), array('ID' => $id), 1);
	}
	
	//show
	$return = "";
	$return .= "<label for='$postname' >$args[label]</label>";
	$return .= "<div><select name='$postname' id='$postname'>";
	$selected_col = $GLOBALS['tableprefix'].'_'.$args['target_table'].'_id';
	$selected_id = ($data ? $data[$selected_col] : '');
	
	$target_data = data(array('table' => $args['target_table']));
	if (empty($target_data)) {return;}
	foreach ($target_data as $t_d) {
		$colvalue = $args['target_col'];
		$selected = ($t_d['id'] == $selected_id ? ' SELECTED ' : '');
		$return .= "<option $selected value='$t_d[id]'>$t_d[$colvalue]</option>";
	}
	$return .= "</select></div>";
	
	return $return;
}
function save_select($thetable, $col, $updateid){
	global $globalid;
	
	
}



// ==============
// = Multigroup ======================================================================================
// ==============
/*
	this function will grab given coll elements from target table and displays them using mr_textfield, mr_textarea, mr_colorfield functions
	Because this is used on s2m relations, data can be entered mutliple times!
	
	$args = array(
		'thetable' => 'antennen',
		'label_sing' => 'Farbe',
		'label_plur' => 'Farben',
		'target_table' => 'farben',
		'target_cols' => array(
			'farben_name' => 'colorfield',
			'name' => 'textfield'
		),
		'target_cols_labels' => array(
			'farben_name' => 'Farbe (#Hex)',
			'name' => 'Farben-Namen'
		),
	);
*/
function multigroup($args, $data){	
	
	$targettable = $GLOBALS['tableprefix'] . '_' . $args['target_table'];
	$thetable = $GLOBALS['tableprefix'] . '_' . $args['thetable'];
	$return = '';
	
	//when plus or minus button has been pressed add/remove connection
	if (array_key_exists($args['target_table'], $_POST)) {
		switch ($_POST[$args['target_table']]) {
			case '+':
				$into = '';
				foreach ($args['target_cols'] as $key => $value) {
					$into .= $key.',';
				}
				$values = str_repeat(" NULL, ", count($args['target_cols']));

				$sql = "INSERT INTO $targettable ($into {$thetable}_id)
						VALUES ($values $data[id])";
				$result = mysql_query($sql) or trigger_error("SQL", E_USER_ERROR);

				//redoo data
				$data = data(array('table' => $args['thetable'], 'joins' => array($args['target_table'])), array('ID' => $data['id']));
			break;
			
			case '-':
				$sql = "DELETE FROM $targettable WHERE id = $_POST[multigroup_remove] ";
				$result = mysql_query($sql) or trigger_error("SQL", E_USER_ERROR);
				
				//redoo data
				$data = data(array('table' => $args['thetable'], 'joins' => array($args['target_table'])), array('ID' => $data['id']));
			break;
		}
	
	}
	
	//preview existing fields
	if (array_key_exists($targettable, $data)) {
		
		$last_key = end(array_keys($data[$targettable]));
		foreach ($data[$targettable] as $key => $multigroup_array) {
			$return .= '<div class="multigroup_item">';
			foreach ($args['target_cols'] as $colname => $inputtype) {
				switch ($inputtype) {
					case 'colorfield':
						$label = (array_key_exists($colname, $args['target_cols_labels']) ? $args['target_cols_labels'][$colname] : $colname);
						$targetdata = data(array('table'=>$args['target_table']),array('ID'=> $multigroup_array['id']), 1);
						$return .= mr_colorfield($targetdata, $args['target_table'], $colname, $label);
					break;
					
					case 'textfield':
						$label = (array_key_exists($colname, $args['target_cols_labels']) ? $args['target_cols_labels'][$colname] : $colname);
						$targetdata = data(array('table'=>$args['target_table']),array('ID'=> $multigroup_array['id']), 1);
						$return .= mr_textfield($targetdata, $args['target_table'], $colname, $label);
					break;

					default:
						$return .= 'Undefined inputtype: '. $inputtype;
					break;
				}
			}
			$return .= '<input type="hidden" name="multigroup_remove" value="'.$targetdata['id'].'" />';
			if ($key == $last_key) {	
					$return .=  "<label for='".$args['target_table']."_".$key."'> Entfernen <small>Änderungen werden gespeichert!</small></label><div><input id='".$args['target_table']."_".$key."' type='submit' name='".$args['target_table']."' value='-' class='plus'></div>";	
			}
			

			$return .= '</div>';
			
		}
	}
	if ($_GET['action'] == 'new') {
		$return .= "Das Multigroup Module wird nach dem Speichern aktiviert";
	} else {
		$return .=  "<label for='mg_add'> Hinzufügen <small>Änderungen werden gespeichert!</small></label><div><input type='submit' name='".$args['target_table']."' id='mg_add' value='+' class='plus'></div>";	
	}
	return $return;
}




// ============
// = Media DB ======================================================================================
// ============
//image for imagedb (m2m)
/*
	$args = array(
		'thetable' => 'materialien',
		'label' => 'Farben',
		'smalltext' => 'instructional text here',
		);
*/
function mr_image($args, $data){
	global $globalid;
	global $root;
	$return = '';

	
	$colname = "field_".$GLOBALS['tableprefix'] . "_mediadb_id_".$globalid;
	if (array_key_exists($colname,$_POST)) {
		if ($_POST[$colname] == '-') {
			mysql_query("UPDATE $args[thetable] SET {$GLOBALS['tableprefix']}_mediadb_id = 0 WHERE id = $globalid LIMIT 1");			
			$data[$GLOBALS['tableprefix'] . '_mediadb_id'] = '';
			unset($data[$GLOBALS['tableprefix'] . '_mediadb']);

		}
	}
	//remove image
	
	
	
	// A new image was added by the uploader
	if (array_key_exists('uploadsubmit', $_POST)){ 
		$return .= "<label>$args[label]<small>This Image will not be added until the changes have been saved!</small></label><div>";
		
		$count = $_POST['uploader_count'];
		for ($i=0; $i < $count; $i++) { 
			$tmpname = $_POST['uploader_'.$i.'_tmpname'];
			$name = $_POST['uploader_'.$i.'_name'];
			$status = $_POST['uploader_'.$i.'_status'];
			$newid = $_POST['uploader_'.$i.'_id'];
		}
		$return .= "<img src='$root/devpress/uploads/".$tmpname. "' style='max-width:40px;max-height:40px;' />";
		$return .= "<h3>" . $name . "</h3>";
		//add new data to the data array
		$data[$GLOBALS['tableprefix'] . '_mediadb_id'] = $newid;

		
		$return .= mr_textfield($data, $args['thetable'], $GLOBALS['tableprefix'] . '_mediadb_id', '', '', $type = 'hidden', '');
	
	
	} else {
	//all normal
		$return .= "<label>$args[label]<small>$args[smalltext]</small></label><div>";
		
		if (array_key_exists($GLOBALS['tableprefix'] . '_mediadb', $data)) {
			$imagedata = $data[$GLOBALS['tableprefix'] . '_mediadb'];
		} else {
			$imagedata = FALSE;
		}
		// 1. check if image is present and preview them 
		if ($imagedata) {
			$return .= "<img src='$root/devpress/uploads/".$imagedata['tmpname'] . "' style='max-width:40px;max-height:40px;' />";
			$return .= "<h3>" . $imagedata['name'] . "</h3>";
			$return .= mr_textfield($data, $args['thetable'], $GLOBALS['tableprefix'] . '_mediadb_id', '', '', $type = 'hidden', '');
			$return .= "<input type='submit' value='-' name='field_".$GLOBALS['tableprefix'] . "_mediadb_id_".$globalid."'>Remove Image";
		} else {
			$return .= "<a class='fancybox fancybox.iframe' href='uploader.php?parent_uri=".$_SERVER['REQUEST_URI']."'>Add Image</a>";
		}
		$return .= "</div>";
		
	}

		
	return $return;
}




// ===============
// = Archiv List ======================================================================================
// ===============
function mr_BuildListTable($data, $constr, $thetable){
	$order = 'asc';
	$orderby = '';
	
	if ( array_key_exists('order', $_GET)) {
		$order = $_GET['order'];
	}
	if ( array_key_exists('orderby', $_GET)) {
		$orderby = $_GET['orderby'];
	}
	
	$headfoot = '<tr>';
	$headfoot .= '<th>Actions</th>';
	foreach ($constr as $key => $col) {
		$it_orderby = 'asc';
		if ($orderby == $col['name'] && $order == 'asc') {
			$it_orderby = 'desc';
		} 
		$headfoot .= '<th id="' . $col['name'] . '" >' . $col['title'] . '</th>';
	}
	$headfoot .= '</tr>';

	$content = mr_listrow($data, $constr, 0, $thetable);

	echo '<form id="whatever" action method="get">';
	echo '<table class="datatable" cellspacing="0">';
		echo "<thead>";
			echo $headfoot;
		echo "</thead>";
		echo "<tbody>";
			echo $content;
		echo "</tbody>";
		echo "<tfoot>";
			echo $headfoot;
		echo "</tfoot>";
	echo "</table>";
	echo '</div>';
	echo '</form>';
}

//arvhivelist
function mr_listrow($data, $constr, $parent_id = 0, $thetable, $level = 0){
	$return  = '';
	global $root;
	foreach ($data as $key => $dataitem) {
		//loop through all root items

		if (array_key_exists('parent_id', $dataitem)) {
			$current_parentid = $dataitem['parent_id'];
		} else {
			$current_parentid = 0;
		}
		if ($current_parentid == $parent_id) {
			$return .=  '<tr id="post-' . $dataitem['id'] . ' level_'.$level.'" class="author-self status-publish format-default iedit" valign="top">';
			$return .= '<td class="column-edit"><span class="button-group"><a href="?action=edit&edit_id='.$dataitem['id'].'" class="button icon edit">Edit</a><a href="#" class="button icon remove danger">Remove</a></span></td>';	
			foreach ($constr as $col) {
				switch ($col['type']) {
					case 'title':
						$pre = str_repeat("– ", $level);
						$return .= "<td><a href='?action=edit&edit_id=$key'>" . $pre . $dataitem[$col['name']] . "</a></td>";
					break;
					case 'm2m':
					$m2table = $GLOBALS['tableprefix'].'_'.$col['name'];
						if (array_key_exists($m2table, $dataitem)) {
							$implodeme = array();
							foreach ($dataitem[$m2table] as $key => $value) {$implodeme[] = $value[$col['m2mcol']];}
							$m2col = implode(', ', $implodeme);
						} else {
							$m2col = '';
						}
						$return .= "<td>" . $m2col . "</td>";
					break;
					case 'image':
						$return .= "<td>" . ($dataitem['bild'] ? "<img src='" . $dataitem['bild'] . "' alt='image' />" : 'empty')."</td>";
					break;
					case 'filepreview':
						$ext = pathinfo($dataitem[$col['name']], PATHINFO_EXTENSION);
						if ($ext == 'png' || $ext == 'jpg') {
							$return .= "<td><img src='" . $root . '/devpress/uploads/' . $dataitem[$col['name']] . "' alt='image' style='max-height:50px;max-width:50px;' /></td>";
						} else {
							$return .= "<td>No preview possible.</td>";
						}
					break;
					default:
						$return .= "<td>". $dataitem[$col['name']] . "</td>";
					break;
				}
			}		
			$return .= '</tr>';			
			if (has_children($thetable, $dataitem['id'])) {
				$levelnew = $level + 1;
				$return .= mr_listrow($data, $constr, $dataitem['id'], $thetable, $levelnew);
			} else {
				$level = 0;
			}
		}
	}
	return $return;
}



?>