<?php
$UA = strtolower($_SERVER['HTTP_USER_AGENT']);
$IPad1 = strtolower('iPad; U;');
$IPad2and3 = strtolower('iPad; CPU');
if (preg_match("/$IPad1/", $UA)) {
 
// / This file will load a static page and return a specified div.
// / The strings for $divStart and $divEnd must by IDENTICAL to the
// / way they are displayed in the $divLocation. 

$divLocation = file_get_contents('https://en.wikipedia.org/wiki/IPad_(1st_generation)#cite_note-AppleIPadSpecs-1');
$divStart = '{?><table class=infobox hproduct vevent"<?php}';
$divEnd = '{?></table><?php}';
$delimiter = '#';
$divData = $delimiter . preg_quote($divStart, $delimiter) 
                    . '(.*?)' 
                    . preg_quote($divEnd, $delimiter) 
                    . $delimiter 
                    . 's';
preg_match($divData,$divLocation,$div1);
$div = $div1[0];
// / Look ma, no CuRL!
echo $div; }
if (preg_match("/$IPad1/", $UA)) { ?>
<script type="text/javascript">// < ![CDATA[
if (screen.width = 768) { 
// ]]>
<?php
 
// This file will load a static page and return a specified div.
// The strings for $divStart and $divEnd must by IDENTICAL to the
// way they are displayed in the $divLocation. 
$divLocation = file_get_contents('https://en.wikipedia.org/wiki/IPad_2');
$divStart = '{?><table class=infobox hproduct vevent"<?php}';
$divEnd = '{?></table><?php}';
$delimiter = '#';
$divData = $delimiter . preg_quote($divStart, $delimiter) 
                    . '(.*?)' 
                    . preg_quote($divEnd, $delimiter) 
                    . $delimiter 
                    . 's';
preg_match($divData,$divLocation,$div1);
$div = $div1[0];
// / Look ma, no CuRL!
echo $div; ?>
} </script>
<script type="text/javascript">// < ![CDATA[
if (screen.width = 1536) { 
// ]]>
<?php
 
// This file will load a static page and return a specified div.
// The strings for $divStart and $divEnd must by IDENTICAL to the
// way they are displayed in the $divLocation. 
$divLocation = file_get_contents('https://en.wikipedia.org/wiki/IPad_(3rd_generation)');
$divStart = '{?><table class=infobox hproduct vevent"<?php}';
$divEnd = '{?></table><?php}';
$delimiter = '#';
$divData = $delimiter . preg_quote($divStart, $delimiter) 
                    . '(.*?)' 
                    . preg_quote($divEnd, $delimiter) 
                    . $delimiter 
                    . 's';
preg_match($divData,$divLocation,$div1);
$div = $div1[0];
// / Look ma, no CuRL!
echo $div; ?>
} </script>
<?php }
