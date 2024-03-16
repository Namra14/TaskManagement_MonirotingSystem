<?php

session_start();
//error_reporting(0);
$session_id = $_SESSION['id'];
if (!isset($session_id) || (trim($session_id) == '')) {
  header('location:index.php');
  $_SESSION['message'] = "<script>alert('Please Login!')</script>";
  exit();
}
include "config.php";
$query = mysqli_query($conn, "SELECT * FROM `students_acc`");
$admin_query = mysqli_query($conn, "SELECT * FROM `admin_acc` WHERE admin_id = $session_id");
$fetch = mysqli_fetch_assoc($admin_query);

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

  <title>Admin - Specialization | Recommendation</title>


</head>

<body>

  <!-- navigation -->
  <?php include "navigation.php"; ?>
  <!-- navigation -->

  <main class="mt-5 pt-3">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 mt-2 mb-2">
          <h4>Dashboard</h4>
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

      <div class="row my-5" id="charts">
        <div class="col-md-8 mb-3">
          <div class="">
            <div class="card h-100">
              <div class="card-header">
                <span class="me-2"><i class="bi bi-bar-chart-fill"></i></span>
                Assessment-based Recommendation
              </div>
              <div class="card-body">
                <div class="chart-container" style="height: 400px;"> <!-- Set a fixed height -->
                  <canvas id="myChartBar" style="display: block; box-sizing: border-box; height: 400px; width: 1000px;"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4 mb-3">
          <div class="">
            <div class="card h-100">
              <div class="card-header">
                <span class="me-2"><i class="bi bi-pie-chart-fill"></i></span>
                Grade-based Recommendation
              </div>
              <div class="card-body">
                <div class="chart-container" style="height: 400px;"> <!-- Set a fixed height -->
                  <canvas id="myChartPie"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4 mb-3">
          <div class="">
            <div class="card h-100">
              <div class="card-header">
                <span class="me-2"><i class="bi bi-pie-chart-fill"></i></span>
                Preference-based Recommendation
              </div>
              <div class="card-body">
                <div class="chart-container" style="height: 400px;"> <!-- Set a fixed height -->
                  <canvas id="myChartPie2"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-8 mb-3">
          <div class="">
            <div class="card h-100">
              <div class="card-header">
                <span class="me-2"><i class="bi bi-bar-chart-fill"></i></span>
                Students Choice based on the 3 Recommendation
              </div>
              <div class="card-body">
                <div class="chart-container" style="height: 400px;"> <!-- Set a fixed height -->
                  <canvas id="myChartBar2" style="display: block; box-sizing: border-box; height: 400px; width: 1000px;"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <hr>

      <div class="row my-5">
        <div class="col-md-12 mb-3">
          <div class="card">
            <div class="card-header">
              <span><i class="bi bi-table me-2"></i></span>Student Data Table
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="example" class="table table-striped data-table" style="width: 100%">
                  <thead>
                    <tr>
                      <th>School ID</th>
                      <th>Name</th>
                      <th>Year Level</th>
                      <th>Decision</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                      <tr>
                        <td><?php echo $row['school_id'] ?></td>
                        <td><?php echo $row['fullname'] ?></td>
                        <td><?php echo $row['year_lvl'] ?></td>
                        <?php if ($row['student_choice'] != NULL) { ?>
                          <td><?php echo $row['student_choice'] ?></td>
                        <?php } else { ?>
                          <td>Undecided</td>
                        <?php } ?>
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
  <script src="./js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="./js/jquery-3.5.1.js"></script>
  <script src="./js/jquery.dataTables.min.js"></script>
  <script src="./js/dataTables.bootstrap5.min.js"></script>
  <script src="./js/script.js"></script>

  <?php

  @include "count.php";

  ?>

  <script>
    const ctx = document.getElementById('myChartBar');
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['WMAD', 'SMP', 'AMG', 'SMP & AMG', 'AMG & WMAD', 'WMAD & SMP', 'Suitable to all Specializations'],
        datasets: [{
          label: '# of students',
          data: <?php echo json_encode($count_specializations); ?>,
          backgroundColor: [
            'rgb(54,92,136)',
            'rgb(255,197,55)',
            'rgb(190,49,68)',
            'rgb(238,114,20)',
            'rgb(36,74,19)',
            'rgba(145, 97, 39, 0.6)',
            'rgba(255, 215, 0, 0.6)'
          ],
          borderWidth: 1
        }]
      },
      options: {
        indexAxis: 'y', // Change the axis to display labels on the y-axis
        scales: {
          x: {
            beginAtZero: true,
            ticks: {
              maxRotation: 0, // Set the maximum rotation angle for labels
              minRotation: 0, // Set the minimum rotation angle for labels
              autoSkip: true, // Allow automatic skipping of labels if they overlap
              padding: 10, // Adjust the padding if needed
            }
          }
        }
      }
    });

    const ctz = document.getElementById('myChartBar2');
    new Chart(ctz, {
      type: 'bar',
      data: {
        labels: ['WMAD', 'AMG', 'SMP'],
        datasets: [{
          label: '# of students',
          data: <?php echo json_encode($count_schoice); ?>,
          backgroundColor: [
            'rgb(54,92,136)',
            'rgb(255,197,55)',
            'rgb(190,49,68)',
          ],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });

    const cty = document.getElementById('myChartPie');
    const data = {
      labels: ['WMAD', 'AMG', 'SMP'],
      datasets: [{
        label: '# of Students',
        data: <?php echo json_encode($count_grade_based); ?>,
        backgroundColor: [
          'rgb(54,92,136)',
          'rgb(255,197,55)',
          'rgb(190,49,68)',
        ],
        hoverOffset: 4
      }]
    };

    new Chart(cty, {
      type: 'doughnut',
      data: data,
      options: {
        maintainAspectRatio: false,
        responsive: true,
        plugins: {
          legend: {
            position: 'top', // Adjust legend position as needed
          },
        },
      },
    });

    const ctv = document.getElementById('myChartPie2');
    const data2 = {
      labels: ['WMAD', 'AMG', 'SMP'],
      datasets: [{
        label: '# of Students',
        data: <?php echo json_encode($count_p_based); ?>,
        backgroundColor: [
          'rgb(54,92,136)',
          'rgb(255,197,55)',
          'rgb(190,49,68)',
        ],
        hoverOffset: 4
      }]
    };

    new Chart(ctv, {
      type: 'pie',
      data: data2,
      options: {
        maintainAspectRatio: false,
        responsive: true,
        plugins: {
          legend: {
            position: 'top', // Adjust legend position as needed
          },
        },
      },
    });
  </script>


</body>

</html>