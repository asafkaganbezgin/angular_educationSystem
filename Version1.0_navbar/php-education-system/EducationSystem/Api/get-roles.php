<?php include "../settings.php";

/* In order to work with the data gathered from angular, the json file
    sent from angular should be decoded. The following two lines are
    responsible for handling that issue. */
$postData = file_get_contents("php://input");
$request = json_decode($postData);

/* The following two lines are responsible for getting the specific parts
    of the json decoding and storing them in separate php variables. */
$loggedID = $connection->real_escape_string(trim($request->id));
$loggedGroup = $connection->real_escape_string(trim($request->group));

/* Using the $loggedID variable to find the role number of the logged in user. */
$data = $connection->query("SELECT number FROM `groups` WHERE user_id = $loggedID");
$loggedGroupNumberRow = mysqli_fetch_array($data);
$loggedInGroupNumber = $loggedGroupNumberRow['number'];

/* Finding the row number of the roles table corresponding to the
    number of the logged in user. */
$data = $connection->query("SELECT role FROM roles WHERE number = $loggedInGroupNumber");

/* Roles array to be filled. */
$roleArray = array();

/* The maximum row number retrieved from the query. */
$maxRows = $data->num_rows;

/* Iterating through the rows retrieved and storing them in the array. */
for($i = 0 ; $i < $maxRows ; $i++)
{
    $data = $connection->query("SELECT role FROM roles WHERE number = $loggedInGroupNumber LIMIT $i, 1");
    $userRoleRow = mysqli_fetch_array($data);
    $userRole = $userRoleRow['role'];
    $roleArray[$i] = $userRole;
}

/* JSON encoding the array. */
echo json_encode(['roles' => $roleArray]);

?>
