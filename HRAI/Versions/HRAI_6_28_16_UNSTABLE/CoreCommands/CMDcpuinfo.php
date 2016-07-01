<?php
// / This code was copied from https://gist.github.com/ezzatron/1321581 on 4/12/2016
// / by Justin Grimes. It has been slightly modified for use as an HRAI Core Command.
// / Thanks, Erin Millard! 

/**
 * Copyright © 2011 Erin Millard
 */
/**
 * Returns the number of available CPU cores
 * 
 *  Should work for Linux, Windows, Mac & BSD
 * 
 * @return integer 
 */

function getNumOfCores() {
  $numCpus = 1;
  if (is_file('/proc/cpuinfo')) {
    $cpuinfo = file_get_contents('/proc/cpuinfo');
    preg_match_all('/^processor/m', $cpuinfo, $matches);
    $numCpus = count($matches[0]); }
  else if ('WIN' == strtoupper(substr(PHP_OS, 0, 3))) {
    $process = @popen('wmic cpu get NumberOfCores', 'rb');
    if (false !== $process) {
      fgets($process);
      $numCpus = intval(fgets($process));
      pclose($process); } }
  else {
    $process = @popen('sysctl -a', 'rb');
    if (false !== $process) {
      $output = stream_get_contents($process);
      preg_match('/hw.ncpu: (\d+)/', $output, $matches);
      if ($matches) {
     $numCpus = intval($matches[1][0]); }
      pclose($process); } }
  return $numCpus; }

// / This portion of code was created by Justin G. 
function getCPUInfo() {
  $infoCachefile = '/var/www/html/infoCache.php';
  $cpuInfo = shell_exec("lscpu"); 
    $infoCachefileO = fopen("$infoCachefile", "a+");
    $txt = ("$cpuInfo");
    $compCachefile = file_put_contents($infoCachefile, $txt.PHP_EOL , FILE_APPEND);
    return $cpuInfo; }

$GetCPUInfo = getCPUInfo();
$GetNumOfCores = getNumOfCores();
    echo nl2br('CPU Information:'."\r");
    echo nl2br("Total Threads: $GetNumOfCores\r");
    echo nl2br("$GetCPUInfo \r");
    echo nl2br("--------------------------------\r");