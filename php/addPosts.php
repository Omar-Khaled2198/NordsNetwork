<?php

session_start();
include "connectDB.php";

if(isset($_SESSION["userId"])&&!empty($_SESSION["userId"]))
{

$UserId=$_SESSION["userId"];
$text=$_POST["text"];

    if(!empty($_POST["text"]))
    {
        $image="";
        if(!empty($_POST["image"]))
            $image=$_POST["image"];
        $sql = "INSERT INTO Posts (UserId, Likes, Text, Comments, ImageLocation) VALUES 
               ('$UserId',0, '$text', 0, '$image')";
        $conn->query($sql);
        $sql = "UPDATE Users SET Posts=Posts+1 WHERE UserId='$UserId'";
        $conn->query($sql);

        echo $image;

    }
}
