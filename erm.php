<?php
$args = array(
	'name' => 'produkte',
	'hyrarchical' => FALSE,
);
set_table($args);

$args = array(
	'table' => 'produkte',
	'relation' => 'self',
	'self_name' => 'Artikelnummer',
	'self_definition' => 'varchar(255)'
);
add_table_data($args);

$args = array(
	'table' => 'produkte',
	'relation' => 'self',
	'self_name' => 'name',
	'self_definition' => 'varchar(255)'
);
add_table_data($args);

$args = array(
	'table' => 'produkte',
	'relation' => 'self',
	'self_name' => 'beschreibung',
	'self_definition' => 'varchar(255)'
);
add_table_data($args);

$args = array(
	'table' => 'produkte',
	'relation' => 'self',
	'self_name' => 'techdata',
	'self_definition' => 'int(2)'
);
add_table_data($args);

$args = array(
	'table' => 'produkte',
	'relation' => 'self',
	'self_name' => 'bild',
	'self_definition' => 'varchar(255)'
);
add_table_data($args);

$args = array(
	'table' => 'produkte',
	'relation' => 'self',
	'self_name' => 'thumb',
	'self_definition' => 'varchar(255)'
);
add_table_data($args);


$args = array(
	'table' => 'produkte',
	'relation' => 'self',
	'self_name' => 'preis_chf',
	'self_definition' => 'varchar(255)'
);
add_table_data($args);

$args = array(
	'table' => 'produkte',
	'relation' => 'self',
	'self_name' => 'preis_wir',
	'self_definition' => 'varchar(255)'
);
add_table_data($args);


// Kategorie
$args = array(
	'table' => 'produkte',
	'relation' => 'm2m',
	'target' => 'kategorien'
);
add_table_data($args);



// ===========
// = kategorie =
// ===========
$args = array(
	'name' => 'kategorien',
	'hyrarchical' => TRUE,
);
set_table($args);

$args = array(
	'table' => 'kategorien',
	'relation' => 'self',
	'self_name' => 'name',
	'self_definition' => 'varchar(255)'
);
add_table_data($args);

/* SOMEHOW DOES NOT WORK!!!
$args = array(
	'table' => 'kategorien',
	'relation' => 'm2s',
	'target' => 'store'
);
add_table_data($args);
*/

// ===========
// = Store =
// ===========
$args = array(
	'name' => 'store',
	'hyrarchical' => false,
);
set_table($args);

$args = array(
	'table' => 'store',
	'relation' => 's2m',
	'target' => 'kategorien'
);
add_table_data($args);

$args = array(
	'table' => 'store',
	'relation' => 'self',
	'self_name' => 'name',
	'self_definition' => 'varchar(255)'
);
add_table_data($args);


?>