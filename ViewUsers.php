<?php

echo("<a href='./index.html'>Go Home</a><br><a href='./AdminHome.html'>Go Back</a><br><br>");



// create mysql connection
$mysqli = new mysqli("mysql.eecs.ku.edu", "e329b498", "pu4oefeL", "e329b498");

// check that the connection was successful
if($mysqli->connect_errno){
  echo("Connection to MySQL server failed: " . $mysqli->connect_errno);
  exit();
}


$query = "SELECT * FROM users";
// add this user to the table

if($result = $mysqli->query($query)){

  echo("<table style='border-collapse: collapse;'>");

  while($row = $result->fetch_assoc()){
    echo("<tr><td style='border: 1px solid black;'>" . $row['user_id'] . "</td></tr>");
  }

  echo("</table>");

  $result->free();
}
else{
  echo("Error reading usernames from database: " . $mysqli->errno);
}



// close connection
$mysqli->close();

?>
