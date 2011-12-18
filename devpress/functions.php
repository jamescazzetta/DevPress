<?php
// ==============
// = globals =
// ==============


function mr_createentry($table){
		$sql = "INSERT INTO {$GLOBALS['tableprefix']}_{$table}(id)
		VALUES (NULL)";
		mysql_query($sql);
		error_log( "<p class='log log_" . (mysql_affected_rows() != -1 ? 'success' : 'failed') . "'><date>[" . date('d-m-Y  G:i:s') . "]</date> Row <strong>" . mysql_insert_id() ."</strong> for <strong>$table</strong> created</p>", 3, "infos.log");
		return mysql_insert_id();
};

function alert($message, $type){
	return '<script type="text/javascript" charset="utf-8">new Notification(\''.$message.'\', \''.$type.'\');</script>';
}
// ===========
// = GLOBALS =
// ===========
// existing data has been submited
if ($_POST && array_key_exists('edit_id', $_GET) && $_GET['edit_id'] != 0) {
	$globalid = $_GET['edit_id'];
// new data has been submited
} elseif ($_POST && array_key_exists('edit_id', $_GET) && $_GET['edit_id'] == 0) {
	$globalid = mr_createentry($thetable);
// no data has been submited (just new one opened)
} elseif (isset($_GET['action']) && $_GET['action'] == 'new') {
	$globalid = 0;
// no data has been submited (just edit opened)
} elseif (isset($_GET['action']) && $_GET['action'] == 'edit') {
	$globalid = $_GET['edit_id'];
} else {
	$globalid = 0;
}
$ALERTS = '';

// ==============
// = Essentials =
// ==============


function mysql_fetch_fields($table) {	
		// LIMIT 1 means to only read rows before row 1 (0-indexed)
		$result = mysql_query("SELECT * FROM $table LIMIT 1");
		$describe = mysql_query("SHOW COLUMNS FROM $table");
		$num = mysql_num_fields($result);
		$output = array();
		for ($i = 0; $i < $num; ++$i) {
				$field = mysql_fetch_field($result, $i);
				// Analyze 'extra' field
				$field->auto_increment = (strpos(mysql_result($describe, $i, 'Extra'), 'auto_increment') === FALSE ? 0 : 1);
				// Create the column_definition
				$field->definition = mysql_result($describe, $i, 'Type');
				if ($field->not_null && !$field->primary_key) $field->definition .= ' NOT NULL';
				if ($field->def) $field->definition .= " DEFAULT '" . mysql_real_escape_string($field->def) . "'";
				if ($field->auto_increment) $field->definition .= ' AUTO_INCREMENT';
				if ($key = mysql_result($describe, $i, 'Key')) {
						if ($field->primary_key) $field->definition .= ' PRIMARY KEY';
						else $field->definition .= ' UNIQUE KEY';
				}
				// Create the field length
				$field->len = mysql_field_len($result, $i);
				// Store the field into the output
				$output[$field->name] = $field;
		}
		return $output;
}


function startsWith($needle, $haystack)
{
    $length = strlen($needle);
    return (substr($haystack, 0, $length) === $needle);
}

function endsWith($needle, $haystack)
{
    $length = strlen($needle);
    $start  = $length * -1; //negative
    return (substr($haystack, $start) === $needle);
}


function mr_image_preview($data){
	global $root;
	$return = "";
	$ext = pathinfo($data["tmpname"], PATHINFO_EXTENSION);
	if ($ext == 'png' || $ext == 'jpg') {
		$return .= "<div class='image_preview'>";
		$return .= "<a class='fancybox' href='" . $root . '/devpress/uploads/' . $data["tmpname"] . "' target='blank' title='$data[name]'>";
		$return .= "<img src='" . $root . '/devpress/uploads/' . $data["tmpname"] . "' alt='image' style='max-height:100px;max-width:100px;' />";
		$return .= "</a>";
		$return .= "</div>";
	} else {
		$return .= "<div class='image_preview'>No preview possible.</div>";
	}	
	return $return;
}


// conditionals

function has_children($table, $id){
	$sql = "SELECT parent_id FROM $GLOBALS[tableprefix]_$table WHERE parent_id = $id";	
	return (mysql_query($sql) ? TRUE : FALSE);
}


function count_table_rows($thetable){
	$result = mysql_query("SELECT * FROM {$GLOBALS["tableprefix"]}_{$thetable}");
	return mysql_num_rows($result);
}

?>