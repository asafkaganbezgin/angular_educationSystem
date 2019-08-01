<?php include '../settings.php';

/* In order to work with the data gathered from angular, the json file
    sent from angular should be decoded. The following two lines are
    responsible for handling that issue. */
$postData = file_get_contents("php://input");
$request = json_decode($postData);

/* The following line is responsible for getting the specific parts
    of the json decoding and storing them in a php variable. */
$loggedID = $connection->real_escape_string(trim($request->id));

/* Getting the grades of the logged in user */
$data = $connection->query("SELECT * FROM grades WHERE user_id = $loggedID");
/* Number of rows of the query returned above */
$numberOfRows = $data->num_rows;

/* If there is no value to show, return null json. */
if($numberOfRows == 0) {
    $noValArr = array("data" => null);
    echo json_encode($noValArr);
} else {
    /* Grades array to be filled. */
    $gradesOfStudent = array();
    /* Variables returned to angular side. */
    $code = "";
    $mtAvg = 0;
    $quizAvg = 0;
    $final = 0;
    $participation = 0;
    $attendance = 0;
    $labAvg = 0;
    $project = 0;
    /* Filling the array. */
    for($i = 0 ; $i < $numberOfRows ; $i++)
    {
        /* Query to limit the rows by one and iterate through them. Look at the end -> (LIMIT $i, 1) */
        $data = $connection->query("SELECT * FROM grades WHERE user_id = $loggedID LIMIT $i, 1");
        /* Retrieving the number of columns to iterate the columns one by one. */
        $numberOfColumns = $data->field_count;
        /* fetched $data query to be able to focus on one field of the row. */
        $gradesRow = mysqli_fetch_array($data);

        /* Taking the grades(columns) of each lesson(rows) in each iteration of the for loop. */
        $grade = array("code" => $gradesRow['code'], "mtAvg" => $gradesRow['midterm_avg'],
            "quizAvg" => $gradesRow['quiz_avg'], "final" => $gradesRow['final'],
            "participation" => $gradesRow['participation'], "attendance" => $gradesRow['attendance'],
            "labAvg" => $gradesRow['lab_avg'], "project" => $gradesRow['project']);

        /* Storing the result arrays in general grade array. */
        $gradesOfStudent[$i] = $grade;
    }

    $resultArray = array("lesson" => $gradesOfStudent);

    echo json_encode($resultArray);
}

?>