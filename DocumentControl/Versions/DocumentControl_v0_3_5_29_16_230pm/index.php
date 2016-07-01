<!DOCTYPE html>
<html>
<head>
<title>DocumentControl | Overview </title>
<link rel="stylesheet" type="text/css" href="DocConCSS.css">
</head>
<?php require_once("config.php");
$InstLoc1 = $InstLoc.'/'; ?>
<body>
<div id="nav" align="center">
<img src="Header.jpg" alt="Tru-Form DocumentControl">
    <div class="nav">
      <ul>
        <li class="overview"><a href="index.php">Overview</a></li>
        <li class="Manage"><a href="#">Manage</a></li>
        <li class="settings"><a href="#">Settings</a></li>
        <li class="logs"><a href="#">Logs</a></li>
      </ul>
    </div>

<div id="overview" style="float: left; ">
  <div style="float: center"><h4>DocumentControl Summary:</h4></div>
  <iframe src="DocCon.php" name="DocConSum" width="350" height="250" scrolling="yes" margin-top:-4px; margin-left:-4px; border:double;></iframe>
  <form action="DocCon.php#end" id="DocConSum" method="post" target="DocConSum">
  <input type="submit" value="Process Pending Documents" name="submit"></form>
<script type="text/javascript">
document.getElementById("DocConSum").submit();
</script>
</div>

<div id="overview" style="float: left; ">
  <div style="float: center"><h4>Standard Operations:</h4></div>
<div id="button" style="float: left; ">
  <form action="AutoBackeruper.php" id="DocConSum" method="post" target="DocConSum">
  <input type="submit" value="Backup Documents" name="submit"></form>
<script type="text/javascript">
document.getElementById("DocConSum").submit();
</script>
</div>


        
</body>

</html>