<!DOCTYPE html>
<html>
<head>
<title>DocumentControl | Overview </title>
<link rel="stylesheet" type="text/css" href="DocConCSS.css">
</head>
<?php 
require_once("config.php");
include("AppCache/SysCache.php");
$InstLoc1 = $InstLoc.'/'; ?>
<body>
<div id="nav" align="center">
<img src="HeaderThin.jpg" alt="Tru-Form DocumentControl">
    <div class="nav">
      <ul>
        <li class="Control"><a href="index.php">Control</a></li>
        <li class="Manage"><a href="AdminLogin1.php" target="DocConSum">Manage</a></li>
        <li class="settings"><a href="AdminLogin2.php" target="DocConSum">Settings</a></li>
        <li class="logs"><a href="Logs.php">Logs</a></li>
      </ul>
    </div>
<div id="centerdiv" align='center' style="margin: 0 auto; max-width:550px;">
<div id="overview" style="float: left; ">
  <div style="float: center"><h4>DocumentControl Summary:</h4></div>
  <iframe src="indexSummary.php" name="DocConSum" width="315" height="350" scrolling="yes" margin-top:-4px; margin-left:-4px; border:double; onload="document.getElementById('loading').style.display='none';">></iframe>
<script type="text/javascript">
document.getElementById("DocConSum").submit();
</script>
</div>
<div id="control" style="float: left; ">
  <div style="float: center"><h4>Control Operations:</h4></div>
<div id="button" style="float: left; ">
  <form action="indexSummary.php" id="summary" method="post" target="DocConSum">
  <input type="submit" value="Summary" id="button" name="submit" onclick="toggle_visibility('loading');"/></form>
  <form action="DocCon.php#end" id="DocConSum" method="post" target="DocConSum">
  <input type="submit" value="Process Pending Documents" name="ProcPending" id="button" name="submit" onclick="toggle_visibility('loading');"/></form>
  <form action="DocCon.php#end" id="ReProcActionItems" method="post" target="DocConSum">
  <input type="submit" value="Re-Process Action Items" id="ReProcActionItems" name="ReProcActionItems" name="submit" onclick="toggle_visibility('loading');"/></form>
  <?php if ($AutoBackup == '1') { ?>
  <form action="AutoBackeruper.php" id="DocConSum" method="post" target="DocConSum">
  <input type="submit" value="Backup Documents" id="button" name="submit" onclick="toggle_visibility('loading');"/></form><?php } ?>
  <form action="Uploader.php" id="DocConSum" method="post" target="DocConSum">
  <input type="submit" value="Submit Documents" id="button" name="submit" onclick="toggle_visibility('loading');"/></form>
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