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



// add this user to the table
$query = $mysqli->prepare("INSERT INTO users VALUES (?)");
$query->bind_param("s", $username);

if($query->execute() === TRUE){
  echo("Username " . $username . " successfully registered in database!");
}
else if($mysqli->errno == 1062){
  echo("The username " . $username . " is already registered.");
}
else{
  echo("Error adding username to database: " . $mysqli->errno);
}



// close connection
$mysqli->close();

?>
