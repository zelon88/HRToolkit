<!DOCTYPE html>
<html>
<head>
<title>DocumentControl | Application Settings</title>
<link rel="stylesheet" type="text/css" href="DocConCSS.css">
</head>
<body>
<script>
function goBack() {
    window.history.back(); }
</script>
<?php
require("config.php");
include($InstLoc.'/AppCache/SysCache.php');
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
$ClamLog = ($InstLoc.'/'.'VirusLogs'.'/'.$Date.'.txt');
$SaltHash = hash('ripemd160',$Salts);
$YUMMYSaltHash = $_POST['YUMMYSaltHash'];

if (!isset($YUMMYSaltHash)) {
  echo nl2br('!!! WARNING !!! SAS16, There was a critical security fault. Login Request Denied.'."\n"); 
  die("Application was halted on $Date".'.'); }
if ($YUMMYSaltHash !== $SaltHash) {
  echo nl2br('!!! WARNING !!! SAS19, There was a critical security fault. Login Request Denied.'."\n"); 
  die("Application was halted on $Date".'.'); }

$SysCache = "AppCache/SysCache.php";


if (isset($_POST['Scan'])) { ?>
<div align="center"><h3>Scan Complete!</h3></div>
<hr />
<?php
@shell_exec('sudo freshclam');
echo nl2br('Updated Virus Definitions.'."\n");
?><hr /><?php
shell_exec("clamscan -r $InputLoc | grep FOUND >> $ClamLog");
echo nl2br('Scanned Input Directory.'."\n");
?><hr /><?php
shell_exec("clamscan -r $OutputLoc | grep FOUND >> $ClamLog");
echo nl2br('Scanned Output Directory.'."\n");
?><hr /><?php
shell_exec("clamscan -r $ActionLoc | grep FOUND >> $ClamLog");
echo nl2br('Scanned Action Directory.'."\n");
?><hr /><?php
shell_exec("clamscan -r $InstLoc | grep FOUND >> $ClamLog");
echo nl2br('Scanned Installation Directory.'."\n");
?><hr /><?php
if ($AutoBackup == '1') {
  shell_exec("clamscan -r $BackupLoc | grep FOUND >> $ClamLog"); 
  echo nl2br('Scanned Backup Directory.'."\n"); 
  ?><hr /><?php }
if (filesize($ClamLog) > 1) {
  ?><br><div align="center"><?php
  echo nl2br('!!! WARNING !!! Potentially infected files found! s40'."\n");
  echo nl2br('DocumentControl DID NOT remove any files. Please see the report below or 
    the logs and verify each file before continuing to use Document Control.'."\n");
    ?><p><a href="<?php echo $ClamLog; ?>" target="DocConSum">View Infected Files Report</a></p> 
    <br>
    <button id='button' name='button' onclick="goBack()">Go Back</button>
    <br>
    <?php }
if (filesize($ClamLog) <= 1) {
  ?><br><div align="center"><?php
  echo nl2br('DocumentControl did not find any potentially infected files.'."\n"); ?>
    <br>
    <button id='button' name='button' onclick="goBack()">Go Back</button>
    <br>
    <?php } }  ?> 
<br>
<?php
if (!isset($_POST['Scan'])) {
if (isset($_POST['Save'])) {
  if (isset($_POST['NEWServerID'])) {
    $NEWServerID = $_POST['NEWServerID'];
    $txt = ('$UniqueServerName = \''.$NEWServerID.'\';') ;
    $WriteSetting = file_put_contents($SysCache, $txt.PHP_EOL , FILE_APPEND); 
    echo nl2br('Saved New Server Name.'."\n"); }
    ?>
<hr />
<?php
  if (isset($_POST['NEWInternalIP'])) {
    $NEWInternalIP = $_POST['NEWInternalIP'];
    $txt = ('$InternalIP = \''.$NEWInternalIP.'\';') ;
    $WriteSetting = file_put_contents($SysCache, $txt.PHP_EOL , FILE_APPEND); 
    echo nl2br('Saved New Internal IP.'."\n"); }
    ?>
<hr />
<?php
  if (isset($_POST['NEWExternalIP'])) {
    $NEWExternalIP = $_POST['NEWExternalIP'];
    $txt = ('$ExternalIP = \''.$NEWExternalIP.'\';') ;
    $WriteSetting = file_put_contents($SysCache, $txt.PHP_EOL , FILE_APPEND);
    echo nl2br('Saved New External IP.'."\n"); }
    ?>
<hr />
<?php
  if (isset($_POST['NEWURL'])) {
    $NEWURL = $_POST['NEWURL'];
    $txt = ('$URL = \''.$NEWURL.'\';') ;
    $WriteSetting = file_put_contents($SysCache, $txt.PHP_EOL , FILE_APPEND); 
    echo nl2br('Saved New Domain.'."\n"); }
    ?>
<hr />
<?php
  if (isset($_POST['NEWAutoBackup'])) {
    $NEWAutoBackup = $_POST['NEWAutoBackup'];
    $txt = ('$AutoBackup = \''.$NEWAutoBackup.'\';') ;
    $WriteSetting = file_put_contents($SysCache, $txt.PHP_EOL , FILE_APPEND); 
    echo nl2br('Saved New Backup Settings.'."\n"); }
    ?>
<hr />
<?php
  if (isset($_POST['NEWVirusScan'])) {
    $NEWVirusScan = $_POST['NEWVirusScan'];
    $txt = ('$VirusScan = \''.$NEWVirusScan.'\';') ;
    $WriteSetting = file_put_contents($SysCache, $txt.PHP_EOL , FILE_APPEND); 
    echo nl2br('Saved New Anti-Virus Settings.'."\n"); }
?>
<hr />
<?php
echo nl2br("\n".'All settings were saved & applied on '.$Time.'.'."\n"); }
if (isset($_POST['LoadDefaults'])) {
  require('config.php');
  $NEWServerName = $UniqueServerName;
  $txt = ('$UniqueServerName = \''.$NEWServerName.'\';') ;
  $WriteSetting = file_put_contents($SysCache, $txt.PHP_EOL , FILE_APPEND); 
  $NEWInternalIP = $InternalIP;
  $txt = ('$InternalIP = \''.$NEWInternalIP.'\';') ;
  $WriteSetting = file_put_contents($SysCache, $txt.PHP_EOL , FILE_APPEND); 
  $NEWExternalIP = $ExternalIP;
  $txt = ('$ExternalIP = \''.$NEWExternalIP.'\';') ;
  $WriteSetting = file_put_contents($SysCache, $txt.PHP_EOL , FILE_APPEND); 
  $NEWURL = $URL;
  $txt = ('$URL = \''.$NEWURL.'\';') ;
  $WriteSetting = file_put_contents($SysCache, $txt.PHP_EOL , FILE_APPEND); 
  $NEWAutoBackup = $AutoBackup;
  $txt = ('$AutoBackup = \''.$NEWAutoBackup.'\';') ;
  $WriteSetting = file_put_contents($SysCache, $txt.PHP_EOL , FILE_APPEND); 
  $NEWVirusScan = $VirusScan; 
  $txt = ('$VirusScan = \''.$NEWVirusScan.'\';') ;
  $WriteSetting = file_put_contents($SysCache, $txt.PHP_EOL , FILE_APPEND); 
  ?><div align="center"><?php echo nl2br("\n".'Reset "Application Settings" to default values on '.$Time.'.'."\n"); } } ?></div>
<br>
<hr />
<div id='end' name='end' class='end'></div>
</body>
</html>