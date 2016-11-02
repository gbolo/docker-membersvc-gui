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
$path = 'db/eca.db';
$dt = new Datatables(new SQLite($path));
// Query
$dt->query('SELECT id, timestamp, usage, row FROM Certificates');

// Modify output
$dt->edit('timestamp', function ($data){
  $epoc = $data['timestamp'] / 1000000000;
  $en_date = gmdate("Y-M-d @ h:m:s A", $epoc);
  return $en_date;
});

$dt->edit('row', function ($data){
  $link = "api/eca_cert.php?row={$data['row']}";
  $html_link = "<a href='{$link}' target='_blank'>Cert Info</a>";
  return $html_link;
});

// Respond with results
echo $dt->generate();
