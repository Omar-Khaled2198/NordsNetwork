$("#postIt").click(function () {
    var settings = {
        async: true,
        crossDomain: true,
        data: {'text':$("#content").val()},
        url: 'php/addPosts.php',
        method: 'POST',

    };

    $.ajax(settings).done(function (response)
    {

    });
});


function comment(id)
{

    var settings =
        {
            async: true,
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

    });
};

function like(btn)
{

    var value;
    if(btn.innerHTML=="Like")
    {
        value=1;
        btn.innerHTML="Unlike";
    }
    else
    {
        value=-1;
        btn.innerHTML="Like";
    }
    var settings =
        {
            async: true,
            crossDomain: true,
            data:
                {
                    'postId':btn.value,
                    'value':value
                },
            url: 'php/likes.php',
            method: 'POST',

        }
    $.ajax(settings).done(function (response)
    {
        console.log(response);
    });
}
