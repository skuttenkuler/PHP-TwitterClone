<?php

require_once 'db.php';
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'password';
$dbname = 'tweet';

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
//set up query
function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    if (!$result) {
      print mysqli_error($conn) . $query;
      return -1;
    }
    return $result;
  }
  //get tweet
  function getSingle($query) {
    global $conn;
    $result = query($query);
    $row = mysqli_fetch_row($result);
    return $row[0];
  }
  




  //event handlers
  if($_REQUEST['tweet']) {
    $tweet = mysqli_real_escape_string($conn, $_REQUEST['tweet']);
    if(getSingle("select count(*) from tweets where post = '$tweet' and date >= '".Date("Y-m-d H:i:s", time()-60*60)."'")){
      die("Disallowed.");
    }
    if(getSingle("select count(*) from tweets where uid=$user and date >= '".Date("Y-m-d H:i:s", time()-60*10)."'") >= 5){
      # Rate limit to less than 5 tweets in 10 minutes.
      die("Too many tweets at this time.");
    }

print <<<EOF
<form action=index.php method=post>
  <table><TR><TD width=400>
  <textarea name=tweet class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
  </td><TD>
  <button type="submit" class="btn btn-primary">Tweet</button>
  </td></tr></table>
</form>
EOF;
