<?php
require 'jsonRPCclient.php';
/**
 * EMERCOIN (EMC) payment gateway
 */

/**
 * self payment
 *
 * @author 
 */
class emercoin {
  public static $username = '';
  public static $password = '';
  public static $address = 'localhost';
  public static $port = '8332';
  public static $account_prefix = 'emc_terminal_';
  /**
   * The function, which returns current order ID which is usualy stored in session
   * @var integer 
   */
  public static $get_order_id;
  /**
   * The function, which returns current order ammount (EMC) which is usualy stored in session
   * @var decimal 
   */
  public static $get_order_ammount;
  public static $rpcClient;
  public static $emercoin_info;
  public static $debug = false;
  
  /**
   * Returns an object containing various state info.
   * @return array 
   */
  public static function getinfo() {
    $url = self::$username.':'.self::$password.'@'.self::$address.':'.self::$port.'/';
    self::$rpcClient = new jsonRPCClient($url, self::$debug);
    return self::$emercoin_info = self::$rpcClient->getinfo();
  }
  
  /**
   * Function creates new account and returns it's address to recieve payments
   * The account name is saved as "self::$account_prefix+_+self::$get_order_id()"
   * @return account Payment address
   */
  public static function createPaymentAddress() {
    $url = self::$username.':'.self::$password.'@'.self::$address.':'.self::$port.'/';
    self::$rpcClient = new jsonRPCClient($url, self::$debug);
    
    self::$emercoin_info = self::$rpcClient->getinfo();
    
    if(!is_callable(self::$get_order_id)) {
      throw new Exception('Property self::$get_order_id must be callable');
    }
    $account = self::$account_prefix.'_'.call_user_func(self::$get_order_id);
    return self::$rpcClient->getaccountaddress($account);
  }
  
  /**
   * The function compares the current account ammount of EMC and
   * current order ammount of EMC and returns TRUE if 
   * (account ammount) >= (order ammount)
   * The account name is "self::$account_prefix+_+self::$get_order_id()"
   * The order ammount is stored in self::$get_order_ammount()
   * @return boolean
   * @throws Exception
   */
  public static function confirmPayment() {
    $url = self::$username.':'.self::$password.'@'.self::$address.':'.self::$port.'/';
    self::$rpcClient = new jsonRPCClient($url, self::$debug);
    
    self::$emercoin_info = self::$rpcClient->getinfo();
    
    if(!is_callable(self::$get_order_id)) {
      throw new Exception('Property self::$get_order_id must be callable');
    }
    $account = self::$account_prefix.'_'.call_user_func(self::$get_order_id);
    
    if(!is_callable(self::$get_order_ammount)) {
      throw new Exception('Property self::$get_order_ammount must be callable');
    }
    $order_ammount = call_user_func(self::$get_order_ammount);
    
    
		try {
      $received_amount = self::$rpcClient->getreceivedbyaccount($account,0);
		} catch (Exception $e) {
			echo false;
		}
		if((float)$received_amount >= (float)$order_ammount) {
			return true;
		}
		else {
			return false;
		}
  }
}