<!DOCTYPE html>
<html>
<head>
<title>DocumentControl | Help </title>
<link rel="stylesheet" type="text/css" href="DocConCSS.css">
</head>
<?php 
require_once("config.php");
include("AppCache/SysCache.php");
$InstLoc1 = $InstLoc.'/'; ?>
<script type="text/javascript">
    function clearThis(target) {
        target.value= ""; }
</script>
<body>
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
  <div style="float: center"><h4>Information Summary:</h4></div>
  <iframe src="Help/HelpSummary.php" name="DocConSum" width="315" height="350" scrolling="yes" margin-top:-4px; margin-left:-4px; border:double; onload="document.getElementById('loading').style.display='none';"></iframe>
<script type="text/javascript">
document.getElementById("DocConSum").submit();
</script>
</div>
<div id="control" style="float: left; ">
  <div style="float: center"><h4>Information:</h4></div>
<div id="button" style="float: left; ">
  <form action="search.php" id="search" method="post" target="DocConSum">
  <p><input type="text" value="Search Help" id="search" name="search" style="float:left; padding: 2px; margin-left:20px; border: 1px solid black; width:150px;" onfocus="clearThis(this)"/><input type="image" src="search.png" alt="Search" style="float:right; padding-right:20px; width:50px; height:25px;"/></form></p>
  <form action="Help/HelpSummary.php" id="help" method="post" target="DocConSum">
  <input type="submit" value="About DocCon" id="DocCon" name="submit" onclick="toggle_visibility('loading');"/></form>
  <form action="Help/HelpControl.php" id="help" method="post" target="DocConSum">
  <input type="submit" value="Control Help" id="DocCon" name="submit" onclick="toggle_visibility('loading');"/></form>
  <form action="Help/HelpManage.php" id="help" method="post" target="DocConSum">
  <input type="submit" value="Manage Help" id="DocCon" name="submit" onclick="toggle_visibility('loading');"/></form>
  <form action="Help/HelpSettings.php" id="help" method="post" target="DocConSum">
  <input type="submit" value="Settings Help" id="DocCon" name="submit" onclick="toggle_visibility('loading');"/></form>
  <form action="Help/HelpLogs.php" id="help" method="post" target="DocConSum">
  <input type="submit" value="Logging Help" id="DocCon" name="submit" onclick="toggle_visibility('loading');"/></form>
  <form action="Help/HelpTroubleshooting.php" id="help" method="post" target="DocConSum">
  <input type="submit" value="Troubleshoot" id="DocCon" name="submit" onclick="toggle_visibility('loading');"/></form>      
  <div align="center" id="loading" name="loading" style="display:none;"><p><img src="pacman.gif" /></p></div>
  <script type="text/javascript">
    function toggle_visibility(id) {
       var e = document.getElementById(id);
       if(e.style.display == 'block')
          e.style.display = 'none';
       else
          e.style.display = 'block'; }
</script>
</div>
</div>

</body>

</html>