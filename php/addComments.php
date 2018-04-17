<?php

session_start();
include "connectDB.php";



if(!empty($_POST["comment"])&&!empty($_POST["postId"]))
{
    $UserId=$_SESSION["userId"];
    $text=$_POST["comment"];
    $postId=$_POST["postId"];
    $sql = "INSERT INTO Comments (PostId, User, comment) VALUES 
           ('$postId','$UserId', '$text')";
    $conn->query($sql);

    $id = $conn->insert_id;

    $comment = "<div class='comment' id='c" . $id . "'value=" . $id . ">
                <div class='imageHolder'></div>
                <div class='user'>
                    <div class='name'>" . $_SESSION["firstName"] . " " . $_SESSION["lastName"] . "</div>
                    <div class='date'>DateHolder</div>
                </div>
                <div class='textHolder'>
                    <div class='textHolder'>" . $text . "</div>
                </div>
            </div>";

    echo $comment;
}