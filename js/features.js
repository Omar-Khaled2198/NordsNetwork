$("#postIt").click(function ()
{
    var formdata=new FormData();
    var text=$("#content").text();
    formdata.append("text",text);
    var imageLocation= $("#edit").children(".posImageContainer").children(".postImage").attr("src");
    formdata.append("image",imageLocation);
    var settings = {
        async: true,
        crossDomain: true,
        data: formdata,
        processData: false,
        contentType: false,
        url: 'php/addPosts.php',
        method: 'POST',
        beforeSend: function() {
            $('#loading').show();
        },

    };

    $.ajax(settings).done(function (response)
    {
        console.log(response);
        $('#loading').hide();
        $("#content").text("");
        $("#edit").children(".posImageContainer").children(".postImage").attr("src","");

    });
});

function updateProfileImage()
{
    $("#file").click();
    $('#file').change(function () {
        var image=$("#file").prop('files')[0];
        var formdata=new FormData();
        formdata.append("file",image);
        var settings = {
            async: true,
            crossDomain: true,
            data: formdata,
            processData: false,
            contentType: false,
            url: 'php/profileImage.php',
            method: 'POST',
            beforeSend: function() {
                $('#loading').show();
            },
        };
        $.ajax(settings).done(function (response)
        {
            $('#loading').hide();
            console.log(response);
            $("#pImage").attr("src",response);
        });
    })
}

function uploadImage()
{

    $("#file").click();
    $('#file').change(function () {
        var image=$("#file").prop('files')[0];
        var formdata=new FormData();
        formdata.append("file",image);
        var settings = {
            async: true,
            crossDomain: true,
            data: formdata,
            processData: false,
            contentType: false,
            url: 'php/uploadImage.php',
            method: 'POST',
            beforeSend: function() {
                $('#loading').show();
            },
        };
        $.ajax(settings).done(function (response)
        {
            $('#loading').hide();
            console.log(response);
            $("#edit").children(".posImageContainer").children(".postImage").attr("src",response);
        });
    })
}

function comment(id)
{

    var settings =
        {
            async: true,
            crossDomain: true,
            data:
                {
                    'postId':$("#"+id).attr("value"),
                    'comment':$("#"+id).children(".editComment").children(".textHolder").children(".text").text()
                },
            url: 'php/addComments.php',
            method: 'POST',
            beforeSend: function() {
                $('#loading').show();
            },

        }
    $.ajax(settings).done(function (response)
    {
        $('#loading').hide();
        console.log(response);
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

function follow(btn)
{
    var value;
    if(btn.innerHTML==="Follow+")
    {
        value=1;
        btn.innerHTML="Unfollow-";
    }
    else
    {
        value=-1;
        btn.innerHTML="Follow+";
    }
    var settings =
        {
            async: true,
            crossDomain: true,
            data:
                {
                    'UserId':btn.value,
                    'value':value
                },
            url: 'php/follow.php',
            method: 'POST',

        }
    $.ajax(settings).done(function (response)
    {
        console.log(response);
    });
}

