<!DOCTYPE html>
<html>
<head>
<title>DocumentControl | Application Settings </title>
<link rel="stylesheet" type="text/css" href="DocConCSS.css">
</head>
<?php 
$sysCache = "AppCache/SysCache.php";
require("config.php");
require_once($sysCache); 
if ($AutoBackup == '1') {
  $ABEcho = 'Enabled'; }
if ($AutoBackup !== '1') {
  $ABEcho = 'Disabled'; }
if ($VirusScan == '1') {
  $VSEcho = 'Enabled'; }
if ($VirusScan !== '1') {
  $VSEcho = 'Disabled'; }

?>
<body>
  <div align='center'><h3>Welcome, <?php echo $AdmLogin; ?>!</h3></div>
  <hr />
 <div align='center'>
<div align='left'>
<strong><?php echo nl2br ('MODIFY APPLICATION SETTINGS: '."\n"); ?></strong>
<form action="SAVEAppSettings.php" method="post" name='NEWAppSettings' id='NEWAppSettings'> 
<p>Unique Server Name: <input type='text' name='NEWServerID' id='NEWServerID' value='<?php echo $UniqueServerName; ?>' style="max-width: 138px; padding: 2px; border: 1px solid black"/></p>
<p>Internal IP Address: <input type='text' name='NEWInternalIP' id='NEWInternalIP' value='<?php echo $InternalIP; ?>' style="max-width: 230px; padding: 2px; border: 1px solid black"/></p>
<p>External IPv4 Address: <input type='text' name='NEWExternalIP' id='NEWExternalIP' value='<?php echo $ExternalIP; ?>' style="width: 130px; padding: 2px; border: 1px solid black"/></p>
<p>Domain (leave blank for none): <input type='text' name='NEWURL' id='NEWURL' value='<?php echo $URL; ?>' style="align: center; width: 280px; padding: 2px; border: 1px solid black"/></p>
<p>Auto Backups (Requires "Backup Directory" be set): <select  id="NEWAutoBackup" name="NEWAutoBackup">
  <option value="<?php echo $AutoBackup; ?>">Current (<?php echo $ABEcho; ?>)</option>
  <option value="1">Enabled</option>
  <option value="0">Disabled</option>
</select></p>
<p>Virus Scanning (Requires ClamAV on server): <select  id="NEWVirusScan" name="NEWVirusScan">
  <option value="<?php echo $VirusScan; ?>">Current (<?php echo $VSEcho; ?>)</option>
  <option value="1">Enabled</option>
  <option value="0">Disabled</option>
</select></p>
<div align='center'>
  <input type='submit' name='Save' id='Save' value='Save Changes' onclick="toggle_visibility('loading');"/>
  <input type='submit' name='Clear' id='Clear' value='Clear Changes' onclick="location.reload();"/>
  <input type='submit' name='LoadDefaults' id='LoadDefaults' value='Load Defaults' onclick="toggle_visibility('loading');"/>
</form>
<div id='end' name='end' class='end'></div>
<br>
<hr />
</body>
</html>