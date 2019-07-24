<?php include('settings.php');

if(isset($_SESSION['number']))
{
    echo "user already logged in";
    header("location: http://localhost/EducationSystem/studentHome.php");
}
?>

<html lang = "en-US">
<head>
    <title>Login</title>
    <link rel = "stylesheet" type = "text/css" href = "css/login.css">
    <script src = "https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
        $(function() {
            $("#log").click(function()
            {
                let number = $('#number').val();
                let password = $('#password').val();

                if(number === "" || typeof number === "undefined")
                    alert("Please enter your student number!");
                // else if(number.isInteger(number))
                //     alert();
                else if(password === "" || typeof password === "undefined")
                    alert("Please enter your password");
                else {
                    $.ajax(
                    {
                        url: "http://localhost/EducationSystem/dologin.php",
                        method: "POST",
                        data: {
                            numberPHP: number,
                            passwordPHP: password
                        },

                        success: function(response)
                        {
                            if(response === "student")
                                location.href = "studentHome.php";
                            if(response === "ta")
                                location.href = "teachingAssistantHome.php";
                            if(response === "instructor")
                                location.href = "instructorHome.php";
                            if(response === "failed")
                                alert("Incorrect credentials");
                        },

                        error: function(err) {}
                    });
                }
            })
        });
    </script>
</head>
<body>
<div class = "loginbox">
    <h1>EducationSystem | Login</h1>
    <form method = "POST" action = "doLogin.php">
        <img src = "assets/user_laptop.png" class = "avatar">
        <p>User Number</p>
        <input type = "text" name = "number" placeholder = "Enter Your Number" id = "number">
        <p>Password</p>
        <input type = "password" name = "password" placeholder = "Enter Password" id = "password">
        <input type = "button" name = "loginButton" id = "log" value = "Login">
    </form>
</div>
</body>
</html>