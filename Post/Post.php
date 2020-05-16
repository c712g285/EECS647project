<?php
session_start();
?>
<html>
    <head>
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script type="text/javascript"
               src="Post.js">
      </script>
	  <link href="Post.css"
		rel="stylesheet"
		type="text/css">
    </head>

    <body>
      <center>
        <a href='../HomePage/HomePage.php'><button class="button">Back to HoemPage</button></a>
      </center>
      <?php
      $userID = $_SESSION["ID"];
      $PostID = $_SESSION["PostID"];
      $mysqli = new mysqli("mysql.eecs.ku.edu", "c712g285", "caC3miex", "c712g285");
      if ($mysqli->connect_errno)
      {
        printf("Connect failed: %s\n", $mysqli->connect_error);
        exit();
      }
      ?>
	  <input type="hidden" id="postid" <?php echo 'value = "'.$PostID.'"'; ?> >
    <input type="hidden" id="userid" <?php echo 'value = "'.$userID.'"'; ?> >
		<div id="box" class="container box">
			<div class="row container">
			<div class="col m1 container center">
			<img src="icon.png" height="98" width="98">
			</div>
			<div class="col m5 container center">
			<h2 id="title" class="distext">
        <?php
        $query = "SELECT * FROM Post WHERE PostID = '$PostID' ";
        if ($result = $mysqli->query($query))
        {
          if($row = $result->fetch_assoc())
          {
            echo $row["PostTitle"];
          }
          $result->free();
        }
        ?>
      </h2>
			</div>
			</div>
      <?php
      $query = "SELECT * FROM User INNER JOIN Post ON User.UserID=Post.PostUser WHERE PostID = '$PostID' ";
      if ($result = $mysqli->query($query))
      {
        if($row = $result->fetch_assoc())
        {
          echo "<script>"."addreply('".
          $row["PostText"]."','".
          $row["UserName"]."','".
          $row["PostDate"]."','".
          $row["PostLike"]."','".
          $row["PostUser"]."','".
          $row["PostID"].
          "','1')".
          "</script>";
        }
        $result->free();
      }
      ?>
      <?php
      $query = "SELECT * FROM Reply INNER JOIN User ON User.UserID=Reply.ReplyUser WHERE ReplyTo = '$PostID' ORDER BY ReplyDate ASC";
      if ($result = $mysqli->query($query))
      {
          while ($row = $result->fetch_assoc())
          {
           echo "<script>"."addreply('".
           $row["ReplyText"]."','".
           $row["UserName"]."','".
           $row["ReplyDate"]."','".
           $row["ReplyLike"]."','".
           $row["ReplyUser"]."','".
           $row["ReplyID"].
           "','0')".
           "</script>";
          }
          $result->free();
      }
       ?>
			<div id="replyarea" class="row container">
			<div class="col m6 container">
			<textarea name="text" rows="8" cols="80" wrap="soft" style="background-color :#DCF8C6;"> </textarea>
			</div>
			<div class="col m1 container center " >
			<button id="reply" >Post Reply</button>
			</div>
			</div>
		</div>
    <div class="col m6 container">

    </div>
    </body>
</html>
