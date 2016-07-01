<!DOCTYPE html>
<html>
<head>
<title>DocumentControl | Controller </title>
<link rel="stylesheet" type="text/css" href="DocConCSS.css">
</head>
<body>
<div>
<?php
require ("config.php");
include ($InstLoc.'/AppCache/SysCache.php');
$Date = date("m_d_y");
$Time = date("F j, Y, g:i a"); 
$LogLoc = $InstLoc.'/AppLogs';
$LogInc = 0;
$SesLogDir = $LogLoc.'/'.$Date;
$LogFile = ($SesLogDir.'/'.$Date.'_'.$LogInc.'.txt');
if (!file_exists($SesLogDir)) {
$JICInstallLogs = @mkdir($SesLogDir, 0755); }
if (!file_exists($LogLoc)) { 
$JICInstallLogs = @mkdir($LogLoc, 0755); }
$JICTouchInstallLogFile = @touch($SesLogDir.'/'.$Date.'_'.$LogInc.'.txt');
$PrefixArr = array($SOPre, $WOPre, $POPre, $CERTPre, $InspPre, $PrintPre);
$SuffixArr = array($SOSuf, $WOSuf, $POSuf, $CERTSuf, $InspSuf, $PrintSuf);
$FirstCCArr = array($SOC1, $WOC1, $POC1, $PrC1);
$SecondCCArr = array($SOC2, $WOC2, $POC2, $PrC2);

if (isset ($_POST['ReProcActionItems'])) {
  unset($InputLoc);
  $InputLoc = $ActionLoc; }
if (!file_exists($LogLoc)) {
  mkdir($LogLoc, 0755); }
if (file_exists($LogFile)) {
  $LogFile = ($SesLogDir.'/'.$Date.'_'.$LogInc.'.txt');  
  while (file_exists($SesLogDir.'/'.$Date.'_'.(++$LogInc).'.txt')); }


function EnableClamAV() {
  if ($VirusScan == '1') {
    shell_exec(freshclam); } 
    return '1'; }

  if ($Online == '') {
    $txt = ('ERROR DC37, '.$Time.', You have not yet setup the DocumentControl configuration file! Please 
      view and completely fill-out the settings or config.php file in your root DocumentControl
      directory.');
    $LogFile = file_put_contents($SesLogDir.'/'.'_'.$LogInc.'.txt', $txt.PHP_EOL , FILE_APPEND);
    die (' ERROR DC37, '.$Time.', You have not yet setup the DocumentControl configuration file! Please 
      view and completely fill-out the settings or config.php file in your root DocumentControl
      directory. '); }
  if ($Online == '0') { 
    $CleanConfig = '1';
    $INTIP = 'localhost';
    $EXTIP = 'localhost'; }
  elseif ($Online !== '0') {
    $CleanConfig = '1';
    $INTIP = $InternalIP; 
    $EXTIP = $ExternalIP; }
  if (isset ($InternalIP)) { 
    unset ($InternalIP); }
  if (isset ($ExternalIP)) { 
    unset ($ExternalIP); }  

if (!file_exists($InputLoc)) {
    $txt = ('Error DC57, There was a problem verifying '.$InputLoc.' as an Input Location. Please double check that the 
    directory exists or that the DocumentControl config file and settings are correct.') ;
    $LogFile = file_put_contents($SesLogDir.'/'.$Date.'_'.$LogInc.'.txt', $txt.PHP_EOL , FILE_APPEND);
  die('Error DC57, There was a problem verifying '.$InputLoc.' as an Input Location. Please double check that the 
    directory exists or that the DocumentControl config file and settings are correct.'); }
if (!file_exists($OutputLoc)) {
    $txt = ('Error DC63, There was a problem verifying '.$OutputLoc.' as an Output Location. Please double check that the 
    directory exists or that the DocumentControl config file and settings are correct.') ;
    $LogFile = file_put_contents($SesLogDir.'/'.$Date.'_'.$LogInc.'.txt', $txt.PHP_EOL , FILE_APPEND);
  die('ERROR DC63, There was a problem verifying '.$OutputLoc.' as an Output Location. Please double check that the 
    directory exists or that the DocumentControl config file and settings are correct.'); }
if ($AutoBackup == '1') {
  if (!file_exists($BackupLoc)) {
    $txt = ('ERROR DC70, There was a problem verifying '.$BackupLoc.' as a Backup Location. Please double check that the 
      directory exists or that the DocumentControl config file and settings are correct.') ;
    $LogFile = file_put_contents($SesLogDir.'/'.$Date.'_'.$LogInc.'.txt', $txt.PHP_EOL , FILE_APPEND);
    die('ERROR DC70, There was a problem verifying '.$BackupLoc.' as a Backup Location. Please double check that the 
      directory exists or that the DocumentControl config file and settings are correct.'); } }
if ($CleanConfig !== '1') {
    $txt = ('ERROR DC76, There was a problem verifying '.$BackupLoc.' as a Backup Location. Please double check that the 
      directory exists or that the DocumentControl config file and settings are correct.') ;
    $LogFilee = file_put_contents($SesLogDir.'/'.$Date.'_'.$LogInc.'.txt', $txt.PHP_EOL , FILE_APPEND);
  die (' ERROR DC76, '.$Time.', DocumentControl could not validate the configuration file! 
    Please verify the application settings and try again. The application has been halted. '); }

if (isset($_POST['ProcPending'])) { 
  $Files = scandir($InputLoc); } 

elseif (isset($_POST['ReProcActionItems'])) {
  $InputLoc = $ActionLoc; 
  $Files = scandir($ActionLoc); }

elseif (!(isset($_POST['ProcPending'])) or !(isset($_POST['ReProcActionItems']))) { 
  $Files = scandir($InputLoc); }

$ClamLog = ($InstLoc.'/'.'VirusLogs'.'/'.$Date.'.txt');
if ($VirusScan == '1') {
  if (file_exists($InputLoc)) {
  shell_exec("clamscan -r $InputLoc | grep FOUND >> $ClamLog"); }
  if (!file_exists($InputLoc)) {  
    $txt = ('ERROR DC87, '.$Time.', There was an error during a routine scan. Please check the Input Location setting and try again. The operation has been haulted.') ;
    $LogFile = file_put_contents($SesLogDir.'/'.$Date.'_'.$LogInc.'.txt', $txt.PHP_EOL , FILE_APPEND);
  die(' ERROR DC87, '.$Time.', There was an error during a routine scan. Please check the Input Location setting and try again. The operation has been haulted. ');
 if( strpos(file_get_contents("$ClamLog"),'FOUND') !== false) {
    $txt = ('!!! WARNING !!! DC92, '.$Time.', DocumentControl detected potentially infected files during a routine scan. 
      Please check the VirusLogs and remove or clean the infected file before running the application again. THE INFECTED FILE WAS !!! NOT !!! AUTO-REMOVED!!!') ;
    $LogFile = file_put_contents($SesLogDir.'/'.$Date.'_'.$LogInc.'.txt', $txt.PHP_EOL , FILE_APPEND);
    die(' !!! WARNING !!! DC92, '.$Time.', DocumentControl detected potentially infected files during a routine scan. 
      Please check the VirusLogs and remove or clean the infected file before running the application again. '); } } }
$FileCount = 0;
foreach ($Files as $File) {

$PathName = pathinfo($File, PATHINFO_FILENAME);
$FileName =  pathinfo($File, PATHINFO_BASENAME); 
$FileType =  pathinfo($File, PATHINFO_EXTENSION); 
$First2 = substr($File, 0,2); 
  if (in_array($First2,$PrefixArr)) { 
    $FileCount++;
    if ($First2 == $SOPre) {
    $FileName1 = preg_replace('/so/', '', $FileName); 
    $SONum = substr($FileName1,0,$SOC1);
    $SO = 'SO'.$SONum;
    $SORestRaw = preg_replace("/$SONum/", '', $FileName1);
    $SORestRaw = preg_replace("/$SOSuf/", '', $SORestRaw);
    if (preg_match("/$INSepChar/", $SORestRaw)) { 
      $SOLineNum = preg_replace("/$INSepChar/", '', $SORestRaw); }
    elseif (!preg_match("/$INSepChar/", $SORestRaw)) {
    	if ($SORestRaw !== '') {
    	  $SOLineNum = $SORestRaw; }
    	if ($SORestRaw == '') {
    	  $SOLineNum = '1'; } } }
//if ($ENABLE_MYSQL == '1') {
// / STILL UNDER DEVELOPMENT !!!
  // / We use the infornation we have to gather more information from MySQL. 
//$OPEN_SQL = mysqli_connect("$DBAdr", "DBUser", "DBPass", "DBName");
  //if (mysqli_connect_errno()) {
   // printf("Connect failed: %s\n", mysqli_connect_error());
   // exit(); } 
//$SODataRaw = (($OPEN_SQL->query("SELECT $SO FROM SO"));
//$CLOSE_SQL->close(); }
/// / ------------------------------
if ($SOSuf == '') {
  $CleanSuf = ''; }
if ($SOSuf !== '') { 
  $CleanSuf = $OUTSepChar.$SOSuf; }
  $NEWFileName = ('SO'.$SONum.$OUTSepChar.$SOLineNum.'.'.$CleanSuf.$FileType);
  $NEWPathName = $OutputLoc.'/'.$SO.'/'.$NEWFileName;
  $NEWPathName1 = $OutputLoc.'/'.$SO;
  $F1 = pathinfo($File, PATHINFO_FILENAME);
  $F2 = pathinfo($File, PATHINFO_EXTENSION);
  $PathName = ($InputLoc.'/'.$F1.'.'.$F2);
  if (!file_exists($NEWPathName1)) {
    mkdir ($NEWPathName1, 0755); 
    echo nl2br("CREATED: \n$NEWPathName1 \non $Time".'.'."\n"); ?><hr /> <?php } 
    $txt = ('OP-Act: '."Created $NEWPathName1 on $Time".'.');
    $LogFile = file_put_contents($SesLogDir.'/'.$Date.'.txt', $txt.PHP_EOL , FILE_APPEND);
      if ($InputLoc == $ActionLoc) {
    $acttxt = ' action item '; }
      elseif ($InputLoc !== $ActionLoc) { 
    $acttxt = ' '; }
    $COPY_IT = rename($PathName, $NEWPathName);
    @chmod($NEWPathName, 0755);
    $txt = ('OP-Act: '."Copied$acttxt$FileName to $NEWPathName on $Time".'.');
    $LogFile = file_put_contents($SesLogDir.'/'.$Date.'_'.$LogInc.'.txt', $txt.PHP_EOL , FILE_APPEND); 
  echo nl2br("COPIED:$acttxt$FileName to \n$NEWPathName \non $Time".'.'."\n DC168"); ?><hr /> <?php } } 


$PendingActFileCount = 0;
$ActionFiles = scandir($InputLoc);
if (count($ActionFiles) > 0) {
  if ($InputLoc !== $ActionLoc) { 
foreach ($ActionFiles as $ActionFile) {
  if ($ActionFile == '.' or $ActionFile == '..') continue;
  if (is_dir($ActionFile)) continue;
    $PendingActFileCount++;
    $F1 = pathinfo($ActionFile, PATHINFO_FILENAME);
    $F2 = pathinfo($ActionFile, PATHINFO_EXTENSION);
    $PathName = ($InputLoc.'/'.$F1.'.'.$F2);
    $NEWFileName = ($F1.'.'.$F2);
    $NEWPathName = $ActionLoc.'/'.$NEWFileName;
    $COPY_IT = rename($PathName, $NEWPathName); } } } 

if (count(glob("$InputLoc/*")) == 0 ) {
    $txt = ('Control Operation Complete! Processed '.$FileCount.' files on '.$Time.'. DC159.');
    $LogFile = file_put_contents($SesLogDir.'/'.$Date.'_'.$LogInc.'.txt', $txt.PHP_EOL , FILE_APPEND); 
  echo nl2br("\n".'Control Operation Complete! Processed '.$FileCount.' files and created '.
    $PendingActFileCount.' action items on '.$Time.'. DC159. '."\n\n"); ?><hr /> <?php 
  die(); } 

?>
</div>
    <div class="end"></div>
</body>

</html>