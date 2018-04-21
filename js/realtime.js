$(document).ready(function ()
{

    setInterval(function () {
        $.when(refreshPosts()).done(function () {
            refreshComments();
        })
    },5000);

});

function refreshPosts()
{
    console.log(1);
    var lastPost=-1;
    if($("#timeline").children().length>0)
        lastPost=$("#timeline").children().last().attr("value");
    var settings = {
        async: true,
        crossDomain: true,
        url: 'php/refreshPosts.php',
        data:{'lastPost':lastPost},
        method: 'post',
    }
    $.ajax(settings).done(function (response)
    {
        $("#timeline").append(response);
    });
}

function refreshComments()
{
    console.log(2);
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

            $("#"+id).children(".commentContainer").append(response);
        });
    });
}
