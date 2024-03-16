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
$query = mysqli_query($conn, "SELECT * FROM `admin_acc`");
$admin_query = mysqli_query($conn, "SELECT * FROM `admin_acc` WHERE admin_acc.admin_id = $session_id");

$fetch = mysqli_fetch_assoc($admin_query);
$admin_type = $fetch['user_type'];

if ($admin_type == 'superadmin') {
  header('url=admin-add-admin.php');
} else {
  header('refresh:0.1; url=admin-dashboard.php');
  echo "<script>alert('Unauthorized User!')</script>";
}


if (isset($_GET['delete'])) {

  $delete_id = $_GET['delete'];
  $delete_query = mysqli_query($conn, "DELETE FROM `admin_acc` WHERE admin_acc.admin_id = $delete_id ") or die('query failed');

  if ($delete_query) {
    header('location:admin-view-admin.php');
    echo 'successfully removed';
  } else {
    header('location:admin-view-admin.php');
    echo 'account deletion failed';
  }
}

if (isset($_POST['submit'])) {
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $admin_username = mysqli_real_escape_string($conn, $_POST['admin_username']);
  $user_type = mysqli_real_escape_string($conn, $_POST['user_type']);
  $password = mysqli_real_escape_string($conn, md5($_POST['password']));
  $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));

  $select = mysqli_query($conn, "SELECT * FROM `admin_acc` WHERE admin_username = '$admin_username' AND password = '$password'") or die("query failed");

  if ($password == $cpass) {
    if (mysqli_num_rows($select) > 0) {
      $message[] = '<script>alert("User Already Exists")</script>';
    } else {
      $message[] = "<script>alert('User Registration Complete.')</script>";
      mysqli_query($conn, "INSERT INTO `admin_acc` (name, admin_username, password, user_type) VALUES ('$name','$admin_username', '$password', '$user_type')") or die("query failed");

      header('location:admin-view-admin.php');
    }
  } else {
    echo "<script>alert('Password Not Matched.')</script>";
  }
}


?>

<?php ?>

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


  <title>Admin - Specialization | Recommendation</title>


</head>

<body>

  <!-- navigation -->
  <?php

  @include "navigation.php";

  if (isset($message)) {
    foreach ($message as $message) {
      echo $message;
    }
  }

  ?>
  <!-- navigation -->

  <main class="mt-5 pt-3">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 mt-2 mb-2">
          <h4><span class="me-2"><i class="bi bi-person-workspace"></i></span>List of Admins</h4>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12 mb-3">
          <div class="card">
            <div class="card-header">
              <span><i class="bi bi-table me-2"></i></span> Admins
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="example" class="table table-striped data-table">
                  <thead>
                    <tr>
                      <th>Admin ID</th>
                      <th>Name</th>
                      <th>Username</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($query)) {
                    ?>
                      <tr>
                        <td><?php echo $row['admin_id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['admin_username']; ?></td>
                        <td class="text-center">
                          <?php if ($row['admin_username'] != "superadmin") { ?>
                            <a href="admin-view-admin.php?delete=<?php echo $row['admin_id']; ?>" class="btn btn-danger btn-sm ps-3 pe-3" onclick="return confirm('are your sure you want to delete this?');"> DELETE </a>
                          <?php } ?>
                        </td>
                      </tr>

                    <?php } ?>
                  </tbody>

                </table>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>

  </main>

  <!-- Button trigger modal -->
  <button type="button" class="open-button" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Admin</button>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Fill up the Form</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body my-3">
          <form action="admin-view-admin.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="name" placeholder="Name" class="form-control my-2" required>
            <input type="text" name="admin_username" placeholder="Username" class="form-control my-2" required>
            <input type="password" name="password" placeholder="Password" class="form-control my-2" required>
            <input type="password" name="cpassword" class="form-control my-2" placeholder="Confirm Password" required>
            <input type="text" hidden name="user_type" value="admin">

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-primary" value="  Submit  " name="submit">
        </div>

        </form>
      </div>
    </div>
  </div>

  <script src="./js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="./js/jquery-3.5.1.js"></script>
  <script src="./js/jquery.dataTables.min.js"></script>
  <script src="./js/dataTables.bootstrap5.min.js"></script>
  <script src="./js/script.js"></script>
</body>

</html>