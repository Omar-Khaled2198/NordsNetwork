<?php

session_start();
include "php/connectDB.php";
if(!isset($_SESSION["userId"])||empty($_SESSION["userId"]))
{
    header("Location: index.html");
    exit();
}
$UserId=$_GET["userId"];
$me=$_SESSION["userId"];
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
    <div id="profile"  class="barButton"><?php echo $_SESSION["firstName"]?></div>
    <div id="logOut" onclick="window.location='index.html'" class="barButton">Logout</div>

</div>
<div id="coverContainer">
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

        <div id="postsNum">Posts<br> <?php echo $user["Posts"]?></div>
        <div id="FollowingNum">Following<br>  <?php echo $user["Following"]?></div>
        <div id="followersNum">Followers<br>  <?php echo $user["Followers"]?></div>
    </div>
    <?php
      $sql = "Select * From Follow WHERE User='$UserId' AND Follower='$me'";
      $result=$conn->query($sql);
      if($result->num_rows>0)
          echo "<button id='follow' onclick='follow(this)' value='$UserId'>Unfollow-</button>";
      else
          echo "<button id='follow' onclick='follow(this)' value='$UserId'>Follow+</button>";
    ?>

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
<script src="js/hashtag.js"></script> <!--https://markjs.io/-->
</body>
</html>