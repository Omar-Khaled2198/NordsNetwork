<?php

session_start();
include "connectDB.php";

if(isset($_SESSION["userId"])&&!empty($_SESSION["userId"]))
{
    if($_POST["option"]==1)
    {
        $UserId=$_SESSION["userId"];
        $lastPost=$_POST["lastPost"];
        $sql = "Select * from Follow Inner join Posts on Follow.User=Posts.UserId 
            inner Join Users on Follow.Follower='$UserId' 
            WHERE Users.UserId=Follow.User And Posts.PostId>'$lastPost' 
            ORDER BY Posts.PostId";

        $_GET["sql"]=$sql;
        include "posts.php";
    }
    else
    {
        $UserId=$_SESSION["userId"];
        $lastPost=$_POST["lastPost"];
        $sql = "Select * from Posts INNeR JOIN Users
                on Posts.UserId=Users.UserId
                WHERE Posts.UserId='$UserId' AND Posts.PostId>'$lastPost' ORDER BY Posts.PostId";
        $_GET["sql"]=$sql;
        include "posts.php";
    }

}

