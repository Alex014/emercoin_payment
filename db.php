<?php
//Connecting
$connection = new PDO("mysql:host=localhost;dbname=emercoin", 'root', 'root');
$connection->query('SET NAMES "utf8"');

//Starting DB-based session
require(dirname(__FILE__).'/classes/session.php');
$session = new session($connection, 'session');