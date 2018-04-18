<?php
session_start();
include "connectDB.php";


if(!empty($_POST["email"])&&!empty($_POST["pass"]))
{
    $UserId=mysqli_real_escape_string($conn,$_POST["email"]);
    $Password=mysqli_real_escape_string($conn,$_POST["pass"]);


    $sql = "SELECT UserId, FirstName, LastName FROM Users Where UserId='$UserId'AND Password='$Password'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0)
    {
        $auth=array("auth"=>"true");
        $data = $result->fetch_assoc();
        $_SESSION["userId"]=$data["UserId"];
        $_SESSION["firstName"]=$data["FirstName"];
        $_SESSION["lastName"]=$data["LastName"];
    }
    else
    {
        $auth=array("auth"=>"false");
        session_destroy();
    }

    echo json_encode($auth);
}
else
{
    echo json_encode(array("auth" => "false"));
}