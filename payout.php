<?php
error_reporting(E_ALL^E_NOTICE^E_WARNING^E_STRICT^E_DEPRECATED);
ini_set("display_errors", true);

require dirname(__FILE__).'/db.php';
require(dirname(__FILE__).'/classes/emercoin.php');
require(dirname(__FILE__).'/classes/emercoin.conf.php');

//Address
$st = $connection->query("SELECT `address`, `ammount` FROM payback_admin");
if($st) {
  $st->setFetchMode(PDO::FETCH_NUM);
  if ($row = $st->fetch()) {
    $address = trim($row[0]);
    $ammount = (double)$row[1];
  }
  $st->closeCursor();
}

if(!isset($address)) {
  echo 'Database error';
  die();
}
elseif($address == '') {
  echo 'Empty address';
  die();
}

//Taking out money
$balance = emercoin::getAllBalance();
if($balance >= $ammount) {
  $result = emercoin::sendAllToAddress($address);
  var_dump($result);

  echo 'OK';
}
else {
  echo "No, Balance=$balance, ammount=$ammount";
}