$(document).ready(function ()
{
    $("#name").load("php/loadProfile.php",function ()
    {
        $("#edit").children('.bar').children('.user').children('.name').html($("#name").text());
    });

    $("#timeline").load("php/getPosts.php");
});

