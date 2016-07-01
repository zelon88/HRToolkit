<?php
// SECRET: Define the ServerID here to enable the CallForHelp feature. 

// SECRET:  ----------------------------------------------
// SECRET: The server ID of the server is defined below.
// SECRET: See below for an example with serverID D620 
$serverID = 'D620';
// SECRET:  ----------------------------------------------

if (isset($_POST['serverIDCFH'])) {
  $serverIDCFH = $_POST['$serverIDCFH'];
  $display_name = $_POST['display_name'];
  $user_ID = $_POST['user_ID'];
  $sesID = $_POST['sesID'];
  $day = date("d");
  $serverIDhash = hash('sha1', $serverID.$sesID.$day); 
  $sesLogfile = ('/HRAI/sesLogs/'.$user_ID.'/'.$sesID.'/'.$sesID.'.txt'); 
// SECRET: If the server ID hash matches the sha1 hash of the current server ID + the sesID + the day of the month, 
// SECRET: we continue processing the call for help request.
if ($serverIDhash == hash('sha1', $serverID.$sesID.$day)) {
echo nl2br("This server has requested assistance. Searching for online nodes... \r");
  $sesLogfileO = fopen("$sesLogfile", "a+");
  $txt = ('CallForHelp: Server reequests assistance on '.$date.'. Aquiring nodes. ');
  $compLogfile = file_put_contents($sesLogfile, $txt.PHP_EOL , FILE_APPEND); 
  $CallForHelp = getNode('http://192.168.1.2');
  echo nl2br("   Checking  http://192.168.1.2 \r");
  if ($CallForHelp == 0) {
  echo nl2br("   Checking  http://192.168.1.3 \r");
  $CallForHelp = getNode('http://192.168.1.3');
  if ($CallForHelp == 0) {
  echo nl2br("   Checking  http://192.168.1.4 \r");
  $CallForHelp = getNode('http://192.168.1.4');
  if ($CallForHelp == 0) {
  echo nl2br("   Checking  http://192.168.1.5 \r");
  $CallForHelp = getNode('http://192.168.1.5');
  if ($CallForHelp == 0) {
  echo nl2br("   Checking  http://192.168.1.6 \r");
  $CallForHelp = getNode('http://192.168.1.6');
  if ($CallForHelp == 0) {
  echo nl2br("   Checking  http://192.168.1.7 \r");
  $CallForHelp = getNode('http://192.168.1.7');
  if ($CallForHelp == 0) {
  echo nl2br("   Checking  http://192.168.1.8 \r");
  $CallForHelp = getNode('http://192.168.1.8');
  if ($CallForHelp == 0) {
  echo nl2br("   Checking  http://192.168.1.9 \r");
  $CallForHelp = getNode('http://192.168.1.9');
  if ($CallForHelp == 0) {
    echo nl2br("   Checking  http://192.168.1.10 \r");
    $CallForHelp = getNode('http://192.168.1.10'); 
  // / If we cannot find other servers to help us we keep going anyway.
    $sesLogfileO = fopen("$sesLogfile", "a+");
    echo nl2br("  No nodes found on local network. \r");
    echo nl2br("  Continuing with limited resources. \r");
    $txt = ('CallForHelp: Tried 9 common addresses on local network on '.$date.'. Found no HRAI servers. Continuing with limited resources... ');
    $compLogfile = file_put_contents($sesLogfile, $txt.PHP_EOL , FILE_APPEND); } } } } } } } } } }  