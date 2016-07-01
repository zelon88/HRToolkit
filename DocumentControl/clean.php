<?php
require_once("config.php");
$TMPDIR = $InstLoc .'/TEMP';
if (!file_exists($TMPDIR)) {
  mkdir($TMPDIR);
  chmod($TMPDIR, 0755); }
if (file_exists($TMPDIR)) {
  $filesOTMP = glob($InstLoc."/TEMP/*");
  $now   = time();
  foreach ($filesOTMP as $fileOTMP) {
    if (is_file($fileOTMP)) {
      if ($now - filemtime($fileOTMP) >= 60 * 60 * 24 * 2) // delete anything older than 2 days
        unlink($fileOTMP); } } } 