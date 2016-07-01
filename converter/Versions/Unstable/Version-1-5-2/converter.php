 <html>

 <head>
  <title>Converting File</title>
 </head>
 <body>
<div align="center">
<a href="http://cloud.honestrepair.net">
<img src="http://cloud.honestrepair.net/HRProprietary/converter/HRBanner.png" alt="HonestRepair"> </a>
</div>
<div style=""
    <br>
    <div align="center"><p><h2>Your file has been converted.</h2></div>
    <br>
<div align="center">
  <br>
<?php
// Justin G.  2015
// Version 1.5 - 3/4/16
// This web application was designed to automatically identify files uploaded by a client and return options for converting that
// fie into other filetypes. The application provides a simple GUI to change settings. It can also identify authenticated
// WordPress users and give them the option to place the converted files into a client-specific destination on the server.
// In addition to a traditional Ubuntu 15.04 or later LAMP stack running PHP 5.6, this application requires ... 
// LibreOffice 4.0 or later, Python 3.5, Unoconv, ffmpeg, ImageMagick, Rar, Unrar, 7z, and ClamAV.
if ( isset( $_POST['convertDownload'] ) ) {
  require_once('/var/www/html/wp-load.php');
  $user_ID = get_current_user_id();
  $extension = $_POST['selected'];
  $file1 = $_POST['hiddenFile'];
  $file = str_replace(" ", "_", $file1 );
  $userTempDirectory = ('/var/www/html/cloud/temp');
  $pathname = $userTempDirectory . '/' . $file;
  $filename = pathinfo($pathname, PATHINFO_FILENAME);
  $newFile = $filename . '.' . $extension;
  $newPathname = $userTempDirectory . '/' . $newFile;
  $safedir = '/tmp/SAFEDIR/isolated/' . $filename; 
  $oldExtension = pathinfo($pathname, PATHINFO_EXTENSION);
  $docarray =  array('txt', 'pages', 'doc', 'xls', 'xlsx', 'docx', 'rtf', 'odf', 'ods', 'odt', 'dat', 'cfg');
  $imgarray = array('jpg', 'jpeg', 'bmp', 'png', 'gif');
  $pdfarray = array('pdf');
  $abwarray = array('abw');
  $archarray = array('zip', '7z', 'rar', 'tar', 'tar.gz', 'tar.bz2', 'iso', 'vhd');
  $array7z = array('7z', 'zip', 'rar', 'iso', 'vhd');
  $array7zo = array('7z');
  $array7zo2 = array('vhd', 'iso');
  $arrayzipo = array('zip');
  $arraytaro = array('tar.gz', 'tar.bz2', 'tar');
  $arrayraro = array('rar');
  $abwstd = array('doc', 'abw');
  $abwuno = array('docx', 'pdf', 'txt', 'rtf', 'odf', 'dat', 'cfg');
  $audioarray =  array('mp3', 'avi', 'wma', 'wav', 'ogg');
  $pdfarray = array('pdf');
  $stub = ('http://cloud.honestrepair.net/cloud/temp/');
  $newFileURL = $stub . $newFile; 
  $logFile = ('/var/www/html/HRProprietary/converter/Logs/' . $user_ID . $filename . $oldExtension . $extension . '.txt');
  $logFileURL = ($user_ID . $filename . $oldExtension . $extension . '.txt');
  print $file; echo ' has sucessfully been converted to '; print $newFile; echo '. You can download this file below.';
    if (in_array($oldExtension,$docarray) ) {
      shell_exec ("unoconv -f $extension $pathname");  }
    if (in_array($oldExtension,$imgarray) ) {
      $height = $_POST['height'];
      $width =  $_POST['width'];
      $maintainAR = $_POST['maintainAR'];
      $rotate = ('-rotate ' . $_POST['rotate']);
      $wxh = $width . 'x' . $height;
        if ($maintainAR = 'maintainAR') {
          $maintain = ' '; }
        elseif ($maintainAR = '\! ') {
          $maintain = ' '; }
          if ($wxh === '0x0') {
     shell_exec ("convert $pathname $rotate $newPathname"); }
          elseif (($width or $height) != '0') {
     shell_exec ("convert -resize $wxh$maintain$rotate $pathname $newPathname"); } } 
    if (in_array($oldExtension,$audioarray) ) { 
      $bitrate = $_POST['bitrate'];
      $ext = (' -f ' . $extension);
      if ($bitrate = 'auto' ) {
        $br = ' '; } 
        elseif ($bitrate != 'auto' ) {
          $br = (' -ab ' . $bitrate . ' '); } 
     shell_exec ("ffmpeg -i $pathname$ext$br$newPathname"); } 
    if (in_array($oldExtension,$archarray) ) {
      $safedir1 = '/tmp/SAFEDIR/isolated/';
      $safedir2 = "/tmp/SAFEDIR/isolated/$filename";
      mkdir("$safedir2", 0777, true);
      chmod($safedir2, 0777);
      $safedir3 = ("/tmp/SAFEDIR/isolated/$filename" . '.7z');
      $safedir4 = ("/tmp/SAFEDIR/isolated/$filename" . '.zip');
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
      } 
shell_exec("clamscan -r --remove $safedir2 | grep FOUND >> $logFile");
      if (in_array($extension,$array7zo) ) {
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

elseif ( isset( $_POST['convertCloud'] ) ) {
  require_once('/var/www/html/wp-load.php');
  $user_ID = get_current_user_id();
  $file = $_POST['hiddenFile'];
  $extension = $_POST['selected']; 
  $userTempDirectory = ('/var/www/html/cloud/temp/');
  $userCloudDirectory = ('/var/www/html/cloud/' . get_current_user_id() . '/');
  $pathname = $userTempDirectory . $file;
  $oldPathname = $userTempDirectory . $file;
  $filename = pathinfo($pathname, PATHINFO_FILENAME);
  $oldExtension = pathinfo($pathname, PATHINFO_EXTENSION);
  $newFile = $filename . '.' . $extension;
  $newPathname = $userCloudDirectory . $newFile;
  $safedir = '/tmp/SAFEDIR/isolated/' . $filename; 
  $docarray =  array('txt', 'pages', 'doc', 'xls', 'xlsx', 'docx', 'rtf', 'odf', 'ods', 'odt', 'dat', 'cfg');
  $imgarray = array('jpg', 'jpeg', 'bmp', 'png', 'gif');
  $pdfarray = array('pdf');
  $abwarray = array('abw');
  $archarray = array('zip', '7z', 'rar', 'tar', 'tar.gz', 'tar.bz2', 'iso', 'vhd',);
  $array7z = array('7z', 'zip', 'rar', 'iso', 'vhd');
  $array7zo = array('7z');
  $arrayzipo = array('zip');
  $array7zo2 = array('vhd', 'iso');
  $arraytaro = array('tar.gz', 'tar.bz2', 'tar');
  $arrayraro = array('rar',);
  $abwstd = array('doc', 'abw');
  $abwuno = array('docx', 'pdf', 'txt', 'rtf', 'odf', 'dat', 'cfg');
  $audioarray =  array('mp3', 'avi', 'wma', 'wav', 'ogg');
  $stub = ('http://cloud.honestrepair.net/cloud/');
  $newFileURL = $stub . $user_ID . '/' . $newFile; 
  $logFile = ( $user_ID . $filename . $oldExtension . $extension . '.txt');
  $logFileURL = ('http://cloud.honestrepair.net/HRProprietary/converter/Logs/') . $user_ID . $filename . $oldExtension . $extension . '.txt';
  if ($user_ID == 0) { print $file; echo ' has sucessfully been converted to '; print $newFile; echo ' HOWEVER since you ARE NOT LOGGED IN your file was placed in a temporary Cloud. Your files are still available for download below.';  }
    else { print $file; echo ' has sucessfully been converted to '; print $newFile; echo '. A copy of '; 
      print $newFile; echo ' was placed in your Cloud Drive. You can download both files below.'; }
    if (in_array($oldExtension,$docarray) ) {
      shell_exec ("unoconv -o $newPathname -f $extension $pathname"); }
    if (in_array($oldExtension,$imgarray) ) {
      $height = $_POST['height'];
      $width =  $_POST['width']; 
      $maintainAR = $_POST['maintainAR'];
      $rotate = ('-rotate ' . $_POST['rotate']);
      $wxh = $width . 'x' . $height;
        if ($maintainAR = 'maintainAR') {
          $maintain = ' '; } 
          elseif ($maintainAR = '\! ') {
            $maintain = ' '; } 
        if ($wxh === '0x0') {       
     shell_exec ("convert $pathname $rotate $newPathname"); } 
          elseif (($width or $height) != '0') {
     shell_exec ("convert -resize $wxh$maintain$rotate $pathname $newPathname"); }  }
    if (in_array($oldExtension,$audioarray) ) { 
      $bitrate = $_POST['bitrate'];
      $ext = (' -f ' . $extension);
      if ($bitrate = 'auto' ) {
        $br = ' '; } 
        elseif ($bitrate != 'auto' ) {
          $br = (' -ab ' . $bitrate . ' '); } 
     shell_exec ("ffmpeg -i $pathname$ext$br$newPathname"); } 
    if (in_array($oldExtension,$archarray) ) {
      $safedir1 = '/tmp/SAFEDIR/isolated/';
      $safedir2 = "/tmp/SAFEDIR/isolated/$filename";
      mkdir("$safedir2", 0777, true);
      chmod($safedir2, 0777);
      $safedir3 = ("/tmp/SAFEDIR/isolated/$filename" . '.7z');
      $safedir4 = ("/tmp/SAFEDIR/isolated/$filename" . '.zip');
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
      } 
shell_exec("clamscan -r --remove $safedir2 | grep FOUND >> $logFile");
      if (in_array($extension,$array7zo) ) {
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
     shell_exec("rar a $newPathname $safedir2");
          $delFiles = glob($safedir2 . '/*');
          foreach($delFiles as $delFile){
            if(is_file($delFile) ) {
              chmod($delFile, 0777);  
              unlink($delFile); }
            elseif(is_dir($delFile) ) {
              chmod($delFile, 0777);
              rmdir($delFile); } } 
            rmdir($safedir2); } }  }

else { 
  print ('No file to convert.'); }
?>
</div>
<div align="center">
<br>
<div align="left">
<?php if (file_exists($logFile) && filesize($logFile) > 1 ) { ?> <ul><a href="http://cloud.honestrepair.net/HRProprietary/converter/Logs/<?php echo $logFileURL; ?>" target="_blank"><strong>INFECTED FILES DETECTED!!</strong> Click for a log of omitted files.</a></ul> <?php }; ?>
<ul><a href="<?php echo $newFileURL; ?>">Click Here to download your converted file</a></ul>
<ul><a href="http://cloud.honestrepair.net/cloud/temp/<?php echo $file; ?>">Click Here to download your original file</a></ul>
<ul><a href="http://cloud.honestrepair.net/HRProprietary/converter/uploadbuttonhtml.php">Click Here to convert another file</a></ul>
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