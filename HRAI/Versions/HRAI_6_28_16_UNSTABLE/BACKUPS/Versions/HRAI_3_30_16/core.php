<!DOCTYPE html>
<html>
<head>
<title>HRAI Core</title>
</head></html>
<?php
session_start();
// SECRET: Get core AI files as well as array and variable libraries.
// SECRET: If we cannot locate $coreFile we kill the script. If we cannot locate library files
// SECRET: we continue the script but warn the user and do the best we can without them.
// SECRET: The nodeCache is where data about recent HRAI networks is stored. 
// SECRET: The $nodeCache is a machine generated file.
$langParserfile = '/var/www/html/HRProprietary/HRAI/langPar.php';
$onlineFile = '/var/www/html/HRProprietary/HRAI/online.php';
$coreVarfile = '/var/www/html/HRProprietary/HRAI/coreVar.php';
$coreArrfile = '/var/www/html/HRProprietary/HRAI/coreArr.php';
$nodeCache = '/var/www/html/HRProprietary/HRAI/Cache/nodeCache.php';
$wpfile = '/var/www/html/wp-load.php';
$date = date("F j, Y, g:i a");
$day = date("d");
//if(!file_exists($langParserfile)){ 
//  die('Sorry, I could not load my core AI language parsing files. My servers must be down. Please try again later'); }
if (!file_exists($coreArrfile)){
  echo ('There was a problem detecting my CoreAI array files, coreArr. My servers must be down. My responses may be limited or corrupt '); }
if (!file_exists($coreVarfile)){
  echo ('There was a problem detecting my CoreAI variable files, coreVar. My servers must be down. Using default core variables. Learning will be disabled for this session. My responses may be limited or corrupt. '); }

// / Set our Post data for the session. If blank we substitute defaults to avoid errors.
if(empty($_POST['input'])) {
  $input = '0'; } 
if(!empty($_POST['input'])) {
  $input = $_POST['input']; }
if(empty($_POST['display_name'])) {
  $display_name = '0'; } 
if(!empty($_POST['display_name'])) {
  $display_name = $_POST['display_name']; }
if(empty($_POST['user_ID'])) {
  $user_ID = '0'; } 
if(!empty($_POST['user_ID'])) {
  $user_ID = $_POST['user_ID']; }

// / Load core AI files. Write an entry to the log if successful.
require_once($coreVarfile);
require_once($coreArrfile);
include_once($onlineFile);
//require_once('$langParserfile');
//require_once('$langParVarfile');
//require_once('$langParArrfile');
echo 'Sucessfully loaded library files. ';
// / Detect WordPress and require it if it is. Echo status to the user when complete.
if (file_exists($wpfile)){
require_once($wpfile);
echo 'WordPress detected! '; }
elseif (!file_exists($wpfile)){
echo 'No WordPress detected! '; }

// SECRET: Establish a session with the user despite logged-in status, by any means necessary. 
// SECRET: Create a directory to store data obtained during the session.
// SECRET: Use a random key genererator for sesID generation. We must establish a session ID.
if(isset($_POST['sesID'])){
  $sesID = $_POST['sesID']; 
    if (empty($sesID)) {
      $sesIDhash = hash('sha1', $display_name.$day);
      $sesID = substr($sesIDhash, -7); } }
if(!isset($_POST['sesID'])){
  $sesIDhash = hash('sha1', $display_name.$day);
  $sesID = substr($sesIDhash, -7); }


if (!file_exists('/HRAI/sesLogs/'.$user_ID)){
mkdir(('/HRAI/sesLogs/'.$user_ID), 0755); }
if (!file_exists('/HRAI/sesLogs/'.$user_ID.'/'.$sesID)){
mkdir(('/HRAI/sesLogs/'.$user_ID.'/'.$sesID), 0755); }
$sesLogfile = ('/HRAI/sesLogs/'.$user_ID.'/'.$sesID.'/'.$sesID.'.txt');
 $sesLogfileO = fopen($sesLogfile, "w");
 $txt = ('CoreAI: '."User $display_name".','." $user_ID initiated $sesID with text $input on $date".'. Libraries loaded. Logfile created.');
 $compLogfile = file_put_contents($sesLogfile, $txt.PHP_EOL , FILE_APPEND); 
echo 'Sucessfully generated session ID: '.$sesID.' ';

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
 	 and failed each time. I am sorry. Please try again later. '); }

// / Re-define $sesLogFile as default. 
$sesLogfile = ('/HRAI/sesLogs/'."$user_ID".'/'."$sesID".'/'."$sesID".'.txt');

// / Detect WordPress and write it's prescence to the sesLog.
if (file_exists($wpfile)){
$sesLogfile = ('/HRAI/sesLogs/'."$user_ID".'/'."$sesID".'/'."$sesID".'.txt');
$txt = ('CoreAI: '."WordPress detected on $date ");
$compLogfile = file_put_contents($sesLogfile, $txt.PHP_EOL , FILE_APPEND); }
elseif (!file_exists($wpfile)){
$sesLogfile = ('/HRAI/sesLogs/'."$user_ID".'/'."$sesID".'/'."$sesID".'.txt');
 $txt = ('CoreAI: '."No WordPress detected on $date ");
 $compLogfile = file_put_contents($sesLogfile, $txt.PHP_EOL , FILE_APPEND); }

// / Write an entry to logfile if there was a problem loading library files.
if (!file_exists($coreArrfile)){
  $sesLogfile0 = fopen("$sesLogfile", "a+");
  $txt = ('CoreAI: '."User $display_name".','." $user_ID during $sesID on $date".'. ERROR: No coreArrfile 
  	      array file found. Continuing... ');
  $compLogfile = file_put_contents($sesLogfile, $txt.PHP_EOL , FILE_APPEND); }
if (!file_exists($coreVarfile)){
  $sesLogfile0 = fopen("$sesLogfile", "a+");
  $txt = ('CoreAI: '."User $display_name".','." $user_ID during $sesID on $date".'. ERROR: No coreVarfile 
  	      variable file found. Continuing... ');
  $compLogfile = file_put_contents($sesLogfile, $txt.PHP_EOL , FILE_APPEND); }

// / Check how many other HRAI servers are in the vicinity. Return number of servers.
include($nodeCache); 
// / Write the nodeCount to the sesLogfile.
$sesLogfileO = fopen("$sesLogfile", "a+");
$txt = ('CoreAI: Loaded nodeCache, nodeCount is '.$nodeCount.' on '.$date.'. ');
$compLogfile = file_put_contents($sesLogfile, $txt.PHP_EOL , FILE_APPEND); 
// / Get the status of this server and write it to the sesLogfile.
$sesLogfileO = fopen("$sesLogfile", "a+");
$txt = ('CoreAI: Server status is '.getServStat().' on '.$date.'. ');
$compLogfile = file_put_contents($sesLogfile, $txt.PHP_EOL , FILE_APPEND); 

// / Check to see if our server is busy. Find other nodes on the local network to help if so.
$getServBusy = getServBusy();
if ($getServBusy == 1) {
  $sesLogfileO = fopen("$sesLogfile", "a+");
  $txt = ('CoreAI: Server reports that it is low on resources on '.$date.'. Attempting to find more servers. ');
  $compLogfile = file_put_contents($sesLogfile, $txt.PHP_EOL , FILE_APPEND); 
  $CallForHelp = getNode('http://192.168.1.2');
  if ($CallForHelp == 0) {
  $CallForHelp = getNode('http://192.168.1.3');
  if ($CallForHelp == 0) {
  $CallForHelp = getNode('http://192.168.1.4');
  if ($CallForHelp == 0) {
  $CallForHelp = getNode('http://192.168.1.5');
  if ($CallForHelp == 0) {
  $CallForHelp = getNode('http://192.168.1.6');
  if ($CallForHelp == 0) {
  $CallForHelp = getNode('http://192.168.1.7');
  if ($CallForHelp == 0) {
  $CallForHelp = getNode('http://192.168.1.8');
  if ($CallForHelp == 0) {
  $CallForHelp = getNode('http://192.168.1.9');
  if ($CallForHelp == 0) {
    $CallForHelp = getNode('http://192.168.1.10'); 
  // / If we cannot find other servers to help us we keep going anyway.
    $sesLogfileO = fopen("$sesLogfile", "a+");
    $txt = ('CoreAI: Tried 9 common addresses on local network on '.$date.'. Found no HRAI servers. Continuing with limited resources... ');
    $compLogfile = file_put_contents($sesLogfile, $txt.PHP_EOL , FILE_APPEND); } } } } } } } } }
  if ($CallForHelp >= 1) {
    include_once $nodeCache; 
    $sesLogfileO = fopen("$sesLogfile", "a+");
    $txt = ('CoreAI: Tried common addresses on local network on '.$date.'. Found a free HRAI server. Adding node'.$nodeCount.' Continuing with expanded environment... ');
    $compLogfile = file_put_contents($sesLogfile, $txt.PHP_EOL , FILE_APPEND); 
    $newNode = ${"node".$nodeCount};
    $newNodeURL = ${"node".$nodeCount."URL"}; 
// / Put what to do if server is busy.
  }
if ($getServBusy == 0) { 
// / Put what to do if the server is not busy. 
}

$cpuUseNow = getServCPUUseNow();
echo $cpuUseNow; 
echo $newNode;
echo $newNodeURL;

?>






