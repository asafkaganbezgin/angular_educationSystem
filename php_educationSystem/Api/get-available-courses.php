<?php include "../settings.php";

/* In order to work with the data gathered from angular, the json file
    sent from angular should be decoded. The following two lines are
    responsible for handling that issue. */
$postData = file_get_contents("php://input");
$request = json_decode($postData);

/* Id of the logged in user sent from angular. Stored in a variable. */
$loggedInID = $connection->real_escape_string(trim($request->id));

/* Stores the courses which are not currently taken from the student. */
$data = $connection->query("SELECT code FROM lectures WHERE code NOT IN(
                                    SELECT `users-lectures`.code FROM `users-lectures` WHERE user_id = $loggedInID)");

/* Number of rows returned from the query. */
$rowCount = $data->num_rows;
/* Array which is going to hold the courses available for a student. */
$coursesAvailable = array();

for($i = 0 ; $i < $rowCount ; $i++)
{
    /* Filling the $coursesAvailable array with the query result below. One row in each iteration.  */
    $data = $connection->query("SELECT code FROM lectures WHERE code NOT IN(
                                    SELECT `users-lectures`.code FROM `users-lectures` WHERE user_id = $loggedInID) LIMIT $i, 1");
    $coursesAvailableRow = mysqli_fetch_array($data);
    $coursesAvailable[$i] = $coursesAvailableRow['code'];
}

echo json_encode(array("courses" => $coursesAvailable));

?>
