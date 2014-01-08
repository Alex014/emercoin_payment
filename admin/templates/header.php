<?php
header("encoding: utf8;");
?>
<!DOCTYPE html>
<html lang="en">
  
<head>
  <meta charset="utf-8">
  <title>
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="/css/bootstrap.min.css" rel="stylesheet">
  <script src="/js/jquery.min.js"></script>
  <script src="/js/bootstrap.min.js"></script>
</head>

<body>
  <div class="container">
    <nav class="navbar navbar-default" role="navigation">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">ACCOUNT BALANCE: <?=$balance?> EMC</a>
      </div>
      <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav">
          <li <?if($module=='takeout'):?>class="active"<?endif;?>>
            <a href="/admin/takeout.php">Take Out</a>
          </li>
          <li <?if($module=='transactions'):?>class="active"<?endif;?>>
            <a href="/admin/transactions.php">Transactions</a>
          </li>
          <li <?if($module=='change_password'):?>class="active"<?endif;?>>
            <a href="/admin/change_password.php">Change password</a>
          </li>
          <li>
            <a href="/admin/logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </nav>
  </div>