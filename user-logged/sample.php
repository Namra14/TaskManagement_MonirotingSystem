<?php

include '../include/config.php';

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

$pref_based = " Based on the user's preferences, I would recommend the Web and Animation Motion Graphics specialization. 
                The majority of his selected preferences are related to coding, programming languages, user experience design, 
                user interface design, and mobile app optimization - all of which fit into the Web and Mobile Application 
                Development specialization. This specialization will help the user gain skills in problem solving, UX design, 
                programming languages, UI design, and mobile optimization - giving him the ability to create efficient and functional 
                web and mobile applications.";

if (strpos(strtolower($pref_based), "web and mobile application development") !== false) {

    $wmad = "WMAD";
    $insert_query = mysqli_query($conn, "UPDATE `students_acc` SET preference_based='$wmad' 
                                     WHERE students_acc.userid='$session_id'");
    if ($insert_query) {
        echo "data inserted";
    } else echo "data update failed: " . mysqli_error($conn);

} elseif (strpos(strtolower($pref_based), "animation motion graphics") !== false) {

    $amg = "AMG";
    $insert_query = mysqli_query($conn, "UPDATE `students_acc` SET preference_based='$amg' 
                                     WHERE students_acc.userid='$session_id'");
    if ($insert_query) {
        echo "data inserted";
    } else echo "data update failed: " . mysqli_error($conn);

} elseif (strpos(strtolower($pref_based), "service management program") !== false) {

    $smp = "SMP";
    $insert_query = mysqli_query($conn, "UPDATE `students_acc` SET preference_based='$smp' 
                                     WHERE students_acc.userid='$session_id'");

    if ($insert_query) {
        echo "data inserted";
    } else echo "data update failed: " . mysqli_error($conn);

}
