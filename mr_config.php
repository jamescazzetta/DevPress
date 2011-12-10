<?php

/* DB */
$DB_HOST	= "localhost";
$DB_BN		= "db131999_andenma";
$DB_PW		= "giraffe33";
$DB_DB		= "db131999_andenmatten";

/* GLOBALS */
$tableprefix = 'andenmatten';
$root = 'http://devpress.local';
$theme = 'franz';
$themeindex = 'kunden.php';
$build = FALSE;

$backendurl = $root . '/backend/' . $theme;
$themeindexurl = $backendurl . '/' . $themeindex;

//MySQL connect
$con = mysql_connect($DB_HOST, $DB_BN, $DB_PW);
if (!$con) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db($DB_DB);
mysql_query("SET NAMES utf8");
mysql_query("SET collation_connection = 'utf8_unicode_ci'");



?>