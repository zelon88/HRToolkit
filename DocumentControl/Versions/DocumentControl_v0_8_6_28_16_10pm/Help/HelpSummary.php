<!DOCTYPE html>
<html>
<head>
<title>DocumentControl | Help - About </title>
<link rel="stylesheet" type="text/css" href="DocConCSS.css">
</head>
<body>
<div align="center"><h3>About DocumentControl</h3></div>
<hr />
<div align='left'>
<p><strong>"DocCon"  . . .</strong></p>
<p>DocumentControl was made by Justin Grimes for Tru-Form Precision Manufacturing 
	beginning in 2016. It is a fully automatic, database enabled, client/server based
	document management platform loosely based off of a variety and combination of 
	it's author's personal and open-source projects.</p>
	<p>DocumentControl works with MRP enabled (and non-MRP enabled) networks 
	to consolidate, simplify, organize, manage, and audit sensitive and controlled documents 
	in even the tightest of quality controlled environments. Quickly and easily.</p>
	<p>In addition to organizing documents placed into an input folder into managed and 
	write-controlled subfolders, DocumentControl can gather information from a database and 
	use that data to rename and relocate the file appropriately based on user defined "Nomenclature 
	Settings." DocCon will also move incorrect or inaccurate files to a specified "Action Items" directory 
	for scrutiny. It is possible to re-process these files directly through the application without manually 
	moving them back to the input directory. DocCon can also scan the files it handles with ClamAV for viruses
	automatically or on-demand. DocCon can also backup the files it has managed to a specified backup directory. 
	DocumentControl keeps excellent logs of everything it does, and makes them easily accesible. The application also 
	handles security functions related to defending itself from erroneous administrator login attempts and 
	unauthorized POST and SQL injection methods, as well as keeping sensitive files out of hosted locations 
	and write-protected.</p>
	<p>It will eventually be possible for admins to rollback previously completed operations to a "like-old" state. 
	It will also be possible to upload regular files and encrypt them with user-specified info, given the option to 
	download the output or submit it for processing. It will also be possible to convert any document file to almost 
	any similar document of different format, or PDF.</p>
	<p><strong>Requirements  . . .</strong></p>
	<p>Minimally this application requires a computer with PHP accesible via the command line. 
	For full functionality, DocumentControl should be installed in a server environment with
	PHP installed on top of an Apache, Nginx, or .NET framework. DocumentControl scripts SHOULD
	ONLY BE RUN from machines on the server's LOCAL network. At this time (and for convinience), 
	DocumentControl DOES NOT present any login requirements to users who perform basic operations. 
	For this reason please do not forward any outside ports to, reverse proxy to, or install this 
	application in a directory that is accesible to the general public via HTTP. If outside access
	is desired please establish an SSL remote desktop connection to an active workstation within
	the local network and perform the desired operations over the remote desktop.</p>
	<p>For Anti-Virus Scanning support, please install ClamAV on your server and enable Virus-Scanning
	under "Settings->Application Settings". This can considerably slow down DocumentControl operations. 
	If this is undesirable, consider installing ClamAV, disabling Anti-Virus support, and occasionally
	selecing "Scan All Directories" under "Settings->Application Settings" instead.</p>
	<p><strong>Technical Reference  . . .</strong></p>
	<p>DocumentControl was written in PHP 5.6, HTML, CSS, and JavaScript. MsSQL and MySQL support 
	is optional. Support for PHP 7.0 is experimental. If you want to try PHP 7.0 it is reccomended 
	that you complete and verify your config.php file using PHP 5.6 before upgrading your PHP version.
	Other than while updating ClamAV Anti-Virus definitions (option in "Settings->Application Settings"), 
	DocumentControl WILL NEVER require any third-party services or make connections to 
	outside servers.</p> 
	<p>To send feedback or get support for "DocCon" please write to zelon88@gmail.com.</p>
</div>
<br>
<hr />
</body>
</html>
