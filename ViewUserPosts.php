<?php

echo("<a href='./index.html'>Go Home</a><br><a href='./ViewUserPosts.html'>Go Back</a><br><br>");

// get entered username from POST data
$username = $_POST["user"];
echo($username);


// create mysql connection
$mysqli = new mysqli("mysql.eecs.ku.edu", "e329b498", "pu4oefeL", "e329b498");

// check that the connection was successful
if($mysqli->connect_errno){
  echo("Connection to MySQL server failed: " . $mysqli->connect_errno);
  exit();
}



// add this user to the table
$query = $mysqli->prepare("SELECT * FROM posts WHERE author_id = ?");
$query->bind_param("s", $username);


if($query->execute()){
  $result = $query->get_result();

  echo("<table style='border-collapse: collapse'><tr><th style='border: 1px solid black'>Post #</th><th style='border: 1px solid black'>User</th><th style='border: 1px solid black'>Content</th>");

  while($row = $result->fetch_assoc()){
    echo("<tr><td style='border: 1px solid black'>" . $row['post_id'] . "</td>");
    echo("<td style='border: 1px solid black'>" . $row['author_id'] . "</td>");
    echo("<td style='border: 1px solid black'>" . $row['content'] . "</td></tr>");
  }

  echo("</table>");

  $result->free();
}
else{
  echo("Error getting user's posts: " . $mysqli->errno);
}



// close connection
$mysqli->close();

?>
