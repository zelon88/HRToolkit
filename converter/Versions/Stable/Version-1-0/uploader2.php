<html>

 <head>
  <title>Upload Complete!</title>
 </head>
 <body>

<?php
require ('http://localhost/HRProprietary/converter/uploader.php')
$file = $_FILES['file']['name'] 
?>
<div align="center">
  <h3>File upload succeeded...</h3>
  <div align="left">><ul>
  <li>Sent: <?php echo $file['file']['name']; ?></li>
  <li>Size: <?php echo $file['file']['size']; ?> bytes</li>
  <li>Type: <?php echo $file['file']['type']; ?></li>
  </ul></div>
</div>
<div align="center">
  <?php echo $file['file']['name']; ?>
</div>
