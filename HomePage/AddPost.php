<?php
  session_start();
  $date = $_POST["date"];
  $title = $_POST["title"];
  $text = $_POST["text"];
  $userID = $_SESSION["ID"];

  $mysqli = new mysqli("mysql.eecs.ku.edu", "c712g285", "caC3miex", "c712g285");

  /* check connection */
  if ($mysqli->connect_error)
  {
      printf("Connect failed: %s\n", $mysqli->connect_error);
      exit();
  }

  $query = "INSERT INTO Post (PostDate,PostTitle,PostText,PostUser) VALUES ('" . $date ."', '". $title ."', '". $text ."', '" . $userID . "');";
  if ($result = $mysqli->query($query))
  {
  }

    /* close connection */
  $mysqli->close();
?>
