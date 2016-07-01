
<html>

 <head>
  <title>File Locker</title>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
 </head>

 <body>
<div align="center">
<a href="http://cloud.honestrepair.net">
<img src="http://cloud.honestrepair.net/HRProprietary/locker/HRBanner.png" alt="HonestRepair"> </a>
</div>
<br>

<?php 
$allowed =  array('dat', 'pages', 'cfg', 'txt', 'doc', 'docx', 'rtf' ,'xls', 'xlsx', 'ods', 'odf', 'odt', 'jpg', 'mp3', 
   'avi', 'wma', 'wav', 'ogg', 'jpeg', 'bmp', 'png', 'gif', 'pdf', 'abw', 'zip', '7z', 'rar', 'tar', 'tar.gz', 'tar.bz2', 'iso', 'vhd');
$docarray =  array('dat', 'pages', 'cfg', 'txt', 'doc', 'docx', 'rtf', 'odf', 'odt', 'abw');
$spreadarray = array ('xls', 'xlsx', 'ods');
$imgarray = array('jpg', 'jpeg', 'bmp', 'png', 'gif');
$audioarray =  array('mp3', 'avi', 'wma', 'wav', 'ogg');
$pdfarray = array('pdf');
$abwarray = array('abw');
$archarray = array('zip', '7z', 'rar', 'tar', 'tar.gz', 'tar.bz2', 'iso', 'vhd');
$filename = str_replace(" ", "_", $_FILES['file']['name']);
$filename1 = pathinfo($filename, PATHINFO_FILENAME);
$ext = pathinfo($filename, PATHINFO_EXTENSION);
$file = $_FILES;
if(!in_array($ext,$allowed) ) {
  die( "Unsupported File Format" ); }
if( $filename != "" ) {
  if(!in_array($ext,$audioarray) ) {
    copy ( $_FILES['file']['tmp_name'], "/var/www/html/cloud/temp/" . $filename ); }
      elseif (in_array($ext,$audioarray) ) {
        copy ( $_FILES['file']['tmp_name'], "/var/www/html/cloud/temp/" . $filename ); } }
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
<div align="center"><img src="http://cloud.honestrepair.net/HRProprietary/locker/document.png" alt="Your Document"> </a></div>
<?php } ?>
<?php if (in_array($ext,$spreadarray) ) { ?>
<div align="center"><img src="http://cloud.honestrepair.net/HRProprietary/locker/document.png" alt="Your Document"> </a></div>
<?php } ?>
<?php if (in_array($ext,$imgarray) ) { ?>
<div align="center"><img src="http://cloud.honestrepair.net/HRProprietary/locker/document.png" alt="Your Image"> </a></div>
<?php } ?>
<?php if (in_array($ext,$audioarray) ) { ?>
<div align="center"><img src="http://cloud.honestrepair.net/HRProprietary/locker/document.png" alt="Your File"> </a></div>
<?php } ?>
<?php if (in_array($ext,$pdfarray) ) { ?>
<div align="center"><img src="http://cloud.honestrepair.net/HRProprietary/locker/document.png" alt="Your File"> </a></div>
<?php } ?>
<?php if (in_array($ext,$abwarray) ) { ?>
<div align="center"><img src="http://cloud.honestrepair.net/HRProprietary/locker/document.png" alt="Your File"> </a></div>
<?php } ?>
<?php if (in_array($ext,$archarray) ) { ?>
<div align="center"><img src="http://cloud.honestrepair.net/HRProprietary/locker/document.png" alt="Your File"> </a></div>
<?php } ?>
<br><hr></div></div>

<div id="Encrypt" style="display:none;" align="center">
<div><h3>Encrypt This File...</h3></div>
<div align="center">
<?php if (in_array($ext,$allowed) ) { ?>
<div style="max-width:400px">
<div align="center">
<form action="/HRProprietary/locker/locker.php" method="post" enctype="multipart/form-data">
 <label><input type="checkbox" id="base64" value="1"> Encode with base64</label>
 <br><label><input type="checkbox" id="salt" value="1"> Use Salts</label>
<br>
Encryption Type:
<select id="eType" name="Encryption Type">
  <option value="">No Encryption</option>
  <option value="e128">Encrypt with  AES-128</option>
  <option value="e256">Encrypt with  AES-256</option>
</select>
<br>
<script type="text/javascript" src="http://cloud.honestrepair.net/HRProprietary/locker/checkpassword.js"></script>
    <form><div>
            <label for="pass1">Password:</label>
            <input name="pass1" id="pass1" type="password">
        </div><div>
            <label for="pass2">Confirm Password:</label>
            <input name="pass2" id="pass2" onkeyup="checkPass(); return false;" type="password">
            <br><span id="confirmMessage" class="confirmMessage"></span>
        </div>
    </form>
</div>
  <input type="hidden" name="hiddenFile" value="<?php echo $file['file']['name']; ?>" />
  <div id="loading" style="display:none;"><img 
    src="/HRProprietary/locker/pacman.gif" /> • • • • •</div>
  <p><input type="submit" id="encryptCloud" name="encryptCloud" value="Encrypt File to Cloud Drive" onclick="$('#loading').show();"/></p>
  <p><input type="submit" id="encrypyDownload" name="encryptDownload" value="Encrypt File and Download Now" onclick="$('#loading').show();"/></p>
 </form>
</div></div></div>

<div id="Decrypt" style="display:none;">
<div align="center"><h3>Decrypt This File...</h3></div>
<div align="center">
<div style="max-width:400px">
<div align="center">
<form action="/HRProprietary/locker/locker.php" method="post" enctype="multipart/form-data">
 <label><input type="checkbox" id="base64" value="base64"> Force Decode With base64</label>
<br>
Decryption Type:
<select name="selected">
  <option value="d128">Decrypt with  AES-128</option>
  <option value="d256">Decrypt with  AES-256</option>
</select>
<br>
<script type="text/javascript" src="http://cloud.honestrepair.net/HRProprietary/locker/checkpassword.js"></script>
    <form><div>
            <label for="pass1">Password:</label>
            <input name="pass1" id="pass1" type="password">
        </div><div>
            <label for="pass2">Confirm Password:</label>
            <input name="pass2" id="pass2" onkeyup="checkPass(); return false;" type="password">
            <br><span id="confirmMessage" class="confirmMessage"></span>
        </div>
    </form>
</div>
  <input type="hidden" name="hiddenFile" value="<?php echo $file['file']['name']; ?>" />
  <div id="loading" style="display:none;"><img 
    src="/HRProprietary/locker/pacman.gif" /> • • • • •</div>
  <p><input type="submit" id="DecryptCloud" name="decryptCloud" value="Decrypt File and send to Cloud Drive" onclick="$('#loading').show();"/></p>
  <p><input type="submit" id="DecrypyDownload" name="decryptDownload" value="Decrypt File and Download Now" onclick="$('#loading').show();"/></p>
 </form>
</div></div></div>
<div id="Buttons" align="center">
<p><input type="submit" name="Encrypt" value="Encrypt a File..." onclick="$('#Buttons').hide(); $('#Encrypt').show();"/></p>
<p><input type="submit" name="Decrypt" value="Decrypt a File..." onclick="$('#Buttons').hide(); $('#Decrypt').show();"/></p>
</div>
<?php } ?>

</div>
</body>

</html>


