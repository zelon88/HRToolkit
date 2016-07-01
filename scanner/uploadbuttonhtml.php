 
<html>

 <head>
  <title>HRCloud Convert File Uploader</title>
 </head>

 <body>
 	<div align="center">
 	<a href="http://localhost/">
<img src="http://localhost/HRProprietary/scanner/HRBanner.png" alt="HonestRepair"> </a></div>
<br>
 <div align="center">
 	HRScan uses the power of the HonestRepair Cloud Platform to scan your files for security and integrity. To begin, select a file to
 	upload to our servers for processing.
 	<br>
  <h3>File Upload</h3>
  Select a file to upload:
  <br>
  <form action="/HRProprietary/scanner/uploader.php" method="post" enctype="multipart/form-data">
  <input type="file" name="file" size="45">
  <br>
  <input type="submit" name="submitNew" value="Upload">
  </form>
</div>
 </body>

</html>