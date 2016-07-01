<!DOCTYPE html>
<html>
<head>
<title>DocumentControl | AutoBackeruper </title>
<link rel="stylesheet" type="text/css" href="DocConCSS.css">
</head>
<body>

<?php

require ("config.php");
include ($InstLoc.'/AppCache/SysCache.php');
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
$JICTouchInstallLogFile = @touch($SesLogDir.'/'.$Date.'_'.$LogInc.'.txt');
$BackupFileCount = 0;
if (!file_exists($LogLoc)) {
  mkdir($LogLoc, 0755); }
if (file_exists($LogFile)) {
  $LogFile = ($SesLogDir.'/'.$Date.'_'.$LogInc.'.txt');  
  while (file_exists($SesLogDir.'/'.$Date.'_'.(++$LogInc).'.txt')); }

  if ($AutoBackup = '1') { 
  	@mkdir($BackupLoc, 0755);
    foreach ($iterator = new \RecursiveIteratorIterator (
      new \RecursiveDirectoryIterator ($OutputLoc, \RecursiveDirectoryIterator::SKIP_DOTS),
      \RecursiveIteratorIterator::SELF_FIRST) as $item) {
        @chmod($item, 0755);
        if ($item->isDir()) {
          if (!file_exists($BackupLoc . DIRECTORY_SEPARATOR . $iterator->getSubPathName())) {
          mkdir($BackupLoc . DIRECTORY_SEPARATOR . $iterator->getSubPathName());
          $BackupFileCount++; } }
        else {
           copy($item, $BackupLoc . DIRECTORY_SEPARATOR . $iterator->getSubPathName());
           $BackupFileCount++; } } } 

$txt = ('Backup Operation Complete! Processed '.$BackupFileCount." files on $Time".'.');
$LogFile = file_put_contents($SesLogDir.'/'.$Date.'_'.$LogInc.'.txt', $txt.PHP_EOL , FILE_APPEND);    
$txt = 'Backup OP on '.$Time;
$LogFile = file_put_contents($InstLoc.'/AppCache/OPCache.txt', $txt.PHP_EOL , FILE_APPEND);           
          if (file_exists($BackupLoc . DIRECTORY_SEPARATOR . $iterator->getSubPathName())) {
            @copy($item, $BackupLoc . DIRECTORY_SEPARATOR . $iterator->getSubPathName()); }
echo nl2br ("\n".'Backup Operation Complete! Processed '.$BackupFileCount.' files on '.$Time.'. AB24.'."\n\n"); ?>
<hr />
</div>
    <div id='end' name='end' class="end"></div>
</body>

</html>