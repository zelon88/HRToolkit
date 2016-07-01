 <html>

 <head>
  <title>Securing File</title>
 </head>
 <body>
<div align="center">
<a href="http://cloud.honestrepair.net">
<img src="http://cloud.honestrepair.net/HRProprietary/converter/HRBanner.png" alt="HonestRepair"> </a>
</div>
<div style=""
    <br>
    <div align="center"><p><h2>Your file has been secured.</h2></div>
    <br>
<div align="center">
  <br>
<?php
// Justin G.  2016
// Version 0.9 - 3/10/16
// This web application was designed to automatically identify files uploaded by a client and return options for securing that
// fie by encrypting or decrypting it with user-specified settings. This program uses OpenSSH to encrypt and decrypt files using
// industry standard AES-128-CBC  or  AES-256-CBC techniques combined with automatic salt capability and base64 encoding/decoding
// capability. In addition to securing single files, this program can also secure an entire archive as a single file or extract an 
// archive, secure the files inside, and then re-comrpress the archive to a different filetype, with the option for also securing 
// the resultant archive. Alongside the newly created archive the user will find a text file left by the program with instructions
// on propere decrypting/decoding their files. The user will have the option to move the files to their HRDrive, or make them 
// available for instant download. 
// This application requires the use of ClamAV, Unrar, Unzip, 7z, and OpenSSH. 
if ( isset( $_POST['encryptDownload'] ) ) {
  require_once('/var/www/html/wp-load.php');
  $user_ID = get_current_user_id();
  $extension = 'enc';
  $extension2 = $extension . '.enc';
  $extension = $_POST['extension']
  $file1 = $_POST['hiddenFile'];
  $file = str_replace(" ", "_", $file1 );
  $userTempDirectory = ('/var/www/html/cloud/temp');
  $pathname = $userTempDirectory . '/' . $file;
  $filename = pathinfo($pathname, PATHINFO_FILENAME);
  $newFile = $filename . '.' . $extension;
  $newPathname = $userTempDirectory . '/' . $newFile;
  $safedir = '/tmp/SAFEDIR/isolated/' . $filename;
  $oldExtension = pathinfo($pathname, PATHINFO_EXTENSION);
  $archarray = array('zip', '7z', 'rar', 'tar', 'tar.gz', 'tar.bz2', 'iso', 'vhd',);
  $array7z = array('7z', 'zip', 'rar', 'iso', 'vhd');
  $array7zo = array('7z');
  $array7zo2 = array('vhd', 'iso');
  $arrayzipo = array('zip');
  $arraytaro = array('tar.gz', 'tar.bz2', 'tar');
  $arrayraro = array('rar');
  $passLit = $_POST('pass1');
  $pass = str_replace(' ', '', $passLit );
  $eType = $_POST['eType'];
  $SimArchEnc = $_POST['simple'];
  $salt =  $_POST['salt'];
  $base64 = $_POST['base64'];
  $stub = ('http://cloud.honestrepair.net/cloud/temp/');
  $newFileURL = $stub . $newFile; 
  $logFile = ('/var/www/html/HRProprietary/locker/Logs/' . $user_ID . $filename . $oldExtension . $extension . '.txt');
  $logFileURL = ($user_ID . $filename . $oldExtension . $extension . '.txt');
  $logFile2 = ('/var/www/html/HRProprietary/locker/Logs/' . $user_ID . $filename . $eType. '.txt');
  $logFile2URL = ($user_ID . $filename . $eType. '.txt');
 // Turn our post data from the uploader into variables for our OpenSSH commands.
  if ($eType = '\! ') {
    $eType1 = ''; }
    elseif ($eType = 'e128') {
    $eType1 = '-aes-128-cbc '; }
    elseif ($eType = 'e256') {
    $eType1 = '-aes-256-cbc ';) }
  if ($base64 = '\! ') {
    $b64 = ''; }
    elseif ($base64 = '1') {
    $b64 = '-a '; }
  if ($salt = '\! ') {
    $salt1 = ''; }
    elseif ($salt = '1') {
    $salt1 = '-salt '; }
// If the file is not an archive we scan it with ClamAV and generate a logfile. If the logfile is larger than 1 byte we 
// delete the files and stop the script. If the logfile is 0 bytes we encrypt the file. We then cleanup any files older 
// 2000 seconds from the temp directory. We also employ a secure way of leaving behind our index.html file that gets 
// reused later.
if (!in_array($oldExtension,$archarray) ) {
shell_exec ("freshclam"); 
shell_exec("clamscan -r --remove $pathname | grep FOUND >> $logFile");
  if filesize($logFile) < 1 ) { 
shell_exec ("openssl enc $eType1 $b64 $salt1 -in $pathname -out $newPathname -pass $pass");  }
    if ($handle = opendir('/var/www/html/cloud/temp/') ) {
      while (false !== ($file2 = readdir($handle) ) ) {
        if (filectime($file2)< (time()-2000) ) {
// The following 3 lines will exclude the index.html from being deleted with the rest of the files in $handle. 
          $file2ext = filetype($file2);
          $file2n = pathinfo($file2, PATHINFO_FILENAME);
          if ($file2ext != 'html') && if ( $file2n != 'index' ) {
          unlink($file2); } } } } }
  else {
    unlink($pathname); 
    die ('INFECTED FILE DETECTED!!! Encryption aborted.'); } 
// If our fie is an archive, but simpe mode is selected we treat the archive as any other file.
    if (in_array($oldExtension,$archarray) ) {
    if ($SimArchEnc = 0) { 
shell_exec ("freshclam"); 
shell_exec("clamscan -r --remove $pathname | grep FOUND >> $logFile");
  if filesize($logFile) < 1 ) { 
shell_exec ("openssl enc $eType1 $b64 $salt1 -in $pathname -out $newPathname -pass $pass");  }
    if ($handle = opendir('/var/www/html/cloud/temp/') ) {
      while (false !== ($file2 = readdir($handle) ) ) {
        if (filectime($file2)< (time()-2000) ) {
          $file2ext = filetype($file2);
          $file2n = pathinfo($file2, PATHINFO_FILENAME);
          if ($file2ext != 'html') && if ( $file2n != 'index' ) {
          unlink($file2); } } } } }
  else {
    unlink($pathname); 
    die ('INFECTED FILE DETECTED!!! Encryption aborted.'); }
// If "Advanced" is set we determine the best way to de-compress it by filtering the file extension. We then feed commands 
// to helpers like Unar, Unzip, and 7z to decompress the file to its own folder in a safe temporary directory. We also update
// ClamAV now and scan the archive before we extract. If infections are found we delete temporary files and kill the script.
  if ($SimArchEnc = 1) { 
      $safedir1 = '/tmp/SAFEDIR/isolated/';
      $safedir2 = "/tmp/SAFEDIR/isolated/$filename";
      mkdir("$safedir2", 0777, true);
      chmod($safedir2, 0777);
      $safedir3 = ("/tmp/SAFEDIR/isolated/$filename" . '.7z');
      $safedir4 = ("/tmp/SAFEDIR/isolated/$filename" . '.zip');
      shell_exec ("freshclam"); 
      shell_exec("clamscan -r --remove $pathname | grep FOUND >> $logFile");
  if filesize($logFile) < 1 ) { 
    if(in_array($oldExtension, $arrayzipo) ) {
     shell_exec("unzip $pathname -d $safedir2");
      } 
    if(in_array($oldExtension, $array7zo) ) {
     shell_exec("7z e $pathname -o$safedir2");
      } 
    if(in_array($oldExtension, $array7zo2) ) {
     shell_exec("7z e $pathname -o$safedir2");
      } 
    if(in_array($oldExtension, $arrayraro) ) {
     shell_exec("unrar e $pathname $safedir2");
      } 
    if(in_array($oldExtension, $arraytaro) ) {
     shell_exec("7z e $pathname -o$safedir2");
      } } }
// Clean up temporary files if virus infections are found.
  else {
        if ($handle = opendir('$safedir1') ) {
      while (false !== ($file2 = readdir($handle) ) ) {
        if (filectime($file2)< (time()-2000) ) {
          unlink($file2); } } } 
    unlink($safedir2);
    unlink($pathname); 
    die ('INFECTED FILE DETECTED!!! Encryption aborted.'); }
// Check if the extraction was sucessful. Die and return error if it was not. Usually this is the result of an unusual filename, 
// or one with a mismatched file extension (like a .txt file renamed to .zip). If we encounter an archive like this we scan the
// temporary locations for viruses before deleting temporary files and returning varying degrees of error messages to the user.
 $i=0;
opendir(DIR, "$safedir2") or die 'Error. Cannot open temporary directory.';
    @files = readdir(DIR);
    foreach $cfile(@files) {
      unless ($cfile =~ /^[.][.]?\z/) {
        $i++; } }
     if ($i = 0) {
shell_exec("clamscan -r --remove $safedir2 | grep FOUND >> $logFile");
if (filesize($logFile) > 1 ) {
  print "Error. No files were unpacked from the archive.";
  print "Error. ClamAV generated a logfile with a filesize over 0 bytes!"
  print "Cleaning temporary file locations... Success."
  print "Encryption aborted!"
      die ("Error during file-decompression. No files were created. Encryption aborted.");
}
else {
  print "Error. No files were unpacked from the archive.";
  print "Cleaning temporary file locations... Success."
  print "Encryption aborted!"
      die ("Error during file-decompression. No files were created. Encryption aborted.");
     } } 
// Scan the extracted files with ClamAV and remove infected files. Generate a logfile, and if that logfile 
// is over 0 bytes we kill the script. Also deletes files in temp directory older than 2,000 seconds. After
// this portion of code is done running no files should be left in ANY HRProprietary temp directory over 2000
// seconds old. Any redundant rmdir or unlink coding is intentional, and designed to completely scrub any files
// that might be kicking aroung. 
shell_exec("clamscan -r --remove $safedir2 | grep FOUND >> $logFile");
if (filesize($logfile) > 1 ) { 
  if ($handle = opendir('/var/www/html/cloud/temp/') ) {
    while (false !== ($file2 = readdir($handle) ) ) {
      if (filectime($file2)< (time()-2000)) {
        $file2ext = filetype($file2);
        $file2n = pathinfo($file2, PATHINFO_FILENAME);
        $delFiles = glob($safedir2 . '/*');
          if ($file2ext != 'html') && if ( $file2n != 'index' ) {
            unlink($pathname);
            unlink($file2); 
            unlink($safedir3);
            unlink($safedir4);
        foreach($delFiles as $delFile){
          if(is_file($delFile) ) {
            chmod($delFile, 0777);  
            unlink($delFile); }
          elseif(is_dir($delFile) ) {
            chmod($delFile, 0777);
            rmdir($delFile); } }    
            rmdir($safedir2); 
            unlink($safedir2); } } } } 
    die ('INFECTED FILE DETECTED!!! Encryption aborted.'); } }
// If our scans return no results we encrypt each file from our original archive and allow the user to select a format for 
// their new encrypted archive. Default means the same method detected from the original file will be used again.  
elseif filesize($logFile) < 1 ) { 
      if (in_array($extension,$array7zo) ) {
        $encFiles = glob($safedir2 . '/*');
        $encFilesNew = ($encFiles . '.enc');
        foreach($encFiles as $encFile) {
     shell_exec ("openssl enc $eType1 $b64 $salt1 -in $encFiles -out $encFilesNew -pass $pass"); }
          if(is_file($encFile) ) {
     shell_exec("7z a -t$extension $safedir3 $safedir2");
      copy($safedir3, $newPathname); } 
      if (file_exists($safedir3) ) {
        chmod($safedir3, 0777); 
        unlink($safedir3);
        $delFiles = glob($safedir2 . '/*');
        foreach($delFiles as $delFile){
          if(is_file($delFile) ) {
          chmod($delFile, 0777);  
          unlink($delFile); }
          elseif(is_dir($delFile) ) {
          chmod($delFile, 0777);
          rmdir($delFile); } }    
        rmdir($safedir2); }
      elseif (in_array($extension,$arrayzipo) ) {
        $encFiles = glob($safedir2 . '/*');
        $encFilesNew = ($encFiles . '.enc');
        foreach($encFiles as $encFile) {
     shell_exec ("openssl enc $eType1 $b64 $salt1 -in $encFiles -out $encFilesNew -pass $pass"); }
          if(is_file($encFile) ) {
     shell_exec("zip -r $safedir4 $safedir2");
      copy($safedir4, $newPathname); } 
      if (file_exists($safedir4) ) {
        chmod($safedir4, 0777); 
        unlink($safedir4);
        $delFiles = glob($safedir2 . '/*');
        foreach($delFiles as $delFile){
          if(is_file($delFile) ) {
          chmod($delFile, 0777);  
          unlink($delFile); }
          elseif(is_dir($delFile) ) {
          chmod($delFile, 0777);
          rmdir($delFile); } }    
        rmdir($safedir2); }
      elseif (in_array($extension, $arraytaro) ) {
        $encFiles = glob($safedir2 . '/*');
        $encFilesNew = ($encFiles . '.enc');
        foreach($encFiles as $encFile) {
     shell_exec ("openssl enc $eType1 $b64 $salt1 -in $encFiles -out $encFilesNew -pass $pass"); }
          if(is_file($encFile) ) {
     shell_exec ("tar czf $newPathname $safedir2");
        $delFiles = glob($safedir2 . '/*');
        foreach($delFiles as $delFile){
          if(is_file($delFile) ) {
          chmod($delFile, 0777);  
          unlink($delFile); }
          elseif(is_dir($delFile) ) {
          chmod($delFile, 0777);
          rmdir($delFile); } }     
        rmdir($safedir2); } 
      elseif(in_array($extension, $arrayraro) ) {
        $encFiles = glob($safedir2 . '/*');
        $encFilesNew = ($encFiles . '.enc');
        foreach($encFiles as $encFile) {
     shell_exec ("openssl enc $eType1 $b64 $salt1 -in $encFiles -out $encFilesNew -pass $pass"); }
          if(is_file($encFile) ) {
     shell_exec("rar a $newPathname $safedir2");
          $delFiles = glob($safedir2 . '/*');
          foreach($delFiles as $delFile){
            if(is_file($delFile) ) {
              chmod($delFile, 0777);  
              unlink($delFile); }
            elseif(is_dir($delFile) ) {
              chmod($delFile, 0777);
              rmdir($delFile); } } 
            rmdir($safedir2); } } } 
// Create a logfile containing the settings used to encrypt the files. This logfile will be presented to the user so they have a record of the work done,
// and so they can decrypt their files later using the same settings.
  if (file_exists($newPathname) ) {
    if ($b64 = '') { 
      $b64L = 'No'; 
      elseif ($b64 != '') { 
        $b64L = 'Yes'; } } 
    if ($salt = '';) { 
      $saltL = 'No'; 
      elseif ($salt != '') { 
        $saltL = 'Yes'; } }
    if(in_array($oldExtension, $archarray) ) { 
      $isArch = 'Yes'; 
      elseif (!in_array($oldExtension, $archarray) ) { 
      $isArch = 'No'; } }
    if ($simEncArch = 0) { 
      $simadv = 'Simple';
      elseif ($simEncArch = 1) {
      $simadv = 'Advanced (Files extracted from archive, encrypted individually, & re-compressed)'} }
    if ($extension = '') { 
      $extL = 'Not Applicable'; 
      elseif ($extension != '') {
      $extL = $extension; } }
    $log  = "Your files have been encrypted using HRLocker version 1.0!" . PHP_EOL . 
            "-------------------------" . PHP_EOL .
            "File: " . $pathname . PHP_EOL . 
            "Date: " . date("F j, Y, g:i a") . PHP_EOL .
            "Original Filetype: " . $oldExtension . PHP_EOL .
            "New Filetype: " . $extL . PHP_EOL .
            "File is archive: " . $isArch . PHP_EOL .
            "Encryption Method: " . $simadv . PHP_EOL .
            "Enctyrption Type : " . $eType.PHP_EOL .
            "Base64 Encoding: " . $b64L . PHP_EOL .
            "Salts Used: ".$saltL . PHP_EOL .
            "Password: " . $pass . PHP_EOL .
            "-------------------------" . PHP_EOL .
            "Thank you for using HRLocker and the Honest Repair Cloud Platform to secure your files. Visit us online at www.HonestRepair.net!" . PHP_EOL .
            "Please keep this logfile, or copy it's contents somewhere safe. These settings will need to be re-used when decrytpting your files." . PHP_EOL .
            "-------------------------" . PHP_EOL .
            "Please note, we are not responsible for files lost, damaged, or corrupted as a result of using this software." . PHP_EOL .
            "Please make backups of your original files in a safe place, and perform a test decryption of your data to make sure there is no corruption before use." . PHP_EOL;
      file_put_contents("$logFile2" . , $log, FILE_APPEND); }
    elseif (!file_exists($newPathname) ) {
      unlink $pathname;
      unlink $newPathname;
      die ('Error Copying files. Encryption aborted.');
    }
    If (!file_exists($logFile2) ) {
      unlink $pathname;
      unlink $newPathname;
      die ('Error generating decryption instructions for your files. Encryption aborted.') }


elseif ( isset( $_POST['encryptCloud'] ) ) {
  require_once('/var/www/html/wp-load.php');
  $user_ID = get_current_user_id();
  $extension = 'enc';
  $extension2 = $extension . '.enc';
  $extension = $_POST['extension']
  $file1 = $_POST['hiddenFile'];
  $file = str_replace(" ", "_", $file1 );
  $userTempDirectory = ('/var/www/html/cloud/temp');
  $userCloudDirectory = ('/var/www/html/cloud/' . $user_ID);
  $pathname = $userTempDirectory . '/' . $file;
  $filename = pathinfo($pathname, PATHINFO_FILENAME);
  $newFile = $filename . '.' . $extension;
  $newPathname = $userCloudDirectory . '/' . $newFile;
  $safedir = '/tmp/SAFEDIR/isolated/' . $filename;
  $oldExtension = pathinfo($pathname, PATHINFO_EXTENSION);
  $archarray = array('zip', '7z', 'rar', 'tar', 'tar.gz', 'tar.bz2', 'iso', 'vhd',);
  $array7z = array('7z', 'zip', 'rar', 'iso', 'vhd');
  $array7zo = array('7z');
  $array7zo2 = array('vhd', 'iso');
  $arrayzipo = array('zip');
  $arraytaro = array('tar.gz', 'tar.bz2', 'tar');
  $arrayraro = array('rar');
  $passLit = $_POST('pass1');
  $pass = str_replace(' ', '', $passLit );
  $eType = $_POST['eType'];
  $SimArchEnc = $_POST['simple'];
  $salt =  $_POST['salt'];
  $base64 = $_POST['base64'];
  $stub = ('http://cloud.honestrepair.net/cloud/temp/');
  $newFileURL = $stub . $newFile; 
  $logFile = ('/var/www/html/HRProprietary/locker/Logs/' . $user_ID . $filename . $oldExtension . $extension . '.txt');
  $logFileURL = ($user_ID . $filename . $oldExtension . $extension . '.txt');
  $logFile2 = ('/var/www/html/HRProprietary/locker/Logs/' . $user_ID . $filename . $eType. '.txt');
  $logFile2URL = ($user_ID . $filename . $eType. '.txt');
 // Turn our post data from the uploader into variables for our OpenSSH commands.
  if ($eType = '\! ') {
    $eType1 = ''; }
    elseif ($eType = 'e128') {
    $eType1 = '-aes-128-cbc '; }
    elseif ($eType = 'e256') {
    $eType1 = '-aes-256-cbc ';) }
  if ($base64 = '\! ') {
    $b64 = ''; }
    elseif ($base64 = '1') {
    $b64 = '-a '; }
  if ($salt = '\! ') {
    $salt1 = ''; }
    elseif ($salt = '1') {
    $salt1 = '-salt '; }
// If the file is not an archive we scan it with ClamAV and generate a logfile. If the logfile is larger than 1 byte we 
// delete the files and stop the script. If the logfile is 0 bytes we encrypt the file. We then cleanup any files older 
// 2000 seconds from the temp directory. We also employ a secure way of leaving behind our index.html file that gets 
// reused later.
if (!in_array($oldExtension,$archarray) ) {
shell_exec ("freshclam"); 
shell_exec("clamscan -r --remove $pathname | grep FOUND >> $logFile");
  if filesize($logFile) < 1 ) { 
shell_exec ("openssl enc $eType1 $b64 $salt1 -in $pathname -out $newPathname -pass $pass");  }
    if ($handle = opendir('/var/www/html/cloud/temp/') ) {
      while (false !== ($file2 = readdir($handle) ) ) {
        if (filectime($file2)< (time()-2000) ) {
// The following 3 lines will exclude the index.html from being deleted with the rest of the files in $handle. 
          $file2ext = filetype($file2);
          $file2n = pathinfo($file2, PATHINFO_FILENAME);
          if ($file2ext != 'html') && if ( $file2n != 'index' ) {
          unlink($file2); } } } } }
  else {
    unlink($pathname); 
    die ('INFECTED FILE DETECTED!!! Encryption aborted.'); } 
// If our fie is an archive, but simpe mode is selected we treat the archive as any other file.
    if (in_array($oldExtension,$archarray) ) {
    if ($SimArchEnc = 0) { 
shell_exec ("freshclam"); 
shell_exec("clamscan -r --remove $pathname | grep FOUND >> $logFile");
  if filesize($logFile) < 1 ) { 
shell_exec ("openssl enc $eType1 $b64 $salt1 -in $pathname -out $newPathname -pass $pass");  }
    if ($handle = opendir('/var/www/html/cloud/temp/') ) {
      while (false !== ($file2 = readdir($handle) ) ) {
        if (filectime($file2)< (time()-2000) ) {
          $file2ext = filetype($file2);
          $file2n = pathinfo($file2, PATHINFO_FILENAME);
          if ($file2ext != 'html') && if ( $file2n != 'index' ) {
          unlink($file2); } } } } }
  else {
    unlink($pathname); 
    die ('INFECTED FILE DETECTED!!! Encryption aborted.'); }
// If "Advanced" is set we determine the best way to de-compress it by filtering the file extension. We then feed commands 
// to helpers like Unar, Unzip, and 7z to decompress the file to its own folder in a safe temporary directory. We also update
// ClamAV now and scan the archive before we extract. If infections are found we delete temporary files and kill the script.
  if ($SimArchEnc = 1) { 
      $safedir1 = '/tmp/SAFEDIR/isolated/';
      $safedir2 = "/tmp/SAFEDIR/isolated/$filename";
      mkdir("$safedir2", 0777, true);
      chmod($safedir2, 0777);
      $safedir3 = ("/tmp/SAFEDIR/isolated/$filename" . '.7z');
      $safedir4 = ("/tmp/SAFEDIR/isolated/$filename" . '.zip');
      shell_exec ("freshclam"); 
      shell_exec("clamscan -r --remove $pathname | grep FOUND >> $logFile");
  if filesize($logFile) < 1 ) { 
    if(in_array($oldExtension, $arrayzipo) ) {
     shell_exec("unzip $pathname -d $safedir2");
      } 
    if(in_array($oldExtension, $array7zo) ) {
     shell_exec("7z e $pathname -o$safedir2");
      } 
    if(in_array($oldExtension, $array7zo2) ) {
     shell_exec("7z e $pathname -o$safedir2");
      } 
    if(in_array($oldExtension, $arrayraro) ) {
     shell_exec("unrar e $pathname $safedir2");
      } 
    if(in_array($oldExtension, $arraytaro) ) {
     shell_exec("7z e $pathname -o$safedir2");
      } } }
// Clean up temporary files if virus infections are found.
  else {
        if ($handle = opendir('$safedir1') ) {
      while (false !== ($file2 = readdir($handle) ) ) {
        if (filectime($file2)< (time()-2000) ) {
          unlink($file2); } } } 
    unlink($safedir2);
    unlink($pathname); 
    die ('INFECTED FILE DETECTED!!! Encryption aborted.'); }
// Check if the extraction was sucessful. Die and return error if it was not. Usually this is the result of an unusual filename, 
// or one with a mismatched file extension (like a .txt file renamed to .zip). If we encounter an archive like this we scan the
// temporary locations for viruses before deleting temporary files and returning varying degrees of error messages to the user.
 $i=0;
opendir(DIR, "$safedir2") or die 'Error. Cannot open temporary directory.';
    @files = readdir(DIR);
    foreach $cfile(@files) {
      unless ($cfile =~ /^[.][.]?\z/) {
        $i++; } }
     if ($i = 0) {
shell_exec("clamscan -r --remove $safedir2 | grep FOUND >> $logFile");
if (filesize($logFile) > 1 ) {
  print "Error. No files were unpacked from the archive.";
  print "Error. ClamAV generated a logfile with a filesize over 0 bytes!"
  print "Cleaning temporary file locations... Success."
  print "Encryption aborted!"
      die ("Error during file-decompression. No files were created. Encryption aborted.");
}
else {
  print "Error. No files were unpacked from the archive.";
  print "Cleaning temporary file locations... Success."
  print "Encryption aborted!"
      die ("Error during file-decompression. No files were created. Encryption aborted.");
     } } 
// Scan the extracted files with ClamAV and remove infected files. Generate a logfile, and if that logfile 
// is over 0 bytes we kill the script. Also deletes files in temp directory older than 2,000 seconds. After
// this portion of code is done running no files should be left in ANY HRProprietary temp directory over 2000
// seconds old. Any redundant rmdir or unlink coding is intentional, and designed to completely scrub any files
// that might be kicking aroung. 
shell_exec("clamscan -r --remove $safedir2 | grep FOUND >> $logFile");
if (filesize($logfile) > 1 ) { 
  if ($handle = opendir('/var/www/html/cloud/temp/') ) {
    while (false !== ($file2 = readdir($handle) ) ) {
      if (filectime($file2)< (time()-2000)) {
        $file2ext = filetype($file2);
        $file2n = pathinfo($file2, PATHINFO_FILENAME);
        $delFiles = glob($safedir2 . '/*');
          if ($file2ext != 'html') && if ( $file2n != 'index' ) {
            unlink($pathname);
            unlink($file2); 
            unlink($safedir3);
            unlink($safedir4);
        foreach($delFiles as $delFile){
          if(is_file($delFile) ) {
            chmod($delFile, 0777);  
            unlink($delFile); }
          elseif(is_dir($delFile) ) {
            chmod($delFile, 0777);
            rmdir($delFile); } }    
            rmdir($safedir2); 
            unlink($safedir2); } } } } 
    die ('INFECTED FILE DETECTED!!! Encryption aborted.'); } }
// If our scans return no results we encrypt each file from our original archive and allow the user to select a format for 
// their new encrypted archive. Default means the same method detected from the original file will be used again.  
elseif filesize($logFile) < 1 ) { 
      if (in_array($extension,$array7zo) ) {
        $encFiles = glob($safedir2 . '/*');
        $encFilesNew = ($encFiles . '.enc');
        foreach($encFiles as $encFile) {
     shell_exec ("openssl enc $eType1 $b64 $salt1 -in $encFiles -out $encFilesNew -pass $pass"); }
          if(is_file($encFile) ) {
     shell_exec("7z a -t$extension $safedir3 $safedir2");
      copy($safedir3, $newPathname); } 
      if (file_exists($safedir3) ) {
        chmod($safedir3, 0777); 
        unlink($safedir3);
        $delFiles = glob($safedir2 . '/*');
        foreach($delFiles as $delFile){
          if(is_file($delFile) ) {
          chmod($delFile, 0777);  
          unlink($delFile); }
          elseif(is_dir($delFile) ) {
          chmod($delFile, 0777);
          rmdir($delFile); } }    
        rmdir($safedir2); }
      elseif (in_array($extension,$arrayzipo) ) {
        $encFiles = glob($safedir2 . '/*');
        $encFilesNew = ($encFiles . '.enc');
        foreach($encFiles as $encFile) {
     shell_exec ("openssl enc $eType1 $b64 $salt1 -in $encFiles -out $encFilesNew -pass $pass"); }
          if(is_file($encFile) ) {
     shell_exec("zip -r $safedir4 $safedir2");
      copy($safedir4, $newPathname); } 
      if (file_exists($safedir4) ) {
        chmod($safedir4, 0777); 
        unlink($safedir4);
        $delFiles = glob($safedir2 . '/*');
        foreach($delFiles as $delFile){
          if(is_file($delFile) ) {
          chmod($delFile, 0777);  
          unlink($delFile); }
          elseif(is_dir($delFile) ) {
          chmod($delFile, 0777);
          rmdir($delFile); } }    
        rmdir($safedir2); }
      elseif (in_array($extension, $arraytaro) ) {
        $encFiles = glob($safedir2 . '/*');
        $encFilesNew = ($encFiles . '.enc');
        foreach($encFiles as $encFile) {
     shell_exec ("openssl enc $eType1 $b64 $salt1 -in $encFiles -out $encFilesNew -pass $pass"); }
          if(is_file($encFile) ) {
     shell_exec ("tar czf $newPathname $safedir2");
        $delFiles = glob($safedir2 . '/*');
        foreach($delFiles as $delFile){
          if(is_file($delFile) ) {
          chmod($delFile, 0777);  
          unlink($delFile); }
          elseif(is_dir($delFile) ) {
          chmod($delFile, 0777);
          rmdir($delFile); } }     
        rmdir($safedir2); } 
      elseif(in_array($extension, $arrayraro) ) {
        $encFiles = glob($safedir2 . '/*');
        $encFilesNew = ($encFiles . '.enc');
        foreach($encFiles as $encFile) {
     shell_exec ("openssl enc $eType1 $b64 $salt1 -in $encFiles -out $encFilesNew -pass $pass"); }
          if(is_file($encFile) ) {
     shell_exec("rar a $newPathname $safedir2");
          $delFiles = glob($safedir2 . '/*');
          foreach($delFiles as $delFile){
            if(is_file($delFile) ) {
              chmod($delFile, 0777);  
              unlink($delFile); }
            elseif(is_dir($delFile) ) {
              chmod($delFile, 0777);
              rmdir($delFile); } } 
            rmdir($safedir2); } } } 
// Create a logfile containing the settings used to encrypt the files. This logfile will be presented to the user so they have a record of the work done,
// and so they can decrypt their files later using the same settings.
  if (file_exists($newPathname) ) {
    if ($b64 = '') { 
      $b64L = 'No'; 
      elseif ($b64 != '') { 
        $b64L = 'Yes'; } } 
    if ($salt = '';) { 
      $saltL = 'No'; 
      elseif ($salt != '') { 
        $saltL = 'Yes'; } }
    if(in_array($oldExtension, $archarray) ) { 
      $isArch = 'Yes'; 
      elseif (!in_array($oldExtension, $archarray) ) { 
      $isArch = 'No'; } }
    if ($simEncArch = 0) { 
      $simadv = 'Simple'; 
      elseif ($simEncArch = 1) {
      $simadv = 'Advanced v1.0 (Files extracted from archive, encrypted individually, & re-compressed)'}
      elseif ($simEncArch = '') {
      $simadv = ('Simple'); } } 
    if ($extension = '') { 
      $extL = 'Not Applicable'; 
      elseif ($extension != '') {
      $extL = $extension; } }
    $log  = "Your files have been encrypted using HRLocker version 1.0!" . PHP_EOL . 
            "-------------------------" . PHP_EOL .
            "File: " . $pathname . PHP_EOL . 
            "Date: " . date("F j, Y, g:i a") . PHP_EOL .
            "Original Filetype: " . $oldExtension . PHP_EOL .
            "New Filetype: " . $extL . PHP_EOL .
            "File is archive: " . $isArch . PHP_EOL .
            "HRLocker Method: " . $simadv . PHP_EOL .
            "Enctyrption Type : " . $eType.PHP_EOL .
            "Base64 Encoding: " . $b64L . PHP_EOL .
            "Salts Used: ".$saltL . PHP_EOL .
            "Password: " . $pass . PHP_EOL .
            "-------------------------" . PHP_EOL .
            "Thank you for using HRLocker and the Honest Repair Cloud Platform to secure your files. Visit us online at www.HonestRepair.net!" . PHP_EOL .
            "Please keep this logfile, or copy it's contents somewhere safe. These settings will need to be re-used when decrytpting your files." . PHP_EOL .
            "-------------------------" . PHP_EOL .
            "Please note, we are not responsible for files lost, damaged, or corrupted as a result of using this software." . PHP_EOL .
            "Please make backups of your original files in a safe place, and perform a test decryption of your data to make sure there is no corruption before use." . PHP_EOL;
      file_put_contents("$logFile2" . , $log, FILE_APPEND); }
    elseif (!file_exists($newPathname) ) {
      unlink $pathname;
      unlink $newPathname;
      die ('Error Copying files. Encryption aborted.');
    }
    If (!file_exists($logFile2) ) {
      unlink $pathname;
      unlink $newPathname;
      die ('Error generating decryption instructions for your files. Encryption aborted.') }

else { 
  print ('No file to encrypt.'); }
?>
</div>
<div align="center">
<br>
<div align="left">
<?php if (filesize($logFile) > 1 ) { ?><ul><a href="http://cloud.honestrepair.net/HRProprietary/locker/Logs/<?php echo $logFileURL; ?>" target="_blank"><strong>INFECTED FILES DETECTED!!</strong> Click for a log of omitted files.</a></ul> <?php }; ?>
<?php if (filesize($logFile2) > 1 ) { ?><ul><?php print $logFile2 ?></ul>
<?php if (filesize($logFile2) > 1 ) { ?><ul><a href="http://cloud.honestrepair.net/HRProprietary/locker/Logs/<?php echo $logFile2URL; ?>" target="_blank"><strong>IMPORTANT! Click here for to view/download a file of this encryption.</a></ul> <?php }; ?>
<?php if (filesize($logFile) < 1 ) { ?><ul><a href="<?php echo $newFileURL; ?>">Click Here to download your encrypted file</a></ul><?php }; ?>
<ul><a href="http://cloud.honestrepair.net/cloud/temp/<?php echo $file; ?>">Click Here to download your original file</a></ul>
<ul><a href="http://cloud.honestrepair.net/HRProprietary/locker/uploadbuttonhtml.php">Click Here to convert another file</a></ul>
</div>
<p><?php if ($user_ID == 0) { ?>
  <p><form action="<?php echo wp_login_url( get_permalink() ); ?>">
    <input type="submit" value="Login">  or  <form action="<?php echo wp_registration_url(); ?>">
    <input type="submit" value="Create an Account"></p><p>to upload your converted files to your own 3GB Cloud Drive.</p>
</form>
<br>
<?php } else { ?>
  <p><form action="http://cloud.honestrepair.net/HRProprietary/CloudIndexer.php">
    <input type="submit" value="Go to my Cloud Drive"></p>
</form>
<?php } ?>
</div>
<div>
<p>Thanks for using our software! To support us please like and share on social media. </p>
<br><p>This software is copyright by Justin G. 2015.  By downloading your converted file you agree that HonestRepair is not responsible for formatting discrepencies or errors in either of your documents. </p>
<p>Version 1.5</p>
</div>
</body>

</html>