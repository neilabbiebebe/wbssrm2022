<?php

define ('DB_NAME', 'scheduling');

define ('DB_USER', 'root');

define ('DB_PASSWORD', 'wbssrm2022');

define ('DB_HOST', 'localhost');

$conn= mysql_connect (DB_HOST,DB_USER,DB_PASSWORD);

if (!$conn) {

die ('could not connect:' . mysql_error () );

}
$db=mysql_select_db (DB_NAME, $conn);

if (!$db) {

die ('cant user' . ':' . mysql_error ());

}

?>