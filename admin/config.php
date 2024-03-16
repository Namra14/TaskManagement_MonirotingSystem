<?php

$conn = mysqli_connect("localhost", "root", "", "db_ccs") or die("connection failed");

	$count_all_students = "SELECT COUNT(*) as count FROM `students_acc`";
    $result = mysqli_query($conn, $count_all_students);
    $row = mysqli_fetch_assoc($result);
    $total_students = $row['count'];

    $count_students_no_assess = "SELECT COUNT(*) as count FROM `students_acc` WHERE specialization IS NULL";
    $result = mysqli_query($conn, $count_students_no_assess);
    $row = mysqli_fetch_assoc($result);
    $total_students_no_assess = $row['count'];

    $count_students_with_assess = "SELECT COUNT(*) as count FROM `students_acc` WHERE specialization IS NOT NULL";
    $result = mysqli_query($conn, $count_students_with_assess);
    $row = mysqli_fetch_assoc($result);
    $total_students_with_assess = $row['count'];

    $count_blogs = "SELECT COUNT(*) as count FROM `blog_data`";
    $result = mysqli_query($conn, $count_blogs);
    $row = mysqli_fetch_assoc($result);
    $total_blogs = $row['count'];

    $count_grade_based = "SELECT COUNT(*) as count FROM `students_acc` WHERE grade_based IS NOT NULL";
    $result = mysqli_query($conn, $count_grade_based);
    $row = mysqli_fetch_assoc($result);
    $total_grade_based = $row['count'];

    $count_preference_based = "SELECT COUNT(*) as count FROM `students_acc` WHERE preference_based IS NOT NULL";
    $result = mysqli_query($conn, $count_preference_based);
    $row = mysqli_fetch_assoc($result);
    $total_preference_based = $row['count'];

    $count_student_choice = "SELECT COUNT(*) as count FROM `students_acc` WHERE student_choice IS NOT NULL";
    $result = mysqli_query($conn, $count_student_choice);
    $row = mysqli_fetch_assoc($result);
    $total_student_choice = $row['count'];
?>