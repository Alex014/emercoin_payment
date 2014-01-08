<?php
error_reporting(E_ALL^E_NOTICE^E_WARNING^E_STRICT^E_DEPRECATED);
ini_set("display_errors", true);

require dirname(__FILE__).'/../db.php';
require dirname(__FILE__).'/_login.php';
require(dirname(__FILE__).'/../classes/emercoin.php');
require(dirname(__FILE__).'/../classes/emercoin.conf.php');


$st = $connection->query("SELECT `address`, `ammount` FROM payback_admin");
if($st) {
  $st->setFetchMode(PDO::FETCH_NUM);
  if ($row = $st->fetch()) {
    $_address = trim($row[0]);
    $_ammount = trim($row[1]);
  }
  $st->closeCursor();
}

if(isset($_POST['save'])) {
  //Change payout address ...
  $a_err = false;
  $_address = $_POST['address'];
  $_ammount = $_POST['ammount'];
          
  if($_address == '') {
    $a_err = 'Empty address';
    $a_err_field = 'address';
  }
  elseif(!is_numeric ($_POST['ammount'])) {
    $a_err = 'Wrong ammount format';
    $a_err_field = 'ammount';
  }
  elseif(! ($st = $connection->prepare('UPDATE payback_admin SET `address` = ?, ammount = ?')) || 
          ! $st->execute(array(trim($_address), (double)$_ammount)) ) {
    $a_err = 'Database error';
  }
  else {
    $a_err = 'addr_ok';
  }
}
elseif(isset($_POST['takeout'])) {
  $__ammount = $_POST['ammount'];
  
  //Address
  $st = $connection->query("SELECT `address` FROM payback_admin");
  if($st) {
    $st->setFetchMode(PDO::FETCH_NUM);
    if ($row = $st->fetch())
      $address = trim($row[0]);
    $st->closeCursor();
  }
  
  if(!isset($address)) {
    $t_err = 'Database error';
  }
  elseif($address == '') {
    $t_err = 'Empty address';
  }
  elseif(!isset($_POST['all']) && !is_numeric ($__ammount)) {
    $t_err = 'Wrong ammount format';
  }
  
  if(!isset($t_err)) {
    //Takeout money
    if(isset($_POST['all'])) {
      //Including 0.01 EMC fee
      $__ammount = emercoin::getAllBalance() - 0.01;
    }
    
    try {
      $result = emercoin::sendToAddress($address, (double)$__ammount);
    } catch (Exception $exc) {
      $t_err = 'Error sending money';
    }
    
    //var_dump($result);
    
    if(!isset($t_err) && (strlen($result) == 64)) {
      $t_err = 'takeout_ok';
      $st = $connection->prepare('INSERT INTO payback_transactions (ammount, address, comment) VALUES (?, ?, ?)');
      $st->execute(array($__ammount, $address, 'Money takeout'));
    }
  }
} else {
  $__ammount = 10.0;
}

//Balance
$balance = emercoin::getAllBalance();

//Module
$module = 'takeout';

require dirname(__FILE__).'/templates/takeout.php';