<?php include 'settings.php';

if(isset($_POST['studentNumberPHP']))
{
    $studentName = $connection->real_escape_string($_POST['studentNamePHP']);
    $studentSurname = $connection->real_escape_string($_POST['studentSurnamePHP']);
    $studentNumber = $connection->real_escape_string($_POST['studentNumberPHP']);
    $studentPassword = $connection->real_escape_string($_POST['studentPasswordPHP']);
    $studentMail = $connection->real_escape_string($_POST['studentMailPHP']);

    $control = $connection->query("SELECT user_id FROM users WHERE email = '$studentMail'");

    if($control->num_rows > 0)
        echo("failed");
    else {
        $_SESSION['studentNumber'] = $studentNumber;
        $_SESSION['studentName'] = $studentName;
        $_SESSION['studentSurname'] = $studentSurname;

        $data = $connection->query("INSERT INTO users (name, surname, number, password, email) 
                        VALUES ('$studentName', '$studentSurname', $studentNumber, '$studentPassword', '$studentMail')");
        exit("success");
    }
} else
    exit("signUp exit");
?>
