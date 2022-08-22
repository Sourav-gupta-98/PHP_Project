<?php

// creating variables for alert
$error1 = "";
$error2 = "";
$error3 = "";
$msg = "";
$correctAnswer = "";

// check form submit or not
if (isset($_POST['submit'])) {
    // geting values from user
    $question = $_POST['question'];
    $option1 = $_POST['option1'];
    $option2 = $_POST['option2'];
    $option3 = $_POST['option3'];
    $option4 = $_POST['option4'];
    // validating user input
    if ($question == "" || $option1 == "" || $option2 == "" || $option3 == "" || $option4 == "") {
        $error1 = "ERROR: All fields are required!";
        echo $error1;
    }


    // validating user radio button input
    if (isset($_POST['answer'])) {
        if ($_POST['answer'] == 'option1') {
            $correctAnswer = $_POST['option1'];
        } else if ($_POST['answer'] == 'option2') {
            $correctAnswer = $_POST['option2'];
        } else if ($_POST['answer'] == 'option3') {
            $correctAnswer = $_POST['option3'];
        } else if ($_POST['answer'] == 'option4') {
            $correctAnswer = $_POST['option4'];
        }
    } else {
        $error2 = "Please Submit with correct answer.";
        echo $error2;
    }
    // validating and connecting to DB
    if ($question == "" || $option1 == "" || $option2 == "" || $option3 == "" || $option4 == "" || !(isset($_POST['answer']))) {
    } else {
        $connect = mysqli_connect('localhost', 'root', '');
        $select = mysqli_select_db($connect, "user");

        $query = "INSERT INTO questions (question,answer1,answer2,answer3,answer4,correctanswer) VALUES ('" . $question . "', '" . $option1 . "', '" . $option2 . "','" . $option3 . "','" . $option4 . "','" . $correctAnswer . "' ) ";
        // inserting user valid details
        $execute = mysqli_query($connect, $query);

        if ($execute) {
            $msg = "SUBMITTED SUCCESSFULLY!";
            echo $msg;
            echo "<script>window.location.href='page1.php';</script>";
        } else {
            $error3 = "Question not submited successfully...";
            echo $error3;
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
    <title>PAGE1</title>
</head>

<body>
    <center>
        <h1>Create your own question</h1>
        <p>tick on correct answer</p>
        <div id="erro1"><?php $error1 ?> </div>
        <div id="erro2"><?php $error2 ?> </div>
        <div id="erro3"><?php $error3 ?> </div>
        <div id="msg"><?php $msg ?> </div>
        <form action="#" method="POST">
            <input id="question" class="question" name="question" type="text" value="" placeholder="question">
            <br><br>
            <input type="radio" name="answer" value="option1">
            <input id="option1" class="option_1" name="option1" type="text" value="" placeholder="option1">
            <br>
            <input type="radio" name="answer" value="option2">
            <input id="option2" class="option_2" name="option2" type="text" value="" placeholder="option2">
            <br>
            <input type="radio" name="answer" value="option3">
            <input id="option3" class="option_3" name="option3" type="text" value="" placeholder="option3">
            <br>
            <input type="radio" name="answer" value="option4">
            <input id="option4" class="option_4" name="option4" type="text" value="" placeholder="option4">
            <br><br>
            <input type="submit" onclick="verifyInput()" name="submit">
            <br><br>
            <a class="btn btn-info" href="index.html">Main Menu</a>

        </form>
    </center>
</body>


</html>