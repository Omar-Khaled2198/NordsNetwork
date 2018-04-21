<?php

session_start();
include "connectDB.php";

if(isset($_SESSION["userId"])&&!empty($_SESSION["userId"]))
{

    if (!empty($_POST["comment"]) && !empty($_POST["postId"]))
    {
        $UserId = $_SESSION["userId"];
        $text = $_POST["comment"];
        $postId = $_POST["postId"];
        $sql = "INSERT INTO Comments (PostId, User, comment) VALUES 
           ('$postId','$UserId', '$text')";
        $conn->query($sql);

        $sql = "UPDATE Posts SET Comments=Comments+1 WHERE PostId='$postId'";
        $conn->query($sql);



    }

}
