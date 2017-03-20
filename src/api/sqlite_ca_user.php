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
$path = 'db/fabric-ca.db';
$dt = new Datatables(new SQLite($path));
// Query
// $dt->query('SELECT id, serial_number, authority_key_identifier, ca_label, status, reason, expiry, revoked_at, \'dummy\' as cert FROM Certificates');
$dt->query('SELECT id, state, token, type, max_enrollments, affiliation, attributes FROM users');



// Modify output
// $dt->edit('timestamp', function ($data){
//   $epoc = $data['timestamp'] / 1000000000;
//   $en_date = gmdate("Y-M-d @ h:m:s A", $epoc);
//   return $en_date;
// });
//
// $dt->edit('id', function ($data){
//   $link = "api/ca_cert.php?s={$data['serial_number']}&a={$data['authority_key_identifier']}";
//   $html_link = "<a href='{$link}' target='_blank'>{$data['id']}</a>";
//   return $html_link;
// });

// Respond with results
echo $dt->generate();
