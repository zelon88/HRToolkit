<?php
 -// / The DeviceDetect application and repo are the result of a Reddit 		
 -// / thread where someone said it wasn't possible to detect, determine,		
 -// / or even extrapolate at the hardware in-use by a client from the server.		
 -// / 		
 -// / This code will attempt to identify a user based on the detected user agent		
 -// / and will redirect the user to a page containing specific information for 		
 -// / their device. 		
 -// / This code could be written to verify the user agent against the requested		
 -// / display resolution as a method for detecting spoofed UA strings.		
 -// / 		
 -// / In the event that the device could not be identified we get as close to 		
 -// / a match as we can before asking the user to install a script that will		
 -// / work to complete the identification.		
$UA = strtolower($_SERVER['HTTP_USER_AGENT']);		  $UA = strtolower($_SERVER['HTTP_USER_AGENT']);
$mobileArr = array('E6782', 'C811', 'Iphone', 'Ipad', 'whatever');		 +$IPad1 = strtolower('iPad; U;');
$deskArr = array('Windows', 'Linux');		 +$IPad2and3 = strtolower('iPad; CPU');
$mc = 0;		 +if (preg_match("/$UA/", $IPad1)) {
foreach ($mobileArr as $mobileArrs) {		 + 
$mobileArrs = strtolower($mobileArrs);		 +// / This file will load a static page and return a specified div.
if (preg_match("/$mobileArrs/", $UA)) {		 +// / The strings for $divStart and $divEnd must by IDENTICAL to the
$mc++;		 +// / way they are displayed in the $divLocation. 
include('/Libraries/'.$mobileArrs.'.php'); } }		 +
if ($mc < 1) {		 +$divLocation = file_get_contents('https://en.wikipedia.org/wiki/IPad_(1st_generation)#cite_note-AppleIPadSpecs-1');
foreach ($deskArr as $desktopArrs) {		 +$divStart = '{?><table class=infobox hproduct vevent"<?php}';
$desktopArrs = strtolower($desktopArrs);		 +$divEnd = '{?></table><?php}';
if (preg_match("/$desktopArrs/", $UA)) {		 +$delimiter = '#';
 include('/Libraries/'.$desktopArrs.'.php'); } } }
