
<html>

 <head>
  <title>DocumentControl | File Uploader</title>
 </head>
 <body>

<div >

<div align="center" style="max-width:400px"><h3>Submit Documents</h3></div> 

<hr />
<div align="center">
<form method="post" action="Uploader2.php" target="DocConSum" enctype="multipart/form-data">
<input name="filesToUpload[]" id="filesToUpload" type="file" multiple="" />
<select name="selected">
  <option value="aai">Add to Action Items...</option>
  <option value="apd">Add to Pending Documents...</option>
 </select>
<div id="loading" style="display:none;"><img src="pacman.gif" /> • • • • •</div>
  <p><input type="submit" name="add" value="Submit Documents..." onclick="$('#loading').show();"/></p>
 </form>
</div>
<hr />
</div>
</div>
</body>
</html>


