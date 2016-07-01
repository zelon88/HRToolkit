<?php
session_start();
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
$coreVarfile = '/var/www/html/HRProprietary/HRAI/coreVar.php';
$coreFile = 'http://localhost/HRProprietary/HRAI/core.php';
$input = $_POST['input'];
if(empty($_POST['input'])) {
  $input = '0'; } 
if(!empty($_POST['input'])) {
  $input = $_POST['input']; }
if(empty($_POST['display_name'])) {
  $display_name = '0'; } 
if(!empty($_POST['display_name'])) {
  $display_name = $_POST['display_name']; }
if(empty($_POST['user_ID'])) {
  $user_ID = '0'; } 
if(!empty($_POST['user_ID'])) {
  $user_ID = $_POST['user_ID']; }
// / Get the session ID. If sesID is empty we post all vars to core.php to generate one, then post the data back
// / for processing.
if(isset($_POST['sesID'])){
  $sesID = $_POST['sesID']; 
    if (empty($sesID)) {
      $dataArr = array('userID' =>  "$user_ID",
            'input' => "$input",
            'display_name' =>  '$display_name',
            'sesID' => '$sesID');

  $handle = curl_init($coreFile);
  curl_setopt($handle, CURLOPT_POST, true);
  curl_setopt($handle, CURLOPT_POSTFIELDS, $dataArr);
  curl_exec($handle);
  die ('Sent data to coreFile to generate a session ID.'); } }


$sesLogfile = ('/HRAI/sesLogs/'.$user_ID.'/'.$sesID.'/'.$sesID.'.txt');
require_once ($coreVarfile);
require_once ($onlineFile);
// / We call this function now because it gathers fresh info about the network and stores it in the nodeCache.
$n0stat = getNetStat();
// / Now that the nodeCache is up-to-date we can include it.
include_once ($nodeCache);
$dataArr = array('userID' =>  "$user_ID",
            'input' => "$input",
            'display_name' =>  '$display_name',
            'sesID' => '$sesID');
// / If we have a logfile we continue the script. If not we pass the variables we've got to core.php
// / to establish a session, which does it's business and then passes the data back for re-parsing
if (!file_exists($sesLogfile)) {
// / We can POST a file by prefixing with an @ (for <input type="file"> fields)
  $handle = curl_init($coreFile);
  curl_setopt($handle, CURLOPT_POST, true);
  curl_setopt($handle, CURLOPT_POSTFIELDS, $dataArr);
  curl_exec($handle); 
  die ('Sent data to coreFile to generate a session ID.'); }

// / Node0 is the server currently running this script. If it reports that it is busy from we will
// / check for other nodes to handle our request, and gather if they are busy or not. If they are 
// / also busy we skip them and remove them from the nodeCache.
if ($node0Busy = 1) {
  // / Check to see if our nodes are busy. If they are we drop the nodeCount and try again.
  if ($nodeCount >= 1) {
    $useNodeBusy = ${"node" . $nodeCount. "Busy"};
      if ($useNodeBusy = 1) {
        $nodeCount = ($nodeCount - 1);
        $useNodeBusy = ${"node" . $nodeCount. "Busy"}; }
  if ($nodeCache >= 1)
    $useNodeBusy = ${"node" . $nodeCount. "Busy"};
      if ($useNodeBusy = 1) {
        $nodeCount = ($nodeCount - 1);
        $useNodeBusy = ${"node" . $nodeCount. "Busy"}; }
  if ($nodeCache >= 1)
    $useNodeBusy = ${"node" . $nodeCount. "Busy"};
      if ($useNodeBusy = 1) {
        $nodeCount = ($nodeCount - 1);
        $useNodeBusy = ${"node" . $nodeCount. "Busy"}; }
  if ($nodeCache >= 1)
    $useNodeBusy = ${"node" . $nodeCount. "Busy"};
      if ($useNodeBusy = 1) {
        $nodeCount = ($nodeCount - 1);
        $useNodeBusy = ${"node" . $nodeCount. "Busy"}; }
  if ($nodeCache >= 1)
    $useNodeBusy = ${"node" . $nodeCount. "Busy"};
      if ($useNodeBusy = 1) {
        $nodeCount = ($nodeCount - 1);
        $useNodeBusy = ${"node" . $nodeCount. "Busy"}; }
  if ($nodeCache >= 1)
    $useNodeBusy = ${"node" . $nodeCount. "Busy"};
      if ($useNodeBusy = 1) {
        $nodeCount = ($nodeCount - 1);
        $useNodeBusy = ${"node" . $nodeCount. "Busy"}; }
  if ($nodeCache >= 1)
    $useNodeBusy = ${"node" . $nodeCount. "Busy"};
      if ($useNodeBusy = 1) {
        $nodeCount = ($nodeCount - 1);
        $useNodeBusy = ${"node" . $nodeCount. "Busy"}; }
  if ($nodeCache >= 1)
    $useNodeBusy = ${"node" . $nodeCount. "Busy"};
      if ($useNodeBusy = 1) {
        $nodeCount = ($nodeCount - 1);
        $useNodeBusy = ${"node" . $nodeCount. "Busy"}; }
  if ($nodeCache >= 1)
    $useNodeBusy = ${"node" . $nodeCount. "Busy"};
      if ($useNodeBusy = 1) {
        $nodeCount = ($nodeCount - 1);
        $useNodeBusy = ${"node" . $nodeCount. "Busy"}; } }
    // / Now that we've eliminated servers that are busy, we send the request to the next available node.
    $useNode = ${"node" . $nodeCount. "URL"};
    $handle = curl_init($useNode/'/langPar.php');
    curl_setopt($handle, CURLOPT_POST, true);
    curl_setopt($handle, CURLOPT_POSTFIELDS, $dataArr);
    curl_exec($handle); 
    // / And write an entry to the sesLog.
    $sesLogfile0 = fopen("$sesLogfile", "a+");
    $txt = ('LangPar: '."User $display_name".','." $user_ID during $sesID on $date".'. Node0 is busy. 
      Sending request to node '.$useNode.'. NodeCount is'.$nodeCount.);
    $compLogfile = file_put_contents($sesLogfile, $txt.PHP_EOL , FILE_APPEND); 
    // / Before we kill the script on this server we update our nodeCache file.
    $n0stat = getNetStat();
    // / And finally we can give this server a break to finish doing what it's doing.
    die ('This request was sent to node '.$useNode.' for processing. ')}

// / A sentence is defined as a user inputed string that terminates with a period.
// / returns an array of separate sentences.
$sentences = implode('.', array_slice(explode('.', $input)));
  foreach ($sentences as $sentence) {

  }
// / Count the number of words within a sentence.
$sentWordCount = str_word_count($sentence);
// / A fragment is defined as a selection of text within a sentence that terminates with a comma.
// / Returns an array of separate arrays.
$fragments = implode(',', array_slice(explode(',', $input), 0, $sentWordCount));
  foreach ($fragments as $fragment) {

  }

// / Count the number of words within a fragment.
$fragWordCount = str_word_count($fragment);
// / If we need to select a part of a section we define the selection by wordcount from the beginning
// / of a user inputted string.
$selection1 = $_POST['selection1'];
  if(empty($selection1)) {
  	$selection1 = 0; }
$selection2 = $_POST['selection2'];
  if(empty($selection2)) {
  	$selection2 = 0; }

// / Here we first get the words out of each fragment and add them to an array. We will later parse each word of this array, in
// / order and return the wordMeaning of each word. We will then parse the next half of the sentence without the frament as though
// / it were a fragment, and then combine the outputs into a cohesive string that gets returned to the user. If the user is confused
// / we can go back, remove the fragment from the original sentence, parse the sentence without the fragment, and return that value
// / in the hopes that it makes sense.
$wordsOfFrag = implode(' ', array_slice(explode(' ', $fragment));
$wordsOfSent = implode(' ', array_slice(explode(' ', $sentence)); }

// / The meaning of a word is interpreted by the HRAI language parser as a hasb based on the type of wordType 
// / (question, statement, command, opinionOut, opinionIn), the wordStat (verb, noun, adjective), the wordTense
// / (past, present, future), the WordWeight (very negative, negative, neutral, positive, very positive), an array
// / of synonyms, an array of antonyms, and a satisfy flag (wordSatisfy) that tells us if the word is to be ignored
// / responded to directly, or included within a part of another response (basically the priority of the word based on 
// / other words around it).
function getWordMeaning($words); {
  foreach ($words as $word) {
 $currentEmo = getCurrentEmo();
 $impliedEmo = getImpliedEmo($word);
 $wordHash = (' '.getFirstWord($word).' '.getWordType($word).' '.getWordStat($word).' '.getWordTense($word).' '
   .getWordWeight($word).' '.getWordSynArr($word).' '.getWordAntArr($word)' '$getWordSatisfy($word).' '); }
  return($wordHash);
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