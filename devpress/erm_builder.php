<?php
// ===============
// = CRM Builder =
// ===============


function set_table($args){
	//DEFAULTS
	if (! array_key_exists('table_data'		, $args)) { $args['table_data'] = array();}
	if (! array_key_exists('name'			, $args)) { return 'No name given'; exit;}
	if (! array_key_exists('hyrarchical'	, $args)) { $args['hyrarchical'] = FALSE;}
	
	//VARIABLES
	$tablename = $GLOBALS['tableprefix'] . '_' . $args['name'];
	$create_parent_id = ($args['hyrarchical'] == TRUE ? 'parent_id INT Default \'0\',' : '');
	$create_children_ids = ($args['hyrarchical'] == TRUE ? 'children_ids INT,' : '');
	
	//Does table already exist?
	$sql = "SELECT * FROM $tablename ";
	$exists = mysql_query($sql);
	
	if (! $exists ){
		//Create the table and its initial AI id / timestamp 
		$sql = "CREATE TABLE $tablename (
					id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
					creation_date TIMESTAMP(8),
					publish_date TIMESTAMP(8),
					roworder INT
				)";
		mysql_query($sql);
		error_log( "<p class='log log_" . (mysql_affected_rows() != -1 ? 'success' : 'failed') . "'><date>[" . date('d-m-Y G:i:s') . "]</date>Table <strong>$tablename</strong> created.</p>", 3, "infos.log");
	}
	
	//Hyrarchy change
	$sql = "SELECT parent_id FROM $tablename";
	$hyr = (mysql_query($sql) ? TRUE : FALSE);
	if ($hyr != $args['hyrarchical']){
		if ($args['hyrarchical']) {
			$sql = "ALTER TABLE $args[name] ADD parent_id INT Default '0'";
			mysql_query($sql);
			error_log( " <p class='log log_" . (mysql_affected_rows() != -1 ? 'success' : 'failed') . "'><date>[" . date('d-m-Y  G:i:s') . "]</date>Table <strong>$tablename</strong> has changed its hyrarchical state to <strong>TRUE</strong>.</p>", 3, "infos.log");
		} else {
			$sql = "ALTER TABLE $tablename DROP COLUMN parent_id";
			mysql_query($sql);
			error_log( "<p class='log log_" . (mysql_affected_rows() != -1 ? 'success' : 'failed') . "'><date>[" . date('d-m-Y G:i:s') . "]</date> Table <strong>$tablename</strong> has changed its hyrarchical state to <strong>FALSE</strong>.</p>", 3, "infos.log");
		}
	}
	
	
//DEPRICATED/////////////////////////////////////////////////////////////
	//Do the columns
	if ($args['table_data']) {
		foreach ($args['table_data'] as $table_data) {
			switch ($table_data['relation']) {
				case 'self':
					$args2 = array(
						'table' => $args['name'],
						'relation' => $table_data['relation'],
						'self_name' => $table_data['self_name'],
						'self_definition' => $table_data['self_definition']
					);
					add_table_data($args2);
					break;
				case 'm2m' || 's2m':
					if (! array_key_exists('hyrarchical', $table_data)) { $table_data['hyrarchical'] = FALSE;}
					if (! array_key_exists('table_data', $table_data)) { $table_data['table_data'] = array();}
					
					
					$args2 = array(
						'table' => $args['name'],
						'relation' => $table_data['relation'],
						'target' => $table_data['target'],
						'hyrarchical' => $table_data['hyrarchical'],
						'table_data' => $table_data['table_data']
					);
					add_table_data($args2);
					break;
					
			}
	
		}
	}
//END DEPRICATED/////////////////////////////////////////////////////////////
	
	
}


function add_table_data($args){
	
	
	//DEFAULTS
	if (! array_key_exists('table'			, $args)) { return 'No Table name given'; exit;}
	if (! array_key_exists('hyrarchical'	, $args)) { $args['hyrarchical'] = FALSE;}
	if (! array_key_exists('table_data'		, $args)) { $args['table_data'] = array();}
	if (! array_key_exists('target'		, $args)) { $args['target'] = '';}
	
	
	//VARIABLES
	$tablename = $GLOBALS['tableprefix'] . '_' . $args['table'];
	$target = $GLOBALS['tableprefix'] . '_' . $args['target'];
	
	
	//Does the Table exist?
	$sql = "SELECT * FROM $tablename";
	$result = mysql_query($sql);
	if (!$result){
		error_log( "<p class='log log_" . (mysql_affected_rows() != -1 ? 'success' : 'failed') . "'><date>[" . date('d-m-Y G:i:s') . "]</date>System tried to add data to table, but Table \'{<strong>$tablename</strong>}\'does not exist! add the Table first with the set_table() function</p>", 3, "infos.log");
		return;
	};
	switch ($args['relation']) {
	case 'self':
		//Does the column alredy exist?
		$sql = "SELECT $args[self_name] FROM $tablename";
		$result = mysql_query($sql);
		if ($result){
			//but does it have the same type?
			$fields = mysql_fetch_fields($tablename);
			foreach ($fields as $key => $field) {
				if ($field->name == $args['self_name']) {
					$currenttype = $field->definition;
				}
			}
			if ($currenttype == $args['self_definition']) {
				//its all up to date
				return; 
			} else {
				//different type? than update (is acctualy DANGGEROUS but ... what can I do)
				$sql = "ALTER TABLE $tablename MODIFY $args[self_name] $args[self_definition]";
				mysql_query($sql);
				
				error_log( "<p class='log log_" . (mysql_affected_rows() != -1 ? 'success' : 'failed') . "'><date>[" . date('d-m-Y G:i:s') . "]</date> update <strong>$tablename.$args[self_name]</strong> fieldtype from <strong>$currenttype</strong> to <strong>$args[self_definition]</strong> </p>", 3, "infos.log");
			}
		} else {
			//add the column
			$sql = "ALTER TABLE $tablename ADD $args[self_name] $args[self_definition]";
			mysql_query($sql);
			error_log( "<p class='log log_" . (mysql_affected_rows() != -1 ? 'success' : 'failed') . "'><date>[" . date('d-m-Y  G:i:s') . "]</date> added <strong>$tablename.$args[self_name]</strong> with fieldtype <strong>$args[self_definition]</strong></p>", 3, "infos.log");
		};
	break;
	
	case 's2m':
		//does target table exist?
		$sql = "SELECT * FROM $target ";
		$exists = mysql_query($sql);
		if (!$exists){
			error_log( "<p class='log log_" . (mysql_affected_rows() != -1 ? 'success' : 'failed') . "'><date>[" . date('d-m-Y G:i:s') . "]</date>System tried to add the connection id to a s2m table, but Table \'{<strong>$target</strong>}\'does not exist! add the Table first with the set_table() function</p>", 3, "infos.log");
			return;
		} 
		//check if the table_id is already in target_table
		$fields = mysql_fetch_fields($target);
		if (! array_key_exists($tablename . '_id', $fields)) {
			//add table_id
			$args2 = array(
				'table' => $args['target'],
				'relation' => 'self',
				'self_name' => $tablename . '_id',
				'self_definition' => 'int(11)'
			);
			add_table_data($args2);
			
		}
	break;
	
	case 'm2m':
		//does target table exist?
		$sql = "SELECT * FROM $target ";
		$exists = mysql_query($sql);
		if (! $exists ){
			error_log( "<p class='log log_" . (mysql_affected_rows() != -1 ? 'success' : 'failed') . "'><date>[" . date('d-m-Y G:i:s') . "]</date>System tried to adda connection to an m2m table, but Table \'{<strong>$target</strong>}\'does not exist! add the Table first with the set_table() function</p>", 3, "infos.log");
			return;
		}
		//is there a tweentable already?
		$tween = get_tweentable_name($tablename,$target);
		$sql = "SELECT * FROM $tween";
		$result = mysql_query($sql);
		if (!$result){ 
			//create tween table
			$sql = "CREATE TABLE $tween (
						id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
						cur_timestamp TIMESTAMP(8),
						{$tablename}_id INT NOT NULL,
						{$target}_id INT NOT NULL
					)";
				
			mysql_query($sql);
			error_log( "<p class='log log_" . (mysql_affected_rows() != -1 ? 'success' : 'failed') . "'><date>[" . date('d-m-Y  G:i:s') . "]</date> Table <strong>$tween</strong> created.</p>", 3, "infos.log");
		}
	break;
	}
}



function get_tweentable_name($table1, $table2, $prifixified = TRUE){
	switch ($prifixified) {
		case FALSE:
			//nothing at the moment
		break;
		
		default:
			$tables = array($table1,$table2);
			sort($tables);  //sort alphabeticaly to prevent bla2bla confusions
			return $tables['0'].'2'.$tables['1'];
		break;
	}

}



?>