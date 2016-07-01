
<html>

 <head>
  <title>File Uploader</title>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
 </head>

 <body>
<div align="center">
<a href="http://localhost/">
<img src="http://localhost/HRProprietary/scanner/HRBanner.png" alt="HonestRepair"> </a>
</div>
<br>

<?php 
$allowed = array('jpg', 'jpeg', 'gif', 'png', 'dat', 'pages', 'cfg', 'txt', 'doc', 'docx', 'rtf', 'odf', 'odt', 'abw', 'msi', 'exe', 'deb', 'dll', 'pif', 'application', 'msp', 'com',
   'scr', 'gadget', 'cpl', 'msc', 'jar', 'zip', '7z', 'rar', 'tar', 'tar.gz', 'tar.bz2', 'iso', 'vhd', 'abw', 'pdf', 'mp3', 'avi', 'wma', 'wav', 'ogg', 'xls', 'xlsx', 'ods', 'bat',
   'cmd', 'inf', 'ppt', 'reg', 'vb', 'vbe', 'vbs,', 'pptm', 'msh', 'msh1', 'msh2', 'xcf', 'lnk', 'docm', 'dotm', 'xltm', 'ws', 'wsf', 'bat', );
$allowed1 = array('jpg', 'jpeg', 'gif', 'png', 'dat', 'pages', 'cfg', 'txt', 'doc', 'docx', 'rtf', 'odf', 'odt', 'abw', 'msi', 'exe', 'deb', 'dll', 'pif', 'application', 'msp', 'com',
   'scr', 'gadget', 'cpl', 'msc', 'jar', 'abw', 'pdf', 'mp3', 'avi', 'wma', 'wav', 'ogg', 'xls', 'xlsx', 'ods', 'bat',
   'cmd', 'inf', 'ppt', 'reg', 'vb', 'vbe', 'vbs,', 'pptm', 'msh', 'msh1', 'msh2', 'xcf', 'lnk', 'docm', 'dotm', 'xltm', 'ws', 'wsf', 'bat', );
$allowed2 = array('zip', '7z', 'rar', 'tar', 'tar.gz', 'tar.bz2', 'iso', 'vhd',);
$filename = str_replace(" ", "_", $_FILES['file']['name']);
$filename1 = pathinfo($filename, PATHINFO_FILENAME);
$ext = pathinfo($filename, PATHINFO_EXTENSION);
$file = $_FILES;
if(!in_array($ext,$allowed) ) {
  die( "Unsupported File Format" ); }
if( $filename != "" ) {
  if(in_array($ext,$allowed) ) {
    copy ( $_FILES['file']['tmp_name'], "/tmp/QNTN/safedir/isolated/" . $file['file']['name'] );
    rename( ("/tmp/QNTN/safedir/isolated/" . $file ), ("/tmp/QNTN/safedir/isolated/" . $filename) ); } }
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
<?php if (in_array($ext,$allowed) ) { ?>
<div align="center"><img src="http://localhost/HRProprietary/scanner/document.png" alt="Your Document"> </a></div>
</div></div>
<?php } ?>
<br><hr></div></div>

<div align="center"><h3>Scan this File...</h3></div>
<div align="center">
<?php if (in_array($ext,$allowed1) ) { ?>
<div style="max-width:400px">
<form action="/HRProprietary/scanner/scanner.php" method="post" enctype="multipart/form-data">
Click the button below to scan this file for viruses and potentially malicious files.
  <input type="hidden" name="hiddenFile" value="<?php echo $filename; ?>" />
  <div id="loading" style="display:none;"><img 
    src="/HRProprietary/scanner/pacman.gif" /> • • • • •</div>
  <p><input type="submit" name="Scan" value="Scan This File ..." onclick="$('#loading').show();"/></p>
 </form>
</div></div>
<?php } ?>


<?php if (in_array($ext,$allowed2) ) { ?>
<div style="max-width:400px">
<div align="center">
<form action="/HRProprietary/scanner/scanner.php" method="post" enctype="multipart/form-data">
Click the button below to safely extract and scan this archive for viruses, potentially unwanted, and potentially malicious files.
  <input type="hidden" name="hiddenFile" value="<?php echo $filename; ?>" />
  <div id="loading" style="display:none;"><img 
    src="/HRProprietary/scanner/pacman.gif" /> • • • • •
  <p>Note: Large archives, or archives that contain a high number of small files can sometimes take a while to scan.</p>
  <p>Please wait ...</p></div>
  <p><input type="submit" name="Scan" value="Scan This File ..." onclick="$('#loading').show();"/></p>
 </form>
</div></div>
<?php } ?>

</div>
</body>

</html>


