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
$dt->query('SELECT id, state, token, type, max_enrollments, affiliation, attributes FROM users');

// Modify output

// Respond with results
echo $dt->generate();
