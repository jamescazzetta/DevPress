<?php
// ================
// = Data Builder =
// ================


/* Retrieves data from db and put it into an array */
function data($args, $filters = array(), $single = ''){
	$tablename = $GLOBALS['tableprefix'] . '_' . $args['table'];

	
	$tablefields = mysql_fetch_fields($tablename);
	$joins = (array_key_exists('joins', $args) ? $args['joins'] : array());	
	$data = ($single ? '' : array());
	

	
	$tablefield_names = array();
	foreach ($tablefields as $tablefield) {$tablefield_names[] = $tablename . '.' . $tablefield->name;}
	$selects = implode(", ", $tablefield_names);
	
	// check if is hyrarchical
	$testsql = "SELECT parent_id FROM $tablename";	
	$hyr = (mysql_query($testsql) ? TRUE : FALSE);
		
	//filters
	$where = " WHERE 0=0 ";
	if (array_key_exists("parent_id", $filters) && $hyr == TRUE) {
		if ($filters["parent_id"] == 'root') {
			$where .= " AND ".$tablename.".parent_id = 0 ";
		} else {
			$where .= " AND ".$tablename.".parent_id = ".$filters["parent_id"]." ";
		}
	}
	if (array_key_exists("ID", $filters)) {
			$where .= " AND ".$tablename.".id = $filters[ID] ";
	}

	
	//get table data
	$sql = " SELECT $selects FROM $tablename $where ORDER BY $tablename.roworder DESC";	
	$result2 = mysql_query($sql) or trigger_error("SQL", E_USER_ERROR);
	
	
    while ($table_data = mysql_fetch_array($result2)) {
		
		//get self data
		foreach ($tablefields as $key => $tablefield) {		
			if ($single) {
				$data[$tablefield->name] = $table_data[$tablefield->name];
			} else {
					$data[$table_data['id']][$tablefield->name] = $table_data[$tablefield->name];					
			}
		}
		
		//get join data 
		if($joins) : 
			foreach ($joins as $key => $join) {	
				$joinname = $GLOBALS['tableprefix'] . '_' . $join;
				//get targetfields
				$targetfields = mysql_fetch_fields($joinname); //retrieve targetfields			

				//test if it is m2s
				if (array_key_exists($joinname . '_id', $tablefields)) {
			
					// loop through the table item and retrieve connection id
					$sql2 = " SELECT {$joinname}_id as 'join_id' FROM $tablename WHERE {$joinname}_id = $table_data[id] /*ORDER BY $joinname.roworder DESC*/";
					$result = mysql_query($sql2) or trigger_error("SQL", E_USER_ERROR);
			 		while ($temp_sql = mysql_fetch_array($result)) { 
						if ($temp_sql['join_id']) { //check if this row even has a connection
					
							// retrieve all the fields for select so that no repetitions from other tables occure
							$targetfield_names = array();
							foreach ($targetfields as $targetfield) {$targetfield_names[] = $joinname . '.' . $targetfield->name;}
							$selects = implode(", ", $targetfield_names);
			
							$sql_sub = " SELECT $selects FROM $joinname JOIN $tablename ON $tablename.{$joinname}_id = $joinname.{$joinname}_id WHERE $joinname.{$joinname}_id = $temp_sql[join_id] ORDER BY $joinname.roworder DESC";
							$result = mysql_query($sql_sub) or trigger_error("SQL", E_USER_ERROR);
							$i = 0;
							
							while ($join_sql = mysql_fetch_array($result)) { // loop through the target rows								
								foreach ($targetfields as $key => $targetfield) {
									
									
									if ($single) {
										$data[$joinname][$i][$targetfield->name] = $join_sql[$targetfield->name];	//add to data
									} else {
										$data[$table_data['id']][$joinname][$i][$targetfield->name] = $join_sql[$targetfield->name];	//add to data
									}
								}
								$i++;
						
						
							}
			
						}
					}
				
				//test if is s2m
				} elseif (array_key_exists($tablename . '_id', $targetfields)) {
						// loop through the join item and retrieve connection id
						$sql2 = " SELECT {$tablename}_id as 'table_id', ID FROM $joinname WHERE {$tablename}_id = $table_data[id] ORDER BY roworder DESC";
						$result = mysql_query($sql2) or trigger_error("SQL", E_USER_ERROR);
				 		while ($connection = mysql_fetch_array($result)) { 
							$joindata = data(array('table' => $join), array('ID' => $connection['ID']), 1);
						$data[$joinname][] = $joindata;
						}
				} else {
					//M2M
					//check the tween table to see with which table it is connected (its possible that it is connected with one of the joins!!!)
					//see if this table is in the joins list if yes then connect the table to that one else stop
					
					// retrieve all the fields for select so that no repetitions from other tables occure
					$targetfield_names = array();
					foreach ($targetfields as $targetfield) {$targetfield_names[] = $joinname . '.' . $targetfield->name;}
					$selects = implode(", ", $targetfield_names);
	
					//sort alphabeticaly to prevent bla2bla confusions
					$tables = array($tablename,$joinname);
					sort($tables);  
	
					$sql_sub = "SELECT $selects FROM $joinname 
								JOIN $tables[0]2$tables[1] ON $tables[0]2$tables[1].{$joinname}_id = $joinname.id 
								JOIN $tablename ON $tables[0]2$tables[1].{$tablename}_id = $tablename.id
								WHERE $tablename.id = $table_data[id] 
								ORDER BY $joinname.roworder DESC
								";
					$result = mysql_query($sql_sub) or trigger_error("SQL", E_USER_ERROR);
					$i = 0;
					
					while ($join_sql = mysql_fetch_array($result)) { // loop through the target rows
						
						foreach ($targetfields as $key => $targetfield) {
							if ($single) {
								$data[$joinname][$i][$targetfield->name] = $join_sql[$targetfield->name];	//add to data
							} else {
								$data[$table_data['id']][$joinname][$i][$targetfield->name] = $join_sql[$targetfield->name];	//add to data
							}
						}
						$i++;
					
				
					}
					
			
				}
		

			} //foreach 
		endif;
		
		
		
	} //while
	
	
	return $data;
	
	
	
}

?>