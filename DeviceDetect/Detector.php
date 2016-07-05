<?php
 // / The DeviceDetect application and repo are the result of a Reddit 		
 // / thread where someone said it wasn't possible to detect, determine,		
 // / or even extrapolate at the hardware in-use by a client from the server.		
 // / 		
 // / This code will attempt to identify a user based on the detected user agent		
 // / and will redirect the user to a page containing specific information for 		
 // / their device. 		
 // / This code could be written to verify the user agent against the requested		
 // / display resolution as a method for detecting spoofed UA strings.		
 // / 		
 // / In the event that the device could not be identified we get as close to 		
 // / a match as we can before asking the user to install a script that will		
 // / work to complete the identification.		
$UA = strtolower($_SERVER['HTTP_USER_AGENT']);
$mobileArr = array('E6782', 'C811', 'Iphone', 'Ipad', 'whatever');
$deskArr = array('Windows', 'Linux');
$mc = 0;		
foreach ($mobileArr as $mobileArrs) {		 
$mobileArrs = strtolower($mobileArrs);		 
if (preg_match("/$mobileArrs/", $UA)) {	
$mc++;	
include('/Libraries/'.$mobileArrs.'.php'); } }	
if ($mc < 1) {	
foreach ($deskArr as $desktopArrs) {		
$desktopArrs = strtolower($desktopArrs);	
if (preg_match("/$desktopArrs/", $UA)) {	
include('/Libraries/'.$desktopArrs.'.php'); } } }
