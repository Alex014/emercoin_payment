<?php
error_reporting(E_ALL^E_NOTICE^E_WARNING^E_STRICT^E_DEPRECATED);
ini_set("display_errors", true);

require 'db.php';
require(dirname(__FILE__).'/classes/emercoin.php');
require(dirname(__FILE__).'/classes/emercoin.conf.php');

if(emercoin::confirmPayment()) echo '1';

//echo 'error';