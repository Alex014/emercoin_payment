#EmerCoin payment example

This is an example of a payment gateway, which uses Emercoin (http://emercoin.com/) cryptocurrency

##Details

 The Emercoin client uses Remote Procedure Call to connect to **emercoind** daemon

 The client has 3 files located in **classes** folder: 
  * jsonRPCclient.php - RPC class file
  * emercoin.php - main class
  * emercoin.conf.php - config file

##Additions
  * Admin part in "admin" path contains an admin panel, where you can view transactions and take some coins out.
  * Run payout.php with **cron** for automatic pay-out

##Uses
  * jQuery http://jquery.com/
  * Bootstrap from twitter http://getbootstrap.com/