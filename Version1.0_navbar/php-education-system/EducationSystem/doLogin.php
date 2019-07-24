<?php include "settings.php";

if (isset($_POST['numberPHP']))
{
    $number = $connection->real_escape_string($_POST['numberPHP']);
    $password = $connection->real_escape_string($_POST['passwordPHP']);

    $data = $connection->query("SELECT user_id FROM users WHERE number = $number 
                                        AND password = $password");

    $userIdRow = mysqli_fetch_array($data);
    $userId = $userIdRow['user_id'];

    if ($data->num_rows > 0)
    {
        $_SESSION['number'] = $number;

        $data = $connection->query("SELECT type FROM `groups` WHERE user_id = $userId");
        $userTypeRow = mysqli_fetch_array($data);
        $userType = $userTypeRow['type'];

        $data = $connection->query("SELECT name FROM users WHERE number = $number");
        $nameRow = mysqli_fetch_array($data);
        $name = $nameRow['name'];

        $data = $connection->query("SELECT surname FROM users WHERE number = $number");
        $surnameRow = mysqli_fetch_array($data);
        $surname = $surnameRow['surname'];

        $_SESSION['name'] = $name;
        $_SESSION['surname'] = $surname;
        $_SESSION['userType'] = $userType;

        if($userType === 'Student')
            exit('student');
        else if($userType === 'Teaching Assistant')
            exit('ta');
        else if($userType === 'Instructor')
            exit('instructor');
    } else
        exit('failed');
} else {
    exit("doLogin.php");
}

?>