<?php
// ===============
// = Mitarbeiter =
// ===============
$args = array(
	'name' => 'mitarbeiter',
	'hyrarchical' => FALSE,
);
set_table($args);

$args = array(
	'table' => 'mitarbeiter',
	'relation' => 'self',
	'self_name' => 'vorname',
	'self_definition' => 'varchar(255)'
);
add_table_data($args);

$args = array(
	'table' => 'mitarbeiter',
	'relation' => 'self',
	'self_name' => 'nachname',
	'self_definition' => 'varchar(255)'
);
add_table_data($args);

$args = array(
	'table' => 'mitarbeiter',
	'relation' => 'self',
	'self_name' => 'funktion',
	'self_definition' => 'varchar(255)'
);
add_table_data($args);

$args = array(
	'table' => 'mitarbeiter',
	'relation' => 'self',
	'self_name' => 'email',
	'self_definition' => 'varchar(255)'
);
add_table_data($args);

$args = array(
	'table' => 'mitarbeiter',
	'relation' => 'self',
	'self_name' => 'telefon',
	'self_definition' => 'varchar(255)'
);
add_table_data($args);

$args = array(
	'table' => 'mitarbeiter',
	'relation' => 'self',
	'self_name' => 'telefax',
	'self_definition' => 'varchar(255)'
);
add_table_data($args);

$args = array(
	'table' => 'mitarbeiter',
	'relation' => 'self',
	'self_name' => 'bild',
	'self_definition' => 'varchar(255)'
);
add_table_data($args);

// Gruppen
$args = array(
	'table' => 'mitarbeiter',
	'relation' => 'm2m',
	'target' => 'gruppen'
);
add_table_data($args);



// ===========
// = Gruppen =
// ===========
$args = array(
	'name' => 'gruppen',
	'hyrarchical' => TRUE,
);
set_table($args);

$args = array(
	'table' => 'gruppen',
	'relation' => 'self',
	'self_name' => 'sparte',
	'self_definition' => 'varchar(255)'
);
add_table_data($args);



// ===========
// = Partner =
// ===========
$args = array(
	'name' => 'partner',
	'hyrarchical' => FALSE, //adds parent_id
);
set_table($args);

$args = array(
	'table' => 'partner',
	'relation' => 'self',
	'self_name' => 'name',
	'self_definition' => 'varchar(255)'
);
add_table_data($args);

$args = array(
	'table' => 'partner',
	'relation' => 'self',
	'self_name' => 'land',
	'self_definition' => 'varchar(255)'
);
add_table_data($args);

$args = array(
	'table' => 'partner',
	'relation' => 'self',
	'self_name' => 'telefon',
	'self_definition' => 'varchar(255)'
);
add_table_data($args);

$args = array(
	'table' => 'partner',
	'relation' => 'self',
	'self_name' => 'telefax',
	'self_definition' => 'varchar(255)'
);
add_table_data($args);

$args = array(
	'table' => 'partner',
	'relation' => 'self',
	'self_name' => 'email',
	'self_definition' => 'varchar(255)'
);
add_table_data($args);


?>