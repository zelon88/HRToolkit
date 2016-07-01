<!DOCTYPE html>
<html>
<head>
<title>DocumentControl | Logs </title>
<link rel="stylesheet" type="text/css" href="DocConCSS.css">
</head>
<?php require_once("config.php");
$InstLoc1 = $InstLoc.'/'; ?>
<body>
<div id="nav" align="center">
<img src="HeaderThin.jpg" alt="Tru-Form DocumentControl">
    <div class="nav">
      <ul>
        <li class="Control"><a href="index.php">Control</a></li>
        <li class="Manage"><a href="#">Manage</a></li>
        <li class="settings"><a href="#">Settings</a></li>
        <li class="logs"><a href="Logs.php">Logs</a></li>
      </ul>
    </div>
<div id="centerdiv" align='center' style="margin: 0 auto; max-width:550px;">
<div id="overview" style="float: left; ">
  <div style="float: center"><h4>Logs Summary:</h4></div>
  <iframe src="LogsSummary.php" name="DocConSum" width="315" height="350" scrolling="yes" margin-top:-4px; margin-left:-4px; border:double;></iframe>
<script type="text/javascript">
document.getElementById("DocConSum").submit();
</script>
</div>

<div id="control" style="float: left; ">
  <div style="float: center"><h4>Logging Operations:</h4></div>
<div id="button" style="float: left; ">
  <form action="AppLogs" id="summary" method="post" target="DocConSum">
  <input type="submit" value="Application Logs" id="button" name="submit"></form>
  <form action="VirusLogs" id="summary" method="post" target="DocConSum">
  <input type="submit" value="Virus Logs" id="button" name="submit"></form>
<script type="text/javascript">
document.getElementById("DocConSum").submit();
</script>
</div>
</div>

        
</body>

</html>