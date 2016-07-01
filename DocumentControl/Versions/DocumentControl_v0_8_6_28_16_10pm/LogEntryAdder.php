<!DOCTYPE html>
<html>
<head>
<title>DocumentControl | Logs - New Log Entry </title>
<link rel="stylesheet" type="text/css" href="DocConCSS.css">
</head>
<body>
<div align="center"><h3>New Log Entry</h3></div>
<hr />
<div align='left'>
Here you can manually add a log entry to DocumentControl.
<form action="LogEntryAdder2.php" method="post" target="DocConSum">
<p>Your Name: <input type="text" name="name" id="name" style="width: 210px; padding: 2px; border: 1px solid black"/></p>
<p>Log Entry: <input type="text" name="entry" id="entry" value="" style="width: 217px; padding: 2px; border: 1px solid black"/></p>
<p><div align="center"><input type='submit' name='SaveEntry' id='SaveEntry' value='Save Log Entry' style="padding: 2px; border: 1px solid black"/></div></p>
</form>
</div>
<hr />
</body>
</html>