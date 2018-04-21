<?php

$sql = "SELECT DISTINCT Hashtag FROM HashTags";
$result = $conn->query($sql);
if ($result->num_rows > 0)
{
    while ($data = $result->fetch_assoc())
    {
        echo '<div id='.$data["Hashtag"].' class="suggest" onclick="hashtag(this)" >
                    #'.$data["Hashtag"].'
              </div>';
    }
}