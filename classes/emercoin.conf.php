<?php
emercoin::$username = 'user';
emercoin::$password = 'password';
emercoin::$get_order_id = function() {
  return $_SESSION['order_id'];
};
emercoin::$get_order_ammount = function() {
  return $_SESSION['order_ammount'];
};