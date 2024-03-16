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
$admin_query = mysqli_query($conn, "SELECT * FROM `admin_acc` WHERE admin_acc.admin_id = $session_id");
$fetch = mysqli_fetch_assoc($admin_query);



if (isset($_GET['delete'])) {

  $delete_id = $_GET['delete'];
  $delete_query = mysqli_query($conn, "DELETE FROM `students_acc` WHERE students_acc.userid = $delete_id ") or die('query failed');

  if ($delete_query) {
    header('location:admin-user-tables.php');
    $message[] = 'successfully removed';
  } else {
    header('location:admin-user-tables.php');
    $message[] = 'product deletion failed';
  };
};


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

  <style>
    .chart-container {
      position: relative;
      height: 400px;
      /* Set initial height or adjust as needed */
    }

    .circle-icon {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .bg-color-2 {
      background-color: rgb(54, 92, 136);
    }

    .bg-color-3 {
      background-color: rgb(238, 114, 20);
    }
  </style>

</head>

<body>

  <!-- navigation -->
  <?php include "navigation.php"; ?>
  <!-- navigation -->

  <main class="mt-5 pt-3">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 mt-2 mb-2">
          <h4><span class="me-2"><i class="bi bi-people"></i></span>Students</h4>
        </div>
      </div>

      <!-- Card stats -->
      <div class="row mb-4">
        <div class="col-md-3 mb-3">
          <div class="card bg-primary text-white h-100 shadow-lg">
            <div class="card-header">
              <div class="row">
                <div class="col-md-10">
                  <p class="my-3">Number of Students</p>
                </div>
                <div class="col-md-2 pt-1 ps-1">
                  <div class="circle-icon bg-primary text-white">
                    <span><i class="bi bi-person fs-3"></i></span>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body py-4 h3"><span><?php echo $total_students; ?></span></div>
          </div>
        </div>

        <div class="col-md-3 mb-3">
          <div class="card bg-warning text-white h-100 shadow-lg">
            <div class="card-header">
              <div class="row">
                <div class="col-md-10 pt-1 ps-1">
                  <p class="my-3">Students not Evaluated</p>
                </div>
                <div class="col-md-2 pt-1 ps-1">
                  <div class="circle-icon bg-warning text-white">
                    <span><i class="bi bi-person-x fs-3"></i></span>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body py-4 text-white h3"><span><?php echo $total_students_no_assess; ?></span></div>
          </div>
        </div>

        <div class="col-md-3 mb-3">
          <div class="card bg-success text-white h-100 shadow-lg">
            <div class="card-header">
              <div class="row">
                <div class="col-md-10">
                  <p class="my-3">Students Evaluated</p>
                </div>
                <div class="col-md-2 pt-1 ps-1">
                  <div class="circle-icon bg-success text-white">
                    <span><i class="bi bi-person-check fs-3"></i></span>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body py-4 h3"><span><?php echo $total_students_with_assess; ?></span></div>
          </div>
        </div>

        <div class="col-md-3 mb-3">
          <div class="card bg-danger text-white h-100 shadow-lg">
            <div class="card-header">
              <div class="row">
                <div class="col-md-10">
                  <p class="my-3">Number of Blogs</p>
                </div>
                <div class="col-md-2 pt-1 ps-1">
                  <div class="circle-icon bg-danger text-white">
                    <span><i class="bi bi-journals fs-3"></i></span>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body py-4 h3"><span><?php echo $total_blogs; ?></span></div>
          </div>
        </div>
      </div>
      <div class="row mb-4">
        <div class="col-md-3 mb-3">
          <div class="card bg-info text-white h-100 shadow-lg">
            <div class="card-header">
              <div class="row">
                <div class="col-md-10">
                  <p class="my-3">Students with Assessment-based Recommendations</p>
                </div>
                <div class="col-md-2 pt-1 ps-1">
                  <div class="circle-icon bg-info text-white">
                    <span><i class="bi bi-book fs-3"></i></span>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body py-4 h3"><span><?php echo $total_students_with_assess; ?></span></div>
          </div>
        </div>

        <div class="col-md-3 mb-3">
          <div class="card bg-secondary text-white h-100 shadow-lg">
            <div class="card-header">
              <div class="row">
                <div class="col-md-10 pt-1 ps-1">
                  <p class="my-3">Students with Grades-based Recommendations</p>
                </div>
                <div class="col-md-2 pt-1 ps-1">
                  <div class="circle-icon bg-secondary text-white">
                    <span><i class="bi bi-journal-text fs-3"></i></span>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body py-4 text-white h3"><span><?php echo $total_grade_based; ?></span></div>
          </div>
        </div>

        <div class="col-md-3 mb-3">
          <div class="card bg-color-2 text-white h-100 shadow-lg">
            <div class="card-header">
              <div class="row">
                <div class="col-md-10">
                  <p class="my-3">Students with Preference-based Recommendations</p>
                </div>
                <div class="col-md-2 pt-1 ps-1">
                  <div class="circle-icon bg-color-2 text-white">
                    <span><i class="bi bi-hand-thumbs-up fs-3"></i></span>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body py-4 h3"><span><?php echo $total_preference_based; ?></span></div>
          </div>
        </div>

        <div class="col-md-3 mb-3">
          <div class="card bg-color-3 text-white h-100 shadow-lg">
            <div class="card-header">
              <div class="row">
                <div class="col-md-10">
                  <p class="my-3">Students with Final <br>Choice</p>
                </div>
                <div class="col-md-2 pt-1 ps-1">
                  <div class="circle-icon bg-color-3 text-white">
                    <span><i class="bi bi-star fs-3"></i></i></span>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body py-4 h3"><span><?php echo $total_student_choice; ?></span></div>
          </div>
        </div>
      </div>

      <hr>

      <div class="row mt-5">
        <div class="col-md-12 mb-3">
          <div class="card">
            <div class="card-header">
              <span><i class="bi bi-table me-2"></i></span> Students Table
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="example" class="table table-striped data-table" style="width: 100%; text-align: center;">
                  <thead>
                    <tr>
                      <th>School ID</th>
                      <th>Name</th>
                      <th>Year Level</th>
                      <th>Decision</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($query)) {
                    ?>
                      <tr>
                        <td><?php echo $row['school_id']; ?></td>
                        <td><?php echo $row['fullname']; ?></td>
                        <td><?php echo $row['year_lvl']; ?></td>
                        <?php if ($row['student_choice'] != NULL) { ?>
                          <td><?php echo $row['student_choice'] ?></td>
                        <?php } else { ?>
                          <td>Undecided</td>
                        <?php } ?>
                        <td>
                          <a href="admin-view-user.php?id=<?php echo $row['userid']; ?>" class="text-warning pe-2"><i class="fa-solid fa-desktop fs-4"></i></a>
                          <a href="admin-user-tables.php?delete=<?php echo $row['userid']; ?>" class="text-danger pe-3" onclick="confirmation(event)"><i class="fa-solid fa-xmark fs-4"></i></a>
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


  <script>
    function confirmation(ev) {
      ev.preventDefault();
      var urlToDirect = ev.currentTarget.getAttribute('href');

      console.log(urlToDirect);

      Swal.fire({
        title: 'Delete User',
        text: 'Are you sure you want to delete this user?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        showCancelButton: true, // Enable the "Cancel" button
        confirmButtonText: "Yes, delete it", // Customize the confirm button text
        cancelButtonText: "Cancel", // Set the "Cancel" button text
        dangerMode: true,
      }).then((willDelete) => {
        if (willDelete.value) { // Check the result for true (if "Yes, delete it" was clicked)
          Swal.fire({
            title: 'User Deleted',
            text: 'The user has been deleted successfully.',
            icon: 'success'
          }).then(() => {
            // Redirect to the desired URL after displaying the message
            window.location.href = urlToDirect;
          });
        }
      });
    }
  </script>


  <script src="./js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="./js/jquery-3.5.1.js"></script>
  <script src="./js/jquery.dataTables.min.js"></script>
  <script src="./js/dataTables.bootstrap5.min.js"></script>
  <script src="./js/script.js"></script>
  <script src="https://kit.fontawesome.com/2895031f15.js" crossorigin="anonymous"></script>


</body>

</html>