<?php

include "../../include/config.php";

session_start();
$session_id = $_SESSION['id'];
if (!isset($_SESSION['id']) || (trim($_SESSION['id']) == '')) {
    header('location:../user-login.php');
    $_SESSION['message'] = "<script>alert('Please Login!')</script>";
    exit();
}
$query2 = mysqli_query($conn, "SELECT * FROM `students_acc` 
		WHERE userid='" . $_SESSION['id'] . "'");
$row = mysqli_fetch_assoc($query2);


require 'vendor/autoload.php';

use Rubix\ML\Datasets\Labeled;
use Rubix\ML\Classifiers\KNearestNeighbors;
use Rubix\ML\Datasets\Unlabeled;
use Rubix\ML\CrossValidation\HoldOut;
use Rubix\ML\CrossValidation\Metrics\Accuracy;
use League\Csv\Reader;

$ml_update_query = mysqli_query($conn, "SELECT * FROM `ml_feed_dataset` WHERE id='1'");
$update_row = mysqli_fetch_assoc($ml_update_query);
$dataset_name = $update_row['uploaded_dataset_name'];

$csv = Reader::createFromPath('dataset/'. $dataset_name , 'r');
$csv->setHeaderOffset(0);

$dataset = [];

foreach ($csv as $record) {
    // Assuming your CSV has columns named 'Feature1', 'Feature2', ... 'Label'
    $sample = array_slice($record, 0, -1); // Exclude the last column (label)
    $label = end($record); // Get the last column (label)

    $dataset['samples'][] = array_map('floatval', $sample);
    $dataset['labels'][] = $label;
}

$samples = $dataset['samples'];
$labels = $dataset['labels'];

$dataset = new Labeled($samples, $labels);

$estimator = new KNearestNeighbors(3);
$estimator->train($dataset);
#var_dump($estimator->trained());


//Unlabeled Sample for prediction
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process the form submission
    $u_samples = [
        [
            'ITEC102' => floatval($_POST['ITEC102']),
            'ITEC103' => floatval($_POST['ITEC103']),
            'ITEC205' => floatval($_POST['ITEC205']),
            'ITEL201' => floatval($_POST['ITEL201']),
            'ITEC204' => floatval($_POST['ITEC204']),
            'ITEP204' => floatval($_POST['ITEP204']),
            'GEC106' => floatval($_POST['GEC106']),
            'ITEP205' => floatval($_POST['ITEP205']),
            'ITEL203' => floatval($_POST['ITEL203']),
            'GEC108' => floatval($_POST['GEC108']),
            'ITEP203' => floatval($_POST['ITEP203']),
            'ITEP207' => floatval($_POST['ITEP207']),
        ],
    ];

    $u_dataset = new Unlabeled($u_samples);

    $estimator = new KNearestNeighbors(3);
    $estimator->train($dataset);

    $predictions = $estimator->predict($u_dataset);


    $itec102 = floatval($_POST['ITEC102']);
    $itec103 = floatval($_POST['ITEC103']);
    $itec205 = floatval($_POST['ITEC205']);
    $itel201 = floatval($_POST['ITEL201']);
    $itec204 = floatval($_POST['ITEC204']);
    $itep204 = floatval($_POST['ITEP204']);
    $gec106 = floatval($_POST['GEC106']);    
    $itep205 = floatval($_POST['ITEP205']);
    $itel203 = floatval($_POST['ITEL203']);
    $gec108 = floatval($_POST['GEC108']);    
    $itep203 = floatval($_POST['ITEP203']);
    $itep207 = floatval($_POST['ITEP207']);

    $update_query = mysqli_query($conn, " UPDATE `students_acc` 
                                                          SET 
                                                          itec102='$itec102', itec103='$itec103', itec205='$itec205', itel201='$itel201', 
                                                          itec204='$itec204', itep204='$itep204', gec106='$gec106', itep205='$itep205', 
                                                          itel203='$itel203', gec108='$gec108', itep203='$itep203', itep207='$itep207', 
                                                          grade_based='$predictions[0]' 
                                                          WHERE 
                                                          students_acc.userid='$session_id'");
    if ($update_query) {
        $_SESSION['message'] = "<script>alert('Database updated successfully!')</script>";
    } else  $_SESSION['message'] = "<script>alert('Database update failed!')</script>";
    
} else {
    // Initialize with default values
    $u_samples = [
        [
            'ITEC102' => 0,
            'ITEC103' => 0,
            'ITEC205' => 0,
            'ITEL201' => 0,
            'ITEC204' => 0,
            'ITEP204' => 0,
            'GEC106' => 0,
            'ITEP205' => 0,
            'ITEL203' => 0,
            'GEC108' => 0,
            'ITEP203' => 0,
            'ITEP207' => 0,
        ],
    ];
}


if (isset($_POST['submit'])) {

    
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
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
    <link rel="stylesheet" href="../../css/style.css">


    <title>Grade Based Recommendation</title>


</head>

<body class="bg-custom-img">

    <?php include 'include/header.php'; ?>

    <section class="container my-5">

        <h1 class="text-center pb-4 text-white">Grade-based Recommendation <br><span class="text-white fs-5">Generate Recommendation based on your grades</span></h1>

        <form method="post" class="form-control shadow-lg p-5" action="grade-based.php#divOne">
            <div class="row g-3 my-3 px-3">
                <h6 class="g-1 px-2 fs-4 fw-bold">Input Students Grades</h6>
                <div class="col-md-4">
                    <label for="ITEC102" class="my-3">Fundamentals of Programming:</label>
                    <select name="ITEC102" class="form-control">
                        <option label=" "></option>
                        <option value="1.00" <?php if ($u_samples[0]['ITEC102'] == 1.00) echo 'selected'; ?>>1.00</option>
                        <option value="1.25" <?php if ($u_samples[0]['ITEC102'] == 1.25) echo 'selected'; ?>>1.25</option>
                        <option value="1.50" <?php if ($u_samples[0]['ITEC102'] == 1.50) echo 'selected'; ?>>1.50</option>
                        <option value="1.75" <?php if ($u_samples[0]['ITEC102'] == 1.75) echo 'selected'; ?>>1.75</option>
                        <option value="2.00" <?php if ($u_samples[0]['ITEC102'] == 2.00) echo 'selected'; ?>>2.00</option>
                        <option value="2.25" <?php if ($u_samples[0]['ITEC102'] == 2.25) echo 'selected'; ?>>2.25</option>
                        <option value="2.50" <?php if ($u_samples[0]['ITEC102'] == 2.50) echo 'selected'; ?>>2.50</option>
                        <option value="2.75" <?php if ($u_samples[0]['ITEC102'] == 2.75) echo 'selected'; ?>>2.75</option>
                        <option value="3.00" <?php if ($u_samples[0]['ITEC102'] == 3.00) echo 'selected'; ?>>3.00</option>
                        <option value="4.00" <?php if ($u_samples[0]['ITEC102'] == 4.00) echo 'selected'; ?>>4.00</option>
                        <option value="5.00" <?php if ($u_samples[0]['ITEC102'] == 5.00) echo 'selected'; ?>>5.00</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="ITEC103" class="my-3">Intermediate Programming:</label>
                    <select name="ITEC103" class="form-control">
                        <option label=" "></option>
                        <option value="1.00" <?php if ($u_samples[0]['ITEC103'] == 1.00) echo 'selected'; ?>>1.00</option>
                        <option value="1.25" <?php if ($u_samples[0]['ITEC103'] == 1.25) echo 'selected'; ?>>1.25</option>
                        <option value="1.50" <?php if ($u_samples[0]['ITEC103'] == 1.50) echo 'selected'; ?>>1.50</option>
                        <option value="1.75" <?php if ($u_samples[0]['ITEC103'] == 1.75) echo 'selected'; ?>>1.75</option>
                        <option value="2.00" <?php if ($u_samples[0]['ITEC103'] == 2.00) echo 'selected'; ?>>2.00</option>
                        <option value="2.25" <?php if ($u_samples[0]['ITEC103'] == 2.25) echo 'selected'; ?>>2.25</option>
                        <option value="2.50" <?php if ($u_samples[0]['ITEC103'] == 2.50) echo 'selected'; ?>>2.50</option>
                        <option value="2.75" <?php if ($u_samples[0]['ITEC103'] == 2.75) echo 'selected'; ?>>2.75</option>
                        <option value="3.00" <?php if ($u_samples[0]['ITEC103'] == 3.00) echo 'selected'; ?>>3.00</option>
                        <option value="4.00" <?php if ($u_samples[0]['ITEC103'] == 4.00) echo 'selected'; ?>>4.00</option>
                        <option value="5.00" <?php if ($u_samples[0]['ITEC103'] == 5.00) echo 'selected'; ?>>5.00</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="ITEC205" class="my-3">Information Management:</label>
                    <select name="ITEC205" class="form-control">
                        <option label=" "></option>
                        <option value="1.00" <?php if ($u_samples[0]['ITEC205'] == 1.00) echo 'selected'; ?>>1.00</option>
                        <option value="1.25" <?php if ($u_samples[0]['ITEC205'] == 1.25) echo 'selected'; ?>>1.25</option>
                        <option value="1.50" <?php if ($u_samples[0]['ITEC205'] == 1.50) echo 'selected'; ?>>1.50</option>
                        <option value="1.75" <?php if ($u_samples[0]['ITEC205'] == 1.75) echo 'selected'; ?>>1.75</option>
                        <option value="2.00" <?php if ($u_samples[0]['ITEC205'] == 2.00) echo 'selected'; ?>>2.00</option>
                        <option value="2.25" <?php if ($u_samples[0]['ITEC205'] == 2.25) echo 'selected'; ?>>2.25</option>
                        <option value="2.50" <?php if ($u_samples[0]['ITEC205'] == 2.50) echo 'selected'; ?>>2.50</option>
                        <option value="2.75" <?php if ($u_samples[0]['ITEC205'] == 2.75) echo 'selected'; ?>>2.75</option>
                        <option value="3.00" <?php if ($u_samples[0]['ITEC205'] == 3.00) echo 'selected'; ?>>3.00</option>
                        <option value="4.00" <?php if ($u_samples[0]['ITEC205'] == 4.00) echo 'selected'; ?>>4.00</option>
                        <option value="5.00" <?php if ($u_samples[0]['ITEC205'] == 5.00) echo 'selected'; ?>>5.00</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="ITEL201" class="my-3">OOP:</label>
                    <select name="ITEL201" class="form-control">
                        <option label=" "></option>
                        <option value="1.00" <?php if ($u_samples[0]['ITEL201'] == 1.00) echo 'selected'; ?>>1.00</option>
                        <option value="1.25" <?php if ($u_samples[0]['ITEL201'] == 1.25) echo 'selected'; ?>>1.25</option>
                        <option value="1.50" <?php if ($u_samples[0]['ITEL201'] == 1.50) echo 'selected'; ?>>1.50</option>
                        <option value="1.75" <?php if ($u_samples[0]['ITEL201'] == 1.75) echo 'selected'; ?>>1.75</option>
                        <option value="2.00" <?php if ($u_samples[0]['ITEL201'] == 2.00) echo 'selected'; ?>>2.00</option>
                        <option value="2.25" <?php if ($u_samples[0]['ITEL201'] == 2.25) echo 'selected'; ?>>2.25</option>
                        <option value="2.50" <?php if ($u_samples[0]['ITEL201'] == 2.50) echo 'selected'; ?>>2.50</option>
                        <option value="2.75" <?php if ($u_samples[0]['ITEL201'] == 2.75) echo 'selected'; ?>>2.75</option>
                        <option value="3.00" <?php if ($u_samples[0]['ITEL201'] == 3.00) echo 'selected'; ?>>3.00</option>
                        <option value="4.00" <?php if ($u_samples[0]['ITEL201'] == 4.00) echo 'selected'; ?>>4.00</option>
                        <option value="5.00" <?php if ($u_samples[0]['ITEL201'] == 5.00) echo 'selected'; ?>>5.00</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="ITEC204" class="my-3">Data Structure and Algorithm:</label>
                    <select name="ITEC204" class="form-control">
                        <option label=" "></option>
                        <option value="1.00" <?php if ($u_samples[0]['ITEC204'] == 1.00) echo 'selected'; ?>>1.00</option>
                        <option value="1.25" <?php if ($u_samples[0]['ITEC204'] == 1.25) echo 'selected'; ?>>1.25</option>
                        <option value="1.50" <?php if ($u_samples[0]['ITEC204'] == 1.50) echo 'selected'; ?>>1.50</option>
                        <option value="1.75" <?php if ($u_samples[0]['ITEC204'] == 1.75) echo 'selected'; ?>>1.75</option>
                        <option value="2.00" <?php if ($u_samples[0]['ITEC204'] == 2.00) echo 'selected'; ?>>2.00</option>
                        <option value="2.25" <?php if ($u_samples[0]['ITEC204'] == 2.25) echo 'selected'; ?>>2.25</option>
                        <option value="2.50" <?php if ($u_samples[0]['ITEC204'] == 2.50) echo 'selected'; ?>>2.50</option>
                        <option value="2.75" <?php if ($u_samples[0]['ITEC204'] == 2.75) echo 'selected'; ?>>2.75</option>
                        <option value="3.00" <?php if ($u_samples[0]['ITEC204'] == 3.00) echo 'selected'; ?>>3.00</option>
                        <option value="4.00" <?php if ($u_samples[0]['ITEC204'] == 4.00) echo 'selected'; ?>>4.00</option>
                        <option value="5.00" <?php if ($u_samples[0]['ITEC204'] == 5.00) echo 'selected'; ?>>5.00</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="ITEP204" class="my-3">Advance Database Systems:</label>
                    <select name="ITEP204" class="form-control">
                        <option label=" "></option>
                        <option value="1.00" <?php if ($u_samples[0]['ITEP204'] == 1.00) echo 'selected'; ?>>1.00</option>
                        <option value="1.25" <?php if ($u_samples[0]['ITEP204'] == 1.25) echo 'selected'; ?>>1.25</option>
                        <option value="1.50" <?php if ($u_samples[0]['ITEP204'] == 1.50) echo 'selected'; ?>>1.50</option>
                        <option value="1.75" <?php if ($u_samples[0]['ITEP204'] == 1.75) echo 'selected'; ?>>1.75</option>
                        <option value="2.00" <?php if ($u_samples[0]['ITEP204'] == 2.00) echo 'selected'; ?>>2.00</option>
                        <option value="2.25" <?php if ($u_samples[0]['ITEP204'] == 2.25) echo 'selected'; ?>>2.25</option>
                        <option value="2.50" <?php if ($u_samples[0]['ITEP204'] == 2.50) echo 'selected'; ?>>2.50</option>
                        <option value="2.75" <?php if ($u_samples[0]['ITEP204'] == 2.75) echo 'selected'; ?>>2.75</option>
                        <option value="3.00" <?php if ($u_samples[0]['ITEP204'] == 3.00) echo 'selected'; ?>>3.00</option>
                        <option value="4.00" <?php if ($u_samples[0]['ITEP204'] == 4.00) echo 'selected'; ?>>4.00</option>
                        <option value="5.00" <?php if ($u_samples[0]['ITEP204'] == 5.00) echo 'selected'; ?>>5.00</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="GEC106" class="my-3">Art Appreciation:</label>
                    <select name="GEC106" class="form-control">
                        <option label=" "></option>
                        <option value="1.00" <?php if ($u_samples[0]['GEC106'] == 1.00) echo 'selected'; ?>>1.00</option>
                        <option value="1.25" <?php if ($u_samples[0]['GEC106'] == 1.25) echo 'selected'; ?>>1.25</option>
                        <option value="1.50" <?php if ($u_samples[0]['GEC106'] == 1.50) echo 'selected'; ?>>1.50</option>
                        <option value="1.75" <?php if ($u_samples[0]['GEC106'] == 1.75) echo 'selected'; ?>>1.75</option>
                        <option value="2.00" <?php if ($u_samples[0]['GEC106'] == 2.00) echo 'selected'; ?>>2.00</option>
                        <option value="2.25" <?php if ($u_samples[0]['GEC106'] == 2.25) echo 'selected'; ?>>2.25</option>
                        <option value="2.50" <?php if ($u_samples[0]['GEC106'] == 2.50) echo 'selected'; ?>>2.50</option>
                        <option value="2.75" <?php if ($u_samples[0]['GEC106'] == 2.75) echo 'selected'; ?>>2.75</option>
                        <option value="3.00" <?php if ($u_samples[0]['GEC106'] == 3.00) echo 'selected'; ?>>3.00</option>
                        <option value="4.00" <?php if ($u_samples[0]['GEC106'] == 4.00) echo 'selected'; ?>>4.00</option>
                        <option value="5.00" <?php if ($u_samples[0]['GEC106'] == 5.00) echo 'selected'; ?>>5.00</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="ITEP205" class="my-3">Multimedia Systems:</label>
                    <select name="ITEP205" class="form-control">
                        <option label=" "></option>
                        <option value="1.00" <?php if ($u_samples[0]['ITEP205'] == 1.00) echo 'selected'; ?>>1.00</option>
                        <option value="1.25" <?php if ($u_samples[0]['ITEP205'] == 1.25) echo 'selected'; ?>>1.25</option>
                        <option value="1.50" <?php if ($u_samples[0]['ITEP205'] == 1.50) echo 'selected'; ?>>1.50</option>
                        <option value="1.75" <?php if ($u_samples[0]['ITEP205'] == 1.75) echo 'selected'; ?>>1.75</option>
                        <option value="2.00" <?php if ($u_samples[0]['ITEP205'] == 2.00) echo 'selected'; ?>>2.00</option>
                        <option value="2.25" <?php if ($u_samples[0]['ITEP205'] == 2.25) echo 'selected'; ?>>2.25</option>
                        <option value="2.50" <?php if ($u_samples[0]['ITEP205'] == 2.50) echo 'selected'; ?>>2.50</option>
                        <option value="2.75" <?php if ($u_samples[0]['ITEP205'] == 2.75) echo 'selected'; ?>>2.75</option>
                        <option value="3.00" <?php if ($u_samples[0]['ITEP205'] == 3.00) echo 'selected'; ?>>3.00</option>
                        <option value="4.00" <?php if ($u_samples[0]['ITEP205'] == 4.00) echo 'selected'; ?>>4.00</option>
                        <option value="5.00" <?php if ($u_samples[0]['ITEP205'] == 5.00) echo 'selected'; ?>>5.00</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="ITEL203" class="my-3">Web Systems and Technologies:</label>
                    <select name="ITEL203" class="form-control">
                        <option label=" "></option>
                        <option value="1.00" <?php if ($u_samples[0]['ITEL203'] == 1.00) echo 'selected'; ?>>1.00</option>
                        <option value="1.25" <?php if ($u_samples[0]['ITEL203'] == 1.25) echo 'selected'; ?>>1.25</option>
                        <option value="1.50" <?php if ($u_samples[0]['ITEL203'] == 1.50) echo 'selected'; ?>>1.50</option>
                        <option value="1.75" <?php if ($u_samples[0]['ITEL203'] == 1.75) echo 'selected'; ?>>1.75</option>
                        <option value="2.00" <?php if ($u_samples[0]['ITEL203'] == 2.00) echo 'selected'; ?>>2.00</option>
                        <option value="2.25" <?php if ($u_samples[0]['ITEL203'] == 2.25) echo 'selected'; ?>>2.25</option>
                        <option value="2.50" <?php if ($u_samples[0]['ITEL203'] == 2.50) echo 'selected'; ?>>2.50</option>
                        <option value="2.75" <?php if ($u_samples[0]['ITEL203'] == 2.75) echo 'selected'; ?>>2.75</option>
                        <option value="3.00" <?php if ($u_samples[0]['ITEL203'] == 3.00) echo 'selected'; ?>>3.00</option>
                        <option value="4.00" <?php if ($u_samples[0]['ITEL203'] == 4.00) echo 'selected'; ?>>4.00</option>
                        <option value="5.00" <?php if ($u_samples[0]['ITEL203'] == 5.00) echo 'selected'; ?>>5.00</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="GEC108" class="my-3">Ethics:</label>
                    <select name="GEC108" class="form-control">
                        <option label=" "></option>
                        <option value="1.00" <?php if ($u_samples[0]['GEC108'] == 1.00) echo 'selected'; ?>>1.00</option>
                        <option value="1.25" <?php if ($u_samples[0]['GEC108'] == 1.25) echo 'selected'; ?>>1.25</option>
                        <option value="1.50" <?php if ($u_samples[0]['GEC108'] == 1.50) echo 'selected'; ?>>1.50</option>
                        <option value="1.75" <?php if ($u_samples[0]['GEC108'] == 1.75) echo 'selected'; ?>>1.75</option>
                        <option value="2.00" <?php if ($u_samples[0]['GEC108'] == 2.00) echo 'selected'; ?>>2.00</option>
                        <option value="2.25" <?php if ($u_samples[0]['GEC108'] == 2.25) echo 'selected'; ?>>2.25</option>
                        <option value="2.50" <?php if ($u_samples[0]['GEC108'] == 2.50) echo 'selected'; ?>>2.50</option>
                        <option value="2.75" <?php if ($u_samples[0]['GEC108'] == 2.75) echo 'selected'; ?>>2.75</option>
                        <option value="3.00" <?php if ($u_samples[0]['GEC108'] == 3.00) echo 'selected'; ?>>3.00</option>
                        <option value="4.00" <?php if ($u_samples[0]['GEC108'] == 4.00) echo 'selected'; ?>>4.00</option>
                        <option value="5.00" <?php if ($u_samples[0]['GEC108'] == 5.00) echo 'selected'; ?>>5.00</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="ITEP203" class="my-3" style="font-size: 15.4px;">Quantitative Methods Modeling and Simulation:</label>
                    <select name="ITEP203" class="form-control">
                        <option label=" "></option>
                        <option value="1.00" <?php if ($u_samples[0]['ITEP203'] == 1.00) echo 'selected'; ?>>1.00</option>
                        <option value="1.25" <?php if ($u_samples[0]['ITEP203'] == 1.25) echo 'selected'; ?>>1.25</option>
                        <option value="1.50" <?php if ($u_samples[0]['ITEP203'] == 1.50) echo 'selected'; ?>>1.50</option>
                        <option value="1.75" <?php if ($u_samples[0]['ITEP203'] == 1.75) echo 'selected'; ?>>1.75</option>
                        <option value="2.00" <?php if ($u_samples[0]['ITEP203'] == 2.00) echo 'selected'; ?>>2.00</option>
                        <option value="2.25" <?php if ($u_samples[0]['ITEP203'] == 2.25) echo 'selected'; ?>>2.25</option>
                        <option value="2.50" <?php if ($u_samples[0]['ITEP203'] == 2.50) echo 'selected'; ?>>2.50</option>
                        <option value="2.75" <?php if ($u_samples[0]['ITEP203'] == 2.75) echo 'selected'; ?>>2.75</option>
                        <option value="3.00" <?php if ($u_samples[0]['ITEP203'] == 3.00) echo 'selected'; ?>>3.00</option>
                        <option value="4.00" <?php if ($u_samples[0]['ITEP203'] == 4.00) echo 'selected'; ?>>4.00</option>
                        <option value="5.00" <?php if ($u_samples[0]['ITEP203'] == 5.00) echo 'selected'; ?>>5.00</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="ITEP207" class="my-3">Networking 1:</label>
                    <select name="ITEP207" class="form-control">
                        <option label=" "></option>
                        <option value="1.00" <?php if ($u_samples[0]['ITEP207'] == 1.00) echo 'selected'; ?>>1.00</option>
                        <option value="1.25" <?php if ($u_samples[0]['ITEP207'] == 1.25) echo 'selected'; ?>>1.25</option>
                        <option value="1.50" <?php if ($u_samples[0]['ITEP207'] == 1.50) echo 'selected'; ?>>1.50</option>
                        <option value="1.75" <?php if ($u_samples[0]['ITEP207'] == 1.75) echo 'selected'; ?>>1.75</option>
                        <option value="2.00" <?php if ($u_samples[0]['ITEP207'] == 2.00) echo 'selected'; ?>>2.00</option>
                        <option value="2.25" <?php if ($u_samples[0]['ITEP207'] == 2.25) echo 'selected'; ?>>2.25</option>
                        <option value="2.50" <?php if ($u_samples[0]['ITEP207'] == 2.50) echo 'selected'; ?>>2.50</option>
                        <option value="2.75" <?php if ($u_samples[0]['ITEP207'] == 2.75) echo 'selected'; ?>>2.75</option>
                        <option value="3.00" <?php if ($u_samples[0]['ITEP207'] == 3.00) echo 'selected'; ?>>3.00</option>
                        <option value="4.00" <?php if ($u_samples[0]['ITEP207'] == 4.00) echo 'selected'; ?>>4.00</option>
                        <option value="5.00" <?php if ($u_samples[0]['ITEP207'] == 5.00) echo 'selected'; ?>>5.00</option>
                    </select>
                </div>
            </div>
            <input type="submit" class="btn btn-primary m-3 w-25" value="SUBMIT" id="assess-btn">
        </form>
        <br><br><br>

        <div class="container-fluid overlay" id="divOne">
            <div class="modal-content">
                <h4>Congratulations!</h4>
                <hr>
                <?php if (isset($predictions)) : ?>
                    <div class="text-center my-5">
                        <h2 class="fs-3">Predicted Label:</h2>
                        <p class="fs-5">Congratulations! Your Grades are qualified for <span class="text-success fw-bold"><?php echo $predictions[0]; ?></span></p>
                    </div>

                <?php endif; ?>
                <hr>
                <a class="btn btn-primary" href="#">Close</a>
            </div>
        </div>
    </section>


    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MzjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="../js/index.js"></script>
    <script src="../js/app.js"></script>

    <script>
        // Function to check if all select elements have a selected value
        function checkForm() {
            var selects = document.querySelectorAll("select"); // Get all select elements
            var submitButton = document.getElementById("assess-btn"); // Get the submit button

            var allSelected = true; // Flag to check if all select elements have a value

            selects.forEach(function(select) {
                if (select.value === "") {
                    allSelected = false;
                }
            });

            // Enable or disable the submit button based on the flag
            if (allSelected) {
                submitButton.disabled = false;
            } else {
                submitButton.disabled = true;
            }
        }

        // Add onchange event listener to all select elements
        var selects = document.querySelectorAll("select");
        selects.forEach(function(select) {
            select.addEventListener("change", checkForm);
        });

        // Initially, call checkForm to set the initial state of the submit button
        checkForm();
    </script>


</body>

</html>