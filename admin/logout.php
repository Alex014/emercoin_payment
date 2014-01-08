<?php
require dirname(__FILE__).'/../db.php';

unset($_SESSION['logged']);
header('location: index.php');