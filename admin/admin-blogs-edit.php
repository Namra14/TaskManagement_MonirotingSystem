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
$query = mysqli_query($conn, "SELECT * FROM `students_acc`");
$admin_query = mysqli_query($conn, "SELECT * FROM `admin_acc` WHERE admin_id = $session_id");
$fetch = mysqli_fetch_assoc($admin_query);

@include "logic.php";

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
  <?php @include "navigation.php"; ?>
  <!-- navigation -->

  <main class="mt-5 pt-3">

    <div class="container p-5 my-5 bg-dark text-white animate__animated animate__fadeIn animate__slower">
      <div class="container mt-2">
        <h1 class="text-center">Update Blog</h1>
        <?php foreach ($query as $q) { ?>
          <form method="POST">
            <input type="text" hidden value='<?php echo $q['id'] ?>' name="id">
            <textarea placeholder="Blog Title" class="form-control my-3 bg-light text-dark text-center" name="title" cols="30" rows="2">
                          <?php echo $q['title'] ?>                      
                        </textarea>
            <textarea name="intro" placeholder="Insert your Introduction here" class="form-control my-3 bg-light text-dark" cols="30" rows="4">
                            <?php echo $q['introduction'] ?>
                        </textarea>
            <textarea name="main_content" class="form-control my-3 bg-light text-dark" cols="30" rows="15">
                            <?php echo $q['content'] ?>                            
                        </textarea>
            <textarea name="conclusion" placeholder="Insert your Conclusion here" class="form-control my-3 bg-light text-dark" cols="30" rows="7">
                            <?php echo $q['conclusion'] ?>                          
                        </textarea>
            <button style="border-radius: 10px;"><a href="admin-manage-blogs.php" style="margin: 0;" class="btn btn-light">Go Back</a></button>
            <button name="update" style="border-radius: 10px; margin-left: 10px;"><a style="margin: 0;" class="btn btn-light">Update</a></button>
          </form>
        <?php } ?>
        <?php
        // Use an if-else statement to display SweetAlert2 message for success or failure
        if (!empty($message)) {
          if (strpos($message, 'Please try again') !== false) {
            echo "<script>
                      Swal.fire({
                          icon: 'error',
                          title: 'Error',
                          text: '$message',
                      });
                  </script>";
          } else {
            echo "<script>
                      Swal.fire({
                          icon: 'success',
                          title: 'Success',
                          text: '$message',
                      }).then((result) => {
                        if (result.isConfirmed) {
                            // Redirect to another page here
                            window.location.href = 'admin-manage-blogs.php';
                        }
                    });
                  </script>";
          }
        }
        ?>
      </div>
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