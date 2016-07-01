<html>
 <head>
  <title>DocumentControl | File Uploader</title>
 </head>
 <body>

<?php
require("config.php"); 
if (!isset($_FILES)) { ?>
<div >
<div align="center" style="max-width:400px"><h3>Submit a new document...</h3></div> 
<hr />
<div align="left">
<form method="post" action="Uploader2.php" enctype="multipart/form-data">
<input name="filesToUpload[]" id="filesToUpload" type="file" multiple="" />
<input type="submit" value="Submit Document" id="filesToUpload" name="submit"></form>
<hr />
</div>
</div>
<?php }
include ("clean.php");
$Date = date("m_d_y");
$Time = date("F j, Y, g:i a");
$LogLoc = $InstLoc.'/AppLogs';
$LogInc = 0;
$fc = 0;
$SesLogDir = $LogLoc.'/'.$Date;
$LogFile = ($SesLogDir.'/'.$Date.'_'.$LogInc.'.txt');
if (!file_exists($SesLogDir)) {
$JICInstallLogs = @mkdir($SesLogDir, 0755); }
if (!file_exists($LogLoc)) { 
$JICInstallLogs = @mkdir($LogLoc, 0755); }
$JICTouchInstallLogFile = @touch($SesLogDir.'/'.$Date.'_'.$LogInc.'.txt');
if (file_exists($LogFile)) {
  $LogFile = ($SesLogDir.'/'.$Date.'_'.$LogInc.'.txt');  
  while (file_exists($SesLogDir.'/'.$Date.'_'.(++$LogInc).'.txt')); }

if (isset($_POST['add'])) {
if ($_POST['selected'] == "aai") {
  $UploadLoc = $ActionLoc; 
  $txtTEMP = 'Action Items'; }
if ($_POST['selected'] == "apd") {
  $UploadLoc = $InputLoc; 
  $txtTEMP = 'Pending Documents'; }

if (isset($_FILES['filesToUpload'])) { 
  foreach ($_FILES['filesToUpload']['name'] as $key=>$file) {
    $fc++;
    if ($file !== '.' or $file !== '..') {
      $file = str_replace(" ", "_", $file);
      $F1 = (pathinfo($file, PATHINFO_DIRNAME).'/'.$file);
      $F2 = pathinfo($file, PATHINFO_BASENAME);
      $F3 = $UploadLoc.'/'.$F2;
     $txt = ('OP-Act: '."Submitted $file to $UploadLoc on $Time".'.');
     $LogFile = file_put_contents($SesLogDir.'/'.$Date.'.txt', $txt.PHP_EOL , FILE_APPEND);
        if($file == "") {
          die("No file specified"); } 
      $COPY_TEMP = copy($_FILES['filesToUpload']['tmp_name'][$key], $F3);
      chmod($F3,0777); } } } }

if (isset($_FILES)) { ?>
<div align="center"><img src="document.png" alt="Your Document"> </a></div>
<?php 
  if (count($fc) <= 1 ) {
  $txt = ('OP-Act: '."Submitted $fc $txtTEMP to $UploadLoc on $Time".'.');
  $LogFile = file_put_contents($SesLogDir.'/'.$Date.'.txt', $txt.PHP_EOL , FILE_APPEND); ?>
  <div align='center'><h3>Your files have been submitted...</h3></div>
  <hr />
  <div><?php echo nl2br ("$fc items have been submitted to the $txtTEMP directory on $Time".'.'."\n"); ?></div>
  </div>
  <?php }  ?> 
<hr />

<?php } ?>


</body>

</html>
