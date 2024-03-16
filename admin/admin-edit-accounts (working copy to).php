<?php

  session_start();
  //error_reporting(0);
  $session_id = $_SESSION['id'];
  if(!isset($session_id) || (trim($session_id) == '')){
    header('location:index.php');
    $_SESSION['message'] = "<script>alert('Please Login!')</script>";
    exit();
  }
  @include "config.php";
  $admin_query = mysqli_query($conn, "SELECT * FROM `admin_acc` WHERE admin_id = $session_id");
  $fetch = mysqli_fetch_assoc($admin_query);



  //Update Profile
  if(isset($_POST['submit'])){

    //Update Personal Information
    $update_admin_username = mysqli_real_escape_string($conn, $_POST['update_admin_username']);
    $update_admin_name = mysqli_real_escape_string($conn, $_POST['update_admin_name']);

    mysqli_query($conn, "UPDATE `admin_acc` SET admin_username='$update_admin_username', name='$update_admin_name' WHERE admin_acc.admin_id='$session_id'") or die('query failed');

    //Update Password
    $new_pass = mysqli_real_escape_string($conn, md5($_POST['update_password']));
    $confirm_pass = mysqli_real_escape_string($conn, md5($_POST['update_cpassword']));

    if($new_pass != $confirm_pass){
          echo "<script>alert('Password Not Matched.')</script>";
          header('refresh:0.1; url=admin-edit-accounts.php');
      }
      else{
          mysqli_query($conn, "UPDATE `admin_acc` SET password = '$confirm_pass' WHERE admin_acc.admin_id = '$session_id'") or die('query failed');
          echo "<script>alert('Profile Successfully Updated!')</script>";
          header('refresh:0.1; url=admin-edit-accounts.php');
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
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
    />
    <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="../css-index/profile.css">
    <title>Admin - Specialization | Recommendation</title>
  </head>
  <body>
    
    <!-- navigation -->
    <?php @include "navigation.php"; ?>
    <!-- navigation -->

    <main class="mt-5 pt-3">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 mt-2 mb-2">
            <h4>
              <span class="me-1"><i class="bi bi-gear-fill"></i></span>
              <span>
                Edit Account
              </span>
          </h4>
          </div>
        </div>

        <!-- Edit Account -->
        <div class="content" style="width: 95%; margin: 0; margin-left: 2.5%;">
                  <form action="admin-edit-accounts.php" method="POST" enctype="multipart/form-data">
                    <div class="flex">
                      <div class="sfy">
                        <label>Username</label>
                        <input type="text" name="update_admin_username" value=<?php echo $fetch['admin_username'];?> required>
                          <label>Full Name</label>
                        <input type="text" name="update_admin_name" value="<?php echo $fetch['name'];?>" required>
                        
                      </div>
                      <div class="upc">
                        <label>Password</label>
                        <input type="password" name="update_password" placeholder="Update Password" required>
                        <label>Confirm Password</label>
                        <input type="password" name="update_cpassword" placeholder="Confirm Password" required>                 
                      </div>  
                    </div>  
                    <input type="submit" name="submit" value="submit">  
                  </form>
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
