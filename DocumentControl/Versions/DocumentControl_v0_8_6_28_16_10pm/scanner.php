<!DOCTYPE html>
<html>
<head>
<title>DocumentControl | Virus Scanner </title>
<link rel="stylesheet" type="text/css" href="DocConCSS.css">
</head>
<body>
<div>

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
  echo nl2br('!!! WARNING !!! s29, There was a critical security fault. Scan Request Denied.'."\n"); 
  die("Application was halted on $Date".'.'); }
if ($YUMMYSaltHash !== $SaltHash) {
  echo nl2br('!!! WARNING !!! s32, There was a critical security fault. Scan Request Denied.'."\n"); 
  die("Application was halted on $Date".'.'); }

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
if (filesize($ClamLog > '1')) {
  ?><br><div align="center"><?php
  echo nl2br('!!! WARNING !!! Potentially infected files found! s40'."\n");
  echo nl2br('DocumentControl DID NOT remove any files. Please see the report below or 
  	the logs and verify each file before continuing to use Document Control.'."\n");
  	?><p><a href="<?php echo $ClamLog; ?>" target="DocConSum">View Infected Files Report</a></p> 
  	<br>
    <button id='button' name='button' onclick="goBack()">Go Back</button>
  	<br>
  	<?php }
if (filesize($ClamLog > '1')) {
  ?><br><div align="center"><?php
  echo nl2br('DocumentControl did not find any potentially infected files.'."\n"); ?>
  	<br>
    <button id='button' name='button' onclick="goBack()">Go Back</button>
  	<br>
  	<?php ] ?> 
<br>