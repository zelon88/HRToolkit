<!DOCTYPE html>
<html>
<head>
<title>DocumentControl | Settings </title>
<link rel="stylesheet" type="text/css" href="DocConCSS.css">
</head>
<?php 
$sysCache = "AppCache/SysCache.php";
require_once("config.php");
include($sysCache); 
$InstLoc1 = $InstLoc.'/'; 
$SaltHash = hash('ripemd160',$Salts);
$YUMMYSaltHash = $_POST['YUMMYSaltHash'];

if (!isset($YUMMYSaltHash)) {
  echo nl2br('!!! WARNING !!! ixSet16, There was a critical security fault. Login Request Denied.'."\n"); 
  die("Application was halted on $Date".'.'); }
if ($YUMMYSaltHash !== $SaltHash) {
  echo nl2br('!!! WARNING !!! ixSet18, There was a critical security fault. Login Request Denied.'."\n"); 
  die("Application was halted on $Date".'.'); }

if (!isset($_POST['admunm']) or !isset($_POST['admpwd']) or 
  ($_POST['admunm']) == '' or ($_POST['admpwd']) == '') {
  ?> 
<div align='center'>
<div align='center' style="max-width: 550px; ">
<br>
<p><h4>DocumentControl Administrator Login Failed!</h4></p>
<hr />
<p><?php 
echo('A login field was blank.'); ?></p>
<button id='button' name='button' onclick="goBack()">Go Back</button>
<script>
function goBack() {
    window.history.back(); }
</script> 
<hr />
<br>
</div>
</div>
<?php die(); }
if (isset($_POST['admunm'])) {
  if ($_POST['admunm'] !== $AdmLogin) {
    ?>
<div align='center'>
<div align='center' style="max-width: 550px; ">
<br>
<p><h4>DocumentControl Administrator Login Failed!</h4></p>
<hr />
<p><?php 
echo('The login credentials were incorrect.'); ?></p>
<button id='button' name='button' onclick="goBack()">Go Back</button>
<script>
function goBack() {
    window.history.back(); }
</script> 
<hr />
<br>
</div>
</div>
<?php die(); } }
if (isset($_POST['admunm'])) {
  if ($_POST['admpwd'] !== $AdmPass) {
    ?>
<div align='center'>
<div align='center' style="max-width: 550px; ">
<br>
<p><h4>DocumentControl Administrator Login Failed!</h4></p>
<hr />
<p><?php 
echo('The login credentials were incorrect.'); ?></p>
<button id='button' name='button' onclick="goBack()">Go Back</button>
<script>
function goBack() {
    window.history.back(); }
</script> 
<hr />
<br>
</div>
</div>    
<?php die(); } }
$UserStatus = 1;
?>
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
  <div style="float: center"><h4>Settings Summary:</h4></div>
  <iframe src="settingsSummary.php" name="DocConSum" width="315" height="350" scrolling="yes" margin-top:-4px; margin-left:-4px; border:double; onload="document.getElementById('loading').style.display='none';">></iframe>
<script type="text/javascript">
document.getElementById("DocConSum").submit();
</script>
</div>
<div id="control" style="float: left; ">
  <div style="float: center"><h4>Settings Menu:</h4></div>
<div id="button" style="float: left; ">
  <form action="settingsSummary.php" id="summary" method="post" target="DocConSum">
  <input type="submit" value="Settings Summary" id="button" name="submit" onclick="toggle_visibility('loading');"/></form>
  <form action="appSettings.php" id="DocConSum" method="post" target="DocConSum">
  <input type="submit" value="Application Settings" name="ProcPending" id="button" name="submit" onclick="toggle_visibility('loading');"/></form>
  <form action="docSettings.php" id="ApplicationSettings" method="post" target="DocConSum">
  <input type="submit" value="Directory Settings" id="ReProcActionItems" name="ReProcActionItems" name="submit" onclick="toggle_visibility('loading');"/></form>
  <form action="datSettings.php" id="DocConSum" method="post" target="DocConSum">
  <input type="submit" value="Database Settings" id="button" name="submit" onclick="toggle_visibility('loading');"/></form>
  <form action="Uploader.php" id="DocConSum" method="post" target="DocConSum">
  <input type="submit" value="Nomenclature Settings" id="button" name="submit" onclick="toggle_visibility('loading');"/></form>
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