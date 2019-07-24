<?php
include "settings.php";

unset($_SESSION["number"]);
unset($_SESSION["name"]);
unset($_SESSION["surname"]);
unset($_SESSION["userType"]);

session_destroy();

header("location: http://localhost/EducationSystem/login.php");

?>