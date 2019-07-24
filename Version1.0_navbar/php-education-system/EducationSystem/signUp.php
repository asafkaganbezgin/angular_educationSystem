<?php include('settings.php');

if(isset($_SESSION['studentNumber']))
{
    echo "user already logged in";
    header("location: http://localhost/StudentSystem/studentHome.php");
}
?>

<html lang = "en-US">
<head>
    <title>Sign Up</title>
    <link rel = "stylesheet" type = "text/css" href = "css/signUp.css">
    <script src = "https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
        $(function()
        {
            $("#sign").click(function()
            {
                let name = $('#name').val();
                let surname = $('#surname').val();
                let number = $('#studentNumber').val();
                let pass = $('#studentPassword').val();
                let mail = $('#email').val();

                if(name === "" || typeof name === "undefined")
                    alert("Please enter your name");
                else if(surname === "" || typeof surname === "undefined")
                    alert("Please enter your surname");
                else if(number === "" || typeof number === "undefined")
                    alert("Please enter your number");
                else if(pass === "" || typeof pass === "undefined")
                    alert("Please enter your password");
                else if(mail === "" || typeof mail === "undefined")
                    alert("Please enter your mail address");
                else {
                    $.ajax(
                    {
                        url: "http://localhost/StudentSystem/doSignUp.php",
                        method: "POST",
                        data: {
                            studentNamePHP: name,
                            studentSurnamePHP: surname,
                            studentNumberPHP: number,
                            studentPasswordPHP: pass,
                            studentMailPHP: mail
                        },

                        success: function(response)
                        {
                            if(response === "success")
                                location.href = "studentHome.php";
                            if(response === "failed")
                                alert("Email already exits");
                        },

                        error: function(err) {}
                    });
                }
            })
        })
    </script>
</head>
<body>
<div class = "signupbox">
    <h1>Student | Sign Up</h1>
    <form method = "POST" action = "doSignUp.php">
        <img src = "assets/user_laptop.png" class = "avatar">
        <p>Name</p>
        <input type = "text" name = "" placeholder = "Enter name" id = "name">
        <p>Surname</p>
        <input type = "text" name = "" placeholder = "Enter surname" id = "surname">
        <p>Student Number</p>
        <input type = "text" name = "" placeholder = "Enter Student Number" id = "studentNumber">
        <p>Password</p>
        <input type = "password" name = "" placeholder = "Enter Password" id = "studentPassword">
        <p>Email</p>
        <input type = "email" name = "" placeholder = "Enter Email Address" id = "email">
        <input type = "button" name = "" value = "Sign Up" id = "sign">
        <a href = login.php>Already have an account?</a><br>
    </form>
</div>
</body>
</html>
