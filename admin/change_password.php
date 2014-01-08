<?php
error_reporting(E_ALL^E_NOTICE^E_WARNING^E_STRICT^E_DEPRECATED);
ini_set("display_errors", true);

require dirname(__FILE__).'/../db.php';
require dirname(__FILE__).'/_login.php';
require(dirname(__FILE__).'/../classes/emercoin.php');
require(dirname(__FILE__).'/../classes/emercoin.conf.php');

if(isset($_POST['save'])) {
  $err = false;
  $err_field = '';

  $st = $connection->query("SELECT `password` FROM payback_admin");
  if($st) {
    $st->setFetchMode(PDO::FETCH_NUM);
    if ($row = $st->fetch())
      $old_pass = $row[0];
    $st->closeCursor();
  }
  
  if(!isset($old_pass)) {
    $err = 'Database error';
  }
  elseif($old_pass != md5(trim($_POST['old_pass']))) {
    $err = 'Old password is wrong';
    $err_field = 'pass0';
    var_dump($old_pass, $_POST['old_pass']);
  }
  elseif(strlen(trim($_POST['pass'])) < 5) {
    $err = 'The length of the new password is less than 5 symbols';
    $err_field = 'pass1';
  }
  elseif(trim($_POST['pass']) != trim($_POST['pass2'])) {
    $err = 'Passwords don\'t match';
    $err_field = 'pass2';
  }

  if($err === false) {
    $password = trim($_POST['pass']);
    //Changing password
    $st = $connection->prepare('UPDATE payback_admin SET `password` = MD5(?)');
    if( ! $st->execute(array($password)) ) {
      $err = 'Database error';
    }
  }
}

//Balance
$balance = emercoin::getAllBalance();

//Module
$module = 'change_password';


require dirname(__FILE__).'/templates/change_password.php';