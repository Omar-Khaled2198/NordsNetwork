<?php

session_start();
include "connectDB.php";

if(isset($_SESSION["userId"])&&!empty($_SESSION["userId"]))
{
    $UserId=$_POST["UserId"];
    $Follower =$_SESSION["userId"];
    $value=$_POST["value"];

    if($value==1)
    {
        $sql = "INSERT INTO Follow (User, Follower) VALUES ('$UserId','$Follower')";
        $conn->query($sql);
        echo 1;

    }
    else
    {
        $sql = "DELETE FROM Follow WHERE '$UserId','$Follower'";
        $conn->query($sql);
        echo -1;
    }

    $sql = "UPDATE Users SET Following=Following+'$value' WHERE UserId='$Follower'";
    $conn->query($sql);

    $sql = "UPDATE Users SET Followers=Followers+'$value' WHERE UserId='$UserId'";
    $conn->query($sql);



}