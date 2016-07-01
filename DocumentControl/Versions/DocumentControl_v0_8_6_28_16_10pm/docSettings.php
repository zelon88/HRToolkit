<!DOCTYPE html>
<html>
<head>
<title>DocumentControl | Directory Settings </title>
<link rel="stylesheet" type="text/css" href="DocConCSS.css">
</head>
<?php 
$sysCache = "AppCache/SysCache.php";
require("config.php");
$SaltHash = hash('ripemd160',$Salts);
require_once($sysCache); 

?>
<body>
  <div align='center'><h3>Welcome, <?php echo $AdmLogin; ?>!</h3></div>
  <hr />
 <div align='center'>
<div align='left'>
<strong><?php echo nl2br ('VIEW DIRECTORY SETTINGS: '); ?></strong>
<p>For security reasons these settings cannot be modified using the DocumentControl application. Navigate to the "Install Directory" and edit the config.php file with a text editor to modify these settings.
<p>Install Directory: <input type='text' name='InstallLoc' id='InstallLoc' value='<?php echo $InstLoc; ?>' readonly style="width: 175px; padding: 2px; border: 1px solid black"/></p>
<p>Input Directory: <input type='text' name='InputLoc' id='InputLoc' value='<?php echo $InputLoc; ?>' readonly style="width: 179px; padding: 2px; border: 1px solid black"/></p>
<p>Output Directory: <input type='text' name='OutputLoc' id='OutputLoc' value='<?php echo $OutputLoc; ?>' readonly style="width: 169px; padding: 2px; border: 1px solid black"/></p>
<p>Action Directory: <input type='text' name='ActionLoc' id='ActionLoc' value='<?php echo $ActionLoc; ?>' readonly style="width: 170px; padding: 2px; border: 1px solid black"/></p>
<?php 
if ($AutoBackup == '1') { ?>
  <p>Backup Directory: <input type='text' name='BackupLoc' id='BackupLoc' value='<?php echo $BackupLoc; ?>' readonly style="width: 165px; padding: 2px; border: 1px solid black"/></p>	
<?php } ?>
</div>
<br>
<hr />
</div>
</body>
</html>
