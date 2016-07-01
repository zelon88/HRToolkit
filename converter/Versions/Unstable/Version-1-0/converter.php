 
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
  $file = $_POST['hiddenFile'];
  $extension = $_POST['selected'];
  $userTempDirectory = ('/var/www/html/cloud/temp');
  $pathname = $userTempDirectory . '/' . $file;
  $filename = pathinfo($pathname, PATHINFO_FILENAME);
  $newFile = $filename . '.' . $extension;
  $newPathname = $userTempDirectory . '/' . $newFile;
  shell_exec ("unoconv -f $extension $userTempDirectory/$file");
  $stub = ('http://localhost/cloud/temp/');
  $newFileURL = $stub . $newFile;
  print $file; echo ' has sucessfully been converted to '; print $newFile; echo '. You can download this file below.';
}

elseif ( isset( $_POST['convertCloud'] ) ) {
  require_once('/var/www/html/wp-load.php');
  $user_ID = get_current_user_id();
  $file = $_POST['hiddenFile'];
  $extension = $_POST['selected'];
  $userTempDirectory = ('/var/www/html/cloud/temp');
  $userCloudDirectory = ('/var/www/html/cloud/' . get_current_user_id() . '/');
  $pathname = $userCloudDirectory . $file;
  $filename = pathinfo($pathname, PATHINFO_FILENAME);
  $newFile = $filename . '.' . $extension;
  $newPathname = $userCloudDirectory . $newFile;
  shell_exec ("unoconv -o $userCloudDirectory/$newFile -f $extension $userTempDirectory/$file");
  $stub = ('http://localhost/cloud/');
  $newFileURL = $stub . $user_ID . '/' . $newFile;
  print $file; echo ' has sucessfully been converted to '; print $newFile; echo '. A copy of '; 
  print $newFile; echo ' was placed in your Cloud Drive. You can also download both files below.';
}

else { 
print ('No file to convert.');
}
?>
</div>
<div align="center">
<br>
<div align="left">
<ul><a href="<?php echo $newFileURL; ?>">Click Here to download your converted file</a></ul>
<ul><a href="http://localhost/cloud/temp/<?php echo $file; ?>">Click Here to download your original file</a></ul>
<ul><a href="http://localhost/HRProprietary/converter/converter.php">Click Here to convert another file</a></ul>
</div>
</div>
<br>
<div>
<p>Thanks for using our software! To support HonestRepair and help power it's in-house servers and future software development please like and share on social media, check out our blog, sign-up for Cloud Storage, have a website made, or schedule an appointment for honest computer repair.</p>
<br><p>This software is copyright by Justin G. 2015 and is only for use by HonestRepair and it's users.</p>
</div>
</body>

</html>