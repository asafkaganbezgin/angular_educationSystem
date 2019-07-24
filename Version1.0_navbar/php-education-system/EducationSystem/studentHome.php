<?php
include "settings.php";
if(isset($_SESSION['number'])) {}
else
    echo "redirecting";
?>

<hmtl lang = "en-US">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Student Home</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel = "stylesheet" type = "text/css" href = "css/studentHome.css" >
        <link rel = "stylesheet" type = "text/css" href = "css/customSelect.css" >
        <script src = "https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script>

            // function() is required if <script> part is written before <head>
            $(function()
            {
                // log out function executed when logout button is clicked
                $("#logout").click(function () {
                    $.ajax(
                        {
                            url: "http://localhost/EducationSystem/doLogOut.php",
                            method: "POST",
                            data: {},

                            success: function (response) {
                                if (response === "success")
                                    location.href = "http://localhost/EducationSystem/login.php";
                            },
                            error: function (err) {
                            }
                        });
                })
            })
        </script>
    </head>
    <body>
        <header>
            <nav id = "nav" class = "nav">
                <userType class = "userType">
                    <!-- Taking the name and the user type of the logged in user from session variables -->
                    <?php
                    echo $_SESSION['name'];
                    echo " ";
                    echo $_SESSION['surname'];
                    echo "   |   ";
                    echo $_SESSION['userType'];
                    ?>
                </userType>
                <ul class = "menu">
                    <!-- navigation bar options for user type of student -->
                    <li rel = "registration" class = "notActive">Registration</li>
                    <li rel = "classes" class = "active">Classes</li>
                    <li rel = "grades" class = "notActive">Grades</li>
                </ul>
                <a class = "logOut" id = "logOut" href = "doLogOut.php">LogOut</a>
            </nav>

            <div class = "mainPanel">
                <!-- Content is displayed under navigation bar on mainPanel. -->
                <!-- Tab mentality is applied. Panel changes its content but the studentHome.php is never left. -->
                <div id = "registration" class = "panelItem panel">
                    <h1>Registration</h1>
                    <br>
                    <p>Select Course</p>
                    <div class = "register-left">
                        <div class = "custom-select" style = "width: 200px;">
                            <select id = "courseSelection">
                                <option value = "0">Select a course</option>
                                <?php
                                    $data = $connection->query("SELECT * FROM lectures");
                                    $lecturesNumRow = $data->num_rows;
                                    for($i = 0 ; $i < $lecturesNumRow; $i++): ?>
                                        <option value = "<?php echo ($i + 1)?>">
                                            <?php
                                                $data = $connection->query("SELECT code FROM lectures LIMIT $i, 1");
                                                $lecturesRow = mysqli_fetch_array($data);
                                                $lectures = $lecturesRow['code'];

                                                echo $lectures;
                                            ?>
                                        </option>
                                    <?php endfor;
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class = "register-right">
                        <div class = "courseSelected">
                            <table>
                                <tr>
                                    <th>Course</th>
                                    <th>Duration</th>
                                    <th>Add</th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div id = "classes" class = "panelItem panelActive">
                    <h1>The courses currently taken</h1>
                    <br>
                    <table>
                        <tr>
                            <th>Course Name</th>
                            <th>Duration</th>
                            <th>Drop</th>
                        </tr>
                        <?php
                            // detecting how many rows required to fill the table
                            $number = $_SESSION['number'];
                            $data = $connection->query("SELECT code FROM grades WHERE user_id IN (
                                                                    SELECT user_id FROM users WHERE number = $number)");
                            $tableRowNumber = $data->num_rows;

                            // if the student is taking any course
                            if($tableRowNumber > 0)
                            {
                                // creating rows in the table according to the number of rows retrieved from database.
                                for($i = 0 ; $i < $tableRowNumber ; $i++): ?>
                                    <tr>
                                        <td>
                                            <?php
                                            /*  LIMIT is used in order to decrease the number of retrieved columns
                                                to one. The reason is when the number of rows in a column is more
                                                than one, mysqli_fetch_array() method can't hold the second, third, ...
                                                rows. Than variable $i is used to increment as much as the loop iterates
                                                and finally ,1 is written to increment the number off rows one by one.
                                                Same method applied throughout the code. */
                                            $data = $connection->query("SELECT code FROM grades WHERE user_id IN (
                                                                                SELECT user_id FROM users WHERE number = 
                                                                                    $number) LIMIT $i, 1");
                                            $courseRow = mysqli_fetch_array($data);
                                            $courseName = $courseRow['code'];

                                                echo $courseName;
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $data = $connection->query("SELECT duration FROM lectures WHERE code IN (
                                                                                SELECT code FROM grades WHERE user_id IN (
                                                                                    SELECT user_id FROM users WHERE number =
                                                                                        $number)) LIMIT $i, 1");
                                            $durationRow = mysqli_fetch_array($data);
                                            $duration = $durationRow['duration'];

                                            echo $duration;
                                            ?>
                                        </td>
                                        <td>
                                            <input class = "dropButton" type = "image" id = "<?php
                                            $data = $connection->query("SELECT code FROM grades WHERE user_id IN (
                                                                                    SELECT user_id FROM users WHERE number = 
                                                                                        $number) LIMIT $i, 1");
                                            $courseRow = mysqli_fetch_array($data);
                                            $courseName = $courseRow['code'];
                                            echo $courseName;?>" src =
                                            "assets/cross-button-game-controller-pngrepo-com%20(1).png">
                                        </td>
                                    </tr>
                                <?php endfor;
                            }
                            else
                                echo "You are currently not enrolled to any course."
                        ?>
                    </table>
                </div>
                <div id = "grades" class = "panelItem panel">
                    <h1>Spring 2019</h1>
                    <br>
                    <table>
                        <tr>
                            <th>Course</th>
                            <th>Midterm Average</th>
                            <th>Quiz Average</th>
                            <th>Final</th>
                            <th>Participation</th>
                            <th>Attendance</th>
                            <th>Lab Average</th>
                            <th>Project</th>
                        </tr>
                        <?php
                            // detecting how many rows required to fill the table
                            $number = $_SESSION['number'];
                            $data = $connection->query("SELECT code FROM grades WHERE user_id IN (
                                                                SELECT user_id FROM users WHERE number = $number)");
                            $tableRowNumber = $data->num_rows;

                            // if the student is taking any course
                            if($tableRowNumber > 0) {

                                // creating rows in the table according to the number of rows retrieved from database.
                                for($i = 0; $i < $tableRowNumber; $i++): ?>
                                    <tr>
                                        <td>
                                            <?php
                                            /* LIMIT is used in order to decrease the number of retrieved rows
                                               to one. The reason is when the number of rows in a column is more
                                               than one, mysqli_fetch_array() method can't hold the second, third, ...
                                               rows. Than variable $i is used to increment as much as the loop iterates
                                               and finally ,1 is written to increment the number off rows one by one.
                                               Same method applied throughout the code. */
                                            $data = $connection->query("SELECT code FROM grades WHERE user_id IN (
                                                                                    SELECT user_id FROM users WHERE number = 
                                                                                        $number) LIMIT $i, 1");
                                            $courseRow = mysqli_fetch_array($data);
                                            $courseName = $courseRow['code'];

                                            echo $courseName;
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $data = $connection->query("SELECT midterm_avg FROM grades WHERE user_id IN (
                                                                                    SELECT user_id FROM users WHERE number = 
                                                                                        $number) LIMIT $i, 1");
                                            $midtermRow = mysqli_fetch_array($data);
                                            $midtermAvg = $midtermRow['midterm_avg'];

                                            echo $midtermAvg;
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $data = $connection->query("SELECT quiz_avg FROM grades WHERE user_id IN (
                                                                                    SELECT user_id FROM users WHERE number = 
                                                                                        $number) LIMIT $i, 1");
                                            $quizRow = mysqli_fetch_array($data);
                                            $quizAvg = $quizRow['quiz_avg'];

                                            echo $quizAvg;
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $data = $connection->query("SELECT final FROM grades WHERE user_id IN (
                                                                                    SELECT user_id FROM users WHERE number = 
                                                                                        $number) LIMIT $i, 1");
                                            $finalRow = mysqli_fetch_array($data);
                                            $finalAvg = $finalRow['final'];

                                            echo $finalAvg;
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $data = $connection->query("SELECT participation FROM grades WHERE user_id IN (
                                                                                    SELECT user_id FROM users WHERE number = 
                                                                                        $number) LIMIT $i, 1");
                                            $participationRow = mysqli_fetch_array($data);
                                            $participationAvg = $participationRow['participation'];

                                            echo $participationAvg;
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $data = $connection->query("SELECT attendance FROM grades WHERE user_id IN (
                                                                                    SELECT user_id FROM users WHERE number = 
                                                                                        $number) LIMIT $i, 1");
                                            $attendanceRow = mysqli_fetch_array($data);
                                            $attendanceAvg = $attendanceRow['attendance'];

                                            echo $attendanceAvg;
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $data = $connection->query("SELECT lab_avg FROM grades WHERE user_id IN (
                                                                                    SELECT user_id FROM users WHERE number = 
                                                                                        $number) LIMIT $i, 1");
                                            $labRow = mysqli_fetch_array($data);
                                            $labAvg = $labRow['lab_avg'];

                                            echo $labAvg;
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $data = $connection->query("SELECT project FROM grades WHERE user_id IN (
                                                                                    SELECT user_id FROM users WHERE number = 
                                                                                        $number) LIMIT $i, 1");
                                            $projectRow = mysqli_fetch_array($data);
                                            $projectAvg = $projectRow['project'];

                                            echo $projectAvg;
                                            ?>
                                        </td>
                                    </tr>
                                <?php endfor;
                            }
                            else
                                echo "You are currently not taking any courses."
                        ?>
                    </table>
                </div>
            </div>
        </header>

        <script>

            // shows classes panel and hides the remaining ones.
            $('.mainPanel .panel').hide();

            // navigation bar events
            $('.nav .menu li').on('click', function() {

                /* highlighting the menu button which is clicked,
                   the classes button is highlighted at landing. */
                $('.nav .menu li').removeClass('active');
                $(this).addClass('active').removeClass('notActive');

                /* showing the content which is selected from the menu and
                   hiding the remaining ones. Classes panel is the landing panel. */
                let panelToShow = $(this).attr('rel');
                $('.mainPanel .panel').hide();
                $('.mainPanel .panelActive').removeClass('panelActive').addClass('panel');
                $('#' + panelToShow).addClass('panelActive').removeClass('panel');
                $('.mainPanel .panel').hide();
                $('.mainPanel .panelActive').show();
            })

            // classes panel delete button functionality
            $('.mainPanel .dropButton').on('click', function () {
                let closest = $(this);
                let buttonPressed = $(this).attr('id');
                if(confirm("Are you sure to drop " + buttonPressed + "?"))
                {
                    $.ajax(
                    {
                        url: "http://localhost/EducationSystem/dropLesson.php",
                        method: "POST",
                        data: {
                            lesson: buttonPressed
                        },

                        success: function(response)
                        {
                            if(response === "success")
                            {
                                alert(buttonPressed + " dropped.");
                                closest.closest('tr').remove();
                                //location.href = "studentHome.php";
                            }

                            if(response === "failed")
                                alert("Couldn't drop " + buttonPressed);
                        },

                        error: function(err){}
                    });
                }
            })

        </script>

        <!-- JavaScript code for select tag when selecting courses to add on registration panel -->
        <script src = "JavaScript/customSelect.js"></script>

    </body>
</hmtl>

