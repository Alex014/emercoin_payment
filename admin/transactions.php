<?php
error_reporting(E_ALL^E_NOTICE^E_WARNING^E_STRICT^E_DEPRECATED);
ini_set("display_errors", true);

require dirname(__FILE__).'/../db.php';
require dirname(__FILE__).'/_login.php';
require(dirname(__FILE__).'/../classes/emercoin.php');
require(dirname(__FILE__).'/../classes/emercoin.conf.php');

//Page count
$st = $connection->query("SELECT COUNT(*) FROM `payback_transactions`");
if($st) {
  $st->setFetchMode(PDO::FETCH_NUM);
  if ($row = $st->fetch())
    $count = $row[0];
  $st->closeCursor();
}
if(!isset($count))  throw new Exception('Database error');
$max_pages = ceil($count/10);
if($max_pages < 1) $max_pages = 1;

$page = 1;

if(isset($_GET['page'])) $page = (int)$_GET['page'];
if($page < 1) $page = 1;
if($page > $max_pages) $page = $max_pages;
$from = 20*($page-1);
$to = 20*($page) - 1;
$page_next = $page + 1;
$page_prev = $page - 1;
if($page_prev < 1) $page_prev = 1;
if($page_next > $max_pages) $page_next = $max_pages;

//Selecting transactions
$st = $connection->query("SELECT * FROM `payback_transactions` ORDER BY `date` DESC LIMIT $from, $to");
if($st) {
  $st->setFetchMode(PDO::FETCH_NAMED);
  while ($row = $st->fetch())
    $ransactions[] = $row;
  $st->closeCursor();
}

//Balance
$balance = emercoin::getAllBalance();

//Module
$module = 'transactions';

require dirname(__FILE__).'/templates/transactions.php';