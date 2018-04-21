/*
$(document).ready(function ()
{
    $("#profileName").load("php/loadProfile.php",function ()
    {
        $("#edit").children('.bar').children('.user').children('.name').html($("#profileName").text());
    });

    var settings = {
        async: true,
        crossDomain: true,
        url: 'php/getPosts.php',
        data:{'option':0},
        method: 'post',
    }

    $.ajax(settings).done(function (response)
    {
        $("#timeline").html(response);
    },function () {
        setInterval(function () {
            $.when(refreshPosts()).done(function () {
               refreshComments();
            })
        },5000);
    });

});

function refreshPosts()
{
    var lastPost=-1;
    if($("#timeline").children().length>0)
         lastPost=$("#timeline").children().last().attr("value");
    var settings = {
        async: true,
        crossDomain: true,
        url: 'php/getPosts.php',
        data:{'option':1,'lastPost':lastPost},
        method: 'post',
    }
    //console.log($("#timeline").children().last().attr("value"));
    $.ajax(settings).done(function (response)
    {
        $("#timeline").append(response);
    });
}

function refreshComments()
{
    $(".post").each(function () {
        var id=$(this).attr("id");
        var lastComment=-1;
        if($(this).children(".commentContainer").children().length>0)
            lastComment=$("#"+id).children(".commentContainer").children().last().attr("value");
        var settings = {
            async: true,
            crossDomain: true,
            url: 'php/refreshComments.php',
            data: {
                'postId': $("#"+id).attr("value"),
                'lastComment':lastComment
            },
            method: 'post',
        }
        $.ajax(settings).done(function (response) {
            console.log(response);
            $("#"+id).children(".commentContainer").append(response);
        });
    });
}

$(".text").hashtagger({hashClass: "hashtag"});
*/
function go(user)
{
    var id=user.id;
    window.location="profile.php?userId="+id;
}

$(document).ready(function ()
{

    $("#home").click(function () {
        window.location="timeline.php";
    })

    $("#profile").click(function () {
        window.location="myprofile.php";
    })
});
