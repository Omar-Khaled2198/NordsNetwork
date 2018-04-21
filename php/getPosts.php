<?php

session_start();
include "connectDB.php";

if(isset($_SESSION["userId"])&&!empty($_SESSION["userId"]))
{
$option=$_POST["option"];
$userId=$_SESSION["userId"];
if($option==0)
{
    $sql = "SELECT Posts.PostId, Posts.Likes, Posts.Text, Posts.UserId, Users.FirstName, Users.LastName, Posts.dateposted
            FROM Users
            INNER JOIN Posts ON Posts.UserId=Users.UserId ORDER BY Posts.PostId";
}
else
{
    $lastPost=$_POST["lastPost"];
    $sql = "SELECT Posts.PostId, Posts.Likes, Posts.Text, Posts.UserId, Users.FirstName, Users.LastName, Posts.dateposted
            FROM Users
            INNER JOIN Posts ON Posts.UserId=Users.UserId WHERE Posts.PostId>'$lastPost' ORDER BY Posts.PostId";
}

$result = $conn->query($sql);

include "posts.php";



}