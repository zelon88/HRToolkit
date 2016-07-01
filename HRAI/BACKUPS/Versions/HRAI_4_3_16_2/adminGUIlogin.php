<?php 


session_start();
// SECRET: ----------------------------------
// SECRET: Admin Display Name ...
  $display_name = 'Justin';
// SECRET: ----------------------------------

$coreFuncfile = '/var/www/html/HRProprietary/HRAI/coreFunc.php';
$adminGUI = '/var/www/html/HRProprietary/HRAI/adminGUI.php';
$wpfile = '/var/www/html/wp-load.php';
require $coreFuncfile;
require $wpfile;
$DetectWordPress = DetectWordPress();
$user_ID = defineUser_ID();
$inputServerID = defineInputServerID();
$sesIDhash = hash('sha1', $display_name.$day);
$sesID = substr($sesIDhash, -7);
$sesLogfile = ('/HRAI/sesLogs/'.$user_ID.'/'.$sesID.'/'.$sesID.'.txt');
$CreateSesDir = forceCreateSesDir();  ?> 
<form action="/HRProprietary/HRAI/adminGUI.php" method="post">
	<p>Username: <input type="text" name="adunm" value=""></p>
	<p>Password: <input type="password" name="adpwd" value=""></p>
	<p><input type="submit" value="Start Core!"></p>
  <input type="hidden" name="user_ID" value="<?php echo $user_ID;?>">
  <input type="hidden" name="display_name" value="<?php echo $display_name;?>">
  <input type="hidden" name="sesID" value="<?php echo $sesID;?>">

</form>