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
$admin_query = mysqli_query($conn, "SELECT * FROM `admin_acc` WHERE admin_acc.admin_id = $session_id");
$fetch = mysqli_fetch_assoc($admin_query);


// Get post data based on id
if (isset($_REQUEST['id'])) {
  $id = $_REQUEST['id'];
  $sql = "SELECT * FROM `students_acc` WHERE students_acc.userid = $id";
  $query = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($query);


  $school_id = $row['school_id'];
  $fullname = $row['fullname'];
  $year_lvl = $row['year_lvl'];
  $dp_img = $row['dp_img'];
  $wmad = $row['wmad_score'];
  $amg = $row['amg_score'];
  $smp = $row['smp_score'];
}


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


</head>

<body class="bg-light">

  <!-- navigation -->
  <?php include "navigation.php"; ?>
  <!-- navigation -->

  <main class="mt-5 pt-3">
    <div class="container-fluid mt-5" style="width: 90%;">
      <div class="card bg-white p-3 shadow">
        <!--<div class="card-header bg-transparent border-1"></div-->

        <div class="row">
          <div class="col-md-6">
            <h3 class="my-3">Students Information</h3>
            <hr>
            <table class="table table-bordered">
              <tr>
                <th width="30%" class="fs-6">Student Name</th>
                <td width="2%">:</td>
                <td class="fs-6"><?php echo $fullname; ?></td>
              </tr>
              <tr>
                <th width="30%" class="fs-6">Student ID</th>
                <td width="2%">:</td>
                <td class="fs-6"><?php echo $school_id; ?></td>
              </tr>
              <tr>
                <th width="30%" class="fs-6">Year Level</th>
                <td width="2%">:</td>
                <td class="fs-6"><?php echo $year_lvl; ?></td>
              </tr>
            </table>
          </div>

          <div class="col-md-6">
            <h3 class="my-3">Assessment Grades</h3>
            <hr>
            <table class="table table-bordered">
              <tr>
                <th width="30%" class="fs-6">AMG Assessment</th>
                <td width="2%">:</td>
                <td class="fs-6"><?php echo isset($amg) ? $amg : 'N/A'; ?></td>
              </tr>
              <tr>
                <th width="30%" class="fs-6">WMAD Assessment</th>
                <td width="2%">:</td>
                <td class="fs-6"><?php echo isset($wmad) ? $wmad : 'N/A'; ?></td>
              </tr>
              <tr>
                <th width="30%" class="fs-6">SMP Assessment</th>
                <td width="2%">:</td>
                <td class="fs-6"><?php echo isset($smp) ? $smp : 'N/A'; ?></td>
              </tr>
            </table>
          </div>
        </div>

        <nav class="my-4">
          <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Assessment Based Recommendation</button>
            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Grade Based Recommendation</button>
            <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Preference Based Recommendation</button>
          </div>
        </nav>
        <div class="tab-content p-4 border bg-light" id="nav-tabContent">
          <div class="tab-pane fade active show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <div class="">
              <div class="bg-transparent">
                <h3 class="mb-0"><i class="fa-solid fa-square-poll-vertical"></i></i> Assessment Recommendation</h3>
              </div>
              <div class="card-body pt-0">
                <?php
                if ($wmad == NULL && $amg == NULL && $smp == NULL) {
                  echo "<h2 class='text-center mt-5 mb-5'>This student have not yet taken the Grade Based Recommendation.</h2>";
                } else {
                  echo "<h3 class='text-center fs-5 pt-4'>Based on this students assessment, below are the following results.</h3>";

                  if ($wmad > $smp && $wmad > $amg) {
                    if ($smp == $amg) {
                      echo '
                      <div class="table-responsive">
                          <table class="table table-bordered bg-white my-3">
                              <tr>
                                  <th width="30%" class="fs-6">First Recommendation</th>
                                  <td width="2%">:</td>
                                  <td class="fs-6">Web and Mobile Application Development (WMAD)</td>
                              </tr>
                              <tr>
                                  <th width="30%" class="fs-6">Second Recommendation</th>
                                  <td width="2%">:</td>
                                  <td class="fs-6">Animation Motion Graphics (AMG) or Service Management Program (SMP)</td>
                              </tr>
                          </table>
                      </div>
                      ';
                      mysqli_query($conn, "UPDATE `students_acc` SET specialization='WMAD' WHERE students_acc.userid='$session_id'")
                        or die('Query Failed');
                    } else if ($amg > $smp) {
                      echo '
                      <div class="table-responsive">
                          <table class="table table-bordered bg-white my-3">
                              <tr>
                                  <th width="30%" class="fs-6">First Recommendation</th>
                                  <td width="2%">:</td>
                                  <td class="fs-6">Web and Mobile Application Development (WMAD)</td>
                              </tr>
                              <tr>
                                  <th width="30%" class="fs-6">Second Recommendation</th>
                                  <td width="2%">:</td>
                                  <td class="fs-6">Animation Motion Graphics (AMG)</td>
                              </tr>
                              <tr>
                                  <th width="30%" class="fs-6">Third Recommendation</th>
                                  <td width="2%">:</td>
                                  <td class="fs-6">Service Management Program (SMP)</td>
                              </tr>
                          </table>
                      </div>
                      ';
                      mysqli_query($conn, "UPDATE `students_acc` SET specialization='WMAD' WHERE students_acc.userid='$session_id'")
                        or die('Query Failed');
                    } else {
                      echo '
                      <div class="table-responsive">
                          <table class="table table-bordered bg-white my-3">
                              <tr>
                                  <th width="30%" class="fs-6">First Recommendation</th>
                                  <td width="2%">:</td>
                                  <td class="fs-6">Web and Mobile Application Development (WMAD)</td>
                              </tr>
                              <tr>
                                  <th width="30%" class="fs-6">Second Recommendation</th>
                                  <td width="2%">:</td>
                                  <td class="fs-6">Service Management Program (SMP)</td>
                              </tr>
                              <tr>
                                  <th width="30%" class="fs-6">Third Recommendation</th>
                                  <td width="2%">:</td>
                                  <td class="fs-6">Animation Motion Graphics (AMG)</td>
                              </tr>
                          </table>
                      </div>
                      ';
                      mysqli_query($conn, "UPDATE `students_acc` SET specialization='WMAD' WHERE students_acc.userid='$session_id'")
                        or die('Query Failed');
                    }
                  } elseif ($amg < $smp && $amg < $wmad) {
                    if ($smp == $wmad) {
                      echo '
                      <div class="table-responsive">
                          <table class="table table-bordered bg-white my-3">
                              <tr>
                                  <th width="30%" class="fs-6">First Recommendation</th>
                                  <td width="2%">:</td>
                                  <td class="fs-6">Web and Mobile Application Development (WMAD) or Service Management Program (SMP)</td>
                              </tr>
                              <tr>
                                  <th width="30%" class="fs-6">Second Recommendation</th>
                                  <td width="2%">:</td>
                                  <td class="fs-6">Animation Motion Graphics (AMG)</td>
                              </tr>
                          </table>
                      </div>
                      ';
                      mysqli_query($conn, "UPDATE `students_acc` SET specialization='AMG' WHERE students_acc.userid='$session_id'")
                        or die('Query Failed');
                    }
                  } elseif ($smp > $wmad && $smp > $amg) {
                    if ($wmad == $amg) {
                      echo '
                      <div class="table-responsive">
                          <table class="table table-bordered bg-white my-3">
                              <tr>
                                  <th width="30%" class="fs-6">First Recommendation</th>
                                  <td width="2%">:</td>
                                  <td class="fs-6">Service Management Program (SMP)</td>
                              </tr>
                              <tr>
                                  <th width="30%" class="fs-6">Second Recommendation</th>
                                  <td width="2%">:</td>
                                  <td class="fs-6">Web and Mobile Application Development (WMAD)</td>
                              </tr>
                              <tr>
                                  <th width="30%" class="fs-6">Third Recommendation</th>
                                  <td width="2%">:</td>
                                  <td class="fs-6">Animation Motion Graphics (AMG)</td>
                              </tr>
                          </table>
                      </div>
                      ';
                      mysqli_query($conn, "UPDATE `students_acc` SET specialization='SMP' WHERE students_acc.userid='$session_id'")
                        or die('Query Failed');
                    } elseif ($amg > $wmad) {
                      echo '
                      <div class="table-responsive">
                          <table class="table table-bordered bg-white my-3">
                              <tr>
                                  <th width="30%" class="fs-6">First Recommendation</th>
                                  <td width="2%">:</td>
                                  <td class="fs-6">Service Management Program (SMP)</td>
                              </tr>
                              <tr>
                                  <th width="30%" class="fs-6">Second Recommendation</th>
                                  <td width="2%">:</td>
                                  <td class="fs-6">Animation Motion Graphics (AMG)</td>
                              </tr>
                              <tr>
                                  <th width="30%" class="fs-6">Third Recommendation</th>
                                  <td width="2%">:</td>
                                  <td class="fs-6">Web and Mobile Application Development (WMAD)</td>
                              </tr>
                          </table>
                      </div>
                      ';
                      mysqli_query($conn, "UPDATE `students_acc` SET specialization='SMP' WHERE students_acc.userid='$session_id'")
                        or die('Query Failed');
                    } else {
                      echo '
                      <div class="table-responsive">
                          <table class="table table-bordered bg-white my-3">
                              <tr>
                                  <th width="30%" class="fs-6">First Recommendation</th>
                                  <td width="2%">:</td>
                                  <td class="fs-6">Service Management Program (SMP)</td>
                              </tr>
                              <tr>
                                  <th width="30%" class="fs-6">Second Recommendation</th>
                                  <td width="2%">:</td>
                                  <td class="fs-6">Web and Mobile Application Development (WMAD)</td>
                              </tr>
                              <tr>
                                  <th width="30%" class="fs-6">Third Recommendation</th>
                                  <td width="2%">:</td>
                                  <td class="fs-6">Animation Motion Graphics (AMG)</td>
                              </tr>
                          </table>
                      </div>
                      ';
                      mysqli_query($conn, "UPDATE `students_acc` SET specialization='SMP' WHERE students_acc.userid='$session_id'")
                        or die('Query Failed');
                    }
                  } elseif ($amg > $smp && $amg > $wmad) {
                    if ($smp > $wmad) {
                      echo '
                    <div class="table-responsive">
                        <table class="table table-bordered bg-white my-3">
                            <tr>
                                <th width="30%" class="fs-6">First Recommendation</th>
                                <td width="2%">:</td>
                                <td class="fs-6">Animation Motion Graphics (AMG)</td>
                            </tr>
                            <tr>
                                <th width="30%" class="fs-6">Second Recommendation</th>
                                <td width="2%">:</td>
                                <td class="fs-6">Service Management Program (SMP)</td>
                            </tr>
                            <tr>
                                <th width="30%" class="fs-6">Third Recommendation</th>
                                <td width="2%">:</td>
                                <td class="fs-6">Web and Mobile Application Development (WMAD)</td>
                            </tr>
                        </table>
                    </div>
                    ';
                      mysqli_query($conn, "UPDATE `students_acc` SET specialization='AMG' WHERE students_acc.userid='$session_id'") or die('Query Failed');
                    } else {
                      echo '
                    <div class="table-responsive">
                        <table class="table table-bordered bg-white my-3">
                            <tr>
                                <th width="30%" class="fs-6">First Recommendation</th>
                                <td width="2%">:</td>
                                <td class="fs-6">Animation Motion Graphics (AMG)</td>
                            </tr>
                            <tr>
                                <th width="30%" class="fs-6">Second Recommendation</th>
                                <td width="2%">:</td>
                                <td class="fs-6">Web and Mobile Application Development (WMAD)</td>
                            </tr>
                            <tr>
                                <th width="30%" class="fs-6">Third Recommendation</th>
                                <td width="2%">:</td>
                                <td class="fs-6">Service Management Program (SMP)</td>
                            </tr>
                        </table>
                     </div>
                    ';
                      mysqli_query($conn, "UPDATE `students_acc` SET specialization='AMG' WHERE students_acc.userid='$session_id'")
                        or die('Query Failed');
                    }
                  } elseif ($amg == $smp && $amg == $wmad) {
                    if ($amg == 0 || $smp == 0 || $wmad == 0) {
                      echo '
                      <div class="table-responsive">
                          <table class="table table-bordered bg-white my-3">
                              <tr>
                                  <th width="30%" class="fs-6">Result</th>
                                  <td width="2%">:</td>
                                  <td class="fs-6">Please Retake the assessment, Thank you.</td>
                              </tr>
                          </table>
                      </div>
                      ';
                    } else {
                      echo '
                      <div class="table-responsive">
                          <table class="table table-bordered bg-white my-3">
                              <tr>
                                  <th width="30%" class="fs-6">Recommendation</th>
                                  <td width="2%">:</td>
                                  <td class="fs-6">You are Suitable to any of the Specializations (WMAD, AMG, SMP)</td>
                              </tr>
                          </table>
                      </div>
                      ';
                      mysqli_query($conn, "UPDATE `students_acc` SET specialization='ALL' WHERE students_acc.userid='$session_id'") or die('Query Failed');
                    }
                  } else {
                    if ($smp > $wmad) {
                      echo '
                      <div class="table-responsive">
                          <table class="table table-bordered bg-white my-3">
                              <tr>
                                  <th width="30%" class="fs-6">First Recommendation</th>
                                  <td width="2%">:</td>
                                  <td class="fs-6">Service Management Program (SMP) or Animation Motion Graphics (AMG)</td>
                              </tr>
                              <tr>
                                  <th width="30%" class="fs-6">Second Recommendation</th>
                                  <td width="2%">:</td>
                                  <td class="fs-6">Web and Mobile Application Development (WMAD)</td>
                              </tr>
                          </table>
                      </div>
                      ';
                      mysqli_query($conn, "UPDATE `students_acc` SET specialization='SMP/AMG' WHERE students_acc.userid='$session_id'")
                        or die('Query Failed');
                    } elseif ($amg > $smp) {
                      echo '
                      <div class="table-responsive">
                          <table class="table table-bordered bg-white my-3">
                              <tr>
                                  <th width="30%" class="fs-6">First Recommendation</th>
                                  <td width="2%">:</td>
                                  <td class="fs-6">Animation Motion Graphics (AMG) or Web and Mobile Application Development (WMAD)</td>
                              </tr>
                              <tr>
                                   <th width="30%" class="fs-6">Second Recommendation</th>
                                  <td width="2%">:</td>
                                  <td class="fs-6">Service Management Program (SMP)</td>
                              </tr>
                          </table>
                      </div>
                      ';
                      mysqli_query($conn, "UPDATE `students_acc` SET specialization='AMG/WMAD' WHERE students_acc.userid='$session_id'")
                        or die('Query Failed');
                    } elseif ($wmad > $smp) {
                      echo '
                      <div class="table-responsive">
                          <table class="table table-bordered bg-white my-3">
                              <tr>
                                  <th width="30%" class="fs-6">First Recommendation</th>
                                  <td width="2%">:</td>
                                  <td class="fs-6">Web and Mobile Application Development (WMAD) or Service Management Program (SMP)</td>
                              </tr>
                              <tr>
                                  <th width="30%" class="fs-6">Second Recommendation</th>
                                  <td width="2%">:</td>
                                  <td class="fs-6">Animation Motion Graphics (AMG)</td>
                              </tr>
                          </table>
                      </div>
                      ';
                      mysqli_query($conn, "UPDATE `students_acc` SET specialization='WMAD/SMP' WHERE students_acc.userid='$session_id'")
                        or die('Query Failed');
                    }
                  }
                }
                ?>
              </div>
            </div>
          </div>

          <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            <div class="bg-transparent">
              <h3 class="mb-0"><i class="fa-solid fa-user-graduate"></i> Grade Based Recommendation</h3>
            </div>
            <?php if ($row['grade_based'] != NULL) { ?>
              <div class="card-body pt-0">

                <div>
                  <p class="fs-5">Based on the students provided grades, the most suitable specialization for is <span class="text-dark fw-bold"><?php echo $row['grade_based']; ?></span></p>
                </div>
                <div class="table-responsive">
                  <table class="table table-bordered bg-white my-2">
                    <tr>
                      <th class="fs-6">ITEC102</th>
                      <td width="1%">:</td>
                      <td class="fs-6"><?php echo $row['itec102']; ?></td>
                      <th class="fs-6">ITEC103</th>
                      <td width="1%">:</td>
                      <td class="fs-6"><?php echo $row['itec103']; ?></td>
                      <th class="fs-6">ITEC205</th>
                      <td width="1%">:</td>
                      <td class="fs-6"><?php echo $row['itec205']; ?></td>
                    </tr>
                    <tr>
                      <th class="fs-6">ITEL201</th>
                      <td width="1%">:</td>
                      <td class="fs-6"><?php echo $row['itel201']; ?></td>
                      <th class="fs-6">ITEC204</th>
                      <td width="1%">:</td>
                      <td class="fs-6"><?php echo $row['itec204']; ?></td>
                      <th class="fs-6">ITEP204</th>
                      <td width="1%">:</td>
                      <td class="fs-6"><?php echo $row['itep204']; ?></td>
                    </tr>
                    <tr>
                      <th class="fs-6">GEC106</th>
                      <td width="1%">:</td>
                      <td class="fs-6"><?php echo $row['gec106']; ?></td>
                      <th class="fs-6">ITEP205</th>
                      <td width="1%">:</td>
                      <td class="fs-6"><?php echo $row['itep205']; ?></td>
                      <th class="fs-6">ITEL203</th>
                      <td width="1%">:</td>
                      <td class="fs-6"><?php echo $row['itel203']; ?></td>
                    </tr>
                    <tr>
                      <th class="fs-6">GEC108</th>
                      <td width="1%">:</td>
                      <td class="fs-6"><?php echo $row['gec108']; ?></td>
                      <th class="fs-6">ITEP203</th>
                      <td width="1%">:</td>
                      <td class="fs-6"><?php echo $row['itep203']; ?></td>
                      <th class="fs-6">ITEP207</th>
                      <td width="1%">:</td>
                      <td class="fs-6"><?php echo $row['itep207']; ?></td>
                    </tr>
                  </table>
                </div>
              </div>
            <?php } else { ?>
              <div class="container my-5">
                <h2 class="text-center">This student have not yet taken the Grade Based Recommendation.</h2>
              </div>
            <?php } ?>
          </div>

          <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
            <div class="bg-transparent">
              <h3 class="mb-0"><i class="fa-regular fa-thumbs-up"></i> Preference Based Recommendation</h3>
            </div>
            <?php if ($row['grade_based'] != "") { ?>
              <div class="card-body pt-0">
                <div>
                  <p class="text-center fs-5">Based on your selected preferences, the recommended specialization for you is <span class="text-dark fw-bold"><?php echo $row['preference_based']; ?></span></p>
                </div>
                <div class="container-fluid bg-white rounded-4 p-3">
                  <p class="lead"><?= $row['pref_based_desc']; ?></p>
                </div>
              </div>
            <?php } else { ?>
              <div class="container my-5">
                <h2 class="text-center">This student have not yet taken the Preference Based Recommendation.</h2>
              </div>
            <?php } ?>
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
  <script src="https://kit.fontawesome.com/2895031f15.js" crossorigin="anonymous"></script>


</body>

</html>