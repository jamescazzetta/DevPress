<?php

/* DB */
$DB_HOST	= "localhost";
$DB_BN		= "root";
$DB_PW		= "metalgear3";
$DB_DB		= "devpress2";

/* GLOBALS */
$tableprefix = 'mr';
$root = 'http://devpress.local';
$theme = 'franz';
$themeindex = 'kunden.php';

$themeurl = $root . '/themes/' . $theme;
$themeindexurl = $themeurl . '/' . $themeindex;

//MySQL connect
$con = mysql_connect($DB_HOST, $DB_BN, $DB_PW);
if (!$con) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db($DB_DB);
mysql_query("SET NAMES utf8");
mysql_query("SET collation_connection = 'utf8_unicode_ci'");



?>