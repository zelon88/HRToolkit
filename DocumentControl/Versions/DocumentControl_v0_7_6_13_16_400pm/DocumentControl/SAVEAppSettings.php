<!DOCTYPE html>
<html>
<head>
<title>DocumentControl | Application Settings SAVED </title>
<link rel="stylesheet" type="text/css" href="DocConCSS.css">
</head>
<body>
<?php
$Date = date("m_d_y");
$Time = date("F j, Y, g:i a"); 
$SysCache = "AppCache/SysCache.php";
?>
<div align="center"><h3>Application Settings Saved!</h3></div>
<hr />
<?php
if (isset($_POST['Save'])) {
  if (isset($_POST['NEWServerID'])) {
    $NEWServerID = $_POST['NEWServerID'];
    $txt = ('$UniqueServerName = \''.$NEWServerID.'\';') ;
    $WriteSetting = file_put_contents($SysCache, $txt.PHP_EOL , FILE_APPEND); 
    echo nl2br("\n".'Saved New Server Name.'."\n"); }
    ?>
<hr />
<?php
  if (isset($_POST['NEWInternalIP'])) {
    $NEWInternalIP = $_POST['NEWInternalIP'];
    $txt = ('$InternalIP = \''.$NEWInternalIP.'\';') ;
    $WriteSetting = file_put_contents($SysCache, $txt.PHP_EOL , FILE_APPEND); 
    echo nl2br("\n".'Saved New Internal IP.'."\n"); }
    ?>
<hr />
<?php
  if (isset($_POST['NEWExternalIP'])) {
    $NEWExternalIP = $_POST['NEWExternalIP'];
    $txt = ('$ExternalIP = \''.$NEWExternalIP.'\';') ;
    $WriteSetting = file_put_contents($SysCache, $txt.PHP_EOL , FILE_APPEND);
    echo nl2br("\n".'Saved New External IP.'."\n"); }
    ?>
<hr />
<?php
  if (isset($_POST['NEWURL'])) {
    $NEWURL = $_POST['NEWURL'];
    $txt = ('$URL = \''.$NEWURL.'\';') ;
    $WriteSetting = file_put_contents($SysCache, $txt.PHP_EOL , FILE_APPEND); 
    echo nl2br("\n".'Saved New Domain.'."\n"); }
    ?>
<hr />
<?php
  if (isset($_POST['NEWAutoBackup'])) {
    $NEWAutoBackup = $_POST['NEWAutoBackup'];
    $txt = ('$AutoBackup = \''.$NEWAutoBackup.'\';') ;
    $WriteSetting = file_put_contents($SysCache, $txt.PHP_EOL , FILE_APPEND); 
    echo nl2br("\n".'Saved New Backup Settings.'."\n"); }
    ?>
<hr />
<?php
  if (isset($_POST['NEWVirusScan'])) {
    $NEWVirusScan = $_POST['NEWVirusScan'];
    $txt = ('$VirusScan = \''.$NEWVirusScan.'\';') ;
    $WriteSetting = file_put_contents($SysCache, $txt.PHP_EOL , FILE_APPEND); 
    echo nl2br("\n".'Saved New Anti-Virus Settings.'."\n"); }
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
  ?><div align="center"><?php echo nl2br("\n".'Reset "Application Settings" to default values on '.$Time.'.'."\n"); } ?></div>
<br>
<hr />
<div id='end' name='end' class='end'></div>
</body>
</html>