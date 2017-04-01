<?php

// Load mysql config

// defaults
$DB_HOST = "localhost";
$DB_PORT = "3306";
$DB_USERNAME = "dbuser";
$DB_PASSWORD = "password";
$DB_NAME = "fabric_ca";

// get overrides from env (12-factor app)
if ( getenv('DB_USERNAME') != false ){
  $DB_USERNAME = getenv('DB_USERNAME');
}

if ( getenv('DB_PORT') != false ){
  $DB_PORT = getenv('DB_PORT');
}

if ( getenv('DB_HOST') != false ){
  $DB_HOST = getenv('DB_HOST');
}

if ( getenv('DB_PASSWORD') != false ){
  $DB_PASSWORD = getenv('DB_PASSWORD');
}

if ( getenv('DB_NAME') != false ){
  $DB_NAME = getenv('DB_NAME');
}

// Format for library
$config = array(
	'host'     => $DB_HOST,
	'port'     => $DB_PORT,
	'username' => $DB_USERNAME,
	'password' => $DB_PASSWORD,
	'database' => $DB_NAME
);


// Load the library for datatables
require_once('lib/DB/DatabaseInterface.php');
require_once('lib/DB/MySQL.php');
require_once('lib/Datatables.php');

use Ozdemir\Datatables\Datatables;
use Ozdemir\Datatables\DB\MySQL;

// Create object
$dt = new Datatables(new MySQL($config));

?>
