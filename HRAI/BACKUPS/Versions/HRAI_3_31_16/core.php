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
$coreFuncfile = '/var/www/html/HRProprietary/HRAI/coreFunc.php';
$coreArrfile = '/var/www/html/HRProprietary/HRAI/coreArr.php';
$nodeCache = '/var/www/html/HRProprietary/HRAI/Cache/nodeCache.php';
$wpfile = '/var/www/html/wp-load.php';
$date = date("F j, Y, g:i a");
$day = date("d");

// / Load core AI files. Write an entry to the log if successful.
require_once($coreVarfile);
require_once($coreArrfile);
require_once($coreFuncfile);
include_once($onlineFile);
//require_once('$langParserfile');
//require_once('$langParVarfile');
//require_once('$langParArrfile');
echo nl2br("Sucessfully loaded library files. \r");

// / Set our Post data for the session. If blank we substitute defaults to avoid errors.
$display_name = defineDisplay_Name();
$user_ID = defineUser_ID();
$inputServerID = defineInputServerID();
$input = defineUserInput();
$DetectWordPress = detectWordPress();
echo nl2br($DetectWordPress."\r");
$CreateSesID = forceCreateSesID();
$CreateSesDir = forceCreateSesDir();
$sesLogfile = ('/HRAI/sesLogs/'.$user_ID.'/'.$sesID.'/'.$sesID.'.txt'); 
echo nl2br("\rSucessfully loaded core variables. \r");
echo nl2br("Sucessfully loaded core functions. \r");
echo nl2br("Sucessfully loaded core POST data. \r");

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
$serverStat = getServStat();
echo nl2br("Sucessfully loaded nodeCache. \r");
echo nl2br("Node Count is $nodeCount. \r");
echo nl2br("This server status is $serverStat. \r");
// / Write the nodeCount to the sesLogfile.
$sesLogfileO = fopen("$sesLogfile", "a+");
$txt = ('CoreAI: Loaded nodeCache, nodeCount is '.$nodeCount.' on '.$date.'. ');
$compLogfile = file_put_contents($sesLogfile, $txt.PHP_EOL , FILE_APPEND); 
// / Get the status of this server and write it to the sesLogfile.
$sesLogfileO = fopen("$sesLogfile", "a+");
$txt = ('CoreAI: Server status is '.$serverStat.' on '.$date.'. ');
$compLogfile = file_put_contents($sesLogfile, $txt.PHP_EOL , FILE_APPEND); 

// / Check to see if our server is busy. Find other nodes on the local network to help if so.
$getServBusy = getServBusy();
if ($getServBusy == 1) {
echo nl2br("This server reports it is busy! \r"); 
  $CallForHelpURL = '/var/www/html/HRProprietary/HRAI/CallForHelp.php';
          $dataArr = array('user_ID' => "$user_ID",
            'display_name' => "$display_name",
            'serverIDCFH' => "serverIDCFH",
            'sesID' => "$sesID", 
            'serverID' => "$serverID"); 
    $handle = curl_init($coreFile);
  curl_setopt($handle, CURLOPT_POST, true);
  curl_setopt($handle, CURLOPT_POSTFIELDS, $CallForHelp);
  curl_exec($handle);
    $sesLogfileO = fopen("$sesLogfile", "a+");
    $txt = ('CoreAI: Sent a CallForHelp request on '.$date.'. Continuing the script. ');
    $compLogfile = file_put_contents($sesLogfile, $txt.PHP_EOL , FILE_APPEND); }

if ($getServBusy = 0) { 
echo nl2br("This server reports it is idle. \r"); }

$cpuUseNow = getServCPUUseNow();
$servMemUse = getServMemUse();
$servPageUse = getServPageUse();
echo nl2br("Hello Emily!!! I love you!!!\r");
echo nl2br('CPU Usage: '.$cpuUseNow."\r"); 
echo nl2br('Mem Usage: '.$servMemUse);  
echo nl2br('Pagefile Usage: '.$servPageUse); 

?>







