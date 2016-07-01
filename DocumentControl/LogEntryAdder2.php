<!DOCTYPE html>
<html>
<head>
<title>DocumentControl | Logs - New Log Entry</title>
<link rel="stylesheet" type="text/css" href="DocConCSS.css">
</head>
<body>
<div align="center"><h3>New Log Entry</h3></div>
<hr />
<div align='left'>
</p>Log entry added sucessfully!</p>
<?php
require ("config.php");
include ($InstLoc.'/AppCache/SysCache.php');
$Date = date("m_d_y");
$Time = date("F j, Y, g:i a"); 
$LogLoc = $InstLoc.'/AppLogs';
$LogInc = 0;
$SesLogDir = $LogLoc.'/'.$Date;
$LogFile = ($SesLogDir.'/'.$Date.'_'.$LogInc.'.txt');
$Name = $_POST['name'];
$Entry = $_POST['entry'];
$Log = ('OP-Act: Submitted Log Entry from, "'.$Name.'" on '.$Time.':  "'.$Entry.'"  .');
if (!file_exists($SesLogDir)) {
$JICInstallLogs = @mkdir($SesLogDir, 0755); }
if (!file_exists($LogLoc)) { 
$JICInstallLogs = @mkdir($LogLoc, 0755); }
$JICTouchInstallLogFile = @touch($SesLogDir.'/'.$Date.'_'.$LogInc.'.txt');
$JICTouchInstallLogFile = @touch($SesLogDir.'/'.$Date.'_'.$LogInc.'.txt');
if (!file_exists($LogLoc)) {
  mkdir($LogLoc, 0755); }
if (file_exists($LogFile)) {
  $LogFile = ($SesLogDir.'/'.$Date.'_'.$LogInc.'.txt');  
  while (file_exists($SesLogDir.'/'.$Date.'_'.(++$LogInc).'.txt')); }
$LogFile = file_put_contents($SesLogDir.'/'.$Date.'_'.$LogInc.'.txt', $Log.PHP_EOL , FILE_APPEND); 
?>
<p>Log Entry Summary: <?php echo nl2br("$Log \n"); ?></p>
</div>
<br>
<hr />
</body>
</html>