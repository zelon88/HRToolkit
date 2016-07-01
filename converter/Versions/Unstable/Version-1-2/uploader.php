 
<html>

 <head>
  <title>File Uploader</title>
 </head>

 <body>
<a href="http://cloud.honestrepair.net">
<img src="http://cloud.honestrepair.net/HRProprietary/converter/HRBanner.png" alt="HonestRepair"> </a>
<?php 
$allowed =  array('txt' ,'doc', 'docx', 'rtf' ,'xls', 'xlsx', 'odf', 'odt', 'jpg', 'jpeg', 'bmp', 'png', 'gif');
$docarray =  array('txt' ,'doc', 'docx', 'rtf', 'odf', 'odt');
$spreadarray = array ('xls', 'xlsx');
$imgarray = array('jpg', 'jpeg', 'bmp', 'png', 'gif');
$filename = $_FILES['file']['name'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);
if(!in_array($ext,$allowed) ) {
    die( "Unsupported File Format" );
}
  if( $_FILES['file']['name'] != "" )
  {
    copy ( $_FILES['file']['tmp_name'], 
     "/var/www/html/cloud/temp/" . $_FILES['file']['name'] ) 
    or die( "Could not copy file" );
  }
  else
  {
    die( "No file specified" );
  }
$file = $_FILES ?>
<div align="center">
<div style="max-width:500px">
<div align="center">
 <h3>File Upload Complete!</h3>
  <div align="left"><ul>
   <li>Sent: <?php echo $file['file']['name']; ?></li>
   <li>Size: <?php echo $file['file']['size']; ?> bytes</li>
   <li>Type: <?php echo $file['file']['type']; ?></li>
  </div>
<div align="center"><img src="http://cloud.honestrepair.net/HRProprietary/converter/document.png" alt="Your Document"> </a>
</div>
<br>
<hr>
</div>

<div align="center"><h3>Convert This File...</h3>
<div align="center">
<?php if (in_array($ext,$docarray) ) { ?>
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
 </form></div>
<?php } ?>
<?php if (in_array($ext,$spreadarray) ) { ?>
<form action="/HRProprietary/converter/converter.php" method="post" enctype="multipart/form-data">
 <select name="selected">
  <option value="xls">Convert to  xls</option>
  <option value="xlsx">Convert to  xlsx</option>
 </select>
  <input type="hidden" name="hiddenFile" value="<?php echo $file['file']['name']; ?>" />
  <p><input type="submit" name="convertCloud" value="Convert File to Cloud Drive"></p>
  <p><input type="submit" name="convertDownload" value="Convert File and Download Now"></p>
 </form></div>
<?php } ?>
<?php if (in_array($ext,$imgarray) ) { ?>
<form action="/HRProprietary/converter/converter.php" method="post" enctype="multipart/form-data">
 <select name="selected">
  <option value="jpg">Convert to  jpg</option>
  <option value="bmp">Convert to  bmp</option>
  <option value="png">Convert to  png</option>
  <option value="gif">Convert to  gif</option>
 </select>
  <br>
  <br>
  Width and height (optional):
  <br>
  <input type="number" size="4" value="0" name="width" min="0" max="3000"> X <input type="number" size="4" value="0" name="height" min="0"  max="3000">
  <br>
  Rotate (optional):
  <br>
  <input type="number" size="3" value="0" name="rotate" min="0" max="359">
  <input type="hidden" name="hiddenFile" value="<?php echo $file['file']['name']; ?>" />
  <p><input type="submit" name="convertCloud" value="Convert File to Cloud Drive"></p>
  <p><input type="submit" name="convertDownload" value="Convert File and Download Now"></p>
 </form></div>
<?php } ?>

</div>
</div>
</body>

</html>


