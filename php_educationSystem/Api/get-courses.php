<?php include "../settings.php";

/* In order to work with the data gathered from angular, the json file
    sent from angular should be decoded. The following two lines are
    responsible for handling that issue. */
$postData = file_get_contents("php://input");
$request = json_decode($postData);

/* The following line is responsible for getting the specific parts
    of the json decoding and storing them in a php variable. */
$loggedID = $connection->real_escape_string(trim($request->id));

/* Getting the courses which the student takes. */
$data = $connection->query("SELECT * FROM `users-lectures` WHERE user_id = $loggedID");
/* Number of rows of the query returned. */
$numberOfRows = $data->num_rows;

/* If there is no value to show, return null json. */
if($numberOfRows == 0) {
    $noValArr = array("data" => null);
    echo json_encode($noValArr);
} else {
    /* Courses array to be filled. */
    $coursesOfStudent = array();
    /* Filling the array. */
    for($i = 0 ; $i < $numberOfRows ; $i++) {
        $data = $connection->query("SELECT code FROM `users-lectures` WHERE user_id = $loggedID LIMIT $i, 1");
        $userCourseRow = mysqli_fetch_array($data);
        $userCourse = $userCourseRow['code'];
        $coursesOfStudent[$i] = $userCourse;
    }
    /* JSON encoding the array and sending it to angular. */
    $resultArray = array("course" => $coursesOfStudent);
    echo json_encode($resultArray);
}

?>
