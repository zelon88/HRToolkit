<?php
// / This file contains the variables required to run core.php. These may be useful if they are required 
// / elsewhere, or if there is a problem and we would have undefined variables. Anything that would otherwise
// / be calculated by core.php or another required or included script will have an optimized default set here.
// / In the event of a missing var elsewhere in HRAI, these defaults should do the trick. For example, in a 
// / default situation where the core.php could not access it's own vars, the $CallForHelp variable here is
// / automatically set to 0, which will find us another available node to offload this servers workload. 
// /
// / We will include all our vars, but barely any includes or requires. There are no functions and barely
// / any logic in this script. 
$langParserfile = '/var/www/html/HRProprietary/HRAI/langPar.php';
$onlineFile = '/var/www/html/HRProprietary/HRAI/online.php';
$coreVarfile = '/var/www/html/HRProprietary/HRAI/coreVar.php';
$coreArrfile = '/var/www/html/HRProprietary/HRAI/coreArr.php';
$nodeCache = '/var/www/html/HRProprietary/HRAI/Cache/nodeCache.php';
$sesLogfile = ('/HRAI/sesLogs/'.$user_ID.'/'.$sesID.'/'.$sesID.'.txt');
$wpfile = '/var/www/html/wp-load.php';
$date = date("F j, Y, g:i a");
$day = date("d");
$sesIDhash = hash('sha1', $date);
$sesID = substr($sesIDhash, -7);
$sesLogfileO = fopen("$sesLogfile", "a+");
$txt = 'coreVarfile: Loaded sucessfully! ';
$compLogfile = file_put_contents($sesLogfile, $txt.PHP_EOL , FILE_APPEND); 
include_once $onlineFile;
$nodeCount = getNetStat();
// / $CallForHelp   0 = Automatically call for help.  1 = Don't automatically call for help.
$CallForHelp = 0;
// / $getServBusy automatically assumes that the server is idle. This avoids a potential loop in core.php
// / where the server could potentially keep calling for help. For good measure, always match this var with
// / $CallForHelp, just-in-case.
$getServBusy = 0;

// / In order to correctly create and log sessions, and to provide learning based on userID we need to validate
// / WordPress. This simple logic will determine if the server runs WordPress, and will get some special vars if
// / it does. If it does not, we will define these vars with constants, just-in-case.
if (file_exists($wpfile)){
  $wp_Userinfo = get_currentuserinfo();
  $user_ID = get_current_user_id(); }

elseif (!file_exists($wpfile)){
  $user_ID = 0; 
  $userSupname = $_POST['display_name'];
  $display_name = $userSupname; }









// / Everything and anything below this line is machine created code.