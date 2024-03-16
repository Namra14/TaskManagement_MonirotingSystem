<?php
error_reporting(0);
include "../include/config.php";

session_start();

$session_id = $_SESSION['id'];
if (!isset($_SESSION['id']) || (trim($_SESSION['id']) == '')) {
    header('location:../user-login.php');
    $_SESSION['message'] = "<script>alert('Please Login!')</script>";
    exit();
}
$query = mysqli_query($conn, "SELECT * FROM `students_acc` 
		WHERE userid='" . $_SESSION['id'] . "'");
$row = mysqli_fetch_assoc($query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!--Fonts-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kdam+Thmor+Pro&family=Lato:wght@400;700;900&family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--Main Css-->
    <link rel="stylesheet" href="../css/style.css">



    <title>SMP Assessment</title>


</head>

<body>

    <?php include 'header.php'; ?>

    <section class="container mt-5">
        <div class="container bg-custom-color rounded-4 p-4 text-light shadow">
            <div class="row">
                <div class="col-md-4">
                    <h1 class="display-3 fw-semibold">Instruction</h1>
                </div>
                <div class="col-md-8">
                    <p class="lead">
                        Welcome to the specialization recommendation quiz. Please answer the following multiple-choice 
                        questions honestly to receive a suitable recommendation.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="container my-4">
        <div class="container bg-secondary-subtle rouded-4 p-5 text-dark rounded-4 shadow">
            <div class="row gx-0">
                <div class="col-md-1 d-none d-md-block">
                    <span class="badge rounded-pill border border-light bg-success-subtle px-3 py-2 text-success">Quiz 1</span>
                </div>
                <div class="col-md-1 d-none d-md-block">
                    <span class="badge rounded-pill border border-light bg-success-subtle px-3 py-2 text-success">Quiz 2</span>
                </div>
                <div class="col-md-1 d-none d-md-block">
                    <span class="badge rounded-pill border border-light bg-custom-color2 px-3 py-2 custom-text-color">Quiz 3</span>
                </div>
            </div>

            <div class="my-4">
                <h5 class="fw-semibold">Category: <span>Service Management Program</span></h5>
            </div>


            <div class="container px-3">

                <?php

                $sql = "SELECT * FROM `questions` WHERE specialization='SMP'";
                $result = mysqli_query($conn, $sql);

                $questions = array();

                while ($row = mysqli_fetch_assoc($result)) {
                    $questions[] = $row;
                }

                shuffle($questions);

                echo '<form action="assessment-smp.php#divOne" method="post" enctype="multipart/form-data">';

                foreach ($questions as $question) {
                    echo '<div class="my-4">';
                        echo '<p class="lead questions fw-semibold">' . $question['question'] . '</p>';
                        echo '<div class="container bg-secondary-subtle shadow-sm rounded p-3">';
                            echo '<div class="row">';
                                echo '<div class="col-md-6">';
                                    echo '<input type="radio" class="form-check-input fs-5" name="question_' . $question['id'] . '" value="option_a" required> ' . '<span class="choices text-dark">' . $question['option_a'] . '</span>' . '<br>';
                                    echo '<input type="radio" class="form-check-input fs-5" name="question_' . $question['id'] . '" value="option_b" required> ' . '<span class="choices text-dark">' . $question['option_b'] . '</span>' . '<br>';
                                echo '</div>';

                                echo '<div class="col-md-6">';
                                    echo '<input type="radio" class="form-check-input fs-5" name="question_' . $question['id'] . '" value="option_c" required> ' . '<span class="choices text-dark">' . $question['option_c'] . '</span>' . '<br>';
                                    echo '<input type="radio" class="form-check-input fs-5" name="question_' . $question['id'] . '" value="option_d" required> ' . '<span class="choices text-dark">' . $question['option_d'] . '</span>' . '<br>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div><br>';
                }

                echo '<input type="submit" class="btn btn-primary rounded-3 float-end" id="assess-btn" value="Submit">';
                echo '</form>';

                ?>


                <?php

                // Initialize the score to 0
                $smp_score = 0;

                // Loop through the questions and check the user's answers
                foreach ($questions as $question) {
                    $answer = $_POST['question_' . $question['id']];
                    if ($answer == $question['answer']) {
                        $smp_score++;
                    }
                }

                $grade = $smp_score;

                $insert_query = "UPDATE `students_acc` SET smp_score = '$grade' WHERE userid = $session_id" or die("Query Failed");
                if (mysqli_query($conn, $insert_query)) {

                    $message[] = 'Insert Successful';
                }

                // Calculate the percentage score
                $percentage = ($smp_score / count($questions)) * 100;

                ?>


                <div class="container-fluid overlay" id="divOne">>
                    <div class="modal-content">
                        <h4>Congratulations!</h4>
                        <hr>
                        <p class="lead">
                            Thank you for taking the SMP assessment. This assessment will help you to determine whether a specialization
                            in Service Management Program is the right fit for you. We hope that this assessment will be a useful tool
                            in your journey towards choosing the right specialization and achieving success in your career. Please click
                            the button to check the results of your assessment, thank you!
                        </p>
                        <hr>
                        <a class="btn btn-primary" href="profile.php">Proceed</a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MzjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="../js/index.js"></script>
    <script src="../js/app.js"></script>

</body>

</html>