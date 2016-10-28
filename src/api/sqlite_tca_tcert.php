<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Load the library for datatables
require_once('lib/DB/DatabaseInterface.php');
require_once('lib/DB/SQLite.php');
require_once('lib/Datatables.php');

use Ozdemir\Datatables\Datatables;
use Ozdemir\Datatables\DB\SQLite;

// Create object
$path = 'db/tca.db';
$dt = new Datatables(new SQLite($path));
// Query
$dt->query('SELECT row, enrollmentID, timestamp FROM TCertificateSets');

// Respond with results
echo $dt->generate();