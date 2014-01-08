<?php
error_reporting(E_ALL^E_NOTICE^E_WARNING^E_STRICT^E_DEPRECATED);
ini_set("display_errors", true);

require 'db.php';
require(dirname(__FILE__).'/classes/emercoin.php');
require(dirname(__FILE__).'/classes/emercoin.conf.php');
header("encoding: utf8;");

//emercoin::$debug = true;
//$info = emercoin::getinfo();
//var_dump($info);

$address = emercoin::createPaymentAddress();

$_SESSION['order_address'] = $address;


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Emercoin test</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head>
<body>
<center>
  <h3>Your payment address:</h3>
  <h1> <a href="emercoin:<?=$address?>?amount=<?=$_SESSION['order_ammount']?>"> <?=$address?> </a> </h1>
  <h2>Payment ammount: <?=$_SESSION['order_ammount']?> (EMC)</h2>
  
  <div style="margin-top: 200px;" id="loading">
    <img src="i/ajax-loader.gif" width="100" height="100"/>
  </div>
  <div style="margin-top: 200px; display: none;" id="done">
    <h3>Payment done</h3>
    <img src="i/done.png" width="100" height="100"/>
  </div>
</center>

<script type="text/javascript">
check_confirm_interval =
setInterval(function() {
  $.get('check_confirm.php', function(res) {
    console.log(res)
    if(res.trim() == '1') {
      $('#loading').hide()
      $('#done').show()
      clearInterval(check_confirm_interval);
      setTimeout(function() { window.location = 'index.php' }, 10000)
    }
  })
}, 2000);
</script>
</body>
</html>
