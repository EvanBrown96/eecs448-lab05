<?php

echo("<a href='./index.html'>Go Home</a><br><a href='./CreatePost.html'>Go Back</a><br><br>");

// get username and post information from POST data
$username = $_POST["username"];
$post_data = $_POST["post-data"];

// check if a any post data was entered
if($post_data == ""){
  echo("Your post cannot be blank!");
  exit();
}

// create mysql connection
$mysqli = new mysqli("mysql.eecs.ku.edu", "e329b498", "pu4oefeL", "e329b498");

// check that the connection was successful
if($mysqli->connect_errno){
  echo("Connection to MySQL server failed: " . $mysqli->connect_errno);
  exit();
}



// add this post to the table
$query = $mysqli->prepare("INSERT INTO posts (content, author_id) VALUES (?, ?);");
$query->bind_param("ss", $post_data, $username);

if($query->execute() === TRUE){
  echo("Post successfully registered in database under username " . $username . "!");
}
else if($mysqli->errno == 1452){
  echo("The given username " . $username . " is not registered - post not saved.");
}
else{
  echo("Error saving post to database: " . $mysqli->errno);
}



// close connection
$mysqli->close();

?>
