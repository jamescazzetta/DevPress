<?php
// ===============
// = Mitarbeiter =
// ===============
$args = array(
	'name' => 'antennen',
	'hyrarchical' => FALSE,
);
set_table($args);

$args = array(
	'table' => 'antennen',
	'relation' => 'self',
	'self_name' => 'Artikelnummer',
	'self_definition' => 'varchar(255)'
);
add_table_data($args);

$args = array(
	'table' => 'antennen',
	'relation' => 'self',
	'self_name' => 'artikeltext',
	'self_definition' => 'varchar(255)'
);
add_table_data($args);

$args = array(
	'table' => 'antennen',
	'relation' => 'self',
	'self_name' => 'bild',
	'self_definition' => 'varchar(255)'
);
add_table_data($args);

$args = array(
	'table' => 'antennen',
	'relation' => 'self',
	'self_name' => 'durchmesser',
	'self_definition' => 'varchar(255)'
);
add_table_data($args);

$args = array(
	'table' => 'antennen',
	'relation' => 'self',
	'self_name' => 'gewicht',
	'self_definition' => 'varchar(255)'
);
add_table_data($args);

$args = array(
	'table' => 'antennen',
	'relation' => 'self',
	'self_name' => 'outdoor',
	'self_definition' => 'BOOL'
);
add_table_data($args);

$args = array(
	'table' => 'antennen',
	'relation' => 'self',
	'self_name' => 'preis',
	'self_definition' => 'varchar(255)'
);
add_table_data($args);

// bauformen
$args = array(
	'table' => 'antennen',
	'relation' => 'm2m',
	'target' => 'antennen_bauformen'
);
add_table_data($args);

// art
$args = array(
	'table' => 'antennen',
	'relation' => 'm2s', //the item has only one art
	'target' => 'antennen_arte'
);
add_table_data($args);

// Farben
$args = array(
	'table' => 'antennen',
	'relation' => 's2m', //the item has many colors
	'target' => 'farben'
);
add_table_data($args);


// materialien
$args = array(
	'table' => 'antennen',
	'relation' => 'm2m',
	'target' => 'antennen_materialien'
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

// =======
// = art =
// =======
$args = array(
	'name' => 'antennen_arte',
	'hyrarchical' => FALSE,
);
set_table($args);

$args = array(
	'table' => 'antennen_arte',
	'relation' => 'self',
	'self_name' => 'antennenart_name',
	'self_definition' => 'varchar(255)'
);
add_table_data($args);

// ==========
// = Farben =
// ==========
$args = array(
	'name' => 'farben',
	'hyrarchical' => FALSE,
);
set_table($args);

$args = array(
	'table' => 'farben',
	'relation' => 'self',
	'self_name' => 'farben_hex',
	'self_definition' => 'varchar(255)'
);
add_table_data($args);

$args = array(
	'table' => 'farben',
	'relation' => 'self',
	'self_name' => 'farben_name',
	'self_definition' => 'varchar(255)'
);
add_table_data($args);

// ===============
// = Materialien =
// ===============
$args = array(
	'name' => 'antennen_materialien',
	'hyrarchical' => FALSE,
);
set_table($args);

$args = array(
	'table' => 'antennen_materialien',
	'relation' => 'self',
	'self_name' => 'materialien_name',
	'self_definition' => 'varchar(255)'
);
add_table_data($args);





?>