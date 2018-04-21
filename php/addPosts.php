<?php

session_start();
include "connectDB.php";

if(isset($_SESSION["userId"])&&!empty($_SESSION["userId"]))
{

$UserId=$_SESSION["userId"];
$text=$_POST["text"];

    if(!empty($_POST["text"]))
    {
        $image="";

        if(!empty($_POST["image"]))
            $image=$_POST["image"];

        $sql = "INSERT INTO Posts (UserId, Likes, Text, Comments, PostImage) VALUES 
               ('$UserId',0, '$text', 0, '$image')";
        $conn->query($sql);

        $id = $conn->insert_id;

        $sql = "UPDATE Users SET Posts=Posts+1 WHERE UserId='$UserId'";
        $conn->query($sql);

        preg_match_all("/#(\w+)/", $_POST["text"], $m);
        if(sizeof($m[1])>0)
        {
            foreach ($m[1] as $match) {
                $keywords[] = $match;
            }


            for ($i=0;$i<sizeof($keywords);$i++)
            {
                $sql = "INSERT INTO HashTags (Hashtag, Post) VALUES 
               ('$keywords[$i]','$id')";
                $conn->query($sql);
            }
        }


        echo $image;

    }
}
