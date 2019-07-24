<?php

include "../settings.php";

/* In order to work with the data gathered from angular, the json file
    sent from angular should be decoded. The following two lines are
    responsible for handling that issue. */
$postData = file_get_contents("php://input");
$request = json_decode($postData);

/* The following two lines are responsible for getting the specific parts
    of the json decoding and storing them in separate php variables. */
$mail = $connection->real_escape_string(trim($request->mail));
$password = $connection->real_escape_string(trim($request->pass));

$data = $connection->query("SELECT * FROM users WHERE email = '$mail' AND password = '$password'");

if ($data->num_rows > 0) {

    // Information of logged in user returned to angular side from users table.
    $data = $connection->query("SELECT * FROM users WHERE email = '$mail' AND password = '$password'");
    $userRow = mysqli_fetch_array($data);
    $id_loggedIn = $userRow['user_id'];
    $name_loggedIn = $userRow['name'];
    $surname_loggedIn = $userRow['surname'];

    /* user_id of the logged in user. Stored in a session variable in
        order to use it through out the project until the session
        is destroyed. */
    $_SESSION['loggedInId'] = $id_loggedIn;

    // Finding the role of the user. Student, Teaching assistant or instructor.
    $data = $connection->query("SELECT * FROM `groups` WHERE user_id = $id_loggedIn");
    $userRoleRow = mysqli_fetch_array($data);
    $role_loggedIn = $userRoleRow['type'];

    $userArray = array("id" => $id_loggedIn, "name" => $name_loggedIn, "surname" => $surname_loggedIn,
                        "email" => $mail, "password" => $password, "group" => $role_loggedIn);
    echo json_encode($userArray);
} else {
    echo null;
}

?>