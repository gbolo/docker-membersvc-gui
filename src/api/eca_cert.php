<?php
/*
  src: https://github.com/gbolo/docker-membersvc-gui

  This script simply does some openssl operations on certs stored by membersrvc.
  DO NOT LET THIS SCRIPT TOUCH THE REAL SQLITE FILES! USE COPIES!
*/

/*
if ( isset($_GET['db']) ){
  $valid = array("tlsca", "eca", "tca");
  if ( !in_array($_GET['db'], $valid) ) {
    echo "error: db does not exist";
    exit(0);
  }
} else {
  echo "error: db not specified";
  exit(0);
}
*/

if ( !isset($_GET['row']) || !is_numeric($_GET['row']) ){
  echo "error: row not specified";
  exit(0);
}

$row = $_GET['row'];
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function sha1_format($sha1){
  return implode(":", str_split($sha1, 2));
}

function der2pem($der_data) {
  $pem = chunk_split(base64_encode($der_data), 64, "\n");
  $pem = "-----BEGIN CERTIFICATE-----\n".$pem."-----END CERTIFICATE-----\n";
  return $pem;
}

function pem2der($pem_data) {
  $begin = "CERTIFICATE-----";
  $end   = "-----END";
  $pem_data = substr($pem_data, strpos($pem_data, $begin)+strlen($begin));
  $pem_data = substr($pem_data, 0, strpos($pem_data, $end));
  $der = base64_decode($pem_data);
  return $der;
}

$db = new PDO('sqlite:db/eca.db');
$stmt = $db->prepare("SELECT id, timestamp, usage, cert FROM Certificates WHERE row = $row");
$stmt->execute();
$row = $stmt->fetch();

if ( !is_array($row) ) {
  echo "error: row not found";
  exit(0);
}

$cert = der2pem($row['cert']);
$cert_info = openssl_x509_parse($cert);
$fingerprint = openssl_x509_fingerprint($cert, "sha1");

if ( isset($_GET['certonly']) ){
  echo $cert;
  exit(0);
}

if ( isset($_GET['fingerprint']) ){
  echo $fingerprint."\n";
  exit(0);
}

$epoc = $row['timestamp'] / 1000000000;
$en_date = gmdate("Y-M-d @ h:m:s A", $epoc);
echo "<pre><h2>Enrollment Id: {$row['id']}</h2>";
echo "<b>Enrollment Date:</b> {$en_date} \n";
echo "<b>Enrollment Usage:</b> {$row['usage']} \n";
echo "<hr />";

echo "\nSHA1 Fingerprint: ".sha1_format($fingerprint)."\n \n";
echo "{$cert} \n";
echo "<hr />";

print_r($cert_info);
