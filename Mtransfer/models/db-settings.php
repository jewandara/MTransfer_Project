<?php

//Database Information
$db_host = "localhost"; //Host address
$db_name = "mtransfer"; //Name of Database
$db_user = "user"; //Name of database user
$db_pass = "user123"; //Password for database user
$db_table_prefix = "mt_";

GLOBAL $errors;
GLOBAL $successes;

$errors = array();
$successes = array();

$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
GLOBAL $mysqli;

if(mysqli_connect_errno()) {
	echo "Connection Failed: " . mysqli_connect_errno();
	exit();
}

if(is_dir("install/"))
{
	header("Location: install/");
	die();
}

?>