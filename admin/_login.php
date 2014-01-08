<? if(!isset($_SESSION['logged'])):?>

<?php
header("encoding: utf8;");

if(isset($_POST['password'])) {
  $st = $connection->query("SELECT `password` FROM payback_admin");
  if($st) {
    $st->setFetchMode(PDO::FETCH_NUM);
    if ($row = $st->fetch())
      $md5_password = trim($row[0]);
    $st->closeCursor();
  }
  
  if(!isset($md5_password)) {
    $err = 'Database error';
  }
  elseif($md5_password != md5(trim($_POST['password']))) {
    $err = 'Wrong password';
  }
  else{
    $err = false;
    $_SESSION['logged'] = true;
    ob_clean();
    header('location: /admin/index.php');
  }
}
?>

<?if(!isset($_POST['password']) || ($err !== false)):?>
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
  
  
    <div class="container" style="width: 400px;">
      
      <h1>Login</h1>
  
      <div class="well">
        <form method='post'>
          <div class="form-group">
            <label>
              Password
            </label>
            <input type="password" name='password' class="form-control">
          </div>
          <?if(isset($err)):?>
          <div class="alert  alert-danger">
            <p>
              <?=$err?>
            </p>
          </div>
          <?endif;?>
          <button type="submit" class="btn btn-default">
            Enter
          </button>
        </form>
      </div>
    </div>
  
</body>
</html>
<? endif;?>

<?php
?>
<? die(); endif;?>