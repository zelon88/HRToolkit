<!DOCTYPE html>
<html>
<head>
<title>DocumentControl | Database Settings </title>
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
<strong><?php echo nl2br ('VIEW DATABASE SETTINGS: '); ?></strong>
<p>For security reasons these settings cannot be modified using the DocumentControl application. Navigate to the "Install Directory" and edit the config.php file with a text editor to modify these settings.

<?php 
if ($ENABLE_MYSQL == '1') { ?>
  <p>Database Support: <input type='text' name='BackupLoc' id='BackupLoc' value='MySQL Support Enabled' readonly style="width: 170px; padding: 2px; border: 1px solid black"/></p>	
<?php }
if ($ENABLE_MSSQL == '1') { ?>
<p>Database Support: <input type='text' name='BackupLoc' id='BackupLoc' value='MsSQL Support Enabled' readonly style="width: 170px; padding: 2px; border: 1px solid black"/></p>
<p>Database Name: <input type='text' name='DBName' id='DBName' value='<?php echo $DBName; ?>' readonly style="width: 184px; padding: 2px; border: 1px solid black"/></p>
<?php }
if (($ENABLE_MSSQL !== '1') and ($ENABLE_MSSQL !== '1')) { ?>
  <p>Database Support: <input type='text' name='BackupLoc' id='BackupLoc' value='Disabled' readonly style="width: 170px; padding: 2px; border: 1px solid black"/></p>
</p>
<?php } ?>
</div>
<br>
<hr />
</div>
</body>
</html>

