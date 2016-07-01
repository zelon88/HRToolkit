 <html>

 <head>
  <title>Scanning File</title>
 </head>
 <body><div align="center">
<a href="http://localhost/">
<img src="http://localhost/HRProprietary/scanner/HRBanner.png" alt="HonestRepair"> </a>
</div>
<div style=""
    <br>
    <div align="center"><p><h2>Your file has been scanned.</h2></div>
    <br>
<div align="center">
  <br>
<?php
// Justin G.  2016
// HRScan Version 1.0 - 3/6/16
// This web application was designed to automatically identify files uploaded by a client and scan that file with ClamAV. If the file is an archive, disk image, 
// or virtual hard drive the contents of the original file are extracted to a quarantine location and scanned individally. After the scan is complete all files are deleted
// and a lot of the scan results is created. If results are found the logfile is offered to the client for viewing. 
if ( isset( $_POST['Scan'] ) ) {
  require_once('/var/www/html/wp-load.php');
  $user_ID = get_current_user_id();
  $file = $_POST['hiddenFile'];
  $filename = pathinfo($file, PATHINFO_FILENAME);
  $safedir = ('/tmp/QNTN/safedir/isolated/' . $file . '.' . $oldExtension); 
  $oldExtension = pathinfo($file, PATHINFO_EXTENSION);
$allowed = array('jpg', 'jpeg', 'gif', 'png', 'dat', 'pages', 'cfg', 'txt', 'doc', 'docx', 'rtf', 'odf', 'odt', 'abw', 'msi', 'exe', 'deb', 'dll', 'pif', 'application', 'msp', 'com',
   'scr', 'gadget', 'cpl', 'msc', 'jar', 'zip', '7z', 'rar', 'tar', 'tar.gz', 'tar.bz2', 'iso', 'vhd', 'abw', 'pdf', 'mp3', 'avi', 'wma', 'wav', 'ogg', 'xls', 'xlsx', 'ods', 'bat',
   'cmd', 'inf', 'ppt', 'reg', 'vb', 'vbe', 'vbs,', 'pptm', 'msh', 'msh1', 'msh2', 'xcf', 'lnk', 'docm', 'dotm', 'xltm', 'ws', 'wsf', 'bat', );
$allowed1 = array('dat', 'pages', 'cfg', 'txt', 'doc', 'docx', 'rtf', 'odf', 'odt', 'abw', 'msi', 'exe', 'deb', 'dll', 'pif', 'application', 'msp', 'com',
   'scr', 'gadget', 'cpl', 'msc', 'abw', 'pdf', 'mp3', 'avi', 'wma', 'wav', 'ogg', 'xls', 'xlsx', 'ods', 'bat', 'jpg', 'jpeg', 'gif', 'png', 
   'cmd', 'inf', 'ppt', 'reg', 'vb', 'vbe', 'vbs,', 'pptm', 'msh', 'msh1', 'msh2', 'xcf', 'lnk', 'docm', 'dotm', 'xltm', 'ws', 'wsf' );
  $allowed2 = array('zip', '7z', 'rar', 'tar', 'tar.gz', 'tar.bz2', 'iso', 'vhd',);
  $archarray = array('zip', '7z', 'rar', 'tar', 'tar.gz', 'tar.bz2', 'iso', 'vhd');
  $array7z = array('7z', 'zip', 'rar', 'iso', 'vhd');
  $array7zo = array('7z');
  $array7zo2 = array('vhd', 'iso');
  $arrayzipo = array('zip');
  $arraytaro = array('tar.gz', 'tar.bz2', 'tar');
  $arrayraro = array('rar');
  $safedir3 = "/tmp/QNTN/safedir/isolated/$file";
  $safedir2 = "/tmp/QNTN/safedir/isolated/$filename";
  $logFile = ('/var/www/html/HRProprietary/scanner/Logs/' . $user_ID . $file . '.txt');
  $logFileURL = ($user_ID . $file . '.txt');
    if (in_array($oldExtension,$allowed1) ) {
      mkdir("$safedir2", 0777, true);
      chmod($safedir2, 0777);
      shell_exec ("freshclam"); 
      shell_exec("clamscan -r --remove $safedir3 | grep FOUND >> $logFile"); }
    if (in_array($oldExtension,$allowed2) ) {
      mkdir("$safedir2", 0777, true);
      chmod($safedir2, 0777);
      $safedir1 = '/tmp/QNTN/safedir/isolated/';
    if(in_array($oldExtension, $arrayzipo) ) {
     shell_exec('unzip ' . $safedir3 . ' -d ' . $safedir2);
      } 
    if(in_array($oldExtension, $array7zo) ) {
     shell_exec('7z e ' . $safedir3 . ' -o' . $safedir2);
      } 
    if(in_array($oldExtension, $array7zo2) ) {
     shell_exec('7z e ' . $safedir3 . ' -o ' . $safedir2);
      } 
    if(in_array($oldExtension, $arrayraro) ) {
     shell_exec('unrar e ' . $safedir3 . ' ' . $safedir2);
      } 
    if(in_array($oldExtension, $arraytaro) ) {
     shell_exec('7z e ' . $safedir3 . ' -o ' . $safedir2);
      } 
shell_exec("freshclam");
shell_exec("clamscan -r --remove $safedir2 | grep FOUND >> $logFile"); 
shell_exec("clamscan -r --remove $safedir3 | grep FOUND >> $logFile"); } }
 if (file_exists($safedir2) ) {
        chmod($safedir2, 0777); 
        $delFiles = glob($safedir2 . '/*');
        foreach($delFiles as $delFile){
          if(is_file($delFile) ) {
          @chmod($delFile, 0777);  
          @unlink($delFile); } 
          elseif(is_dir($delFile) ) {
          @chmod($delFile, 0777);
          @rmdir($delFile); } }   
        @chmod($safedir2, 0777);
        @rmdir($safedir2); 
        @unlink($safedir2);
        @chmod($file, 0777);
        @rmdir($file); 
        @unlink($file);
        @chmod($filename, 0777); 
        @rmdir($filename);
        @unlink($filename); 
        @chmod($safedir3, 0777); 
        @unlink($safedir3);
        @rmdir($safedir3); } 
 if (file_exists($safedir3) ) {
        @chmod($safedir3, 0777); 
        $delFiles2 = glob($safedir3 . '/*');
        foreach($delFiles2 as $delFile2){
          if(is_file($delFile2) ) {
          @chmod($delFile2, 0777);  
          @unlink($delFile2); } 
          elseif(is_dir($delFile2) ) {
          @chmod($delFile2, 0777);
          @rmdir($delFile2); } }   
        @chmod($safedir2, 0777);  
        @rmdir($safedir2); 
        @unlink($safedir2);
        @rmdir($file);
        @chmod($file, 0777); 
        @unlink($file);
        @chmod($filename, 0777); 
        @rmdir($filename);
        @unlink($filename); 
        @chmod($safedir, 0777); 
        @unlink($safedir);
        @rmdir($safedir);
        @chmod($safedir3, 0777); 
        @unlink($safedir3);
        @rmdir($safedir3);  } 
 if (file_exists($safedir) ) {
        @chmod($safedir1, 0777); 
        $delFiles3 = glob($safedir1 . '/*');
        foreach($delFiles3 as $delFile3){
          if(is_file($delFile3) ) {
          @chmod($delFile3, 0777);  
          @unlink($delFile3); } 
          elseif(is_dir($delFile3) ) {
          @chmod($delFile3, 0777);
          @rmdir($delFile3); } }  
        @chmod($safedir2, 0777); 
        @rmdir($safedir2); 
        @unlink($safedir2);
        @chmod($file, 0777); 
        @rmdir($file);
        @rmdir($filename);
        @unlink($file);
        @chmod($filename, 0777); 
        @unlink($filename); 
        @chmod($safedir, 0777); 
        @unlink($safedir); 
        @rmdir($safedir); 
        @chmod($safedir3, 0777); 
        @unlink($safedir3);
        rmdir($safedir3); } 
 if (file_exists($logFile) ) {
print $file; echo ' has sucessfully been scanned. The results of our scan can be viewed below. ' ; }
 if (!file_exists($logFile) ) {
echo ("Errors were encountered and $file has NOT been scanned. Please try renaming the file. If you still cannot get beyond this error message try renaming the file extension to .txt."); }
 ?>

<div align="center">
<div style="max-width:700px">
<?php if (filesize($logFile) < 1 ) { ?> 
<hr />
<br>
<h2><p>No infections detected. Your files should be safe for use. </p></h2>
<p><strong>NOTE:</strong> We assume no reponsibility for the consequences of using these files. We offer no guarantees over accuracy when using this software.</p>
<br>
<hr />
<p><h3>How our scanner detects infected, malicious, and potentially unwanted files. </h3></p>
<p>Our scanner uses <a href="https://www.clamav.net/" target="_blank">ClamAV Open Source Anti-Virus Software</a> to scan your files. If your files are uploaded in an archive, disk image, or virtual drive format they will be extracted prior to scanning with either 
<a href="https://www.rarlab.com/rar_add.htm" target="_blank">Unrar</a>, <a href="http://www.linuxfromscratch.org/blfs/view/svn/general/unzip.html" target="_blank">Unzip</a> or <a href="http://7-zip.org/download.html" target="_blank">7z</a></ul>
<p>Once you upload your file to our servers it is immediately quarantined and scanned in-place. As soon as this process is complete all traces of the uploaded file are removed from our servers. We cannot recover these files under any circumstances. We also cannot modify the files on your personal 
devices. This means anything you uploaded to HRScan will be deleted immediately after our scan is complete. You are responsible for either keeping, or deleting the files in question from your device.</p>
<p><strong>This Program Only DETECTS Potential Threats. It CANNOT Remove Them From Your Device.</strong></p>
<p>If you have any doubts regarding the results of this test, or the legitimacy of these files it is recommended that you seek additional scans or that you remove/uninstall these files/programs properly, following all applicable instructions if possible. If you decide not to keep this file, you must remember to delete it manually.</p>
<p>It is important to note that HRScan <strong>Will Not</strong> extract an archive-in-an-archive. Only the master arhive will be extracted and scanned. To scan archives inside of other archives safely, first upload the parent archive for scanning, followed by the children archives separately.</p>
<?php }; ?>
<?php if (filesize($logFile) > 1 ) { ?> <ul><a href="http://localhost/HRProprietary/scanner/Logs/<?php echo $logFileURL; ?>" target="_blank"><h3><strong>INFECTED FILES DETECTED!!</strong></h3> Click to download a log of infected files.</a></ul></p>
<hr />
<br>
<p><h2>Infections were found during our scan! It is highly reccomended that you review the results of our scan with great scrutiny before you decide to open or execute the files in question.</h2></p>
<br><a href="http://localhost/HRProprietary/scanner/Logs/<?php echo $logFileURL; ?>" target="_blank"><h3><strong>VIEW SCAN RESULTS!!!</strong></h3></a>
<hr />
<p><h3>How our scanner detects infected, malicious, and potentially unwanted files. </h3></p>
<p>Our scanner uses <a href="https://www.clamav.net/" target="_blank">ClamAV Open Source Anti-Virus Software</a> to scan your files. If your files are uploaded in an archive, disk image, or virtual drive format they will be extracted prior to scanning with either 
<a href="https://www.rarlab.com/rar_add.htm" target="_blank">Unrar</a>, <a href="http://www.linuxfromscratch.org/blfs/view/svn/general/unzip.html" target="_blank">Unzip</a> or <a href="http://7-zip.org/download.html" target="_blank">7z</a></ul>
<p>Once you upload your file to our servers it is immediately quarantined and scanned in-place. As soon as this process is complete all traces of the uploaded file are removed from our servers. We cannot recover these files under any circumstances. We also cannot modify the files on your personal 
devices. This means anything you uploaded to HRScan will be deleted immediately after our scan is complete. You are responsible for either keeping, or deleting the files in question from your device.</p>
<p><strong>This Program Only DETECTS Potential Threats. It CANNOT Remove Them From Your Device.</strong> </p>
<p>If you have any doubts regarding the results of this test, or the legitimacy of these files it is recommended that you seek additional scans or that you remove/uninstall these files/programs properly, following all applicable instructions if possible. If you decide not to keep this file, you must remember to delete it manually.</p>
<p>It is important to note that HRScan <strong>Will Not</strong> extract an archive-in-an-archive. Only the master arhive will be extracted and scanned. To scan archives inside of other archives safely, first upload the parent archive for scanning, followed by the children archives separately.</p>
<?php }; ?>
</div></div>