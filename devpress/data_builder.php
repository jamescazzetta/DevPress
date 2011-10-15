<?php
// ================
// = Data Builder =
// ================


/* Retrieves data from db and put it into an array */
function data($args, $filters = array(), $single = ''){
	$tablename = $GLOBALS['tableprefix'] . '_' . $args['table'];
	
	$where = '';
	
	foreach ($filters as $key => $value) {
		$where .= " AND $key = $value ";
	}
	
	
	
	$tablefields = mysql_fetch_fields($tablename);
	$joins = (array_key_exists('joins', $args) ? $args['joins'] : array());	
	$data = ($single ? '' : array());
	
	// retrieve all the fields 
	$tablefield_names = array();
	foreach ($tablefields as $tablefield) {$tablefield_names[] = $tablename . '.' . $tablefield->name;}
	$selects = implode(", ", $tablefield_names);
	
	
	//get table data
	$sql = " SELECT $selects FROM $tablename WHERE 0=0 $where ORDER BY $tablename.roworder DESC";
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
				$join = $GLOBALS['tableprefix'] . '_' . $join;
				//get targetfields
				$targetfields = mysql_fetch_fields($join); //retrieve targetfields			
		
				//test if it is s2m
				if (array_key_exists($join . '_id', $tablefields)) {
			
					// loop through the table item and retrieve connection id
					$sql2 = " SELECT {$join}_id as 'join_id' FROM $tablename WHERE $tablename.id = $table_data[id] ORDER BY $join.roworder DESC";
					$result = mysql_query($sql2) or trigger_error("SQL", E_USER_ERROR);
			 		while ($temp_sql = mysql_fetch_array($result)) { 
						if ($temp_sql['join_id']) { //check if this row even has a connection
					
							// retrieve all the fields for select so that no repetitions from other tables occure
							$targetfield_names = array();
							foreach ($targetfields as $targetfield) {$targetfield_names[] = $join . '.' . $targetfield->name;}
							$selects = implode(", ", $targetfield_names);
			
							$sql_sub = " SELECT $selects FROM $join JOIN $tablename ON $tablename.{$join}_id = $join.{$join}_id WHERE $join.{$join}_id = $temp_sql[join_id] ORDER BY $join.roworder DESC";
							$result = mysql_query($sql_sub) or trigger_error("SQL", E_USER_ERROR);
							$i = 0;
							
							while ($join_sql = mysql_fetch_array($result)) { // loop through the target rows
								foreach ($targetfields as $key => $targetfield) {
									if ($single) {
										$data[$join][$i][$targetfield->name] = $join_sql[$targetfield->name];	//add to data
									} else {
										$data[$table_data['id']][$join][$i][$targetfield->name] = $join_sql[$targetfield->name];	//add to data
									}
								}
								$i++;
						
						
							}
			
						}
					}
				//is m2m
				} else {
					//M2M
					//check the tween table to see with which table it is connected (its possible that it is connected with one of the joins!!!)
					//see if this table is in the joins list if yes then connect the table to that one else stop
					
					// retrieve all the fields for select so that no repetitions from other tables occure
					$targetfield_names = array();
					foreach ($targetfields as $targetfield) {$targetfield_names[] = $join . '.' . $targetfield->name;}
					$selects = implode(", ", $targetfield_names);
	
					//sort alphabeticaly to prevent bla2bla confusions
					$tables = array($tablename,$join);
					sort($tables);  
	
					$sql_sub = "SELECT $selects FROM $join 
								JOIN $tables[0]2$tables[1] ON $tables[0]2$tables[1].{$join}_id = $join.id 
								JOIN $tablename ON $tables[0]2$tables[1].{$tablename}_id = $tablename.id
								WHERE $tablename.id = $table_data[id] 
								ORDER BY $join.roworder DESC
								";
					$result = mysql_query($sql_sub) or trigger_error("SQL", E_USER_ERROR);
					$i = 0;
					
					while ($join_sql = mysql_fetch_array($result)) { // loop through the target rows
						
						foreach ($targetfields as $key => $targetfield) {
							if ($single) {
								$data[$join][$i][$targetfield->name] = $join_sql[$targetfield->name];	//add to data
							} else {
								$data[$table_data['id']][$join][$i][$targetfield->name] = $join_sql[$targetfield->name];	//add to data
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