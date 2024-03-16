<?php
include "include/config.php";

if (isset($_POST['id'])) {
  $userId = $_POST['id'];
  $delete_query = mysqli_query($conn, "DELETE FROM `user_table` WHERE id = $userId");

  if ($delete_query) {
    echo 'success';
  } else {
    echo 'error';
  }
  
}

if (isset($_POST['id'])) {
  $userId = $_POST['id'];
  $delete_query = mysqli_query($conn, "DELETE FROM `admin_table` WHERE id = $userId");

  if ($delete_query) {
    echo 'success';
  } else {
    echo 'error';
  }

}
