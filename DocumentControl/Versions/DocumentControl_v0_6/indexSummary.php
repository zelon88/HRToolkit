<!DOCTYPE html>
<html>
<head>
<title>DocumentControl | Summary Window </title>
<link rel="stylesheet" type="text/css" href="DocConCSS.css">
</head>
<?php 
require ("config.php");
$InstLoc1 = $InstLoc.'/'; 
require ($InstLoc.'/AppCache/SysCache.php');
$OPCache = $InstLoc1.'/AppCache/OPCache.txt';
$LastOPTime = trim(implode("", array_slice(file($OPCache), -1)));
$FilesToProc = 0; 
$FilesTEMP = glob($InputLoc . '/*');
if ( $FilesTEMP !== false ) {
  $FilesToProc = count($FilesTEMP); } 
$FilesTEMP2 = glob($ActionLoc . '/*');
if ( $FilesTEMP2 !== false ) {
  $FilesToProc2 = count($FilesTEMP2); } ?>

<body>
	<div align='center'><h3>Welcome!</h3></div>
	<hr />
	<div align='left'>
<strong><?php echo nl2br ('DIRECTORY STATUS: '."\n"); ?></strong>

<?php
echo nl2br(' Documents Pending: '); ?><i><?php echo nl2br ($FilesToProc ."\n");?></i><?php
echo nl2br(' Documents Pending Action: '); ?><i><?php echo nl2br ($FilesToProc2 ."\n");?></i><?php
echo nl2br(' Pending Document Directory: '."\n"); ?><i><?php echo nl2br ($InputLoc ."\n");?></i><?php
echo nl2br(' Pending Action Directory: '."\n"); ?><i><?php echo nl2br ($ActionLoc ."\n");?></i><?php
echo nl2br(' Finished Document Directory: '."\n"); ?><i><?php echo nl2br ($OutputLoc ."\n");?></i><?php
if ($AutoBackup == '1') { ?>
  <?php echo nl2br(' Backup Directory: '."\n"); ?><i><?php echo nl2br ($BackupLoc ."\n\n"); } ?></i>
<?php
if ($AutoBackup !== '1') {
  echo nl2br("\n"); } ?>
<hr />
<strong><?php echo nl2br ('SYSTEM STATUS: '."\n"); ?></strong><?php
echo nl2br('Last OP Complete: '); ?><i><?php echo nl2br ($LastOPTime."\n"); ?></i><?php
if ($AutoBackup !=='1') {
  echo nl2br(' Managed Backups: '); ?><i><?php echo nl2br (' Disabled'."\n"); } ?></i><?php
if ($AutoBackup =='1') {
  echo nl2br(' Managed Backups: '); ?><i><?php echo nl2br (' Enabled'."\n"); } ?></i><?php
if ($VirusScan !== '1') {
  echo nl2br(' Virus Scanning: '); ?><i><?php echo nl2br (' Disabled'."\n"); } ?></i><?php
if ($VirusScan == '1') {
  echo nl2br( 'Virus Scanning: '); ?><i><?php echo nl2br (' Enabled'."\n"); } ?></i><?php
if ($URL !== '') {
  echo nl2br(' Domain:  '."\n"); ?><i><?php echo nl2br ($URL ."\n"); } ?></i><?php
if ($URL == '') {
  echo nl2br(' Domain: '); ?><i><?php echo nl2br (' Not Set'."\n"); } ?></i><?php
echo nl2br("\n"); ?>


<hr />
</div>
</body>
</html>