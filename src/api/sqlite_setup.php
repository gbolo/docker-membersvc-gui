<?php

// Load sqllite config

// defaults
$SQLITE_DB_FILE = 'db/fabric-ca.db';

// get overrides from env (12-factor app)
if ( getenv('SQLITE_DB_FILE') != false ){
  $SQLITE_DB_FILE = getenv('SQLITE_DB_FILE');
}

// Load the library for datatables
require_once('lib/DB/DatabaseInterface.php');
require_once('lib/DB/SQLite.php');
require_once('lib/Datatables.php');

use Ozdemir\Datatables\Datatables;
use Ozdemir\Datatables\DB\SQLite;

// Create object
$dt = new Datatables(new SQLite($SQLITE_DB_FILE));

?>
