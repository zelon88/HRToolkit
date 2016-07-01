<!DOCTYPE html>
<html>
<head>
<title>DocumentControl | Logs </title>
<link rel="stylesheet" type="text/css" href="DocConCSS.css">
</head>
<?php require_once("config.php");
$InstLoc1 = $InstLoc.'/'; ?>
<body>
<script type="text/javascript">
    function clearThis(target) {
        target.value= ""; }
</script>
<div id="nav" align="center">
<img src="HeaderThin.jpg" alt="Tru-Form DocumentControl">
    <div class="nav">
      <ul>
        <li class="Control"><a href="index.php">Control</a></li>
        <li class="Manage"><a href="AdminLogin1.php" target="DocConSum">Manage</a></li>
        <li class="Settings"><a href="AdminLogin2.php" target="DocConSum">Settings</a></li>
        <li class="Logs"><a href="Logs.php">Logging</a></li>
        <li class="Help"><a href="Help.php">Help</a></li>
      </ul>
    </div>
<div id="centerdiv" align='center' style="margin: 0 auto; max-width:550px;">
<div id="overview" style="float: left; ">
  <div style="float: center"><h4>Logs Summary:</h4></div>
  <iframe src="LogsSummary.php" name="DocConSum" width="315" height="350" scrolling="yes" margin-top:-4px; margin-left:-4px; border:double;></iframe>
</div>

<div id="control" style="float: left; ">
  <div style="float: center"><h4>Logging Operations:</h4></div>
<div id="button" style="float: left; ">
  <form action="search2.php" id="search" method="post" target="DocConSum">
  <p><input type="text" value="Search Logs" id="search" name="search" style="float:left; padding: 2px; margin-left:20px; border: 1px solid black; width:150px;" onfocus="clearThis(this)"/><input type="image" src="search.png" alt="Search" style="float:right; padding-right:20px; width:50px; height:25px;"/></form></p>
  <form action="AppLogs" id="summary" method="post" target="DocConSum">
  <input type="submit" value="Application Logs" id="button" name="submit"></form>
  <form action="VirusLogs" id="summary" method="post" target="DocConSum">
  <input type="submit" value="Virus Logs" id="button" name="submit"></form>
  <form action="LogEntryAdder.php" id="summary" method="post" target="DocConSum">
  <input type="submit" value="New Log Entry" id="button" name="submit"></form>
<script type="text/javascript">
document.getElementById("DocConSum").submit();
</script>
</div>
</div>

        
</body>

</html>