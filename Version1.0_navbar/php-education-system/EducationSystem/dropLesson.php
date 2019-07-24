<?php include('settings.php');

if(isset($_POST['lesson']))
{
    $number = $_SESSION['number'];
    $lesson = $connection->real_escape_string($_POST['lesson']);

    // deleting the selected lesson from the user
    $data = $connection->query("DELETE FROM grades WHERE code = '$lesson' AND user_id IN (
                                        SELECT user_id FROM users WHERE number = $number)");

    /* mysqli_affected_rows returns an integer value which indicates the affected rows in a database after
       update, delete and insert operations. If the number of affected rows is greater than zero meaning if
       delete operation is successful, return success to ajax success method in studentHome.php */
    if(mysqli_affected_rows($connection))
        exit("success");
    else
        exit("failed");
}
else
    exit("failed");

