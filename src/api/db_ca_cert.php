<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Get database type from env

// default
$DB_TYPE = 'sqlite';

if ( getenv('CA_DB_TYPE') != false ){

  // acceptable values for DB_TYPE
  switch (getenv('CA_DB_TYPE')) {
    case "mysql":
        $DB_TYPE = "mysql";
        break;
    case "sqlite":
        $DB_TYPE = "sqlite";
        break;
  }

}

// Load related files depending on db type
require_once($DB_TYPE . '_setup.php');

// Query
$dt->query('SELECT id, serial_number, authority_key_identifier, ca_label, status, reason, expiry, revoked_at FROM certificates');

// Modify output
$dt->edit('id', function ($data){
  $link = "api/ca_cert.php?s={$data['serial_number']}&a={$data['authority_key_identifier']}";
  $html_link = "<a href='{$link}' target='_blank'>{$data['id']}</a>";
  return $html_link;
});

// Respond with results
echo $dt->generate();
