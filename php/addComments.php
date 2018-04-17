<?php

session_start();
include "connectDB.php";

$UserId=$_SESSION["userId"];
$text=$_POST["comment"];
$postId=$_POST["postId"];

$sql = "INSERT INTO Comments (PostId, User, comment) VALUES 
           ('$postId','$UserId', '$text')";
$conn->query($sql);

$comment="<div class='comment'>
                <div class='imageHolder'></div>
                <div class='user'>
                    <div class='name'>".$_SESSION["firstName"]." ".$_SESSION["lastName"]."</div>
                    <div class='date'>DateHolder</div>
                </div>
                <div class='textHolder'>
                    <div class='textHolder'>".$text."</div>
                </div>
            </div>";

echo $comment;