<?php

session_start();
include "connectDB.php";

$UserId=$_SESSION["userId"];
$text=$_POST["text"];

if(!empty($_POST["text"]))
{
    $sql = "INSERT INTO Posts (UserId, Likes, Text) VALUES 
           ('$UserId',0, '$text')";
    $conn->query($sql);

    $id = $conn->insert_id;

    $post = "<div class='post' id='p" . $id . "'value=" . $id . ">
        <div class='bar'>
            <div class='imageHolder'></div>
            <div class='user'>
                <div class='name'>" . $_SESSION["firstName"] . " " . $_SESSION["lastName"] . "</div>
                <div class='date'>DateHolder</div>
            </div>
        </div>
        <div class='textHolder'>" . $text . "</div>
        <div class='bottomBar'>
            <button class='like' onclick='like(this)' value='" . $id . "'> Likes(0)</button>
            <div class='likeCounter'>0 Likes</div>
        </div>
         <div class='commentContainer'></div>
        <div class='editComment'>
            <div class='imageHolder'></div>
            <div class='user'>
                <div class='name'>" . $_SESSION["firstName"] . " " . $_SESSION["lastName"] . "</div>
            </div>
            <div class='textHolder'>
                <textarea class='text'></textarea>
                <button class='commentIt' onclick='comment(this.value)' value='p" . $id . "'>Comment</button>
            </div>
        </div>
    </div>";

    echo $post;
}