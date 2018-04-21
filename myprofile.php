<?php

session_start();
include "php/connectDB.php";
if(!isset($_SESSION["userId"])||empty($_SESSION["userId"]))
{
    header("Location: index.html");
    exit();
}

$UserId=$_SESSION["userId"];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $_SESSION["firstName"]." ".$_SESSION["lastName"]?></title>
    <link rel="stylesheet" href="css/timeline.css">
    <link rel="stylesheet" href="css/profile.css">
    <script src="js/jquery-3.3.1.min.js"></script>

</head>
<body>
<div id="bar">
    <div id="home" class="barButton">Home</div>
    <div class="barTitle">Nords Network</div>
    <input class="search" type="text" placeholder="Search Nords Network...">
    <div style="background-color: #1b95e0; color: white" id="profile" class="barButton"><?php echo $_SESSION["firstName"]?></div>
    <div id="logOut" onclick="window.location='index.html'" class="barButton">Logout</div>
</div>
<div id="coverContainer">

    <div id="pImageContainer">
        <img id="pImage" src="<?php echo $_SESSION["image"]?>">
    </div>
</div>
<div id="infoBar">
    <div class="infoBarName"><?php echo $_SESSION["firstName"]." ".$_SESSION["lastName"]?></div>
    <div id="infos">

        <?php
        $sql = "SELECT * FROM Users Where UserId='$UserId'";
        $result = $conn->query($sql);
        $user = $result->fetch_assoc();
        ?>
        <div id="postsNum">Posts <?php echo $user["Posts"]?></div>
        <div id="FollowingNum">Following  <?php echo $user["Following"]?></div>
        <div id="followersNum">Followers  <?php echo $user["Followers"]?></div>
    </div>
    <button onclick="updateProfileImage()" id="updateImage" >Upload Image</button>
</div>
<div class="leftSideContainer">

</div>
<div id="container">
    <div id="edit">
        <div class="bar">
            <div class="imageHolder">
                <img class="timelineImage" src=<?php echo $_SESSION["image"]?>>
            </div>
            <div class="user">
                <div class="name"><?php echo $_SESSION["firstName"]." ".$_SESSION["lastName"]?></div>
            </div>
        </div>
        <div class="textHolder">
            <div id="content" class="text" contenteditable="true"></div>
        </div>
        <div class="posImageContainer">
            <img class="postImage" src="">
        </div>
        <div class="bottomBar">
            <button id="uploadImage" onclick="$('#file').click()">Update Image</button>
            <input id="file" type="file" accept="image/*" >
            <button id="postIt">Post</button>
        </div>
    </div>
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
<script src="js/hashtag.js"></script> <!--https://markjs.io/-->
</body>
</html>
