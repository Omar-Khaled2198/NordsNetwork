<?php

session_start();
include "connectDB.php";

if(isset($_SESSION["userId"])&&!empty($_SESSION["userId"]))
{

$UserId=$_SESSION["userId"];
$text=$_POST["text"];

if(!empty($_POST["text"]))
{
    $sql = "INSERT INTO Posts (UserId, Likes, Text) VALUES 
           ('$UserId',0, '$text')";
    $conn->query($sql);

}
}
