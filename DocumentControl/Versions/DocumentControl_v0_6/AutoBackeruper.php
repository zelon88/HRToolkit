<!DOCTYPE html>
<html>
<head>
<title>DocumentControl | AutoBackeruper </title>
<link rel="stylesheet" type="text/css" href="DocConCSS.css">
</head>
<body>



<?php

$Date = date("m_d_y");
$Time = date("F j, Y, g:i a"); 
require 'config.php';
$BackupFileCount = 0;

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
    
$txt = 'Backup OP on '.$Time;
$LogFile = file_put_contents($InstLoc.'/AppCache/OPCache.txt', $txt.PHP_EOL , FILE_APPEND);           
          if (file_exists($BackupLoc . DIRECTORY_SEPARATOR . $iterator->getSubPathName())) {
            @copy($item, $BackupLoc . DIRECTORY_SEPARATOR . $iterator->getSubPathName()); }
echo nl2br ("\n".'Backup Operation Complete! Processed '.$BackupFileCount.' files on '.$Time.'. AB24.'."\n\n"); ?>
<hr />
</div>
    <div class="end"></div>
</body>

</html>