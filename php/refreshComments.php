<?php

session_start();
include 'connectDB.php';



    $comments = "";

         $postId = $_POST["postId"];
        $lastComment = $_POST["lastComment"];
        $sql = "SELECT Comments.comment, Users.FirstName, Users.LastName, Comments.CommentId, Comments.dateposted
              FROM Users
              INNER JOIN Comments ON Comments.User=Users.UserId 
              Where Comments.PostId='$postId' AND Comments.CommentId>'$lastComment' 
              ORDER BY Comments.CommentId";
        $results = $conn->query($sql);
        if ($results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $comments .= "<div class='comment' id='c" . $row["CommentId"] . "'value=" . $row["CommentId"] . ">
                    <div class='imageHolder'></div>
                    <div class='user'>
                        <div class='name'>" . $row["FirstName"] . " " . $row["LastName"] . "</div>
                        <div class='date'>".$row["dateposted"]."</div>
                    </div>
                    <div class='textHolder'>
                        <div class='textHolder'>" . $row["comment"] . "</div>
                    </div>
                </div>";
            }
        }

        echo $comments;





