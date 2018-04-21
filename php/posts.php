<?php


$sql=$_GET["sql"];
$result = $conn->query($sql);

$posts="";

if ($result->num_rows > 0)
{
    while($row = $result->fetch_assoc())
    {
        $posts .= "<div class='post' id='p".$row["PostId"]."'value=".$row["PostId"] . ">
        <div class='bar'>
            <div class='imageHolder'>
                  <img class='timelineImage' src=".$row["ProfileImage"].">
            </div>
            <div class='user'>
                <div class='name'>" . $row["FirstName"] . " " . $row["LastName"] . "</div>
                <div class='date'>".$row["dateposted"]."</div>
            </div>
        </div>
        <div class='textHolder'>
               <div class='text' style='border: none'>".$row["Text"]."</div>
        </div>
        <div class='posImageContainer'>
            <img class='postImage' src=".$row["PostImage"].">
        </div>
        <div class='bottomBar'>";
        $postId=$row["PostId"];
        $userId=$row["UserId"];
        $sql = "SELECT * FROM Likes Where UserId='$userId'AND PostId='$postId'";
        $conn->query($sql);
        $result3 = $conn->query($sql);

        if ($result3->num_rows > 0)
        {
            $posts.="<button class='like' onclick='like(this)' value='".$row["PostId"]."'>Unlike</button>";
        }
        else
        {
            $posts.="<button class='like' onclick='like(this)' value='".$row["PostId"]."'>Like</button>";
        }

        $posts.="<div><div class='counters'>".$row["Comments"]." Comments</div>
                  <div class='counters'>".$row["Likes"]." Likes</div></div>
                  </div>
        <div class='commentContainer'>";
        $id = $row['PostId'];
        $sql = "SELECT * FROM Users INNER JOIN Comments ON Comments.User=Users.UserId Where Comments.PostId='$id'ORDER BY Comments.CommentId";
        $results2 = $conn->query($sql);
        if ($results2->num_rows > 0)
        {
            while ($row2 = $results2->fetch_assoc())
            {
                $posts.="<div class='comment' id='c".$row2["CommentId"]."'value=".$row2["CommentId"].">
                            <div class='imageHolder'>
                             <img class='timelineImage' src=".$row2["ProfileImage"].">
                             </div>
                            <div class='user'>
                                <div class='name'>".$row2["FirstName"]." ".$row2["LastName"]."</div>
                                <div class='date'>".$row2["dateposted"]."</div>
                            </div>
                            <div class='textHolder'>
                                <div class='text' style='border: none'>".$row2["comment"]."</div>
                            </div>
                        </div>";
            }
        }
        $posts.="</div><div class='editComment'>
            <div class='imageHolder'>
             <img class='timelineImage' src=".$_SESSION["image"].">
             </div>
            <div class='user'>
                <div class='name'>".$_SESSION["firstName"]." ".$_SESSION["lastName"]."</div>
            </div>
            <div class='textHolder'>
                <div class='text' contenteditable='true'></div>
                <button class='commentIt' onclick='comment(this.value)' value='p".$id."'>Comment</button>
            </div>
        </div>
    </div>";
    }
    echo $posts;
}