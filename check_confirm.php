<?php
error_reporting(E_ALL^E_NOTICE^E_WARNING^E_STRICT^E_DEPRECATED);
ini_set("display_errors", true);

require 'db.php';
require(dirname(__FILE__).'/classes/emercoin.php');
require(dirname(__FILE__).'/classes/emercoin.conf.php');

if(emercoin::confirmPayment()) {
  $st = $connection->prepare('INSERT INTO payback_transactions (ammount, address, comment) VALUES (?, ?, ?)');
  $st->execute(array($_SESSION['order_ammount'], $_SESSION['order_address'], "Order # ".call_user_func(emercoin::$get_order_id)));
  echo '1'; 
}
else {
  echo '0';
}