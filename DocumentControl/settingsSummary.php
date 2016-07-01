<!DOCTYPE html>
<html>
<head>
<title>DocumentControl | Summary Window </title>
<link rel="stylesheet" type="text/css" href="DocConCSS.css">
</head>
<?php 
// / For security reasons This page is not "technically" password protected. The idea is that by
// / putting a thin outer layer of security on the outside of the settings login screen will allow
// / most attacks through initially. The attaker will be ensnared on a page they believe holds the 
// / key to changing settings, when in reality they left a Yummy, Salty piece behind a long time ago.
$sysCache = "AppCache/SysCache.php";
require("config.php");
include($sysCache); 

if ($AutoBackup == '1') {
  $ABEcho = ('Enabled'); }
  else {
  	$ABEcho = ('Disabled'); }
if ($VirusScan == '1') {
  $VEcho = ('Enabled'); }
  else {
  	$VEcho = ('Disabled'); }
$DBEArr = array('01','10','11');
if ($ENABLE_MYSQL.$ENABLE_MSSQL == '11') {
	$DBEcho = ('ERROR, sS22 !!! Multi DBs Is Not Supported!'); }
if (in_array(($ENABLE_MYSQL.$ENABLE_MSSQL), $DBEArr)) {
	$DBEcho = ('Disabled'); }
if ($ENABLE_MSSQL == '1') {
	$DBEcho = ('MsSQL Support Enabled'); }
if ($ENABLE_MYSQL == '1') {
	$DBEcho = ('MySQL Support Enabled'); }
if ($URL == '') {
	$DEcho = ('Not Set'); }
?>
<body>
  <div align='center'><h3>Welcome, <?php echo $AdmLogin; ?>!</h3></div>
  <hr />
 <div align='center'>
<div align='left'>
<strong><?php echo nl2br ('CURRENT SETTINGS: '."\n"); ?></strong>
<?php
echo nl2br(' Server Name: '); ?><i><?php echo nl2br ($UniqueServerName ."\n");?></i><?php
echo nl2br(' Managed Backups: '); ?><i><?php echo nl2br ($ABEcho ."\n");?></i><?php
echo nl2br(' Virus Scanning: '); ?><i><?php echo nl2br ($VEcho ."\n");?></i><?php
echo nl2br(' Internal IP: '); ?><i><?php echo nl2br ($InternalIP ."\n");?></i><?php
echo nl2br(' External IPv4: '); ?><i><?php echo nl2br ($ExternalIP ."\n");?></i><?php
echo nl2br(' Domain: '); ?><i><?php echo nl2br ($DEcho ."\n");?></i><?php
echo nl2br(' Database Support: '); ?><i><?php echo nl2br ($DBEcho ."\n");?></i><?php
echo nl2br(' Pending Document Directory: '."\n"); ?><i><?php echo nl2br ($InputLoc ."\n");?></i><?php
echo nl2br(' Pending Action Directory: '."\n"); ?><i><?php echo nl2br ($ActionLoc ."\n");?></i><?php
echo nl2br(' Finished Document Directory: '."\n"); ?><i><?php echo nl2br ($OutputLoc ."\n");?></i><?php
if ($AutoBackup == '1') { ?>
  <?php echo nl2br(' Backup Directory: '."\n"); ?><i><?php echo nl2br ($BackupLoc ."\n\n"); } ?></i>
<?php
if ($AutoBackup !== '1') {
  echo nl2br("\n"); } ?>
</div>
<hr />
</body>
</html>