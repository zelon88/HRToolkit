<?php
$coreVarfile = '/var/www/html/HRProprietary/HRAI/coreVar.php';
require($coreVarfile);

// / If there was text inputted by the user we use that text for $input. If there was no text, or if the input field 
// / blank we use '0' for $input. 0 as an input will tell HRAI that we want to run background tasks like learning or
// / research or networking functions.

function defineUserInput() {
if(empty($_POST['input'])) {
  $input = '0'; } 
if(!empty($_POST['input'])) {
  $input = $_POST['input']; } 
return ($input); }

// / If no display name has been set we set this to 0 to avoid errors. We need a display name to generate a sesLog.
function defineDisplay_Name() {
if(empty($_POST['display_name'])) {
  $display_name = '0'; } 
if(!empty($_POST['display_name'])) {
  $display_name = $_POST['display_name']; }
  return ($display_name); }

// / If there is no user_ID we set this var to 0, which assumes either the user is not logged in or there is no WordPress.
// / Without this var we cannot generate a sesID.
function defineUser_ID() {
if(empty($_POST['user_ID'])) {
  $user_ID = '0'; } 
if(!empty($_POST['user_ID'])) {
  $user_ID = $_POST['user_ID']; }
  return ($user_ID); }

// / If there is no serverID we set the serverID to 0, which means localhost. This helps us track data that travels between
// / HRAI nodes.
function defineInputServerID() {
if(empty($_POST['serverID'])) {
  $inputServerID = '0'; } 
if(!empty($_POST['serverID'])) {
  $inputServerID = $_POST['serverID']; } 
  return ($inputServerID); }

function forceCreateSesID() {
$user_ID = defineUser_ID();
$display_name = defineDisplay_Name();
$day = date("d");
if(isset($_POST['sesID'])){
  $sesID = $_POST['sesID']; 
    if (empty($sesID)) {
      $sesIDhash = hash('sha1', $display_name.$day);
      $sesID = substr($sesIDhash, -7); } }
if(!isset($_POST['sesID'])){
  $sesIDhash = hash('sha1', $display_name.$day);
  $sesID = substr($sesIDhash, -7); } 
$sesLogfile = ('/HRAI/sesLogs/'.$user_ID.'/'.$sesID.'/'.$sesID.'.txt'); 
return ($sesID); }

// SECRET: This is to verify that the sesDir is authentic and up-to-date.
function authSesID() {
$user_ID = defineUser_ID();
$display_name = defineDisplay_Name();
$day = date("d");
if(isset($_POST['sesID'])){
  $sesID = $_POST['sesID']; 
    if (empty($sesID)) {
      $sesIDhash = hash('sha1', $display_name.$day);
      $sesID = substr($sesIDhash, -7); } }
if(!isset($_POST['sesID'])){
  $sesIDhash = hash('sha1', $display_name.$day);
  $sesID = substr($sesIDhash, -7); } 
$sesLogfile = ('/HRAI/sesLogs/'.$user_ID.'/'.$sesID.'/'.$sesID.'.txt'); 
  $sesIDhashAuth = hash('sha1', $display_name.$day);
  $sesIDAuth = substr($sesIDhashAuth, -7);  
if($sesID !== $sesIDAuth){
  $sesIDhash = hash('sha1', $display_name.$day);
  $sesID = substr($sesIDhash, -7); } 
$sesLogfile = ('/HRAI/sesLogs/'.$user_ID.'/'.$sesID.'/'.$sesID.'.txt'); 
return ($sesID); }



// / Get the session ID. If sesID is empty we post all vars to core.php to generate one, then post the data back
// / for processing. 
function getSesIDFromCore () {
  if(isset($_POST['sesID'])){
    $sesID = $_POST['sesID']; 
    if (empty($sesID)) {
      $dataArr = array('user_ID' =>  "$user_ID",
            'input' => "$input",
            'display_name' =>  '$display_name',
            'sesID' => '$sesID',
            'serverID' => '$serverID');
  $handle = curl_init($coreFile);
  curl_setopt($handle, CURLOPT_POST, true);
  curl_setopt($handle, CURLOPT_POSTFIELDS, $dataArr);
  curl_exec($handle);
  return(die('Sent data to coreFile to generate a session ID.') ); } } } 

// / Detect WordPress and require it if it is. Echo and log status when complete.
function detectWordPress() {
$wpfile = '/var/www/html/wp-load.php';
$date = date("F j, Y, g:i a");
$user_ID = defineUser_ID();
$display_name = defineDisplay_Name();
if (empty($sesID)) {
  $sesID = forceCreateSesID(); }
if (file_exists($wpfile)){
require_once($wpfile);
$sesLogfile = ('/HRAI/sesLogs/'."$user_ID".'/'."$sesID".'/'."$sesID".'.txt');
$txt = ('CoreAI: '."WordPress detected on $date ");
$compLogfile = file_put_contents($sesLogfile, $txt.PHP_EOL , FILE_APPEND); 
$txt = 'WordPress detected! '; }
elseif (!file_exists($wpfile)){
$sesLogfile = ('/HRAI/sesLogs/'."$user_ID".'/'."$sesID".'/'."$sesID".'.txt');
$txt = ('CoreAI: '."No WordPress detected on $date ");
$compLogfile = file_put_contents($sesLogfile, $txt.PHP_EOL , FILE_APPEND); 
$txt = 'No WordPress detected! '; }
return($txt); }

function forceCreateSesDir() {
$user_ID = defineUser_ID();
$input = defineUserInput();
$display_name = defineDisplay_Name();
$sesID = forceCreateSesID();
$day = date("d");
$date = date("F j, Y, g:i a");
$sesLogfile = ('/HRAI/sesLogs/'.$user_ID.'/'.$sesID.'/'.$sesID.'.txt');
if (!file_exists('/HRAI/sesLogs/'.$user_ID)){
mkdir(('/HRAI/sesLogs/'.$user_ID), 0755); }
if (!file_exists('/HRAI/sesLogs/'.$user_ID.'/'.$sesID)){
mkdir(('/HRAI/sesLogs/'.$user_ID.'/'.$sesID), 0755); 
echo 'Sucessfully generated session ID: '.$sesID.' ';}
$sesLogfile = ('/HRAI/sesLogs/'.$user_ID.'/'.$sesID.'/'.$sesID.'.txt');
 $sesLogfileO = fopen($sesLogfile, "w");
 $txt = ('CoreAI: '."User $display_name".','." $user_ID initiated $sesID with text $input on $date".'. Libraries loaded. Logfile created.');
 $compLogfile = file_put_contents($sesLogfile, $txt.PHP_EOL , FILE_APPEND); 
echo 'Using sesID: '.$sesID.' ';
// / Create a logfile for the session if none exists already.
if (!file_exists($sesLogfile)){
 $sesLogfileO = fopen("$sesLogfile", "a+");
 $txt = ('CoreAI: '."User $display_name".','." $user_ID initiated $sesID with text $input on $date".
       ' Libraries loaded. Logfile created, method 2. ');
 $compLogfile = file_put_contents($sesLogfile, $txt.PHP_EOL , FILE_APPEND); }
// / Double check that a logfile was created. Attempt another method if it was not. 
if (!file_exists($sesLogfile)){
 $sesLogfileO = fopen("$sesLogfile", "w");
 $txt = ('CoreAI: '."User $display_name".','." $user_ID initiated $sesID with text $input on $date".
       ' Libraries loaded. Logfile created, method 3. ');
 $compLogfile = file_put_contents($sesLogfile, $txt.PHP_EOL , FILE_APPEND); }
// / If a logfile still doesn't exist try making one with extra privilages.
if (!file_exists($sesLogfile)){
 mkdir('/HRAI/sesLogs/'."$user_ID".'/'."$sesID".'/'."$sesID".'.txt', 0755);
 $sesLogfile = ('/HRAI/sesLogs/'."$user_ID".'/'."$sesID".'/'."$sesID".'.txt');
 $txt = ('CoreAI: '."User $display_name".','." $user_ID initiated $sesID with text $input on $date".
         ' Libraries loaded. Logfile created, method 4. ');
 $compLogfile = file_put_contents($sesLogfile, $txt.PHP_EOL , FILE_APPEND); }
// / If we cannot establish a logfile we kill the script.
if (!file_exists($sesLogfile)){
 die('An internal error was encountered. I attempted to genereate a logfile for the session by several methods 
   and failed each time. I am sorry. Please try again later. '); } }

// / This function executes a PHP file and returns the output as the return variable.
function readOutputOfPHPfile($aPHPfileORurl) {
ob_start(); // begin collecting output
include "$aPHPfileORurl";
$varCache = '/var/www/html/Cache/varCache.php';
$result = ob_get_clean(); // retrieve output from myfile.php, stop buffering
    $varCache = fopen("$varCache", "a+");
    $txt = ('$result = '.$result);
    $compLogfile = file_put_contents($varCache, $txt.PHP_EOL , FILE_APPEND); 
return $result; }