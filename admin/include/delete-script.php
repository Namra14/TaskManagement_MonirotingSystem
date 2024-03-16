<?php
include "../config.php";

// Remove all questions from the database.
$query = mysqli_query($conn, "DELETE FROM questions") or die('Query failed');

if ($query) {
  header('refresh:0.1; url=../admin-manage-questions.php');
} else {
  header('refresh:0.1; url=../admin-manage-questions.php');
}

