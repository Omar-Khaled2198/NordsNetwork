<?php

session_start();
include "php/connectDB.php";
$UserId=$_GET["userId"];

$sql = "SELECT UserId, FirstName, LastName, ProfileImage FROM Users Where UserId='$UserId'";

$result = $conn->query($sql);
$data = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $data["FirstName"]." ".$data["LastName"]?></title>
    <link rel="stylesheet" href="css/timeline.css">
    <link rel="stylesheet" href="css/profile.css">
    <script src="js/jquery-3.3.1.min.js"></script>

</head>
<body>
<div id="bar">
    <div id="home" class="barButton">Home</div>
    <div class="barTitle">Nords Network</div>
    <input class="search" type="text" placeholder="Search Nords Network...">
    <div id="profile"  class="barButton"><?php echo $_SESSION["firstName"]?></div>
</div>
<div id="coverContainer">
    <img id="coverImage" src="">
    <div id="pImageContainer">
        <img id="pImage" src="<?php echo $data["ProfileImage"]?>">
    </div>
</div>
<div id="infoBar">
    <div class="infoBarName"><?php echo $data["FirstName"]." ".$data["LastName"]?></div>
    <div id="infos">

        <?php
        $UserId=$data["UserId"];
        $sql = "SELECT * FROM Users Where UserId='$UserId'";
        $result = $conn->query($sql);
        $user = $result->fetch_assoc();
        ?>

        <div id="postsNum">Posts <?php echo $user["Posts"]?></div>
        <div id="FollowingNum">Following  <?php echo $user["Following"]?></div>
        <div id="followersNum">Followers  <?php echo $user["Followers"]?></div>
    </div>
    <button id="follow" onclick="follow(this)" value=<?php echo $UserId?>>Follow +</button>
</div>
<div class="leftSideContainer">

</div>
<div id="container">
    <div id="timeline">
        <?php
        $sql = "SELECT * FROM Users INNER JOIN Posts ON Posts.UserId=Users.UserId Where Users.UserId='$UserId' ORDER BY Posts.PostId";
        $_GET["sql"]=$sql;
        include "php/posts.php";
        ?>
    </div>
</div>
<div class="rightSideContainer">
    <div class="sideNav">
        <div class="followSuggest">Users</div>
        <?php

        include "php/users.php"
        ?>
    </div>
</div>
<script src="js/features.js"></script>
<script src="js/load.js"></script>
</body>
</html>