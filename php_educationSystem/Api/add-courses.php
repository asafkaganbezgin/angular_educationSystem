<?php include "../settings.php";

/* In order to work with the data gathered from angular, the json file
    sent from angular should be decoded. The following two lines are
    responsible for handling that issue. */
$postData = file_get_contents("php://input");
$request = json_decode($postData);

/* Id of the logged in user sent from angular. Stored in a variable. */
$loggedInID = $connection->real_escape_string(trim($request->id));

/* Storing the courses array sent from angular which are going to be the courses
    to be deleted. */
$coursesToBeAdded = $request->courses;

/* array length of the courses which are going to be added. */
$numberOfCourses = count($coursesToBeAdded);

if($numberOfCourses != 0)
{
    for($i = 0 ; $i < $numberOfCourses ; $i++)
    {
        $data = $connection->query("INSERT INTO `users-lectures`(user_id, code) 
                                            VALUES ($loggedInID, '$coursesToBeAdded[$i]')");
    }
}

if($connection->affected_rows > 0)
{
    echo json_encode(array("message" => 'success'));
}

?>
