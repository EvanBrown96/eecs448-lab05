<?php

echo("<a href='./index.html'>Go Home</a><br><a href='./CreateUser.html'>Go Back</a><br><br>");

// get entered username from POST data
$username = $_POST["username"];

// check if a blank username was entered
if($username == ""){
  echo("You must enter a non-blank username!");
  exit();
}



// create mysql connection
$mysqli = new mysqli("mysql.eecs.ku.edu", "e329b498", "pu4oefeL", "e329b498");

// check that the connection was successful
if($mysqli->connect_errno){
  echo("Connection to MySQL server failed: " . $mysqli->connect_errno);
  exit();
}



// see if this user has already been entered
$query = "SELECT * FROM users WHERE user_id='" . $username . "';";

if($result = $mysqli->query($query)){

  // check if there are any values in this query result -
  //   if there are, display an error message
  if($result->fetch_assoc()){

    echo("The username " . $username . " is already in use, try again.");
    exit();

  }

  $result->free();
}



// add this user to the table
$query = "INSERT INTO users VALUES ('" . $username . "')";

if($mysqli->query($query) === TRUE){
  echo("Username " . $username . " successfully registered in database!");
}
else{
  echo("Error pushing username to database: " . $mysqli->error);
}



// close connection
$mysqli->close();

?>
