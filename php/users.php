<?php


$UserId=$_SESSION["userId"];

$sql = "SELECT * FROM Users WHERE UserId!='$UserId'";
$result = $conn->query($sql);
if ($result->num_rows > 0)
{
    while ($data = $result->fetch_assoc())
    {
        echo '<div id='.$data["UserId"].' onclick=go(this) class="suggest"><img class="image" src='.$data["ProfileImage"].'><div class="name">'
            .$data["FirstName"]." ".$data["LastName"].'</div></div>';
    }
}