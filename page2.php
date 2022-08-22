<?php

use function PHPSTORM_META\type;
// connecting to DB
$connect = mysqli_connect('localhost', 'root', '');
$select = mysqli_select_db($connect, "user");
$sql = "SELECT * FROM questions";
$check1 = mysqli_query($connect, $sql);

// creating counters
$totalcorrectanswer = 0;
$totalwronganswer = 0;
$totalSkipedquestion = 0;



if (isset($_POST['submit'])) {

    // finding total number of rows
    $rowcount = mysqli_num_rows($check1);

    // variable i help to count and collect marks
    $i = 1;


    while ($rows = mysqli_fetch_array($check1)) {



        if ((int)$rows['id'] == $i) {

            // radio option correctness checking
            $id = (int)$rows['id'];

            // radio option set or not checking
            if (isset($_POST['radioanswer' . $rows['id']])) {

                // option checking
                if ($_POST['radioanswer' . $rows['id']] == "option1") {

                    $query = "SELECT correctanswer,answer1 FROM questions WHERE id = $id";
                    $execute = mysqli_query($connect, $query);
                    while ($rowq = mysqli_fetch_array($execute)) {

                        if ($rows['correctanswer'] == $rows['answer1']) {

                            $totalcorrectanswer++;
                        } else {

                            $totalwronganswer++;
                        }
                    }
                } else if ($_POST['radioanswer' . $rows['id']] == "option2") {

                    $query = "SELECT correctanswer,answer2 FROM questions WHERE id = $id";
                    $execute = mysqli_query($connect, $query);
                    while ($rowq = mysqli_fetch_array($execute)) {

                        if ($rows['correctanswer'] == $rows['answer2']) {;
                            $totalcorrectanswer++;
                        } else {

                            $totalwronganswer++;
                        }
                    }
                } else if ($_POST['radioanswer' . $rows['id']] == "option3") {

                    $query = "SELECT correctanswer,answer3 FROM questions WHERE id = $id";
                    $execute = mysqli_query($connect, $query);
                    while ($rowq = mysqli_fetch_array($execute)) {

                        if ($rows['correctanswer'] == $rows['answer3']) {

                            $totalcorrectanswer++;
                        } else {

                            $totalwronganswer++;
                        }
                    }
                } else if ($_POST['radioanswer' . $rows['id']] == "option4") {

                    $query = "SELECT correctanswer,answer4 FROM questions WHERE id = $id";
                    $execute = mysqli_query($connect, $query);
                    while ($rowq = mysqli_fetch_array($execute)) {

                        if ($rows['correctanswer'] == $rows['answer4']) {

                            $totalcorrectanswer++;
                        } else {

                            $totalwronganswer++;
                        }
                    }
                } else {
                    // number of skiped question
                    $totalSkipedquestion++;
                }
            }
            // checking total question iteration
            if ($i == $rowcount) {
                echo "last";
                echo "Total Score: " . $totalcorrectanswer;
                echo "Total Wrong: " . $totalwronganswer;
                echo "Total Skkiped : " . $totalSkipedquestion;
                echo "<script>window.location.href='page3.php?totalscore=" . $totalcorrectanswer . "&totalwronganswer=" . $totalwronganswer . "&totalskipped=" . $totalSkipedquestion . "';</script>";
            }
            $i++;
        }
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous" />
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
    <title>Document</title>
</head>

<body>
    <center>
        <h1>Exam Time</h1>
        <p>tick on correct answer</p>
        <form action="#" method="POST">
            <?php
            while ($row = mysqli_fetch_array($check1)) {
                if (isset($row['id'])) {
                    echo "<p id='div2'>" . $row['id'] . "</p><p>" . $row['question'] . "</p>";
                    echo "<br><br>";
                    echo "<input type='radio' name='radioanswer" . $row['id'] . "' value='option1'>";
                    echo "<input type='text' name='option1' value=" . $row['answer1'] . " disabled>";
                    echo "<br>";
                    echo "<input type='radio' name='radioanswer" . $row['id'] . "' value='option2'>";
                    echo "<input type='text' name='option2' value=" . $row['answer2'] . " disabled>";
                    echo "<br>";
                    echo "<input type='radio' name='radioanswer" . $row['id'] . "' value='option3'>";
                    echo "<input type='text' name='option3' value=" . $row['answer3'] . " disabled>";
                    echo "<br>";
                    echo "<input type='radio' name='radioanswer" . $row['id'] . "' value='option4'>";
                    echo "<input type='text' name='option4' value=" . $row['answer4'] . " disabled>";
                    echo "<br><br>";
                }
            }
            echo "<input type='submit' name='submit'>";
            ?>

        </form>
    </center>
</body>

</html>