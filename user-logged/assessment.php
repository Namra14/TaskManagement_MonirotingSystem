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



    <title>Assessment</title>


</head>

<body class="bg-custom-img">

    <?php include 'header.php'; ?>
    <br><br><br>
    <section class="my-5">
        <div class="container bg-light rounded-4 shadow-lg p-5 hidden">
            <h2 class="py-3" style="color: #2c3e50">Welcome <?php echo $row['fullname']; ?>!</h2>
            <?php if ($row['specialization'] == NULL) { ?>
                <p class="fs-4 py-3">
                    Before taking the assessment, knowing and following the instruction is a must for us to have the best result.<br><br>
                    Instructions: All specializations' assessment must be taken (sequential <span class="fw-semibold text-dark">amg, wmad, and smp</span>). <br>
                    Take your time answering every question and read it carefully. Be honest and Goodluck!
                </p>
                <div class="mt-4">
                    <a class="btn btn-primary btn-lg px-5" href="assessment-amg.php">Start Assessment</a>
                </div>
            <?php } else { ?>
                <p class="fs-3 text-center py-3">
                    You have completed the assessment exam once and are not able to attempt it again.
                </p>
                <div class="mt-4">
                    <a class="btn btn-primary btn-lg px-5" href="recommendations.php">Go Back</a>
                </div>
            <?php } ?>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MzjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="../js/index.js"></script>
    <script src="../js/app.js"></script>

</body>

</html>