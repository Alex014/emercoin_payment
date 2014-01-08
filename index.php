<?php
error_reporting(E_ALL^E_NOTICE^E_WARNING^E_STRICT^E_DEPRECATED);
ini_set("display_errors", true);

//Initializing database and session
require 'db.php';
header("encoding: utf8;");
global $connection;

//Selecting and displaying products
$st = $connection->query("SELECT * FROM products");
if($st) {
  $st->setFetchMode(PDO::FETCH_NAMED);
  while ($row = $st->fetch())
    $products[] = $row;
  $st->closeCursor();
}
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
  <h1>Shopping CART</h1>
  
  <form method="post">
    <table style="margin-top: 50px;">
      <tr>
        <th></th>
        <th align="center" colspan="2">Product</th>
        <th align="center">Price</th>
        <th align="center">Ammount</th>
      </tr>
      <?foreach($products as $product):?>
      <tr>
        <td> 
          <input name="products[<?=$product['id']?>][id]" type="checkbox"/> 
          <input name="products[<?=$product['id']?>][price]" value="<?=$product['price']?>" type="hidden"/>
        </td>
        <td> <img src="i/prod_<?=$product['id']?>.jpg" width="200"/> </td>
        <td> <?=$product['name']?> </td>
        <td style="padding-left: 100px;"> <?=$product['price']?> (EMC) </td>
        <td> <input name="products[<?=$product['id']?>][ammount]" value="1" type="text" style="width: 50px"/> </td>
      </tr>
      <?endforeach;?>
    </table>
    
    <input type="submit" value="BUY" class="btn btn-primary"/>
  </form>
</center>
</body>
</html>

<?php
//Saving current order
if(count($_POST) > 0) {
  $total_price = 0;
  foreach ($_POST['products'] as $id => $product) {
    if(isset($product['id'])) {
      $prods[$id] = $product['ammount'];
      $total_price += (double)((int)$product['ammount']*(double)$product['price']);
    }
  }
  
  if(count($prods) > 0) {
    foreach ($prods as $id => $ammount) {
      if(!isset($order_id)) {
        $connection->exec("INSERT INTO orders (price) VALUES ($total_price)");
        $order_id = $connection->lastInsertId('orders');
        //Saving order ID !!!
        $_SESSION['order_id'] = $order_id;
        //Saving order PRICE !!!
        $_SESSION['order_ammount'] = (double)$total_price;
      }
      
      $product_id = (int)$id;
      $ammount = (int)$ammount;
      $connection->exec("INSERT INTO orders_products (order_id, product_id, ammount) VALUES ($order_id, $product_id, $ammount)");
    }
    //Redirecting to payment gateway
    header('location: payment.php');
  }
  
}
?>