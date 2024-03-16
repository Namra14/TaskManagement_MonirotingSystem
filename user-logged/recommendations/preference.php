<?php

error_reporting(0);
include "../include/config.php";
include "../include/logic.php";

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



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["language"]) && is_array($_POST["language"]) && count($_POST["language"]) > 0) {
        // At least one checkbox is selected, process the form
        // Redirect or display the recommendation as needed
        header("Location: result.php");
        exit;
    } else {
        // No checkboxes are selected, display an error message
        $errorMessage = "Please select at least one preference.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
    <link rel="stylesheet" href="../../css/form.css">


    <title>Preference Based Recommendation</title>

</head>

<body class="bg-custom-img">

    <?php include 'include/header.php'; ?>

    <?php
    if (isset($errorMessage)) {
        echo '  <div class="alert alert-danger alert-dismissible fade show m-2" role="alert">
                        <i class="bi bi-exclamation-triangle-fill"></i> ' . $errorMessage . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
    }
    ?>

    <div class="container bg-light shadow-lg border rounded-5 my-5">
        <h1 class="page-header fs-2 py-5">What are you interested in? <br><span class="text-dark fs-5">Generate Recommendation based on your preferences</span></h1>
        <div class="form-container">
            <form action="result.php" method="POST" role="form">
                <input id='step2' type='checkbox'>
                <input id='step3' type='checkbox'>

                <div id="part1" class="form-group">
                    <div class="panel panel-primary">

                        <div class="row g-5 pt-5 pb-5 mx-5">

                            <div class="col-sm-4 hidden">
                                <div class="quiz_card_area">
                                    <input class="quiz_checkbox" type="checkbox" name="language[]" value="Process optimization: Identifying and streamlining service delivery processes for efficiency and effectiveness." />
                                    <div class="single_quiz_card">
                                        <div class="quiz_card_content">
                                            <div class="quiz_card_icon">
                                                <img src="../../img/i_pref/process-optimization.png" class="img-fluid w-50" alt="">
                                            </div>

                                            <div class="quiz_card_title">
                                                <h3><i class="fa fa-check" aria-hidden="true"></i> Process optimization</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4 hidden">
                                <div class="quiz_card_area">
                                    <input class="quiz_checkbox" type="checkbox" name="language[]" value="Data analysis and reporting: Analyzing data to make informed decisions and improve service strategies." />
                                    <div class="single_quiz_card">
                                        <div class="quiz_card_content">
                                            <div class="quiz_card_icon">
                                                <img src="../../img/i_pref/data-analysis.png" class="img-fluid w-50" alt="">
                                            </div>

                                            <div class="quiz_card_title">
                                                <h3><i class="fa fa-check" aria-hidden="true"></i> Data analysis and reporting</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4 hidden">
                                <div class="quiz_card_area">
                                    <input class="quiz_checkbox" type="checkbox" name="language[]" value="Problem-solving in coding: Mastering complex coding challenges to create efficient and functional applications." />
                                    <div class="single_quiz_card">
                                        <div class="quiz_card_content">
                                            <div class="quiz_card_icon">
                                                <img src="../../img/i_pref/problem-solving.png" class="img-fluid w-50" alt="">
                                            </div>

                                            <div class="quiz_card_title">
                                                <h3><i class="fa fa-check" aria-hidden="true"></i> Problem-solving in coding</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4 hidden">
                                <div class="quiz_card_area">
                                    <input class="quiz_checkbox" type="checkbox" name="language[]" value="User experience (UX) design: Focusing on creating intuitive and enjoyable user experiences in web and mobile applications." />
                                    <div class="single_quiz_card">
                                        <div class="quiz_card_content">
                                            <div class="quiz_card_icon">
                                                <img src="../../img/i_pref/ui-ux.png" class="img-fluid w-50" alt="">
                                            </div>

                                            <div class="quiz_card_title">
                                                <h3><i class="fa fa-check" aria-hidden="true"></i> User experience (UX) design</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4 hidden">
                                <div class="quiz_card_area">
                                    <input class="quiz_checkbox" type="checkbox" name="language[]" value="Visual effects (VFX): Adding captivating special effects to enhance visual storytelling." />
                                    <div class="single_quiz_card">
                                        <div class="quiz_card_content">
                                            <div class="quiz_card_icon">
                                                <img src="../../img/i_pref/visual-effects.png" class="img-fluid w-50" alt="">
                                            </div>

                                            <div class="quiz_card_title">
                                                <h3><i class="fa fa-check" aria-hidden="true"></i> Visual effects (VFX)</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4 hidden">
                                <div class="quiz_card_area">
                                    <input class="quiz_checkbox" type="checkbox" name="language[]" value="Character animation: Giving characters personality and movement through animation techniques." />
                                    <div class="single_quiz_card">
                                        <div class="quiz_card_content">
                                            <div class="quiz_card_icon">
                                                <img src="../../img/i_pref/character-animation.png" class="img-fluid w-50" alt="">
                                            </div>

                                            <div class="quiz_card_title">
                                                <h3><i class="fa fa-check" aria-hidden="true"></i> Character animation</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="btn-group btn-group-lg pb-5" role="group" aria-label="...">
                            <label for='step2' id="continue-step2" class="continue">
                                <div class="btn btn-default btn-primary btn-next">Continue</div>
                            </label>
                        </div>
                    </div>

                </div>

                <div id="part2" class="form-group">
                    <div class="panel panel-primary">


                        <div class="row g-5 pt-5 pb-5 mx-5">

                            <div class="col-sm-4 hidden">
                                <div class="quiz_card_area">
                                    <input class="quiz_checkbox" type="checkbox" name="language" value="Supply chain management: Efficiently managing the flow of resources to ensure smooth service delivery." />
                                    <div class="single_quiz_card">
                                        <div class="quiz_card_content">
                                            <div class="quiz_card_icon">
                                                <img src="../../img/i_pref/scm.png" class="img-fluid w-50" alt="">
                                            </div>

                                            <div class="quiz_card_title">
                                                <h3><i class="fa fa-check" aria-hidden="true"></i> Supply chain management</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4 hidden">
                                <div class="quiz_card_area">
                                    <input class="quiz_checkbox" type="checkbox" name="language[]" value="Sound design: Incorporating audio elements to enhance the storytelling and immersion in animated content." />
                                    <div class="single_quiz_card">
                                        <div class="quiz_card_content">
                                            <div class="quiz_card_icon">
                                                <img src="../../img/i_pref/sound-design.png" class="img-fluid w-50" alt="">
                                            </div>

                                            <div class="quiz_card_title">
                                                <h3><i class="fa fa-check" aria-hidden="true"></i> Sound design</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4 hidden">
                                <div class="quiz_card_area">
                                    <input class="quiz_checkbox" type="checkbox" name="language[]" value="Programming languages (e.g., Java, Swift): Proficiency in languages that power web and mobile apps, enabling versatile development." />
                                    <div class="single_quiz_card">
                                        <div class="quiz_card_content">
                                            <div class="quiz_card_icon">
                                                <img src="../../img/i_pref/programming-languages.png" class="img-fluid w-50" alt="">
                                            </div>

                                            <div class="quiz_card_title">
                                                <h3><i class="fa fa-check" aria-hidden="true"></i> Programming languages</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4 hidden">
                                <div class="quiz_card_area">
                                    <input class="quiz_checkbox" type="checkbox" name="language[]" value="Team leadership and collaboration: Guiding teams to deliver exceptional service and collaborate effectively." />
                                    <div class="single_quiz_card">
                                        <div class="quiz_card_content">
                                            <div class="quiz_card_icon">
                                                <img src="../../img/i_pref/team-leadership.png" class="img-fluid w-50" alt="">
                                            </div>

                                            <div class="quiz_card_title">
                                                <h3><i class="fa fa-check" aria-hidden="true"></i> Team leadership and collaboration</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4 hidden">
                                <div class="quiz_card_area">
                                    <input class="quiz_checkbox" type="checkbox" name="language[]" value="Storyboarding and scriptwriting: Creating compelling narratives and scripts as a foundation for animated content." />
                                    <div class="single_quiz_card">
                                        <div class="quiz_card_content">
                                            <div class="quiz_card_icon">
                                                <img src="../../img/i_pref/script-writing.png" class="img-fluid w-50" alt="">
                                            </div>

                                            <div class="quiz_card_title">
                                                <h3><i class="fa fa-check" aria-hidden="true"></i> Storyboarding and scriptwriting</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4 hidden">
                                <div class="quiz_card_area">
                                    <input class="quiz_checkbox" type="checkbox" name="language[]" value="Customer relationship management (CRM): Nurturing long-lasting customer relationships through personalized service." />
                                    <div class="single_quiz_card">
                                        <div class="quiz_card_content">
                                            <div class="quiz_card_icon">
                                                <img src="../../img/i_pref/crm.png" class="img-fluid w-50" alt="">
                                            </div>

                                            <div class="quiz_card_title">
                                                <h3><i class="fa fa-check" aria-hidden="true"></i> Customer relationship management</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="btn-group btn-group-lg btn-group-justified pb-5" role="group" aria-label="...">

                            <label for='step2' id="back-step2" class="back">
                                <div class="btn btn-default btn-primary btn-next" role="button">Back</div>
                            </label>


                            <label for='step3' id="continue-step3" class="continue">
                                <div class="btn btn-default btn-primary btn-next mx-3" role="button">Continue</div>
                            </label>

                        </div>
                    </div>
                </div>

                <div id="part3" class="form-group">
                    <div class="panel panel-primary">


                        <div class="row g-5 pt-5 pb-5 mx-5">

                            <div class="col-sm-4 hidden">
                                <div class="quiz_card_area">
                                    <input class="quiz_checkbox" type="checkbox" name="language[]" value="User interface (UI) design: Crafting visually appealing and user-friendly interfaces for seamless user experiences." />
                                    <div class="single_quiz_card">
                                        <div class="quiz_card_content">
                                            <div class="quiz_card_icon">
                                                <img src="../../img/i_pref/user-interface.png" class="img-fluid w-50" alt="">
                                            </div>

                                            <div class="quiz_card_title">
                                                <h3><i class="fa fa-check" aria-hidden="true"></i> User interface (UI) design</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4 hidden">
                                <div class="quiz_card_area">
                                    <input class="quiz_checkbox" type="checkbox" name="language[]" value="Mobile app optimization: Enhancing app performance and responsiveness for various devices." />
                                    <div class="single_quiz_card">
                                        <div class="quiz_card_content">
                                            <div class="quiz_card_icon">
                                                <img src="../../img/i_pref/mobile-app.png" class="img-fluid w-50" alt="">
                                            </div>

                                            <div class="quiz_card_title">
                                                <h3><i class="fa fa-check" aria-hidden="true"></i> Mobile app optimization</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4 hidden">
                                <div class="quiz_card_area">
                                    <input class="quiz_checkbox" type="checkbox" name="language[]" value="Service quality metrics: Implementing metrics to measure and maintain high service quality standards." />
                                    <div class="single_quiz_card">
                                        <div class="quiz_card_content">
                                            <div class="quiz_card_icon">
                                                <img src="../../img/i_pref/sqm.png" class="img-fluid w-50" alt="">
                                            </div>

                                            <div class="quiz_card_title">
                                                <h3><i class="fa fa-check" aria-hidden="true"></i> Service quality metrics</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4 hidden">
                                <div class="quiz_card_area">
                                    <input class="quiz_checkbox" type="checkbox" name="language[]" value="3D modeling: Designing intricate 3D models to bring characters and scenes to life." />
                                    <div class="single_quiz_card">
                                        <div class="quiz_card_content">
                                            <div class="quiz_card_icon">
                                                <img src="../../img/i_pref/3d-animation.png" class="img-fluid w-50" alt="">
                                            </div>

                                            <div class="quiz_card_title">
                                                <h3><i class="fa fa-check" aria-hidden="true"></i> 3D modeling</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4 hidden">
                                <div class="quiz_card_area">
                                    <input class="quiz_checkbox" type="checkbox" name="language[]" value="Animation software (e.g., Adobe After Effects): Utilizing industry-standard software for animation and motion graphics production." />
                                    <div class="single_quiz_card">
                                        <div class="quiz_card_content">
                                            <div class="quiz_card_icon">
                                                <img src="../../img/i_pref/animation-software.png" class="img-fluid w-50" alt="">
                                            </div>

                                            <div class="quiz_card_title">
                                                <h3><i class="fa fa-check" aria-hidden="true"></i> Animation software</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4 hidden">
                                <div class="quiz_card_area">
                                    <input class="quiz_checkbox" type="checkbox" name="language[]" value="Process optimization: Identifying and streamlining service delivery processes for efficiency and effectiveness." />
                                    <div class="single_quiz_card">
                                        <div class="quiz_card_content">
                                            <div class="quiz_card_icon">
                                                <img src="../../img/i_pref/tech-management.png" class="img-fluid w-50" alt="">
                                            </div>

                                            <div class="quiz_card_title">
                                                <h3><i class="fa fa-check" aria-hidden="true"></i> Process optimization</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="btn-group btn-group-lg pb-5" role="group" aria-label="...">
                            <label for='step3' id="back-step3" class="back">
                                <div class="btn btn-default btn-primary btn-next">Back</div>
                            </label>
                            <label class="continue">
                                <input type="submit" class="btn btn-default btn-primary btn-next mx-3" name="Generate" value="Generate" />
                            </label>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>




    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MzjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="../js/index.js"></script>
    <script src="../../js/app.js"></script>

</body>

</html>