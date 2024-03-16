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
    <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="css/style2.css" />


    <title>Admin - Specialization | Recommendation</title>


  </head>
  <body>

    <!-- navigation -->
    <?php @include "navigation.php"; ?>
    <!-- navigation -->

    <main class="mt-5 pt-3">
      
        <h1 class="text-center mt-4">Manage <span style="color: #30336b;">Blogs</span></h1>

        <div class="container mt-2">

            <!-- Display posts from database -->
            <div class="row">
                <?php foreach($query as $q){ ?>
                    <div class="col-12 col-lg-4 d-flex justify-content-center">
                        <div class="card text-white bg-dark mt-2 mb-3" style="width: 24rem;">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $q['title'];?></h5>
                                <p class="card-text"><?php echo substr($q['content'], 0, 100);?>...</p>
                                <a href="admin-view-blogs.php?id=<?php echo $q['id']?>" class="btn btn-light">Read More <span class="text-danger">&rarr;</span></a>
                            </div>
                        </div>
                    </div>
                <?php }?>
            </div>
           
        </div>

       <!-- Create a new Post button -->
       <a class="open-button" href="admin-blogs-create.php">+ Create a new post</a>

    </main>
    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="./js/jquery-3.5.1.js"></script>
    <script src="./js/jquery.dataTables.min.js"></script>
    <script src="./js/dataTables.bootstrap5.min.js"></script>
    <script src="./js/script.js"></script>
  </body>
</html>
