<?php

echo("<a href='./index.html'>Go Home</a><br><a href='./DeletePost.html'>Go Back</a><br><br>");



// create mysql connection
$mysqli = new mysqli("mysql.eecs.ku.edu", "e329b498", "pu4oefeL", "e329b498");

// check that the connection was successful
if($mysqli->connect_errno){
  echo("Connection to MySQL server failed: " . $mysqli->connect_errno);
  exit();
}



// iterate through all entered post values to delete
foreach($_POST as $key => $value){
  // delete the post
  $query = "DELETE FROM posts WHERE post_id = " . $key;
  if($mysqli->query($query)){
    echo("Post #" . $key . " successfully deleted.<br>");
  }
  else{
    echo("Error deleting post #" . $key . "<br>");
  }
}

// close connection
$mysqli->close();

?>
