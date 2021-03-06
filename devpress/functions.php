<?php
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




// conditionals

function has_children($table, $id){
	$sql = "SELECT parent_id FROM $GLOBALS[tableprefix]_$table WHERE parent_id = $id";	
	return (mysql_query($sql) ? TRUE : FALSE);
}




?>