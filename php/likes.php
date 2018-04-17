<?php

session_start();
include "connectDB.php";

$postId=$_POST["postId"];
$value=$_POST["value"];
$UserId=$_SESSION["userId"];
$sql = "UPDATE Posts SET Likes=Likes+'$value' WHERE PostId='$postId'";
$conn->query($sql);
if($value==1)
{
    $sql = "INSERT INTO Likes (UserId, PostId) VALUES ('$UserId','$postId')";
    $conn->query($sql);
    echo "1";
}
else if($value==-1)
{
    $sql = "DELETE FROM Likes WHERE UserId='$UserId'And PostId=$postId";
    $conn->query($sql);
    echo "-1";
}

