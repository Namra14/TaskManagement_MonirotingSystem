<?php

error_reporting(0);
include "../../include/config.php";

session_start();

$session_id = $_SESSION['id'];
if (!isset($_SESSION['id']) || (trim($_SESSION['id']) == '')) {
    header('location:../../user-login.php');
    $_SESSION['message'] = "<script>alert('Please Login!')</script>";
    exit();
}
$query2 = mysqli_query($conn, "SELECT * FROM `students_acc` 
		WHERE userid='" . $_SESSION['id'] . "'");
$row = mysqli_fetch_assoc($query2);

$school_id = $row['school_id'];
$fullname = $row['fullname'];


require __DIR__ . '/vendor/autoload.php';

use Orhanerday\OpenAi\OpenAi;

$open_ai_key = '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';

$open_ai = new OpenAi($open_ai_key);

$selectedPreferences = $_POST['language']; // Get selected preferences from checkboxes as an array

// Construct the prompt based on selected preferences
$prompt = implode(", ", $selectedPreferences);

$complete = $open_ai->completion([
    'model' => 'gpt-3.5-turbo-instruct',
    'prompt' => '
    
    In this conversation, you are a specialization recommendation system. 

    Base on the preferences that will be selected by the user, you can give an exact specialization by looking at what is the majority of selected preferences are under of what specialization.
    
    The specializations are:
    1. "Web and Mobile Application Development"
    
    2. "Animation and Motion Graphics"
    
    3. "Service management program"
    
    
    
    
    Now these are the user selected preferences:
    ' . $prompt . '
    
    Note: strictly follow that you have to identify the majority of selected preferences base and characterized them base on the specializations categorized above, 
    You are restricted to recommend only 1 specialization, do not do a breakdown, you have to convince the user that that is the most suitable specialization for him.',

    'temperature' => 0.9,
    'max_tokens' => 150,
    'frequency_penalty' => 0,
    'presence_penalty' => 0.6,
]);

$response = json_decode($complete, true);
$response = $response["choices"][0]["text"];
$escapedResponse = mysqli_real_escape_string($conn, $response);

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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <title>Preference Based Recommendation Results</title>

</head>

<body class="bg-custom-img">

    <?php include 'include/header.php'; ?>

    <br><br>

    <section>
        <div class="container my-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card border border-0 shadow p-3" id="abcard1">

                        <div class="row">
                            <div class="col-md-12 p-5 words">
                                <h2 class="text-center fw-bold fs-1 mb-4 discover">Discover Your Ideal Specialization Based on Your Preferences</h2>
                                <div class="me-5">
                                    <div class="container bg-light mx-3 rounded">
                                        <p class="card-text p-4 fs-5">
                                            <?php echo $response ?>
                                        </p>
                                    </div>
                                </div>

                                <div class="mt-5">
                                    <a href="preference.php" class="float-left fs-5" id="regen">Regenerate?</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <?php

    if (strpos($response, "Web and Mobile Application Development") !== false) {

        $wmad = "WMAD";
        $insert_query = mysqli_query($conn, "UPDATE `students_acc` SET preference_based='$wmad', pref_based_desc='$escapedResponse' 
                                        WHERE students_acc.userid='$session_id'");
        if ($insert_query) {
            $message = "Successfully Generated the Recommendations based on your Preferences.";
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '$message',
                });
            </script>";
        } else {
            $message = "Data update failed: " . mysqli_error($conn);
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '$message',
                }).then(function() {
                    location.reload(); // Reload the same page after closing the alert
                });
            </script>";
        }
    } elseif (strpos($response, "Animation and Motion Graphics") !== false) {

        $amg = "AMG";
        $insert_query = mysqli_query($conn, "UPDATE `students_acc` SET preference_based='$amg', pref_based_desc='$escapedResponse' 
                                        WHERE students_acc.userid='$session_id'");
        if ($insert_query) {
            $message = "Successfully Generated the Recommendations based on your Preferences.";
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '$message',
                });
            </script>";
        } else {
            $message = "Data update failed: " . mysqli_error($conn);
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '$message',
                });
            </script>";
        }
    } elseif (strpos($response, "Service Management Program") !== false) {

        $smp = "SMP";
        $insert_query = mysqli_query($conn, "UPDATE `students_acc` SET preference_based='$smp', pref_based_desc='$escapedResponse' 
                                        WHERE students_acc.userid='$session_id'");
        if ($insert_query) {
            $message = "Successfully Generated the Recommendations based on your Preferences.";
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '$message',
                });
            </script>";
        } else {
            $message = "Data update failed: " . mysqli_error($conn);
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '$message',
                });
            </script>";
        }
    }


    ?>


    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MzjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="../js/index.js"></script>

</body>

</html>