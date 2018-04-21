function go(user)
{
    var id=user.id;
    window.location="profile.php?userId="+id;
}

function hashtag(hashtag)
{
    var id=hashtag.id;
    window.location="hashtag.php?hashtag="+id;
}

$(document).ready(function ()
{
    $(".text").markRegExp(/([@]|[#])([a-z])\w+/gmi);
    $("#home").click(function () {
        window.location="timeline.php";
    })

    $("#profile").click(function () {
        window.location="myprofile.php";
    })
});
