<?php
error_reporting(0);
include "../include/config.php";

session_start();

$session_id = $_SESSION['id'];
if (!isset($_SESSION['id']) || (trim($_SESSION['id']) == '')) {
    header('location:index.php');
    $_SESSION['message'] = "<script>alert('Please Login!')</script>";
    exit();
}

$query = mysqli_query($conn, "SELECT * FROM `students_acc` 
                                  WHERE userid='" . $_SESSION['id'] . "'");

$row = mysqli_fetch_assoc($query);


$school_id = $row['school_id'];
$fullname = $row['fullname'];
$year_lvl = $row['year_lvl'];
$dp_img = $row['dp_img'];
$wmad = $row['wmad_score'];
$amg = $row['amg_score'];
$smp = $row['smp_score'];
$specialization = $row['specialization'];
$grade_based = $row['grade_based'];
$preference_based  = $row['preference_based'];


if (isset($_POST['submitFinal'])) {
    $student_choice = $_POST['student_choice'];
    $finalization_date = $_POST['finalization_date'];

    if ($student_choice == $_POST['student_choice']) {
        mysqli_query($conn, "UPDATE `students_acc` SET student_choice='$student_choice', finalization_date='$finalization_date' WHERE students_acc.userid='$session_id'");
        $message = 'You have successfully chosen your desired specialization. Thanks for using our system!';
    } else {
        $message = 'Failed! Please try again..';
    }
}


//Update Profile
if (isset($_POST['submit'])) {

    //Update Personal Information
    $update_school_id = mysqli_real_escape_string($conn, $_POST['update_school_id']);
    $update_fullname = mysqli_real_escape_string($conn, $_POST['update_fullname']);
    $update_year_lvl = mysqli_real_escape_string($conn, $_POST['update_year_lvl']);

    mysqli_query($conn, "UPDATE `students_acc` SET school_id='$update_school_id', fullname='$update_fullname', year_lvl='$update_year_lvl' WHERE students_acc.userid='$session_id'")
        or die('query failed');

    //Update Password
    $new_pass = mysqli_real_escape_string($conn, md5($_POST['update_password']));
    $confirm_pass = mysqli_real_escape_string($conn, md5($_POST['update_cpassword']));

    if ($new_pass != $confirm_pass) {
        $message = 'Pasword not matched! Please try again..';
    } else {
        mysqli_query($conn, "UPDATE `students_acc` SET password = '$confirm_pass' WHERE students_acc.userid = '$session_id'") or die('query failed');
        $message = 'Profile Updated Successfully!';
    }

    //Update Profile Picture
    $update_image = $_FILES['update_image']['name'];
    $update_image_size = $_FILES['update_image']['size'];
    $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
    $update_image_folder = '../img/uploaded_img/' . $update_image;

    if (!empty($update_image)) {
        if ($update_image_size > 2000000) {
            $message[] = 'image is too large';
        } else {
            $image_update_query = mysqli_query($conn, "UPDATE `students_acc` SET dp_img = '$update_image' WHERE students_acc.userid = '$session_id'") or die('query failed');
            if ($image_update_query) {
                move_uploaded_file($update_image_tmp_name, $update_image_folder);
            }
        }
    }
}


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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <title>Profile</title>


    <style>
        /* Add your custom styles here */
        .nav-link.active {
            background-color: black;
            /* Change this to your desired background color */
            color: #FFFFFF;
            /* Change this to your desired text color */
            /* You can also add more styles as needed */
        }

        .modal-lg {
            max-width: 2280px;
        }
    </style>




</head>

<body class="bg-custom-img">

    <?php

    include 'header.php';

    ?>

    <!-- Profile Page -->
    <br><br>
    <section class="container my-5" id="profile-page">
        <div class="row mb-5">

            <div class="col-md-6 my-5" id="profile-details">
                <div class="card rounded-4 shadow-lg">
                    <div class="card-header text-center">

                        <?php
                        if ($row['dp_img'] == '') {
                            echo '<img class="img-fluid w-50 rounded-circle" src="../img/avatar/default-avatar.png">';
                        } else {
                            echo '<img class="img-fluid w-50 rounded-circle py-3" src="../img/uploaded_img/' . $row['dp_img'] . '">';
                        }
                        ?>

                    </div>
                    <div class="card-body">
                        <p class="my-1"><strong>Name:</strong> <?php echo $fullname; ?></p>
                        <p class="my-1"><strong class="pr-1">Profile ID:</strong><?php echo " " . $session_id; ?></p>
                    </div>
                    <hr style="margin-top: 1%;">

                    <!-- Tab navs -->
                    <div class="nav flex-column nav-pills text-center w-75 mx-auto my-2" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link custom-btn2" id="v-pills-link4-tab" data-mdb-toggle="pill" href="#v-pills-link4" role="tab" aria-controls="v-pills-link4" aria-selected="true">Edit Profile</a>
                        <a class="nav-link custom-btn2 active" id="v-pills-link1-tab" data-mdb-toggle="pill" href="#v-pills-link1" role="tab" aria-controls="v-pills-link1" aria-selected="true">Assessment Based Result</a>
                        <a class="nav-link custom-btn2" id="v-pills-link2-tab" data-mdb-toggle="pill" href="#v-pills-link2" role="tab" aria-controls="v-pills-link2" aria-selected="false">Grade Based Result</a>
                        <a class="nav-link custom-btn2" id="v-pills-link3-tab" data-mdb-toggle="pill" href="#v-pills-link3" role="tab" aria-controls="v-pills-link3" aria-selected="false">Preference Based Result</a>
                        <a class="nav-link custom-btn2 mb-3" id="v-pills-link5-tab" data-mdb-toggle="pill" href="#v-pills-link5" role="tab" aria-controls="v-pills-link5" aria-selected="false">Specialization Selection</a>
                    </div>
                    <!-- Tab navs -->

                </div>


            </div>

            <div class="col-md-9">
                <!-- Tab content -->
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-link1" role="tabpanel" aria-labelledby="v-pills-link1-tab">
                        <div class="card rounded-4 shadow-lg">
                            <div class="card-header bg-transparent border-1">
                                <h3 class="mt-3"><i class="far fa-clone"></i> General Information</h3>
                            </div>
                            <div class="card-body pt-0">
                                <table class="table table-bordered my-5">
                                    <tr>
                                        <th width="30%" class="fs-6">Student ID</th>
                                        <td width="2%">:</td>
                                        <td class="fs-6"><?php echo $school_id; ?></td>
                                    </tr>
                                    <tr>
                                        <th width="30%" class="fs-6">Year Level</th>
                                        <td width="2%">:</td>
                                        <td class="fs-6"><?php echo $year_lvl; ?></td>
                                    </tr>
                                </table>

                                <h3 style="text-align: left;"><i class="fa-solid fa-graduation-cap"></i> Assessment Grades</h3>
                                <table class="table table-bordered my-5">
                                    <tr>
                                        <th width="30%" class="fs-6">AMG Assessment</th>
                                        <td width="2%">:</td>
                                        <td class="fs-6"><?php echo isset($amg) ? $amg : 'N/A'; ?></td>
                                    </tr>
                                    <tr>
                                        <th width="30%" class="fs-6">WMAD Assessment</th>
                                        <td width="2%">:</td>
                                        <td class="fs-6"><?php echo isset($wmad) ? $wmad : 'N/A'; ?></td>
                                    </tr>
                                    <tr>
                                        <th width="30%" class="fs-6">SMP Assessment</th>
                                        <td width="2%">:</td>
                                        <td class="fs-6"><?php echo isset($smp) ? $smp : 'N/A'; ?></td>
                                    </tr>
                                </table>

                                <div class="">
                                    <div class="bg-transparent">
                                        <h3 class="mb-0"><i class="fa-solid fa-square-poll-vertical"></i></i> Assessment Recommendation</h3>
                                    </div>
                                    <div class="card-body pt-0">
                                        <?php

                                        echo "<h3 class='text-center fs-5 pt-4'>Based on your assessment, below are the following results.</h3>";

                                        if ($wmad > $smp && $wmad > $amg) {
                                            if ($smp == $amg) {
                                                echo '
                                                <div class="table-responsive">
                                                    <table class="table table-bordered my-4">
                                                        <tr>
                                                            <th width="30%" class="fs-6">First Recommendation</th>
                                                            <td width="2%">:</td>
                                                            <td class="fs-6">Web and Mobile Application Development (WMAD)</td>
                                                        </tr>
                                                        <tr>
                                                            <th width="30%" class="fs-6">Second Recommendation</th>
                                                            <td width="2%">:</td>
                                                            <td class="fs-6">Animation Motion Graphics (AMG) or Service Management Program (SMP)</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                ';
                                                mysqli_query($conn, "UPDATE `students_acc` 
                                                                    SET specialization='WMAD' WHERE students_acc.userid='$session_id'")
                                                    or die('Query Failed');
                                            } else if ($amg > $smp) {
                                                echo '
                                                <div class="table-responsive">
                                                    <table class="table table-bordered my-4">
                                                        <tr>
                                                            <th width="30%" class="fs-6">First Recommendation</th>
                                                            <td width="2%">:</td>
                                                            <td class="fs-6">Web and Mobile Application Development (WMAD)</td>
                                                        </tr>
                                                        <tr>
                                                            <th width="30%" class="fs-6">Second Recommendation</th>
                                                            <td width="2%">:</td>
                                                            <td class="fs-6">Animation Motion Graphics (AMG)</td>
                                                        </tr>
                                                        <tr>
                                                            <th width="30%" class="fs-6">Third Recommendation</th>
                                                            <td width="2%">:</td>
                                                            <td class="fs-6">Service Management Program (SMP)</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                ';
                                                mysqli_query($conn, "UPDATE `students_acc` 
                                                                    SET specialization='WMAD' WHERE students_acc.userid='$session_id'")
                                                    or die('Query Failed');
                                            } else {
                                                echo '
                                                <div class="table-responsive">
                                                    <table class="table table-bordered my-4">
                                                        <tr>
                                                            <th width="30%" class="fs-6">First Recommendation</th>
                                                            <td width="2%">:</td>
                                                            <td class="fs-6">Web and Mobile Application Development (WMAD)</td>
                                                        </tr>
                                                        <tr>
                                                            <th width="30%" class="fs-6">Second Recommendation</th>
                                                            <td width="2%">:</td>
                                                            <td class="fs-6">Service Management Program (SMP)</td>
                                                        </tr>
                                                        <tr>
                                                            <th width="30%" class="fs-6">Third Recommendation</th>
                                                            <td width="2%">:</td>
                                                            <td class="fs-6">Animation Motion Graphics (AMG)</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                ';
                                                mysqli_query($conn, "UPDATE `students_acc` 
                                                                    SET specialization='WMAD' WHERE students_acc.userid='$session_id'")
                                                    or die('Query Failed');
                                            }
                                        } elseif ($amg < $smp && $amg < $wmad) {
                                            if ($smp == $wmad) {
                                                echo '
                                                <div class="table-responsive">
                                                    <table class="table table-bordered my-4">
                                                        <tr>
                                                            <th width="30%" class="fs-6">First Recommendation</th>
                                                            <td width="2%">:</td>
                                                            <td class="fs-6">Web and Mobile Application Development (WMAD) or Service Management Program (SMP)</td>
                                                        </tr>
                                                        <tr>
                                                            <th width="30%" class="fs-6">Second Recommendation</th>
                                                            <td width="2%">:</td>
                                                            <td class="fs-6">Animation Motion Graphics (AMG)</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                ';
                                                mysqli_query($conn, "UPDATE `students_acc` 
                                                                    SET specialization='AMG' WHERE students_acc.userid='$session_id'")
                                                    or die('Query Failed');
                                            }
                                        } elseif ($smp > $wmad && $smp > $amg) {
                                            if ($wmad == $amg) {
                                                echo '
                                                <div class="table-responsive">
                                                    <table class="table table-bordered my-4">
                                                        <tr>
                                                            <th width="30%" class="fs-6">First Recommendation</th>
                                                            <td width="2%">:</td>
                                                            <td class="fs-6">Service Management Program (SMP)</td>
                                                        </tr>
                                                        <tr>
                                                            <th width="30%" class="fs-6">Second Recommendation</th>
                                                            <td width="2%">:</td>
                                                            <td class="fs-6">Web and Mobile Application Development (WMAD)</td>
                                                        </tr>
                                                        <tr>
                                                            <th width="30%" class="fs-6">Third Recommendation</th>
                                                            <td width="2%">:</td>
                                                            <td class="fs-6">Animation Motion Graphics (AMG)</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                ';
                                                mysqli_query($conn, "UPDATE `students_acc` 
                                                                    SET specialization='SMP' WHERE students_acc.userid='$session_id'")
                                                    or die('Query Failed');
                                            } elseif ($amg > $wmad) {
                                                echo '
                                                <div class="table-responsive">
                                                    <table class="table table-bordered my-4">
                                                        <tr>
                                                            <th width="30%" class="fs-6">First Recommendation</th>
                                                            <td width="2%">:</td>
                                                            <td class="fs-6">Service Management Program (SMP)</td>
                                                        </tr>
                                                        <tr>
                                                            <th width="30%" class="fs-6">Second Recommendation</th>
                                                            <td width="2%">:</td>
                                                            <td class="fs-6">Animation Motion Graphics (AMG)</td>
                                                        </tr>
                                                        <tr>
                                                            <th width="30%" class="fs-6">Third Recommendation</th>
                                                            <td width="2%">:</td>
                                                            <td class="fs-6">Web and Mobile Application Development (WMAD)</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                ';
                                                mysqli_query($conn, "UPDATE `students_acc` 
                                                                    SET specialization='SMP' WHERE students_acc.userid='$session_id'")
                                                    or die('Query Failed');
                                            } else {
                                                echo '
                                                <div class="table-responsive">
                                                    <table class="table table-bordered my-4">
                                                        <tr>
                                                            <th width="30%" class="fs-6">First Recommendation</th>
                                                            <td width="2%">:</td>
                                                            <td class="fs-6">Service Management Program (SMP)</td>
                                                        </tr>
                                                        <tr>
                                                            <th width="30%" class="fs-6">Second Recommendation</th>
                                                            <td width="2%">:</td>
                                                            <td class="fs-6">Web and Mobile Application Development (WMAD)</td>
                                                        </tr>
                                                        <tr>
                                                            <th width="30%" class="fs-6">Third Recommendation</th>
                                                            <td width="2%">:</td>
                                                            <td class="fs-6">Animation Motion Graphics (AMG)</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                ';
                                                mysqli_query($conn, "UPDATE `students_acc` 
                                                                    SET specialization='SMP' WHERE students_acc.userid='$session_id'")
                                                    or die('Query Failed');
                                            }
                                        } elseif ($amg > $smp && $amg > $wmad) {
                                            if ($smp > $wmad) {
                                                echo '
                                                <div class="table-responsive">
                                                    <table class="table table-bordered my-4">
                                                        <tr>
                                                            <th width="30%" class="fs-6">First Recommendation</th>
                                                            <td width="2%">:</td>
                                                            <td class="fs-6">Animation Motion Graphics (AMG)</td>
                                                        </tr>
                                                        <tr>
                                                            <th width="30%" class="fs-6">Second Recommendation</th>
                                                            <td width="2%">:</td>
                                                            <td class="fs-6">Service Management Program (SMP)</td>
                                                        </tr>
                                                        <tr>
                                                            <th width="30%" class="fs-6">Third Recommendation</th>
                                                            <td width="2%">:</td>
                                                            <td class="fs-6">Web and Mobile Application Development (WMAD)</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                ';
                                                mysqli_query($conn, "UPDATE `students_acc` 
                                                                    SET specialization='AMG' WHERE students_acc.userid='$session_id'")
                                                    or die('Query Failed');
                                            } else {
                                                echo '
                                                <div class="table-responsive">
                                                    <table class="table table-bordered my-4">
                                                        <tr>
                                                            <th width="30%" class="fs-6">First Recommendation</th>
                                                            <td width="2%">:</td>
                                                            <td class="fs-6">Animation Motion Graphics (AMG)</td>
                                                        </tr>
                                                        <tr>
                                                            <th width="30%" class="fs-6">Second Recommendation</th>
                                                            <td width="2%">:</td>
                                                            <td class="fs-6">Web and Mobile Application Development (WMAD)</td>
                                                        </tr>
                                                        <tr>
                                                            <th width="30%" class="fs-6">Third Recommendation</th>
                                                            <td width="2%">:</td>
                                                            <td class="fs-6">Service Management Program (SMP)</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                ';
                                                mysqli_query($conn, "UPDATE `students_acc` 
                                                                    SET specialization='AMG' WHERE students_acc.userid='$session_id'")
                                                    or die('Query Failed');
                                            }
                                        } elseif ($amg == $smp && $amg == $wmad) {
                                            if ($amg == 0 || $smp == 0 || $wmad == 0) {
                                                echo '
                                                <div class="table-responsive">
                                                    <table class="table table-bordered my-4">
                                                        <tr>
                                                            <th width="30%" class="fs-6">Result</th>
                                                            <td width="2%">:</td>
                                                            <td class="fs-6">Please Retake the assessment, Thank you.</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                ';
                                            } else {
                                                echo '
                                                <div class="table-responsive">
                                                    <table class="table table-bordered my-4">
                                                        <tr>
                                                            <th width="30%" class="fs-6">Recommendation</th>
                                                            <td width="2%">:</td>
                                                            <td class="fs-6">You are Suitable to any of the Specializations (WMAD, AMG, SMP)</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                ';
                                                mysqli_query($conn, "UPDATE `students_acc` 
                                                                    SET specialization='ALL' WHERE students_acc.userid='$session_id'")
                                                    or die('Query Failed');
                                            }
                                        } else {
                                            if ($smp > $wmad) {
                                                echo '
                                                <div class="table-responsive">
                                                    <table class="table table-bordered my-4">
                                                        <tr>
                                                            <th width="30%" class="fs-6">First Recommendation</th>
                                                            <td width="2%">:</td>
                                                            <td class="fs-6">Service Management Program (SMP) or Animation Motion Graphics (AMG)</td>
                                                        </tr>
                                                        <tr>
                                                            <th width="30%" class="fs-6">Second Recommendation</th>
                                                            <td width="2%">:</td>
                                                            <td class="fs-6">Web and Mobile Application Development (WMAD)</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                ';
                                                mysqli_query($conn, "UPDATE `students_acc` 
                                                                    SET specialization='SMP/AMG' WHERE students_acc.userid='$session_id'")
                                                    or die('Query Failed');
                                            } elseif ($amg > $smp) {
                                                echo '
                                                <div class="table-responsive">
                                                    <table class="table table-bordered my-4">
                                                        <tr>
                                                            <th width="30%" class="fs-6">First Recommendation</th>
                                                            <td width="2%">:</td>
                                                            <td class="fs-6">Animation Motion Graphics (AMG) or Web and Mobile Application Development (WMAD)</td>
                                                        </tr>
                                                        <tr>
                                                            <th width="30%" class="fs-6">Second Recommendation</th>
                                                            <td width="2%">:</td>
                                                            <td class="fs-6">Service Management Program (SMP)</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                ';
                                                mysqli_query($conn, "UPDATE `students_acc` 
                                                                    SET specialization='AMG/WMAD' WHERE students_acc.userid='$session_id'")
                                                    or die('Query Failed');
                                            } elseif ($wmad > $smp) {
                                                echo '
                                                <div class="table-responsive">
                                                    <table class="table table-bordered my-4">
                                                        <tr>
                                                            <th width="30%" class="fs-6">First Recommendation</th>
                                                            <td width="2%">:</td>
                                                            <td class="fs-6">Web and Mobile Application Development (WMAD) or Service Management Program (SMP)</td>
                                                        </tr>
                                                        <tr>
                                                            <th width="30%" class="fs-6">Second Recommendation</th>
                                                            <td width="2%">:</td>
                                                            <td class="fs-6">Animation Motion Graphics (AMG)</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                ';
                                                mysqli_query($conn, "UPDATE `students_acc` 
                                                                    SET specialization='WMAD/SMP' WHERE students_acc.userid='$session_id'")
                                                    or die('Query Failed');
                                            }
                                        }

                                        ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade mt-5" id="v-pills-link2" role="tabpanel" aria-labelledby="v-pills-link2-tab">
                        <div class="card rounded-4 shadow-lg">
                            <div class="card-header bg-transparent border-0">
                                <h3 class="my-2"><i class="fa-solid fa-user-graduate"></i> Grade Based Recommendation</h3>
                            </div>
                            <?php if ($row['grade_based'] != NULL) { ?>
                                <div class="card-body pt-0">

                                    <div>
                                        <p class="text-center fs-5">Based on your provided grades, the most suitable specialization for is <span class="text-dark fw-bold"><?php echo $row['grade_based']; ?></span></p>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered my-2">
                                            <tr>
                                                <th width="%" class="fs-6">ITEC102</th>
                                                <td width="1%">:</td>
                                                <td class="fs-6"><?php echo $row['itec102']; ?></td>
                                                <th width="%" class="fs-6">ITEC103</th>
                                                <td width="1%">:</td>
                                                <td class="fs-6"><?php echo $row['itec103']; ?></td>
                                                <th width="%" class="fs-6">ITEC205</th>
                                                <td width="1%">:</td>
                                                <td class="fs-6"><?php echo $row['itec205']; ?></td>
                                            </tr>
                                            <tr>
                                                <th width="%" class="fs-6">ITEL201</th>
                                                <td width="1%">:</td>
                                                <td class="fs-6"><?php echo $row['itel201']; ?></td>
                                                <th width="%" class="fs-6">ITEC204</th>
                                                <td width="1%">:</td>
                                                <td class="fs-6"><?php echo $row['itec204']; ?></td>
                                                <th width="%" class="fs-6">ITEP204</th>
                                                <td width="1%">:</td>
                                                <td class="fs-6"><?php echo $row['itep204']; ?></td>
                                            </tr>
                                            <tr>
                                                <th width="%" class="fs-6">GEC106</th>
                                                <td width="1%">:</td>
                                                <td class="fs-6"><?php echo $row['gec106']; ?></td>
                                                <th width="%" class="fs-6">ITEP205</th>
                                                <td width="1%">:</td>
                                                <td class="fs-6"><?php echo $row['itep205']; ?></td>
                                                <th width="%" class="fs-6">ITEL203</th>
                                                <td width="1%">:</td>
                                                <td class="fs-6"><?php echo $row['itel203']; ?></td>
                                            </tr>
                                            <tr>
                                                <th width="%" class="fs-6">GEC108</th>
                                                <td width="1%">:</td>
                                                <td class="fs-6"><?php echo $row['gec108']; ?></td>
                                                <th width="%" class="fs-6">ITEP203</th>
                                                <td width="1%">:</td>
                                                <td class="fs-6"><?php echo $row['itep203']; ?></td>
                                                <th width="%" class="fs-6">ITEP207</th>
                                                <td width="1%">:</td>
                                                <td class="fs-6"><?php echo $row['itep207']; ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="container my-5">
                                    <h2 class="text-center">You have not yet taken the Grade Based Recommendation.</h2>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="tab-pane fade mt-5" id="v-pills-link3" role="tabpanel" aria-labelledby="v-pills-link3-tab">
                        <div class="card rounded-4 shadow-lg">
                            <div class="card-header bg-transparent border-0">
                                <h3 class="my-2"><i class="fa-regular fa-thumbs-up"></i> Preference Based Recommendation</h3>
                            </div>
                            <div class="card-body">
                                <?php if ($row['grade_based'] != "") { ?>
                                    <div class="card-body pt-0">

                                        <div>
                                            <p class="text-center fs-5">Based on your selected preferences, the recommended specialization for you is <span class="text-dark fw-bold"><?php echo $row['preference_based']; ?></span></p>
                                        </div>
                                        <div class="container bg-light rounded p-3">
                                            <p class="lead"><?= $row['pref_based_desc']; ?></p>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div class="container my-5">
                                        <h2 class="text-center">You have not yet taken the Preference Based Recommendation.</h2>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade my-5" id="v-pills-link4" role="tabpanel" aria-labelledby="v-pills-link4-tab">
                        <div class="card rounded-4 shadow-lg">
                            <div class="card-body">
                                <form class="row g-3" method="POST" action="#" enctype="multipart/form-data">
                                    <h3 class="text-center text-md-start py-2"><i class="fa-solid fa-gear"></i> Edit Profile Information</h3>

                                    <div class="row g-3 my-4">
                                        <div class="col-md-6">
                                            <label for="inputUpdateName" class="form-label">Full Name</label>
                                            <input type="text" class="form-control" id="inputUpadteName" name="update_fullname" value="<?php echo $fullname; ?>" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputID" class="form-label">School ID</label>
                                            <input type="text" class="form-control" id="inputID" name="update_school_id" value="<?php echo $school_id; ?>" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputYear" class="form-label">Year Level</label>
                                            <select class="form-select" id="inputYear" aria-label="Floating label disabled select example" name="update_year_lvl" required>
                                                <option value="1ST YEAR">1ST YEAR</option>
                                                <option value="2ND YEAR">2ND YEAR</option>
                                                <option value="3RD YEAR">3RD YEAR</option>
                                                <option value="4TH YEAR">4TH YEAR</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="formFile" class="form-label">Profile Image</label>
                                            <input class="form-control" type="file" id="formFile" name="update_image" accept="image/jpg, image/jpeg, image/png">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputPassword" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="inputPassword" name="update_password" placeholder="Update Password" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputConfirmPassword" class="form-label">Confirm Password</label>
                                            <input type="password" class="form-control" id="inputConfirmPassword" name="update_cpassword" placeholder="Confirm Password" required>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <button type="submit" name="submit" class="custom-btn3 px-4 border-0 rounded-3 text-light bg-custom-color2">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade my-5" id="v-pills-link5" role="tabpanel" aria-labelledby="v-pills-link4-tab">
                        <div class="card rounded-4 shadow-lg">
                            <div class="card-body">
                                <?php if ($specialization != NULL && $grade_based != NULL && $preference_based != NUll) { ?>
                                    <div class="container">
                                        <h3 class="text-center text-md-start py-2"><i class="fa-solid fa-check-to-slot"></i> Specialization Selection</h3>

                                        <div>
                                            <p class="lead">Based on the results from the system, what is your preferred specialization?</p>
                                            <table class="table table-bordered my-5">
                                                <tr>
                                                    <th width="50%" class="fs-6">Assessment-Based Recommendation</th>
                                                    <td width="2%">:</td>
                                                    <td class="fs-6"><?php echo $specialization; ?></td>
                                                </tr>
                                                <tr>
                                                    <th width="50%" class="fs-6">Grade-Based Recommendation</th>
                                                    <td width="2%">:</td>
                                                    <td class="fs-6"><?php echo $grade_based; ?></td>
                                                </tr>
                                                <tr>
                                                    <th width="50%" class="fs-6">Preference-Based Recommendation</th>
                                                    <td width="2%">:</td>
                                                    <td class="fs-6"><?php echo $preference_based; ?></td>
                                                </tr>
                                            </table>
                                        </div>

                                        <div class="text-center mb-4">
                                            <button class="custom-btn3 px-4 border-0 rounded-3 text-light bg-custom-color2" data-bs-toggle="modal" data-bs-target="#finalizeSelection">Finalize your Specialization</button>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div class="container p-5 m-3">
                                        <p class="text-center fw-semibold fs-4">
                                            For the preservation of the integrity of the specializations recommendation,
                                            you must take all of 3 recommendation before submitting your final specialization choice. Thank you!
                                        </p>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="modal fade" id="finalizeSelection" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content bg-light">
                    <div class="modal-header">
                        <h1 class="modal-title fs-4 fw-bold" id="exampleModalLabel">Edit Question</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="#" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="inputAnswer" class="form-label fw-bold">What is your final preferred specialization?</label>
                                    <select name="student_choice" class="form-control" id="inputAnswer">
                                        <option value="WMAD">Web and Mobile Application Development (WMAD)</option>
                                        <option value="AMG">Animation Motion Graphics (AMG)</option>
                                        <option value="SMP">Service Management Program (SMP)</option>
                                    </select>
                                </div>
                            </div>

                            <?php
                            $month = date('m');
                            $day = date('d');
                            $year = date('Y');

                            $today = $year . '-' . $month . '-' . $day;
                            ?>

                            <input type="date" value="<?php echo $today; ?>" class="form-control" id="date" name="finalization_date" hidden>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="custom-btn3 px-3 border-0 rounded-3 text-light bg-danger" data-bs-dismiss="modal">Close</button>
                        <input type="submit" class="custom-btn3 px-3 border-0 rounded-3 text-light bg-primary" value="Submit" name="submitFinal">
                    </div>
                    </form>
                </div>
            </div>


            <?php
            // Use an if-else statement to display SweetAlert2 message for success or failure
            if (!empty($message)) {
                if (strpos($message, 'Please try again') !== false) {
                    echo "<script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: '$message',
                            }).then(function () {
                                window.location.href = 'profile.php';
                            });
                        </script>";
                } else {
                    echo "<script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: '$message',
                            }).then(function () {
                                // Reload the page after the SweetAlert2 modal is closed
                                window.location.href = 'profile.php';
                            });
                        </script>";
                }
            }
            ?>


    </section>

    <!--FOOTER-->
    <br><br><br>

    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MzjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.js"></script>
    <script src="js/index.js"></script>
</body>

</html>