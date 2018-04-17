$("#postIt").click(function () {
    var settings = {
        async: false,
        crossDomain: true,
        data: {'text':$("#content").val()},
        url: 'php/addPosts.php',
        method: 'POST',

    };

    $.ajax(settings).done(function (response)
    {
        console.log(response);
        $("#timeline").append(response);

    });
});

function comment(id)
{
    var settings =
        {
            async: false,
            crossDomain: true,
            data:
                {
                    'postId':$("#"+id).attr("value"),
                    'comment':$("#"+id).children(".editComment").children(".textHolder").children(".text").val()
                },
            url: 'php/addComments.php',
            method: 'POST',

        }
    $.ajax(settings).done(function (response)
    {
        $("#"+id).children(".commentContainer").append(response);
    });
};
