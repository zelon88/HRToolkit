 <html>

 <head>
  <title>Converting File</title>
 </head>
 <body>
<a href="http://cloud.honestrepair.net">
<img src="http://localhost/HRProprietary/converter/HRBanner.png" alt="HonestRepair"> </a>
<div style=""
    <br>
    <div align="center"><p><h2>Your file has been converted</h2></div>
    <br>
<div align="center">
<?php
if ( isset( $_POST['convertDownload'] ) ) {
  require_once('/var/www/html/wp-load.php');
  $user_ID = get_current_user_id();
  $extension = $_POST['selected'];
  $file = $_POST['hiddenFile'];
  $userTempDirectory = ('/var/www/html/cloud/temp');
  $pathname = $userTempDirectory . '/' . $file;
  $filename = pathinfo($pathname, PATHINFO_FILENAME);
  $newFile = $filename . '.' . $extension;
  $newPathname = $userTempDirectory . '/' . $newFile;
  $safedir = '/tmp/SAFEDIR/isolated/' . $filename; 
  $oldExtension = pathinfo($pathname, PATHINFO_EXTENSION);
  $docarray =  array('txt' ,'doc', 'xls', 'xlsx', 'docx', 'rtf', 'odf', 'ods', 'odt', 'dat', 'cfg');
  $imgarray = array('jpg', 'jpeg', 'bmp', 'png', 'gif');
  $pdfarray = array('pdf');
  $abwarray = array('abw');
  $archarray = array('zip', '7z', 'rar', 'tar', 'tar.gz', 'tar.bz2', 'iso', 'vhd');
  $array7z = array('7z', 'zip', 'rar', 'iso', 'vhd');
  $array7zo = array('7z');
  $arraytaro = array('tar.gz', 'tar.bz2', 'tar');
  $arrayraro = array('rar', 'zip');
  $abwstd = array('doc', 'abw');
  $abwuno = array('docx', 'pdf', 'txt', 'rtf', 'odf', 'dat', 'cfg');
  $audioarray =  array('mp3', 'avi', 'wma', 'wav', 'ogg');
  $pdfarray = array('pdf');
  $stub = ('http://localhost/cloud/temp/');
  $newFileURL = $stub . $newFile; 
  print $file; echo ' has sucessfully been converted to '; print $newFile; echo '. You can download this file below.';
    if (in_array($oldExtension,$docarray) ) {
      if (!in_array($extension, $abwarray) ) {
     shell_exec ("unoconv -o $newPathname -f $extension $pathname"); }
      elseif (in_array($extension,$abwarray) ) {
        if (in_array($oldExtension,$abwstd) ) {
     shell_exec ("abiword --to=$newPathname $pathname"); }
        elseif (in_array($oldExtension,$abwuno) ) {
          $safedir1 = $safedir . '.doc';
          $extensiondoc = 'doc';
     shell_exec ("unoconv -o $safedir1 -f $extensiondoc $pathname");
     shell_exec ("abiword --to=$newPathname $safedir1"); } } }


      if (in_array($oldExtension,$abwarray) ) {
        if (in_array($extension,$abwstd) ) {
     shell_exec ("abiword --to=$newPathname $pathname"); }
        elseif (in_array($extension,$abwuno) ) {
          $safedir1 = $safedir . '.doc';
     shell_exec ("abiword --to=$safedir1 $pathname");
     shell_exec ("unoconv -o $newPathname -f $extension $safedir1"); } }
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
     shell_exec ("ffmpeg -i $pathname$ext$br$newPathname"); } }

    if (in_array($oldExtension,$archarray) ) {
      $safedir1 = '/tmp/SAFEDIR/isolated/';
      $safedir2 = "/tmp/SAFEDIR/isolated/$filename";
      mkdir("$safedir2", 0777, true);
      chmod($safedir2, 0777);
      if (in_array($extension,$array7zo) ) {
     shell_exec("7z e $pathname -o$safedir2");
     shell_exec("7z a $safedir2");
      $safedir3 = ("/tmp/SAFEDIR/isolated/$filename" . '.7z');
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
      elseif (in_array($extension, $arraytaro) ) {
     shell_exec("7z e $pathname -o$safedir2");
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
     shell_exec("7z e $pathname -o$safedir2");
     shell_exec("rar a $newPathname $safedir2");
          $delFiles = glob($safedir2 . '/*');
          foreach($delFiles as $delFile){
            if(is_file($delFile) ) {
              chmod($delFile, 0777);  
              unlink($delFile); }
            elseif(is_dir($delFile) ) {
              chmod($delFile, 0777);
              rmdir($delFile); } } 
            rmdir($safedir2); } }

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
  $docarray =  array('txt' ,'doc', 'xls', 'xlsx', 'docx', 'rtf', 'odf', 'ods', 'odt', 'dat', 'cfg');
  $imgarray = array('jpg', 'jpeg', 'bmp', 'png', 'gif');
  $pdfarray = array('pdf');
  $abwarray = array('abw');
  $archarray = array('zip', '7z', 'rar', 'tar', 'tar.gz', 'tar.bz2', 'iso', 'vhd',);
  $array7z = array('7z', 'zip', 'rar', 'iso', 'vhd');
  $array7zo = array('7z');
  $arraytaro = array('tar.gz', 'tar.bz2', 'tar');
  $arrayraro = array('rar', 'zip');
  $abwstd = array('doc', 'abw');
  $abwuno = array('docx', 'pdf', 'txt', 'rtf', 'odf', 'dat', 'cfg');
  $audioarray =  array('mp3', 'avi', 'wma', 'wav', 'ogg');
  $stub = ('http://localhost/cloud/');
  $newFileURL = $stub . $user_ID . '/' . $newFile; 
  if ($user_ID == 0) { print $file; echo ' has sucessfully been converted to '; print $newFile; echo ' HOWEVER since you ARE NOT LOGGED IN your file was placed in a temporary Cloud. Your files are still available for download below.';  }
    else { print $file; echo ' has sucessfully been converted to '; print $newFile; echo '. A copy of '; 
      print $newFile; echo ' was placed in your Cloud Drive. You can download both files below.'; }
    if (in_array($oldExtension,$docarray) ) {
      if (in_array($extension,$abwarray) ) {
        if (in_array($oldExtension,$abwstd) ) {
     shell_exec ("abiword --to=$newPathname $pathname"); }
        elseif (in_array($oldExtension,$abwuno) ) {
          $safedir1 = $safedir . '.doc';
          $extensiondoc = 'doc';
     shell_exec ("unoconv -o $safedir1 -f $extensiondoc $pathname");
     shell_exec ("abiword --to=$newPathname $safedir1"); }
       else {
     shell_exec ("unoconv -o $newPathname -f $extension $pathname"); } } }
     if (in_array($oldExtension,$abwarray) ) {
       if (in_array($extension,$abwstd) ) {
     shell_exec ("abiword --to=$newPathname $pathname"); }
       elseif (in_array($extension,$abwuno) ) {
         $safedir1 = $safedir . '.doc';
     shell_exec ("abiword --to=$safedir1 $pathname");
     shell_exec ("unoconv -o $newPathname -f $extension $safedir1"); } }
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
     shell_exec ("ffmpeg -i $pathname$ext$br$newPathname"); } }

    if (in_array($oldExtension,$archarray) ) {
      $safedir1 = '/tmp/SAFEDIR/isolated/';
      $safedir2 = "/tmp/SAFEDIR/isolated/$filename";
      mkdir("$safedir2", 0777, true);
      chmod($safedir2, 0777);
      if (in_array($extension,$array7zo) ) {
     shell_exec("7z e $pathname -o$safedir2");
     shell_exec("7z a $safedir2");
      $safedir3 = ("/tmp/SAFEDIR/isolated/$filename" . '.7z');
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
      elseif (in_array($extension, $arraytaro) ) {
     shell_exec("7z e $pathname -o$safedir2");
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
     shell_exec("7z e $pathname -o$safedir2");
     shell_exec("rar a $newPathname $safedir2");
          $delFiles = glob($safedir2 . '/*');
          foreach($delFiles as $delFile){
            if(is_file($delFile) ) {
              chmod($delFile, 0777);  
              unlink($delFile); }
            elseif(is_dir($delFile) ) {
              chmod($delFile, 0777);
              rmdir($delFile); } } 
            rmdir($safedir2); } }

else { 
  print ('No file to convert.'); }
?>

</div>
<div align="center">
<br>
<div align="left">
<ul><a href="<?php echo $newFileURL; ?>">Click Here to download your converted file</a></ul>
<ul><a href="http://localhost/cloud/temp/<?php echo $file; ?>">Click Here to download your original file</a></ul>
<ul><a href="http://localhost/HRProprietary/converter/uploadbuttonhtml.php">Click Here to convert another file</a></ul>
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
<p>Thanks for using our software! To support HonestRepair and help power it's in-house servers and future software development please like and share on social media, check out our blog, sign-up for Cloud Storage, have a website made, or schedule an appointment for honest computer repair.</p>
<br><p>This software is copyright by Justin G. 2015.  By downloading your converted file you agree that HonestRepair is not responsible for formatting discrepencies or errors in either of your documents. </p>
</div>
</body>

</html>