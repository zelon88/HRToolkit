<!DOCTYPE html>
<html>
<head>
<title>DocumentControl | Admin Login Window </title>
<link rel="stylesheet" type="text/css" href="DocConCSS.css">
</head>
<?php
require("config.php");
?>
<div align="center">
  <h3>Administrator Login</h3>
  <hr />
  <p>Please enter your login credentials below.</p>
<form action="indexSettings.php" method="post" target='_parent'>
  <p>Admin Username: <input type="text" name="admunm" value=""></p>
  <p>Admin Password: <input type="password" name="admpwd" value=""></p>
  <p><input type="submit" value="Login"</p>

</form>
</div>
</div>
<hr />
</div>
</body>
</html>