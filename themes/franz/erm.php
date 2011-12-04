<?php
// ===============
// = Mitarbeiter =
// ===============
$args = array(
	'name' => 'kunden',
	'hyrarchical' => FALSE,
);
set_table($args);

$args = array(
	'table' => 'kunden',
	'relation' => 'self',
	'self_name' => 'nachname',
	'self_definition' => 'varchar(255)'
);
add_table_data($args);

$args = array(
	'table' => 'kunden',
	'relation' => 'self',
	'self_name' => 'vorname',
	'self_definition' => 'varchar(255)'
);
add_table_data($args);

$args = array(
	'table' => 'kunden',
	'relation' => 'self',
	'self_name' => 'strasse',
	'self_definition' => 'varchar(255)'
);
add_table_data($args);

$args = array(
	'table' => 'kunden',
	'relation' => 'self',
	'self_name' => 'zip',
	'self_definition' => 'varchar(255)'
);
add_table_data($args);

$args = array(
	'table' => 'kunden',
	'relation' => 'self',
	'self_name' => 'ort',
	'self_definition' => 'varchar(255)'
);
add_table_data($args);


/*
$args = array(
	'table' => 'kunden',
	'relation' => 'self',
	'self_name' => 'joindate',
	'self_definition' => 'varchar(255)'
);
add_table_data($args);
*/


$args = array(
	'table' => 'kunden',
	'relation' => 'self',
	'self_name' => 'active',
	'self_definition' => 'BOOL'
);
add_table_data($args);

$args = array(
	'table' => 'kunden',
	'relation' => 'self',
	'self_name' => 'informationen',
	'self_definition' => 'varchar(255)'
);
add_table_data($args);

// Statuses
$args = array(
	'table' => 'kunden',
	'relation' => 'm2s', //the item has only one art
	'target' => 'kunden_status'
);
add_table_data($args);

// rechnungen
$args = array(
	'table' => 'kunden',
	'relation' => 's2m', //the item has many rechnungen
	'target' => 'rechnungen'
);
add_table_data($args);

// ===========
// = Bauformen =
// ===========
$args = array(
	'name' => 'antennen_bauformen',
	'hyrarchical' => TRUE,
);
set_table($args);

$args = array(
	'table' => 'antennen_bauformen',
	'relation' => 'self',
	'self_name' => 'bauform_name',
	'self_definition' => 'varchar(255)'
);
add_table_data($args);

// ==========
// = Status =
// ==========
$args = array(
	'name' => 'kunden_status',
	'hyrarchical' => FALSE,
);
set_table($args);

$args = array(
	'table' => 'kunden_status',
	'relation' => 'self',
	'self_name' => 'name',
	'self_definition' => 'varchar(255)'
);
add_table_data($args);

// ==============
// = Rechnungen =
// ==============
$args = array(
	'name' => 'rechnungen',
	'hyrarchical' => FALSE,
);
set_table($args);

$args = array(
	'table' => 'rechnungen',
	'relation' => 'self',
	'self_name' => 'ref',
	'self_definition' => 'varchar(255)'
);
add_table_data($args);

$args = array(
	'table' => 'rechnungen',
	'relation' => 'self',
	'self_name' => 'amount',
	'self_definition' => 'varchar(255)'
);
add_table_data($args);

$args = array(
	'table' => 'rechnungen',
	'relation' => 'self',
	'self_name' => 'bank',
	'self_definition' => 'varchar(255)'
);
add_table_data($args);

$args = array(
	'table' => 'rechnungen',
	'relation' => 'self',
	'self_name' => 'konto',
	'self_definition' => 'varchar(255)'
);
add_table_data($args);







?>