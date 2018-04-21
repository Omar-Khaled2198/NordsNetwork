$("#signIn").click(function ()
    {
        var flag=false;
        var email=$("#inEmail").val();
        var pass=$("#inPass").val();
        if(email==="")
        {
            $("#inEmail").val("").css('border-color', 'red');
            flag=true;
        }
        var pass=$("#inPass").val();
        if(pass==="")
        {
            $("#inPass").val("").css('border-color', 'red');
            flag=true;
        }
        if(flag==true)
            return;
        var settings = {
            async: true,
            crossDomain: true,
            data: {'email':email,'pass':pass},
            url: 'php/signIn.php',
            method: 'POST',

        }

        $.ajax(settings).done(function (response)
        {
            var jsonObj=JSON.parse(response);

            if(jsonObj["auth"]==="false")
            {
                $("#inEmail").val("").css('border-color', 'red');
                $("#inPass").val("").css('border-color', 'red');
            }
            else
                window.location="timeline.php";

        });
    });

$("#signUp").click(function ()
{
    var flag=false;
    var email=$("#email").val();
    if(email==="")
    {
        $("#email").val("").css('border-color', 'red');
        flag=true;
    }
    var pass=$("#pass").val();
    if(pass==="")
    {
        $("#pass").val("").css('border-color', 'red');
        flag=true;
    }
    var firstName=$("#firstName").val();
    if(firstName==="")
    {
        $("#firstName").val("").css('border-color', 'red');
        flag=true;
    }
    var lastName=$("#lastName").val();
    if(lastName==="")
    {
        $("#lastName").val("").css('border-color', 'red');
        flag=true;
    }
    if(flag==true)return;
    var settings = {
        async: true,
        crossDomain: true,
        data: {'email':email,'pass':pass,'firstName':firstName,'lastName':lastName},
        url: 'php/signUp.php',
        method: 'POST',

    }

    $.ajax(settings).done(function (response)
    {
        var jsonObj=JSON.parse(response);
        if(jsonObj["auth"]==="false")
        {
            $("#error").html("This email already Exists or Invalid Email!")
            $("#email").val("").css('border-color', 'red');
        }
        else
            window.location="timeline.php";
    });
});