<?php

session_start();
include "connectDB.php";

if($_FILES["file"]["name"] != '')
{
    $UserId=$_SESSION["userId"];
    $test = explode('.', $_FILES["file"]["name"]);
    $ext = end($test);
    $name = rand(100, 999) . '.' . $ext;
    $location = '../upload/' . $name;
    move_uploaded_file($_FILES["file"]["tmp_name"], $location);
    $location="upload/".$name;
    $sql = "UPDATE Users SET ImageLocation='$location' WHERE UserId='$UserId'";
    $conn->query($sql);
    $_SESSION["image"]=$location;
    echo $location;
}


