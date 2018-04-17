<?php

session_start();
include "connectDB.php";

$sql = "SELECT Posts.PostId, Posts.Likes, Posts.Text, Posts.UserId, Users.FirstName, Users.LastName
FROM Users
INNER JOIN Posts ON Posts.UserId=Users.UserId";


$result = $conn->query($sql);
$posts="";

if ($result->num_rows > 0)
{
    while($row = $result->fetch_assoc())
    {
        $posts .= "<div class='post' id='p".$row["PostId"]."'value=".$row["PostId"] . ">
        <div class='bar'>
            <div class='imageHolder'></div>
            <div class='user'>
                <div class='name'>" . $row["FirstName"] . " " . $row["LastName"] . "</div>
                <div class='date'>DateHolder</div>
            </div>
        </div>
        <div class='textHolder'>" . $row["Text"] . "</div>
        <div class='bottomBar'>
            <button class='like' value='p".$row["PostId"]."'>Likes(" . $row["Likes"] . ")</button>
        </div>
        <div class='commentContainer'>
        ";
        $id = $row['PostId'];
        $sql = "SELECT Comments.comment, Users.FirstName, Users.LastName
              FROM Users
              INNER JOIN Comments ON Comments.User=Users.UserId Where Comments.PostId='$id'";
        $results2 = $conn->query($sql);
        if ($results2->num_rows > 0)
        {
            while ($row2 = $results2->fetch_assoc())
            {
                $posts.="<div class='comment'>
                            <div class='imageHolder'></div>
                            <div class='user'>
                                <div class='name'>".$row2["FirstName"]." ".$row2["LastName"]."</div>
                                <div class='date'>DateHolder</div>
                            </div>
                            <div class='textHolder'>
                                <div class='textHolder'>".$row2["comment"]."</div>
                            </div>
                        </div>";
            }
        }
                $posts.="</div><div class='editComment'>
            <div class='imageHolder'></div>
            <div class='user'>
                <div class='name'>".$row["FirstName"]." ".$row["LastName"]."</div>
            </div>
            <div class='textHolder'>
                <textarea class='text'></textarea>
                <button class='commentIt' onclick='comment(this.value)' value='p".$id."'>Comment</button>
            </div>
        </div>
    </div>";
    }
    echo $posts;
}