<?php




function mr_startform($data, $table){
	
	$action = $_GET['action'];
	
	if ($data) {
		$id = $data['id'];
	} else {
		$id = 0;
	}

	if (startsWith('save', $action)) {
		$action = str_replace("save", "", $action);
	}
	
	return '<form  method="post" action="?action=save' . $action . '&edit_id=' . $id .'"><input type="hidden" name="id" value="' . $id . '"> ';
}


function mr_endform(){
	return '</form>';
}


function mr_submitbutton($value){
	return "<input type='submit' name='submit' value='$value' class='important'>";
}

function mr_cancelbutton($value){
	return "<a href='".$_SERVER['SCRIPT_NAME']."' class='linktobutton'>$value</a>";

}


function mr_createentry($table){
		$sql = "INSERT INTO {$GLOBALS['tableprefix']}_{$table}(id)
		VALUES (NULL)";
		mysql_query($sql);
		error_log( "<p class='log log_" . (mysql_affected_rows() != -1 ? 'success' : 'failed') . "'><date>[" . date('d-m-Y  G:i:s') . "]</date> Row <strong>" . mysql_insert_id() ."</strong> for <strong>$table</strong> created</p>", 3, "devpress/infos.log");
		return mysql_insert_id();
};

function mr_deleteentry($table, $id){
	$table = $GLOBALS['tableprefix']."_".$table;
	mysql_query("DELETE FROM $table WHERE $table.id = $id");
	
	error_log( "<p class='log log_" . (mysql_affected_rows() != -1 ? 'success' : 'failed') . "'><date>[" . date('d-m-Y  G:i:s') . "]</date> All rows with id:<strong>$id</strong> from table <strong>$table</strong> were deleted.</p>", 3, "devpress/infos.log");
	
}

function mr_deletetweenentries($table1, $table2, $id){
	
	$table1 = $GLOBALS['tableprefix']."_".$table1;
	$table2 = $GLOBALS['tableprefix']."_".$table2;
	$tables = array($table1,$table2);
	sort($tables);  //sort alphabeticaly to prevent bla2bla confusions
	$tweentable = $tables[0].'2'.$tables[1];
	
	mysql_query("DELETE FROM $tweentable WHERE $table1.{$table1}_id = $id");
	
	error_log( "<p class='log log_" . (mysql_affected_rows() != -1 ? 'success' : 'failed') . "'><date>[" . date('d-m-Y  G:i:s') . "]</date> All rows with id:<strong>$id</strong> from table <strong>$tweentable</strong> were deleted.</p>", 3, "devpress/infos.log");
	
}


//field
function mr_textfield($data = '', $table, $field, $label, $customattr = ''){
	
	$name = $field;
	if ($data) {
		$value = ($data[$field] ? $data[$field] : '');
		$id = $data['id'];
	} else {
		$value = '';
		$id = 'new';
	}
	
	
	$return = "<label for='field_{$name}_{$id}'>$label</label>";
	$return .= "<input id='field_{$name}_{$id}' type='text' name='$name' value='$value' $customattr>";
	
	return $return;
}
function mr_savetextfielddata($table, $name, $newid = ''){
	$value = $name;
	$id = ($newid ? $newid : $_POST['id']);
	$where = " AND id = $id";
		
		//row exists already? then update values
		$sql ="UPDATE {$GLOBALS['tableprefix']}_{$table}
		SET $name = '$_POST[$name]'
		WHERE 0=0 $where";
		mysql_query($sql);
		
		error_log( "<p class='log log_" . (mysql_affected_rows() != -1 ? 'success' : 'failed') . "'><date>[" . date('d-m-Y  G:i:s') . "]</date> Row <strong>$id</strong> field <strong>$table.$name</strong> updated to <strong>$_POST[$name]</strong></p>", 3, "devpress/infos.log");
		
}



//textarea
function mr_textarea($data = '', $table, $field, $label, $customattr = '', $rows = 5, $cols = 20){
	
	$name = $field;
	if ($data) {
		$value = ($data[$field] ? $data[$field] : '');
		$id = $data['id'];
	} else {
		$value = '';
		$id = 'new';
	}
	
	
	$return = "<label for='field_{$name}_{$id}'>$label</label>";
	$return .= "<textarea rows='$rows' cols='$cols' id='field_{$name}_{$id}' type='text' name='$name' $customattr>$value </textarea>";
	
	return $return;
}
function mr_savetextareadata($table, $name){
	$value = $name;
	$id = ($newid ? $newid : $_POST['id']);
	$where = " AND id = $id";
	
	
		//row exists already? then update values
		
		$sql ="UPDATE {$GLOBALS['tableprefix']}_{$table}
		SET $name = '$_POST[$name]'
		WHERE 0=0 $where";
		mysql_query($sql);
		
		error_log( "<p class='log log_" . (mysql_affected_rows() != -1 ? 'success' : 'failed') . "'><date>[" . date('d-m-Y  G:i:s') . "]</date> Row <strong>$id</strong> field <strong>$table.$name</strong> updated to <strong>$_POST[$name]</strong></p>", 3, "devpress/infos.log");
		
}


//checkboxes
function mr_checkboxes($data = array(), $table = '', $col = '', $name = '', $beforecol = '', $aftercol = ''){
	$return = '';
	$selected = '';
	$thetable = $GLOBALS['tableprefix'].'_'.$table;
		if (array_key_exists($thetable, $data)) {
			foreach ($data[$thetable] as $key => $value) {
				$selected[] = $value['id'];
			}
		}
	
	

	$return .= "<label>$name</label>";
	$tabledata = data(array('table' => $table));
		
		if (array_key_exists($thetable, $data)) {	
			
			//if there are more then 10 do a multiselect instead
			if (count($tabledata) > 10) {
				$return .= '<select name="'.$table.'[]" class="multipleselect" multiple="multiple">';
				foreach ($tabledata as $key => $value) {
					$beforecol2 = $value[$beforecol] . ' ';
					$aftercol2 =  (array_key_exists($aftercol, $value) ? ' ' . $value[$aftercol] : "");
					$isselected = (in_array($value['id'], $selected )?' SELECTED ':'');
					
					$return .= '<option '.$isselected.' value="'.$value['id'].'" />' . $beforecol2 . $value[$col] . $aftercol2 . '<br />';
				}
				$return .= '</select>';
			} else {
				foreach ($tabledata as $key => $value) {
					$beforecol2 =  (array_key_exists($beforecol, $value) ? ' ' . $value[$beforecol] : "");
					$aftercol2 =  (array_key_exists($aftercol, $value) ? ' ' . $value[$aftercol] : "");
					$checked = (in_array($value['id'], $selected )?' CHECKED ':'');
					
					$return .= '<input '.$checked.' type="checkbox" name="'.$table.'[]" value="'.$value['id'].'" />'. $beforecol2 . $value[$col] . $aftercol2 . '<br />';
				}			
			}

		
		} else {
			foreach ($tabledata as $key => $value) {
				$beforecol2 =  (array_key_exists($beforecol, $value) ? ' ' . $value[$beforecol] : "");
				$aftercol2 =  (array_key_exists($aftercol, $value) ? ' ' . $value[$aftercol] : "");
				$return .= '<input type="checkbox" name="'.$table.'[]" value="'.$value['id'].'" />'. $beforecol2 . $value[$col] . $aftercol2 .'<br />';
			}
		
		}

	
	return $return;
}

function mr_savecheckboxes($sourcetable, $savetable, $newid){
	
	//sourcetable
	$prefix_sourcetable =  $GLOBALS['tableprefix'] .'_'. $sourcetable;
	
	//savetable
	$prefix_savetable =  $GLOBALS['tableprefix'] .'_'. $savetable;
	
	//TWEEN TABLE
	$tables = array($prefix_sourcetable,$prefix_savetable);
	sort($tables);  //sort alphabeticaly to prevent bla2bla confusions
	$tweentable = $tables[0].'2'.$tables[1];
	
	//id
	$id = ($newid ? $newid : $_POST['id']);


		
		//delete
		mysql_query("DELETE FROM $tweentable WHERE {$prefix_sourcetable}_id = '$id'");
		error_log( "<p class='log log_" . (mysql_affected_rows() != -1 ? 'success' : 'failed') . "'><date>[" . date('d-m-Y  G:i:s') . "]</date> All rows with id:<strong>$id</strong> from table <strong>$tweentable</strong> were deleted to make room.</p>", 3, "devpress/infos.log");
	
		//insert new
		if (array_key_exists($savetable, $_POST)) {
			foreach ($_POST[$savetable] as $item) {
				$SQL = "INSERT INTO $tweentable ({$prefix_sourcetable}_id, {$prefix_savetable}_id) VALUES ('$id', '$item')";
				$sq = mysql_query($SQL);
				print mysql_error();
				error_log( "<p class='log log_" . (mysql_affected_rows() != -1 ? 'success' : 'failed') . "'><date>[" . date('d-m-Y  G:i:s') . "]</date> Row <strong>$id</strong> to table <strong>$tweentable</strong> added </p>", 3, "devpress/infos.log");
			
			}
		}
	
	
	
	
};

//hyrachie
function mr_hyr_select(
		$data,
		$args = array(
			"table" => "", 
			"label" => "Parent",
			"colvalues" => array(),
			"valueseperation" => " ",
			"parent_id" => 0
		)
	){
	
	$target_table = $GLOBALS['tableprefix'].'_'.$args["table"];
	$target_data = $data[$target_table];
	
	$return = "";
	
	//put all connected ids into an array
	$selected = array();
		foreach ($target_data as $key => $value) {
			$selected[] = $value['id'];
		}
	

	
	$args2 = array("table" => $args["table"]);
	$filter2 =  array(	"parent_id" => $args["parent_id"]);
	$connectiondata = data($args2, $filter2);
	

	
		if ($args["parent_id"] == 0) {$return .= "<label>$args[label]</label>";}
		$return .= "<ul>";
		foreach ($connectiondata as $key => $value) {
			$return .= "<li>";
			$checked = (in_array($value['id'], $selected )?' CHECKED ':'');
			$inputtxt = "";
			foreach ($args["colvalues"] as $txt) {
				$inputtxt .= ($inputtxt != "" ? $args["valueseperation"] : "");
				$inputtxt .= $target_data[$value['id']][$txt]; 
			}
						

			
			$return .= '<input '.$checked.' type="checkbox" name="'.$args["table"].'[]" value="'.$value['id'].'" />'. $inputtxt;
			mr_hyr_select($data, array ("table" => $args["table"], "colvalues" => $args["colvalues"], "valueseperation" => $args["valueseperation"], "parent_id" => $data["id"]));
			$return .= "</li>";
		}
		$return .= "</ul>";
	
	return $return;
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


function mr_BuildListTable($data, $constr){
	$order = 'asc';
	$orderby = '';
	
	if ( array_key_exists('order', $_GET)) {
		$order = $_GET['order'];
	}
	if ( array_key_exists('orderby', $_GET)) {
		$orderby = $_GET['orderby'];
	}
	
	$headfoot = '<tr><th id="cb" class="manage-column column-cb check-column"><input type="checkbox"></th>';
	foreach ($constr as $key => $col) {
		$it_orderby = 'asc';
		if ($orderby == $col['name'] && $order == 'asc') {
			$it_orderby = 'desc';
		} 
		$headfoot .= '<th scope="col" id="' . $col['name'] . '" class="manage-column column-'.$col['name'].' sortable '.$it_orderby.'" style=""><a href="?orderby=' . $col['name'] . '&amp;order='.$it_orderby.'" ><span>' . $col['title'] . '</span><span class="sorting-indicator"></span></a></th>';
	}
	$headfoot .= '</tr>';

	
	$content = '';
	foreach ($data as $key => $dataitem) {
		$options = '<div class="row-actions">
			<span class="edit"><a href="?action=edit&edit_id='.$dataitem['id'].'" title="Edit this item">Edit</a> | </span>
			<!--<span class="inline hide-if-no-js"><a href="#" class="editinline" title="Edit this item inline">Quick&nbsp;Edit</a> | </span>-->
			<span class="trash"><a class="submitdelete" title="Move this item to the Trash" href="?delete='.$dataitem['id'].'">Delete</a></span>
			</div>';
		$content .=  '<tr id="post-' . $dataitem['id'] . '" class="author-self status-publish format-default iedit" valign="top">';
		$content .= '<td class="column-cb"><input type="checkbox" name="post[]" value="'.$dataitem['id'].'" /></td>';
		foreach ($constr as $col) {
			switch ($col['type']) {
				case 'title':
					$content .= "<td><a href='?edit_id=$key'>" . $dataitem[$col['name']] . "</a>$options</td>";
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

					$content .= "<td>" . $m2col . "</td>";
					break;
				case 'image':
					$content .= "<td>" . ($dataitem['bild'] ? "<img src='" . $dataitem['bild'] . "' alt='image' />" : 'empty')."</td>";
					break;
				default:
					$content .= "<td>" . $dataitem[$col['name']] . "</td>";
					break;
			}
		}
		$content .= '</tr>';
	}
	

	echo '<form id="whatever" action method="get">';
		

	echo '<table class="dp-list-table" cellspacing="0">';
		echo "<thead>";
			echo $headfoot;
		echo "</thead>";
		echo "<thbody";
			echo $content;
		echo "</thbody>";
		echo "<tfoot>";
			echo $headfoot;
		echo "</tfoot>";
	echo "</table>";
	
	
	
		echo '<div class="tablenav bottom">';
			echo '<div class="alignleft actions">';
				echo '<select name="action2">';
					echo '<option value="-1" selected="selected">Bulk Actions</option>';
					echo '<option value="edit" class="hide-if-no-js">Edit</option>';
					echo '<option value="trash">Delete</option>';
				echo '</select>';
			echo '<input type="submit" name="" id="doaction2" class="button-secondary action" value="Apply">';
		echo '</div>';
	echo '</div>';
	
	echo '</form>';
}




?>