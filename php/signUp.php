<?php

include "connectDB.php";

$FirstName=mysqli_real_escape_string($conn,$_POST["firstName"]);
$LastName=mysqli_real_escape_string($conn,$_POST["lastName"]);
$UserId=mysqli_real_escape_string($conn,$_POST["email"]);
$Password=mysqli_real_escape_string($conn,$_POST["pass"]);

if(!empty($_POST["firstName"])&&!empty($_POST["lastName"])&&!empty($_POST["email"])&&!empty($_POST["pass"])) {
    if (!filter_var($UserId, FILTER_VALIDATE_EMAIL)) {
        $conn->close();
        echo json_encode(array("auth" => "false"));
    } else {
        $sql = "SELECT UserId FROM Users Where UserId='$UserId'";

        $result = $conn->query($sql);

        if ($result->num_rows == 0) {
            session_start();
            $sql = "INSERT INTO Users (UserId, FirstName, LastName, Password) VALUES 
           ('$UserId', '$FirstName','$LastName', '$Password')";
            $conn->query($sql);
            $_SESSION["userId"] = $UserId;
            $_SESSION["firstName"] = $FirstName;
            $_SESSION["lastName"] = $LastName;
            $auth = array("auth" => "true");

        } else {
            $auth = array("auth" => "false");
        }

        echo json_encode($auth);
    }
}
else
{
    echo json_encode(array("auth" => "false"));
}

