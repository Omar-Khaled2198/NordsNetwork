<?php

session_start();
include 'connectDB.php';



    $comments = "";
         $postId = $_POST["postId"];
        $lastComment = $_POST["lastComment"];
        $sql = "SELECT *
              FROM Users
              INNER JOIN Comments ON Comments.User=Users.UserId 
              Where Comments.PostId='$postId' AND Comments.CommentId>'$lastComment' 
              ORDER BY Comments.CommentId";
        $results = $conn->query($sql);
        if ($results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $comments .= "<div class='comment' id='c" . $row["CommentId"] . "'value=" . $row["CommentId"] . ">
                    <div class='imageHolder'>
                             <img class='timelineImage' src=".$row["ProfileImage"].">
                             </div>
                    <div class='user'>
                        <div class='name'>" . $row["FirstName"] . " " . $row["LastName"] . "</div>
                        <div class='date'>".$row["dateposted"]."</div>
                    </div>
                    <div class='textHolder'>
                                <div class='text' style='border: none'>".$row["comment"]."</div>
                            </div>
                </div>";
            }
        }

        echo $comments;





