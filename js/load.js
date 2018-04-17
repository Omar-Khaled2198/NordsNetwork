$(document).ready(function ()
{
    $("#name").load("php/loadProfile.php",function ()
    {
        $("#edit").children('.bar').children('.user').children('.name').html($("#name").text());
    });

    var settings = {
        async: true,
        crossDomain: true,
        url: 'php/getPosts.php',
        data:{'option':0},
        method: 'post',
    }

    /**After done from appending posts to timeline call function refresh every 3s**/
    $.ajax(settings).done(function (response)
    {
        $("#timeline").html(response);
    },function () {
        setInterval(function () {
            $.when(refreshPosts()).done(function () {
               refreshComments();
            })
        },4000);
    });

});

/**fuck this function **/
function refreshPosts()
{
    if($("#timeline").children().length>0) {
    var settings = {
        async: false,
        crossDomain: true,
        url: 'php/getPosts.php',
        data:{'option':1,'lastPost':$("#timeline").children().last().attr("value")},
        method: 'post',
    }
    //console.log($("#timeline").children().last().attr("value"));
    $.ajax(settings).done(function (response)
    {
        $("#timeline").append(response);
    })};
}

function refreshComments()
{
    $(".post").each(function () {
        if($(this).children(".commentContainer").children().length>0)
        {
            var id=$(this).attr("id");
            var settings = {
                async: false,
                crossDomain: true,
                url: 'php/refreshComments.php',
                data: {
                    'postId': $("#"+id).attr("value"),
                    'lastComment': $("#"+id).children(".commentContainer").children().last().attr("value")
                },
                method: 'post',
            }
            $.ajax(settings).done(function (response) {
                $("#"+id).children(".commentContainer").append(response);
            });
        }
    });
}