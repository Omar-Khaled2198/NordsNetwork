<?php

$Hashtag=$_GET["hashtag"];

?>

<?php

session_start();
include "php/connectDB.php";
$UserId=$_SESSION["userId"];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="css/timeline.css">
    <script src="js/jquery-3.3.1.min.js"></script>

</head>
<body>
<div id="bar">
    <div id="home" class="barButton">Home</div>
    <div class="barTitle">Nords Network</div>
    <div id="profile"  class="barButton"><?php echo $_SESSION["firstName"]?></div>
    <div id="logOut" onclick="window.location='index.html'" class="barButton">Logout</div>

</div>
<div class="leftSideContainer">
    <div class="sideNav">
        <div id="profileImage">
            <img class="image" src="<?php echo $_SESSION["image"]?>">
            <div id="profileName"><?php echo $_SESSION["firstName"]." ".$_SESSION["lastName"]?></div>
        </div>

        <?php
        $sql = "SELECT * FROM Users Where UserId='$UserId'";
        $result = $conn->query($sql);
        $user = $result->fetch_assoc();
        ?>

        <div id="postsNum">Posts <?php echo $user["Posts"]?></div>
        <div id="FollowingNum">Following  <?php echo $user["Following"]?></div>
        <div id="followersNum">Followers  <?php echo $user["Followers"]?></div>
    </div>
</div>
<div id="container">
    <div id="timeline">

        <?php
        $sql = "SELECT * FROM HashTags INNER JOIN Posts ON Posts.PostId=HashTags.Post 
                INNER JOIN Users On Posts.UserId=Users.UserId WHERE HashTags.Hashtag='$Hashtag'";
        $_GET["sql"]=$sql;
        include "php/posts.php";
        ?>

    </div>
</div>

<script src="js/features.js"></script>
<script src="js/load.js"></script>
<script src="js/hashtag.js"></script> <!--https://markjs.io/-->
</body>
</html>

