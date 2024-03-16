<?php

session_start();
//error_reporting(0);
$session_id = $_SESSION['id'];
if (!isset($session_id) || (trim($session_id) == '')) {
  header('location:index.php');
  $_SESSION['message'] = "<script>alert('Please Login!')</script>";
  exit();
}
@include "config.php";
$admin_query = mysqli_query($conn, "SELECT * FROM `admin_acc` WHERE admin_id = $session_id");
$fetch = mysqli_fetch_assoc($admin_query);



//Update Profile
if (isset($_POST['submit'])) {

  //Update Personal Information
  $update_admin_username = mysqli_real_escape_string($conn, $_POST['update_admin_username']);
  $update_admin_name = mysqli_real_escape_string($conn, $_POST['update_admin_name']);

  mysqli_query($conn, "UPDATE `admin_acc` SET admin_username='$update_admin_username', name='$update_admin_name' WHERE admin_acc.admin_id='$session_id'") or die('query failed');

  //Update Password
  $new_pass = mysqli_real_escape_string($conn, md5($_POST['update_password']));
  $confirm_pass = mysqli_real_escape_string($conn, md5($_POST['update_cpassword']));

  if ($new_pass != $confirm_pass) {
    $message = "Password not matched! Please try again.";

  } else {
    mysqli_query($conn, "UPDATE `admin_acc` SET password = '$confirm_pass' WHERE admin_acc.admin_id = '$session_id'") or die('query failed');
    $message = "Profile Updated Successfully!";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css" />
  <link rel="stylesheet" href="css/style2.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


  <title>Admin - Specialization | Recommendation</title>


</head>

<body>

  <!-- navigation -->
  <?php include "navigation.php"; ?>
  <!-- navigation -->

  <main class="mt-5 pt-3">

    <!-- Edit Account -->
    <section class="container">
      <div class="container bg-light  my-5 p-5 rounded-5">
        <form action="#" method="POST" enctype="multipart/form-data">

          <div class="row g-3">
            <h6 class="g-1 px-2 fs-5 fw-bold"><span class="me-1"><i class="bi bi-gear-fill"></i></span> Edit Admin Account</h6>

            <div class="col-md-6">
              <label for="inputUpdateUname" class="form-label">Username</label>
              <input type="text" class="form-control" id="inputUpdateUname" name="update_admin_username" value=<?php echo $fetch['admin_username']; ?> required>
            </div>
            <div class="col-md-6">
              <label for="inputName" class="form-label">Full Name</label>
              <input type="text" class="form-control" id="inputName" name="update_admin_name" value=<?php echo $fetch['name']; ?> required>
            </div>

            <div class="col-md-6">
              <label for="inputUpdatePW" class="form-label">Password</label>
              <input type="password" class="form-control" id="inputUpdatePW" name="update_password" placeholder="Update Password" required>
            </div>
            <div class="col-md-6">
              <label for="inputUpdateCPW" class="form-label">Confirm Password</label>
              <input type="password" class="form-control" id="inputUpdateCPW" name="update_cpassword" placeholder="Confirm Password" required>
            </div>

          </div>
          <input type="submit" class="btn btn-primary my-3 w-25" value="Update" name="submit">
      </div>
    </section>
    </form>
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
                  // Reload to a specific page after the SweetAlert2 modal is closed
                  window.location.href = 'admin-edit-accounts.php';
              });
              </script>";
      } else {
        echo "<script>
                  Swal.fire({
                  icon: 'success',
                  title: 'Success',
                  text: '$message',
                }).then(function () {
                  // Reload to a specific page after the SweetAlert2 modal is closed
                  window.location.href = 'admin-edit-accounts.php';
              });
              </script>";
      }
    }
    ?>
    </div>



  </main>

  <script src="./js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="./js/jquery-3.5.1.js"></script>
  <script src="./js/jquery.dataTables.min.js"></script>
  <script src="./js/dataTables.bootstrap5.min.js"></script>
  <script src="./js/script.js"></script>
</body>

</html>