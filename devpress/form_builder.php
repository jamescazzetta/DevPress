<?php

function mr_startform($data, $table){
	if ($data) {
		$id = $data['id'];
	} else {
		$id = 0;
	}
	return '<form  method="post" action="?action=save&edit_id=' . $id .'"><input type="hidden" name="id" value="' . $id . '"> ';
}

function mr_endform($data, $args = array(
		'aktiontitle' => 'Actions', 
		'submit' => 'Save', 
		'cancel' => 'Cancel', 
		'delete' => 'Delete',
		'publish' => 'Publish'
		)
){
	$return = '';
	$return .= "<div class='db-edit-col'>";
		$return .= '<h4 class="db-edit-title">'.$args['aktiontitle'].'</h4>';
		$return .= mr_tf_published($args['publish']);
		
		$return .= mr_submitbutton($args['submit']);
		$return .= mr_cancelbutton($args['cancel']);
		if ($data) {$return .= mr_deletebutton($data['id'], $args['delete']);}	
	$return .= "</div>";
	
	$return .= '</form>';
	
	return $return;
}

function mr_submitbutton($value){
	return "<input type='submit' name='submit' value='$value' class='important'>";
}

function mr_cancelbutton($value){
	return "<a href='".$_SERVER['SCRIPT_NAME']."' class='linktobutton'>$value</a>";
}

function mr_deletebutton($id, $value){
	return "<a href='?delete=$id' class='linktobutton'>$value</a>";
}

function mr_tf_published($value, $trueval = "public", $falseval = "hidden"){
	return '
	<script type="text/javascript" charset="utf-8">
		$(window).load(function() {
			$(\'.on_off :checkbox\').iphoneStyle({ checkedLabel: \''.$trueval.'\', uncheckedLabel: \''.$falseval.'\',resizeHandle: true }); 
		});
	</script>
	<table>
		<tr class="on_off">
			<td>
				<input type="checkbox" id="on_off" />
			</td>
		</tr>
		</table>
	';
}
function mr_createentry($table){
		$sql = "INSERT INTO {$GLOBALS['tableprefix']}_{$table}(id)
		VALUES (NULL)";
		mysql_query($sql);
		error_log( "<p class='log log_" . (mysql_affected_rows() != -1 ? 'success' : 'failed') . "'><date>[" . date('d-m-Y  G:i:s') . "]</date> Row <strong>" . mysql_insert_id() ."</strong> for <strong>$table</strong> created</p>", 3, "infos.log");
		return mysql_insert_id();
};

function mr_deleteentry($table, $id){
	$table = $GLOBALS['tableprefix']."_".$table;
	mysql_query("DELETE FROM $table WHERE $table.id = $id");
	
	error_log( "<p class='log log_" . (mysql_affected_rows() != -1 ? 'success' : 'failed') . "'><date>[" . date('d-m-Y  G:i:s') . "]</date> All rows with id:<strong>$id</strong> from table <strong>$table</strong> were deleted.</p>", 3, "infos.log");
	
}

function mr_deletetweenentries($table1, $table2, $id){
	
	$table1 = $GLOBALS['tableprefix']."_".$table1;
	$table2 = $GLOBALS['tableprefix']."_".$table2;
	$tables = array($table1,$table2);
	sort($tables);  //sort alphabeticaly to prevent bla2bla confusions
	$tweentable = $tables[0].'2'.$tables[1];
	
	mysql_query("DELETE FROM $tweentable WHERE $table1.{$table1}_id = $id");
	error_log( "<p class='log log_" . (mysql_affected_rows() != -1 ? 'success' : 'failed') . "'><date>[" . date('d-m-Y  G:i:s') . "]</date> All rows with id:<strong>$id</strong> from table <strong>$tweentable</strong> were deleted.</p>", 3, "infos.log");

}

//textfield (self)
function mr_textfield($data = '', $table, $col, $label, $customattr = ''){
	
	// data has been submited
	if ($_POST) {
		//comming from new
		if ($_GET['edit_id'] == 0) {
			$postname = "field_{$col}_new";
			$id = mr_createentry($table);
			if (array_key_exists($postname,$_POST)) {
				mr_savetextfielddata($table, $col, $_POST[$postname], $id);
			}
			$postname = "field_{$col}_{$id}";
		//comming from existing	
		} else {
			$id = $data['id'];	
			$postname = "field_{$col}_{$id}";
			if (array_key_exists($postname,$_POST)) {
				mr_savetextfielddata($table, $col, $_POST[$postname], $id);
			}			
		}
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
	$return .= "<input id='$postname' type='text' name='$postname' value='$value' $customattr>";
	
	return $return;
}

//textarea (self)
function mr_textarea($data = '', $table, $col, $label, $customattr = '', $rows = 5, $cols = 20){
	// data has been submited
	if ($_POST) {
		//comming from new
		if ($_GET['edit_id'] == 0) {
			$postname = "field_{$col}_new";
			$id = mr_createentry($table);
			if (array_key_exists($postname,$_POST)) {
				mr_savetextfielddata($table, $col, $_POST[$postname], $id);
			}
			$postname = "field_{$col}_{$id}";
		//comming from existing	
		} else {
			$id = $data['id'];	
			$postname = "field_{$col}_{$id}";
			if (array_key_exists($postname,$_POST)) {
				mr_savetextfielddata($table, $col, $_POST[$postname], $id);
			}			
		}
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
	$return .= "<textarea rows='$rows' cols='$cols'  id='$postname' type='text' name='$postname' $customattr>$value</textarea>";
	
	return $return;
	

}

function mr_savetextfielddata($table, $col, $value, $id){
	$where = " AND id = $id";
	
	//row exists already? then update values
	$sql ="UPDATE {$GLOBALS['tableprefix']}_{$table}
	SET $col = '$value'
	WHERE 0=0 $where";
	mysql_query($sql);
	
	error_log( "<p class='log log_" . (mysql_affected_rows() != -1 ? 'success' : 'failed') . "'><date>[" . date('d-m-Y  G:i:s') . "]</date> Row <strong>$id</strong> field <strong>$table.$col</strong> updated to <strong>$value</strong></p>", 3, "infos.log");
}


//colorfield (self)
function mr_colorfield($data = '', $table, $col, $label){	
	return mr_textfield($data, $table, $col, $label, ' class="colorpickerinput" ');
}






$args = array(
	"table" => "antennen_materialien",
	"original_table" => "antennen",
	"label" => "Materialien", //just for presentation
	"colvalues" => array("materialien_name"), //just for presentation
	"valueseperation" => " ", //just for presentation
	"parent_id" => "" //used by the function
);
//checkboxes (m2m) (possibly s2m)
function mr_checkboxes($args, $data){
	$col = "";
	$target_table = $GLOBALS['tableprefix'].'_'.$args["table"];	
	foreach($args['colvalues'] AS $colitem) {
		$col .= $colitem;
	}
	
	// data has been submited		
	if ($_POST) {
			$id = ($_GET['edit_id'] == 0 ? 0 : $data['id']);
			$postname = $target_table;
			//if its a new item being submited than dont save
			if (array_key_exists($postname,$_POST) && $_GET['edit_id'] != 0) {
				mr_savecheckboxes($args['original_table'], $args['table'] , $_POST[$postname], $id);
			}
			$data = data(array('table' => $args["original_table"], 'joins' => array($args['table'])), array('ID' => $id), 1);
	// no data has been submited (just new one opened) (we will ignore this function then because it has a foreign requirenment)
	} elseif ($_GET['action'] == 'new') {
		return "you must complete the creation stage before you can asign it to $args[label].";
		
	// no data has been submited (just edit opened)
	} else {
		$id = $data['id'];
	}
	
	if (! array_key_exists('parent_id', $args)) { $args['parent_id'] = 'root';}
	
	$return = "";
	
	//put all connected ids into an array (if the item is new ignore it)
	$selected = array();
	if ($_GET['edit_id'] != 0) {	
		if (array_key_exists($target_table,$data)) {
			foreach ($data[$target_table] as $key => $value) {
				$selected[] = $value['id'];
			}
		}
	}
	$connectiondata = data( array("table" => $args["table"]),  array("parent_id" => $args["parent_id"]) );
	$isroot = FALSE;
	if ($args['parent_id'] == 'root') {
		$isroot = TRUE;
	}
	
		//if ($isroot) {$return .= "<label>$args[label]</label>";}
		if ($connectiondata > 0) {$return .= "<ul class='".($isroot ? 'parent' : 'child')."'>";} else {return;}
		foreach ($connectiondata as $key => $value) {
			
			$return .= "<li>";
			$checked = (in_array($value['id'], $selected )?' CHECKED ':'');
			$inputtxt = "";
			foreach ($args["colvalues"] as $txt) {
				$inputtxt .= ($inputtxt != "" ? $args["valueseperation"] : "");
				$inputtxt .= $value[$txt]; 
			}
			
			$return .= '<input '.$checked.' type="checkbox" name="'.$target_table.'[]" value="'.$value['id'].'" />'. $inputtxt;
			
			//children
			if (has_children($args['table'],$value['id'])) {
				$args['parent_id'] = $value['id'];
				$return .= mr_checkboxes($args, $data );
			}
			
			$return .= "</li>";
		}
		$return .= "</ul>";
	
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
	error_log( "<p class='log log_" . (mysql_affected_rows() != -1 ? 'success' : 'failed') . "'><date>[" . date('d-m-Y  G:i:s') . "]</date> All rows with id:<strong>$id</strong> from table <strong>$tweentable</strong> were deleted to make room.</p>", 3, "infos.log");

	//insert new
	foreach ($values as $item) {
		$SQL = "INSERT INTO $tweentable ({$prefix_sourcetable}_id, {$prefix_savetable}_id) VALUES ('$id', '$item')";
		$sq = mysql_query($SQL);
		print mysql_error();
		error_log( "<p class='log log_" . (mysql_affected_rows() != -1 ? 'success' : 'failed') . "'><date>[" . date('d-m-Y  G:i:s') . "]</date> Row <strong>$id</strong> to table <strong>$tweentable</strong> added </p>", 3, "infos.log");	
	}
};


//parentselect (self)
function mr_parentselect($args, $data){
	
	// data has been submited
	if ($_POST) {
		$id = ($_GET['edit_id'] == 0 ? mr_createentry($args['table']) : $data['id']);
		if (array_key_exists('parent_id',$_POST)) {
			mr_saveparentselect($args['table'], $id);
			$data = data(array('table' => $args['table']), array('ID' => $id), 1);
		}
		
	
	// no data has been submited (just new one opened)
	} elseif ($_GET['action'] == 'new') {
		$id = 'new';
		$data['parent_id'] = 'none';

	// no data has been submited (just edit opened)
	} else {
		$id = $data['id'];
	}
	
	$return = "<label>$args[label]</label>";
	$return .= "<select name='parent_id'>";
	$return .= "<option value='0'>None</option>";
	
	$optiondatas = data(array('table' => $args['table']));
	
	//echo $id;
	//echo $data['parent_id'];
	
	foreach ($optiondatas as $optiondata) {
		if ($id != $optiondata['id']) {		
			$selected = ($data['parent_id'] == $optiondata['id'] ?' SELECTED ':'');
				
			$return .= "<option $selected value='$optiondata[id]'>";
			$txt = "";
			foreach ($args["colvalues"] as $col) {
				$txt .= ($txt != "" ? $args["valueseperation"] : "");
				$txt .= $optiondata[$col]; 
			}
			$return .= $txt . '</option>';
		}
	}
	$return .= "</select>";
	
	return $return;
}

function mr_saveparentselect($table, $id){
	
	$sql ="UPDATE {$GLOBALS['tableprefix']}_{$table}
	SET parent_id = '$_POST[parent_id]'
	WHERE id = $id";
	mysql_query($sql);
	
	error_log( "<p class='log log_" . (mysql_affected_rows() != -1 ? 'success' : 'failed') . "'><date>[" . date('d-m-Y  G:i:s') . "]</date> {$GLOBALS['tableprefix']}_{$table} Parent_id with id $id changed to $_POST[parent_id]</p>", 3, "infos.log");
}

//images
function mr_self_image($data = '', $table = '', $col = '', $name = '', $beforecol = '', $aftercol = '') {
		
	if ($data) {
		if ($data[$col]) {
			$value = ($data[$col] ? $data[$col] : '');
			$return = "<img src='" . $data[$col] . "' alt='image' />";
			$return .= "<br /><a href='?action=uploadimage&edit_id=".$data['id']."'>Neues Bild hochladen</a>";
		} else {
			$value = ($data[$col] ? $data[$col] : '');
			$return = "<a href='?action=uploadimage&edit_id=".$data['id']."'>Bild hochladen</a>";
		}
	} else {
		$return = "Sie können ein Bild hochladen sobale Sie die anderen Daten eingetragen haben.";
	}
	
	return $return;
}


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
	$headfoot .= '<th id="cb" class="manage-column column-cb check-column"><!--<input type="checkbox">--></th>';
	foreach ($constr as $key => $col) {
		$it_orderby = 'asc';
		if ($orderby == $col['name'] && $order == 'asc') {
			$it_orderby = 'desc';
		} 
		$headfoot .= '<th scope="col" id="' . $col['name'] . '" class="manage-column column-'.$col['name'].' sortable '.$it_orderby.'" style=""><a href="?orderby=' . $col['name'] . '&amp;order='.$it_orderby.'" ><span>' . $col['title'] . '</span><span class="sorting-indicator"></span></a></th>';
	}
	$headfoot .= '</tr>';

	$content = mr_listrow($data, $constr, 0, $thetable);

	echo '<form id="whatever" action method="get">';
	
	echo '<table class="dp-list-table" cellspacing="0">';
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
	/*
		echo '<div class="tablenav bottom">';
			echo '<div class="alignleft actions">';
				echo '<select name="action2">';
					echo '<option value="-1" selected="selected">Bulk Actions</option>';
					echo '<option value="edit" class="hide-if-no-js">Edit</option>';
					echo '<option value="trash">Delete</option>';
				echo '</select>';
			echo '<input type="submit" name="" id="doaction2" class="button-secondary action" value="Apply">';
		echo '</div>';
	*/
	echo '</div>';
	echo '</form>';
}


//multigroup (s2m)
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
		foreach ($data[$targettable] as $multigroup_array) {
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
			$return .=  "<input type='submit' name='".$args['target_table']."' value='-' class='plus'> Entfernen";	

			$return .= '</div>';
			
		}
	}
	if ($_GET['action'] == 'new') {
		$return .= "Wird nach dem Speichern aktiviert";
	} else {
		$return .=  "<input type='submit' name='".$args['target_table']."' value='+' class='plus'> Hinzufügen";	
	}
	return $return;
}

//select (m2s)
/*
	A simple singular connection to a table 

	$args = array(
		'thetable' => 'materialien',
		'target_table' => 'farben',
		'target_col' => 'material_name',
		'target_col_label' => 'Material'
		);
*/
function mr_select($args, $data){

	//save

	//show
	$return = "<select name='$args[target_table]'><option value=''>none</option>";
	$selected_col = $GLOBALS['tableprefix'].'_'.$args['target_table'].'_id';
	$selected_id = ($data ? $data[$selected_col] : '');
	
	$target_data = data(array('table' => $args['target_table']));
	foreach ($target_data as $t_d) {
		$colvalue = $args['target_col'];
		$selected = ($t_d['id'] == $selected_id ? ' SELECTED ' : '');
		$return .= "<option $selected value='$t_d[id]'>$t_d[$colvalue]</option>";
	}
	$return .= "</select>";
	
	return $return;
}


//formlogic
function form_logic($thetable, $joins){
	if ( array_key_exists('edit_id', $_GET)) {
			$data = data(array('table' => $thetable, 'joins' => $joins), array('ID' => $_GET['edit_id']), 1);
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
		editit($data, $thetable);
	} else {
		//echo "<p>Diese Einträge werden nach <a href='sparten.php' >Sparten</a> geordnet und werden auf der <a href='http://algra.pcardsolution.ch/v3/mitarbeiter.php'>Ansprechspartner</a> Seite angezeigt.</p>";
	}
}


//arvhivelist
function mr_listrow($data, $constr, $parent_id = 0, $thetable, $level = 0){
	$return  = '';
	foreach ($data as $key => $dataitem) {
		//loop through all root items

		if (array_key_exists('parent_id', $dataitem)) {
			$current_parentid = $dataitem['parent_id'];
		} else {
			$current_parentid = 0;
		}
		if ($current_parentid == $parent_id) {
			//if ($dataitem['parent_id'] == $parent_id) {$return .= '–';}
				$options = '<div class="row-actions">
				<span class="edit"><a href="?action=edit&edit_id='.$dataitem['id'].'" title="Edit this item">Edit</a> | </span>
				<!--<span class="inline hide-if-no-js"><a href="#" class="editinline" title="Edit this item inline">Quick&nbsp;Edit</a> | </span>-->
				<!--<span class="trash"><a class="submitdelete" title="Move this item to the Trash" href="?delete='.$dataitem['id'].'">Delete</a></span>-->
				</div>';
			$return .=  '<tr id="post-' . $dataitem['id'] . ' level_'.$level.'" class="author-self status-publish format-default iedit" valign="top">';
			$return .= '<td class="column-cb"><!--<input type="checkbox" name="post[]" value="'.$dataitem['id'].'" />--></td>';
			foreach ($constr as $col) {
				switch ($col['type']) {
					case 'title':
						$pre = str_repeat("– ", $level);
						$return .= "<td><a href='?action=edit&edit_id=$key'>" . $pre . $dataitem[$col['name']] . "</a>$options</td>";
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
					default:
						$return .= "<td>" . $dataitem[$col['name']] . "</td>";
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