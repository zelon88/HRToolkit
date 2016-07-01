 
<html>

 <head>
  <title>File Uploader</title>
 </head>

 <body>
<a href="http://cloud.honestrepair.net">
<img src="http://localhost/HRProprietary/converter/HRBanner.png" alt="HonestRepair"> </a>

<?php 
$allowed =  array('txt' ,'doc', 'docx', 'rtf' ,'xls', 'xlsx', 'odf', 'odt', 'jpg', 'mp3', 
   'avi', 'wma', 'wav', 'ogg', 'jpeg', 'bmp', 'png', 'gif');
$docarray =  array('txt' ,'doc', 'docx', 'rtf', 'odf', 'odt');
$spreadarray = array ('xls', 'xlsx');
$imgarray = array('jpg', 'jpeg', 'bmp', 'png', 'gif');
$audioarray =  array('mp3' ,'avi', 'wma', 'wav', 'ogg');
$filename = $_FILES['file']['name']; 
$filename1 = pathinfo($filename, PATHINFO_FILENAME);
$ext = pathinfo($filename, PATHINFO_EXTENSION);
$file = $_FILES;
$userTempIMG = ('http://localhost/cloud/temp/' . $filename1 . '.' . $ext);
if(!in_array($ext,$allowed) ) {
  die( "Unsupported File Format" ); }
if( $_FILES['file']['name'] != "" ) {
  copy ( $_FILES['file']['tmp_name'], "/var/www/html/cloud/temp/" . $_FILES['file']['name'] )
  or die( "Could not copy file" ); }
else {
  die( "No file specified" ); }
?>

<div align="center">
<div style="max-width:400px">
<div align="center"><h3>File Upload Complete!</h3></div>
  <div align="left"><ul>
   <li>Sent: <?php echo $file['file']['name']; ?></li>
   <li>Size: <?php echo $file['file']['size']; ?> bytes</li>
   <li>Type: <?php echo $file['file']['type']; ?></li>
  </div>
<?php if (in_array($ext,$docarray) ) { ?>
<div align="center"><img src="http://localhost/HRProprietary/converter/document.png" alt="Your Document"> </a></div>
<?php } ?>
<?php if (in_array($ext,$spreadarray) ) { ?>
<div align="center"><img src="http://localhost/HRProprietary/converter/document.png" alt="Your Image"> </a></div>
<?php } ?>
<?php if (in_array($ext,$imgarray) ) { ?>
<div align="center"><img src="http://localhost/HRProprietary/converter/document.png" alt="Your Document"> </a></div>
<?php } ?>
<?php if (in_array($ext,$audioarray) ) { ?>
<div align="center"><img src="http://localhost/HRProprietary/converter/document.png" alt="Your Image"> </a></div>
<?php } ?>
<br><hr></div></div>

<div align="center"><h3>Convert This File...</h3></div>
<div align="center">
<?php if (in_array($ext,$docarray) ) { ?>
<div style="max-width:400px">
<div align="center">
<form action="/HRProprietary/converter/converter.php" method="post" enctype="multipart/form-data">
 <select name="selected">
  <option value="pdf">Convert to  pdf</option>
  <option value="txt">Convert to  txt</option>
  <option value="rtf">Convert to  rtf</option>
  <option value="doc">Convert to  doc</option>
  <option value="docx">Convert to  docx</option>
  <option value="odt">Convert to  odt</option>
 </select>
  <input type="hidden" name="hiddenFile" value="<?php echo $file['file']['name']; ?>" />
  <p><input type="submit" name="convertCloud" value="Convert File to Cloud Drive"></p>
  <p><input type="submit" name="convertDownload" value="Convert File and Download Now"></p>
 </form></div></div>
<?php } ?>


<?php if (in_array($ext,$spreadarray) ) { ?>
<div style="max-width:400px">
<div align="center">
<form action="/HRProprietary/converter/converter.php" method="post" enctype="multipart/form-data">
 <select name="selected">
  <option value="xls">Convert to  xls</option>
  <option value="xlsx">Convert to  xlsx</option>
 </select>
  <input type="hidden" name="hiddenFile" value="<?php echo $file['file']['name']; ?>" />
  <p><input type="submit" name="convertCloud" value="Convert File to Cloud Drive"></p>
  <p><input type="submit" name="convertDownload" value="Convert File and Download Now"></p>
 </form></div></div>
<?php } ?>

<?php if (in_array($ext,$imgarray) ) { ?>
<div style="max-width:400px">
<div align="center">
<form action="/HRProprietary/converter/converter.php" method="post" enctype="multipart/form-data">
 <select name="selected">
  <option value="jpg">Convert to  jpg</option>
  <option value="bmp">Convert to  bmp</option>
  <option value="png">Convert to  png</option>
  <option value="gif">Convert to  gif</option>
 </select>
  <br>
  <br>
  Width and height:
  <br>
  <input type="number" size="4" value="0" name="width" min="0" max="3000"> X <input type="number" size="4" value="0" name="height" min="0"  max="3000">
  <br>
  Maintain aspect ratio:<input type="checkbox" name="maintainAR" value="maintainAR">
  <br>
  <br>
  Rotate:
  <br>
  <input type="number" size="3" value="0" name="rotate" min="0" max="359">
  <input type="hidden" name="hiddenFile" value="<?php echo $file['file']['name']; ?>" />
  <p><input type="submit" name="convertCloud" value="Convert File to Cloud Drive"></p>
  <p><input type="submit" name="convertDownload" value="Convert File and Download Now"></p>
 </form></div></div>
<?php } ?>

<?php if (in_array($ext,$audioarray) ) { ?>
<div style="max-width:500px">
<div align="center">
<form action="/HRProprietary/converter/converter.php" method="post" enctype="multipart/form-data">
 <select name="selected">
  <option value="mp3">Convert to  mp3</option>
  <option value="avi">Convert to  avi</option>
  <option value="wav">Convert to  wav</option>
  <option value="wma">Convert to  wma</option>
  <option value="ogg">Convert to  ogg</option>
 </select>
  <input type="hidden" name="hiddenFile" value="<?php echo $file['file']['name']; ?>" />
  <p><input type="submit" name="convertCloud" value="Convert File to Cloud Drive"></p>
  <p><input type="submit" name="convertDownload" value="Convert File and Download Now"></p>
 </form></div></div>
<?php } ?>
</div>
</body>

</html>


