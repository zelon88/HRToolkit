<?php

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
  <div style="float: center"><h4>DocumentControl Summary:</h4></div>
  <iframe src="indexSummary.php" name="DocConSum" width="315" height="350" scrolling="yes" margin-top:-4px; margin-left:-4px; border:double;></iframe>
<script type="text/javascript">
document.getElementById("DocConSum").submit();
</script>

</div>
<div id="control" style="float: left; ">
  <div style="float: center"><h4>App Settings:</h4></div>
<div id="button" style="float: left; ">
  <form action="indexSummary.php#end" id="summary" method="post" target="DocConSum">
  <input type="submit" value="Summary" id="button" name="submit"></form>
  <form action="DocCon.php#end" id="DocConSum" method="post" target="DocConSum">
  <input type="submit" value="Process Pending Documents" name="ProcPending" id="button" onclick="$('#loading').show();" name="submit"></form>
  <form action="DocCon.php#end" id="ReProcActionItems" method="post" target="DocConSum">
  <input type="submit" value="Re-Process Action Items" id="ReProcActionItems" name="ReProcActionItems" onclick="$('#loading').show();" name="submit"></form>
  <form action="AutoBackeruper.php" id="DocConSum" method="post" target="DocConSum">
  <input type="submit" value="Backup Documents" id="button" onclick="$('#loading').show();" name="submit"></form>
  <form action="Uploader.php" id="DocConSum" method="post" target="DocConSum">
  <input type="submit" value="Submit Documents" id="button" onclick="$('#loading').show();" name="submit"></form>
  <div id="loading" style="display:none;"><img 
    src="pacman.gif" /> • • • • •</div>
</div>
</div>
        
</body>

</html>