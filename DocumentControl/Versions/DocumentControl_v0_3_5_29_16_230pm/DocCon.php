<?php
require ("config.php");
$Date = date("m_d_y");
$Time = date("F j, Y, g:i a"); 
$LogLoc = $InstLoc.'/AppLogs';
$SesLogDir = $LogLoc.'/'.$Date;
$PrefixArr = array($SOPre, $WOPre, $POPre, $CERTPre, $InspPre, $PrintPre);
$SuffixArr = array($SOSuf, $WOSuf, $POSuf, $CERTSuf, $InspSuf, $PrintSuf);
$FirstCCArr = array($SOC1, $WOC1, $POC1, $PrC1);
$SecondCCArr = array($SOC2, $WOC2, $POC2, $PrC2);

if (!file_exists($LogLoc)) {
    mkdir($LogLoc, 0755); }
if (file_exists($LogLoc)) {
  if (!file_exists($SesLogDir)) {
    mkdir($SesLogDir, 0755); } }

function EnableClamAV() {
  if ($VirusScan == '1') {
    shell_exec(freshclam); } 
    return '1'; }

  if ($Online == '') {
    $txt = ('ERROR DC28, '.$Time.', You have not yet setup the DocumentControl configuration file! Please 
      view and completely fill-out the settings or config.php file in your root DocumentControl
      directory.') ;
    $myfile = file_put_contents($SesLogDir.'/'.$Date.'.txt', $txt.PHP_EOL , FILE_APPEND);
    die (' ERROR DC28, '.$Time.', You have not yet setup the DocumentControl configuration file! Please 
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
    $txt = ('Error DC48, There was a problem verifying '.$InputLoc.' as an Input Location. Please double check that the 
    directory exists or that the DocumentControl config file and settings are correct.') ;
    $myfile = file_put_contents($SesLogDir.'/'.$Date.'.txt', $txt.PHP_EOL , FILE_APPEND);
  die('Error DC48, There was a problem verifying '.$InputLoc.' as an Input Location. Please double check that the 
    directory exists or that the DocumentControl config file and settings are correct.'); }
if (!file_exists($OutputLoc)) {
    $txt = ('Error DC54, There was a problem verifying '.$InputLoc.' as an Input Location. Please double check that the 
    directory exists or that the DocumentControl config file and settings are correct.') ;
    $myfile = file_put_contents($SesLogDir.'/'.$Date.'.txt', $txt.PHP_EOL , FILE_APPEND);
  die('ERROR DC54, There was a problem verifying '.$OutputLoc.' as an Output Location. Please double check that the 
    directory exists or that the DocumentControl config file and settings are correct.'); }
if ($AutoBackup == '1') {
  if (!file_exists($BackupLoc)) {
    $txt = ('ERROR DC61, There was a problem verifying '.$BackupLoc.' as a Backup Location. Please double check that the 
      directory exists or that the DocumentControl config file and settings are correct.') ;
    $myfile = file_put_contents($SesLogDir.'/'.$Date.'.txt', $txt.PHP_EOL , FILE_APPEND);
    die('ERROR DC61, There was a problem verifying '.$BackupLoc.' as a Backup Location. Please double check that the 
      directory exists or that the DocumentControl config file and settings are correct.'); } }
if ($CleanConfig !== '1') {
    $txt = ('ERROR DC67, There was a problem verifying '.$BackupLoc.' as a Backup Location. Please double check that the 
      directory exists or that the DocumentControl config file and settings are correct.') ;
    $myfile = file_put_contents($SesLogDir.'/'.$Date.'.txt', $txt.PHP_EOL , FILE_APPEND);
  die (' ERROR DC67, '.$Time.', DocumentControl could not validate the configuration file! 
    Please verify the application settings and try again. The application has been halted. '); }

$Files = scandir($InputLoc);
$ClamLog = ($InstLoc.'/'.'VirusLogs'.'/'.$Date.'.txt');
if ($VirusScan == '1') {
  if (file_exists($InputLoc)) {
  shell_exec("sudo clamscan -r $InputLoc | grep FOUND >> $ClamLog"); }
  if (!file_exists($InputLoc)) {  
    $txt = ('ERROR DC78, '.$Time.', There was an error during a routine scan. Please check the Input Location setting and try again. The operation has been haulted.') ;
    $myfile = file_put_contents($SesLogDir.'/'.$Date.'.txt', $txt.PHP_EOL , FILE_APPEND);
  die(' ERROR DC78, '.$Time.', There was an error during a routine scan. Please check the Input Location setting and try again. The operation has been haulted. ');
 if( strpos(file_get_contents("$ClamLog"),'FOUND') !== false) {
    $txt = ('!!! WARNING !!! DC83, '.$Time.', DocumentControl detected potentially infected files during a routine scan. 
      Please check the VirusLogs and remove or clean the infected file before running the application again.') ;
    $myfile = file_put_contents($SesLogDir.'/'.$Date.'.txt', $txt.PHP_EOL , FILE_APPEND);
    die(' !!! WARNING !!! DC83, '.$Time.', DocumentControl detected potentially infected files during a routine scan. 
      Please check the VirusLogs and remove or clean the infected file before running the application again. '); } } }

$FileCount = 0;
if (count(glob("path/*")) === 0 ) {
    $txt = ('Operation Complete! Processed '.$FileCount.' files on '.$Time.'. DC90.') ;
    $myfile = file_put_contents($SesLogDir.'/'.$Date.'.txt', $txt.PHP_EOL , FILE_APPEND);
  die(' Operation Complete! Processed '.$FileCount.' files on '.$Time.'. DC90. '); }

foreach ($Files as $File) {
$PathInfo = pathinfo("$File");
$FileName = $PathInfo['filename'];
$FileType = $PathInfo['filetype'];
$FileCount++;
$Matches = preg_grep ($FileName, $PrefixArr);
  if (in_array('SO',$PrefixArr)) { 
    $FileName1 = preg_replace('so', '', $FileName);
    $SONum = substr($FileName1,0,$SOC1);
    $SO = 'SO'.$SONum;
    $SORestRaw = preg_replace($SONum, '', $FileName1);
    $SORestRaw = preg_replace($SOSuf, '', $SORestRaw);
    if (preg_match($INSepChar, $SORestRaw)) { 
      $SOLineNum = preg_replace($INSepChar, '', $SORestRaw); }
    elseif (!preg_match($INSepChar, $SORestRaw)) {
    	if ($SORestRaw !== '') {
    	  $SOLineNum = $SORestRaw; }
    	if ($SORestRaw == '') {
    	  $SOLineNum = '1'; } }
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
elseif ($SOSuf !== '') { 
  $CleanSuf = $OUTSepChar.$SOSuf; }
  $NEWFileName = ('SO'.$SONum.$OUTSepChar.$SOLineNum.'.'.$CleanSuf.$FileType);
  $NEWPathName = $OuputLoc.'/'.$SONum.'/'.$NEWFileName;
  $NEWPathName1 = $OuputLoc.'/'.$SONum;
  if (!file_exists($NEWPathName1)) {
    mkdir ($NEWPathName1, 0755); 
    echo nl2br("/nCreated $NEWPathName1 on $Time".'.'."/n"); }
    $txt = ('OP-Act: '."Creted $NEWPathName1 on $Time".'.');
    $myfile = file_put_contents($SesLogDir.'/'.$Date.'.txt', $txt.PHP_EOL , FILE_APPEND);
  $COPY_IT = rename($PathName, $NEWPathName);
    $txt = ('OP-Act: '."Copied $FileName to $NEWPathName on $Time".'.');
    $myfile = file_put_contents($SesLogDir.'/'.$Date.'.txt', $txt.PHP_EOL , FILE_APPEND); 
  echo nl2br("/nCopied $FileName to $NEWPathName on $Time".'.'."/n"); }  } 

if (count(glob("path/*")) === 0 ) {
    $txt = ('Operation Complete! Processed '.$FileCount.' files on '.$Time.'. DC141.');
    $myfile = file_put_contents($SesLogDir.'/'.$Date.'.txt', $txt.PHP_EOL , FILE_APPEND); 
  die(' Operation Complete! Processed '.$FileCount.' files on '.$Time.'. DC141. '); }

?>

    <div class="end">
