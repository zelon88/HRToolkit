 
<html>

 <head>
  <title>File Uploader</title>
 </head>

 <body>
<a href="http://cloud.honestrepair.net">
<img src="http://localhost/HRProprietary/converter/HRBanner.png" alt="HonestRepair"> </a>
<?php 
$allowed =  array('txt' ,'doc', 'docx', 'rtf' ,'xls', 'xlsx', 'odf', 'odt');
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
<div style="max-width:400px">
<div align="center">
 <h3>File Upload Complete!</h3>
  <div align="left"><ul>
   <li>Sent: <?php echo $file['file']['name']; ?></li>
   <li>Size: <?php echo $file['file']['size']; ?> bytes</li>
   <li>Type: <?php echo $file['file']['type']; ?></li>
  </div>
<div align="center"><img src="http://localhost/HRProprietary/converter/document.png" alt="Your Document"> </a>
</div>
<br>
<hr>
</div>

<div align="center"><h3>Convert This File...</h3>
<div align="center">
<br>
<form action="/HRProprietary/converter/converter.php" method="post" enctype="multipart/form-data">
 <select name="selected">
  <option value="pdf">Convert to  pdf</option>
  <option value="txt">Convert to  txt</option>
  <option value="rtf">Convert to  rtf</option>
  <option value="doc">Convert to  doc</option>
  <option value="docx">Convert to  docx</option>
  <option value="xls">Convert to  xls</option>
  <option value="xlsx">Convert to  xlsx</option>
  <option value="odt">Convert to  odt</option>
 </select>
  <input type="hidden" name="hiddenFile" value="<?php echo $file['file']['name']; ?>" />
  <p><input type="submit" name="convertCloud" value="Convert File to Cloud Drive"></p>
  <p><input type="submit" name="convertDownload" value="Convert File and Download Now"></p>
 </form></div>
</div>
</div>
</body>

</html>


