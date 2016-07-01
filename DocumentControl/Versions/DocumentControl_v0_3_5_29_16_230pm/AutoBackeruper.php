<?php

$Date = date("m_d_y");
$Time = date("F j, Y, g:i a"); 
require 'config.php';
$BackupFileCount = 0;

  if ($AutoBackup = '1') { 
  	@mkdir($BackupLoc, 0755);
    foreach ($iterator = new \RecursiveIteratorIterator (
      new \RecursiveDirectoryIterator ($InputLoc, \RecursiveDirectoryIterator::SKIP_DOTS),
      \RecursiveIteratorIterator::SELF_FIRST) as $item) {
      	$BackupFileCount++;
        if ($item->isDir()) {
          mkdir($BackupLoc . DIRECTORY_SEPARATOR . $iterator->getSubPathName());}
          else {
           copy($item, $BackupLoc . DIRECTORY_SEPARATOR . $iterator->getSubPathName()); } } } 
echo nl2br ('Operation Complete! Processed '.$BackupFileCount.' files on '.$Time.'. AB18.');
