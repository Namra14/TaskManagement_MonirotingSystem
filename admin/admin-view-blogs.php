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
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"/>
    <link rel="stylesheet" href="css/style2.css" />


    <title>Admin - Specialization | Recommendation</title>


  </head>
  <body>

    <!-- navigation -->
    <?php include "navigation.php"; ?>
    <!-- navigation -->
    
    <main class="mt-5 pt-3">

        <div class="container mt-5">

        <?php foreach($query as $q){?>
            <div class="bg-dark p-5 rounded-lg text-white text-center animate__animated animate__backInDown animate__slow">
                <h1><?php echo $q['title'];?></h1>

                  <div class="d-flex mt-2 justify-content-center align-items-center animate__animated animate__backInDown animate__slow">
                      <a href="admin-blogs-edit.php?id=<?php echo $q['id']?>" class="btn btn-light btn-sm blog-edit-btn" name="edit">Edit </a>                    
                      <form method="POST">
                          <input type="text" hidden value='<?php echo $q['id']?>' name="id">
                          <button class="btn btn-danger btn-sm ml-2" name="delete">Delete</button>
                      </form>                  
                  </div>

            </div>
            <p class="mt-5 border-left border-dark pl-3 animate__animated animate__backInLeft animate__slower"><?php echo $q['introduction'];?></p>
            <p class="mt-5 border-left border-dark pl-3 animate__animated animate__backInRight animate__slower"><?php echo $q['content'];?></p>
            <p class="mt-5 border-left border-dark pl-3 animate__animated animate__backInUp animate__slower"><?php echo $q['conclusion'];?></p>
        <?php } ?>    

        <a href="admin-manage-blogs.php" class="btn btn-outline-dark my-4 mb-5 float-end me-3 animate__animated animate__backInUp animate__slower">Go Back</a>
   </div>

    </main>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../js/jquery-3.5.1.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
    <script src="../js/dataTables.bootstrap5.min.js"></script>
    <script src="../js/script.js"></script>
  </body>
</html>
