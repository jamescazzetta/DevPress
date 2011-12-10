<?php
// ===============
// = Mediatable =
// ===============
$args = array(
	'name' => 'mediadb',
	'hyrarchical' => FALSE,
);
set_table($args);

$args = array(
	'table' => 'mediadb',
	'relation' => 'self',
	'self_name' => 'tmpname',
	'self_definition' => 'varchar(255)'
);
add_table_data($args);

$args = array(
	'table' => 'mediadb',
	'relation' => 'self',
	'self_name' => 'name',
	'self_definition' => 'varchar(255)'
);
add_table_data($args);


?>