<!DOCTYPE html>
<html>
<head>
<title>HRAI Admin Panel</title>
<link rel="stylesheet" type="text/css" href="http://localhost/HRProprietary/HRAI/HRAI.css">
</head></html>
<?php
session_start();
// SECRET: Set the default admin username, password and name here. HRAI requires these to be 
// SECRET: completely separate and independant from any other framework (like WordPress).

// /----------------------------------------------------------------------------------------
// SECRET: Admin Username ...
  $adunm1 = 'salad';
// SECRET: Admin Password ...
  $adpwd1 = 'tosser32';
// SECRET: Admin Display Name ...
  $display_name = 'Justin';
// /----------------------------------------------------------------------------------------

// SECRET: The very first thing we're going to do is verify the credentials being used to log in.
// SECRET: 
if (isset($_POST['adunm'])) {
  $adunm = $_POST['adunm'];
  if ($adunm !== $adunm1 ) {
    die ('The supplied Admin Username was incorrect.'); } }
elseif (!isset($_POST['adunm'])) {
  die ('The supplied Admin Username was blank.'); }

if (isset($_POST['adpwd'])) {
  $adpwd = $_POST['adpwd'];
  if ($adpwd !== $adpwd1 ) {
    die ('The supplied Admin Password was incorrect.'); } }
elseif (!isset($_POST['adpwd'])) {
  die ('The supplied Admin Password was incorrect.'); }


// SECRET: Variables ...
$coreFile = '/var/www/html/HRProprietary/HRAI/core.php';
$langParserfile = '/var/www/html/HRProprietary/HRAI/langPar.php';
$onlineFile = '/var/www/html/HRProprietary/HRAI/online.php';
$coreVarfile = '/var/www/html/HRProprietary/HRAI/coreVar.php';
$coreFuncfile = '/var/www/html/HRProprietary/HRAI/coreFunc.php';
$coreArrfile = '/var/www/html/HRProprietary/HRAI/coreArr.php';
$nodeCache = '/var/www/html/HRProprietary/HRAI/Cache/nodeCache.php';
$varCache = '/var/www/html/HRProprietary/HRAI/Cache/varCache.php';
$coreArrfile = '/var/www/html/HRProprietary/HRAI/coreArr.php';
$CallForHelpURL = '/var/www/html/HRProprietary/HRAI/CallForHelp.php';
$wpfile = '/var/www/html/wp-load.php';
$date = date("F j, Y, g:i a");
$day = date("d");
$dataScrub = '<!DOCTYPE html>
<html>
<head>
<title>HRAI Core</title>
</head></html>';

// SECRET: Functions ... 
function LOCALreadOutputOfPHPfile($aPHPfileORurl) {
  // / This function executes a PHP file and returns the output as the return variable.
  // / This function is also defined in coreVar, but to make the adminGUI more resiliant
  // / we define it here as well. This also improves performance.
ob_start(); // begin collecting output
include "$aPHPfileORurl";
$result = ob_get_clean(); // retrieve output from myfile.php, stop buffering
$varCache0 = '/var/www/html/HRProprietary/HRAI/Cache/varCache.php';
    $varCache1 = fopen("$varCache0", "a+");
    $txt = ('$result = '.$result);
    $compLogfile = file_put_contents($varCache0, $txt.PHP_EOL , FILE_APPEND); 
return $result; }

require $CallForHelpURL;
require $coreFuncfile;
$DetectWordPress = DetectWordPress();
$user_ID = $_POST['user_ID'];
$sesID = $_POST['sesID'];
$display_name = $_POST['display_name'];
$ForceCreateSesDir = forceCreateSesDir();
?>
    <div class="nav">
      <ul>
        <li class="home"><a href="#">Overview</a></li>
        <li class="tutorials"><a href="#">Server</a></li>
        <li class="about"><a href="#">Network</a></li>
        <li class="news"><a href="#">Settings</a></li>
        <li class="contact"><a href="#">Logs</a></li>
      </ul>
    </div>


<div align='center' ><?php echo '<h3>Welcome back, Commander!';?></h3></div>
<div align='center' ><h5><hr><?php echo 'ServerID: '.$serverID.'  |  Username: '.$display_name;?></h5></div>


<div style="float: left; ">
  <div style="float: center"><h4>Corefile Output:</h4></div>
  <iframe src="/HRProprietary/HRAI/core.php" name="core_iframer" width="300" height="350" scrolling="yes" margin-top:-4px; margin-left:-4px; border:double;></iframe>
  <form action="http://localhost/HRProprietary/HRAI/core.php" method="post" target="core_iframer">
  <input type="hidden" name="user_ID" value="<?php echo $user_ID;?>">
  <input type="hidden" name="sesID" value="<?php echo $sesID;?>">
  <input type="hidden" name="display_name" value="<?php echo $display_name;?>">
  <input type="text" name="input" id="input" value="<?php echo $input; ?>">
  <input type="submit" value="Submit to Core!"></form></div>

<div style="float: left; ">
  <div style="float: center"><h4>LanguageParser Output:</h4></div>
  <iframe src="/HRProprietary/HRAI/langPar.php" name="langpar_iframer" width="300" height="350" margin-top:-4px; margin-left:-4px; border:double;></iframe>
  <form action="http://localhost/HRProprietary/HRAI/langPar.php#end" method="post" target="langpar_iframer">
  <input type="hidden" name="user_ID" value="<?php echo $user_ID;?>">
  <input type="hidden" name="sesID" value="<?php echo $sesID;?>">
  <input type="hidden" name="display_name" value="<?php echo $display_name;?>">
  <input type="text" name="input" value="">
  <input type="submit" value="Submit to LangPar!"></form></div> </div>

</html>


