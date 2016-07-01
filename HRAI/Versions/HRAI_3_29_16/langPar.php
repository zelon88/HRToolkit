<?php
// / This is the english language parser for HRAI written by Justin Grimes starting on 3/28/2016.
// / The goal of this file is to break down complex sentences into a complex identifier that can
// / be fed to a set of algorithms that break down human speech into a set of satisfiable conditions.
// / Through the parsing process we will incorporate statistical relational learning, as well as 
// / machine reading and machine learning abilities to create databases of information we can use.
// / 
// / This file is also capable of detecting the available system resources and outsourcing work
// / to an established member of the HRAI network. When outsourcing work, the language parser will
// / POST data to other HRAI servers for processing. We may also POST out some data if we need to
// / perform concurrent research and/or learning functions and we anticipate not having enough 
// / resources. Because the language parser only receives and sends data to the userGUI, we don't
// / are able to POST data to and from scripts as many times as we like before giving a response
// / to the user.


// /If we have a logfile we continue the script.
if (file_exists($sesLogfile)){
$input = $_POST['chat'];
$sentence = implode('.', array_slice(explode('.', $input)));
$sentWordCount = str_word_count($sentence);
$fragment = implode(',', array_slice(explode(',', $input), 0, $sentWordCount));
$selection1 = $_POST['selection1'];
  if(empty($selection1)) {
  	$selection1 = 0; }
$selection2 = $_POST['selection2'];
  if(empty($selection2)) {
  	$selection2 = 0; }
$words = implode(' ', array_slice(explode(' ', $sentence));}

function getWordMeaning($words); {
  foreach ($words as $word) {
  	
  }

}


// /Get the first word of a sentence and determine the nature of it.
function getFirstWord($sentence) {
$words = implode(' ', array_slice(explode(' ', $sentence));
$firstW = implode(' ', array_slice(explode(' ', $sentence), 0, 1)); }
 if $firstW (in_array($wordTypeQ)) {
   


  }

function getWordsCust($sentence) {
$words = implode(' ', array_slice(explode(' ', $sentence));
$first10 = implode(' ', array_slice(explode(' ', $sentence), 0, 10)); 
















//All data below this line is machine generated code.