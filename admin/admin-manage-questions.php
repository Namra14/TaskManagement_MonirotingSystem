<?php

session_start();
error_reporting(0);
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
  $delete_query = mysqli_query($conn, "DELETE FROM `questions` WHERE id = $delete_id ") or die('query failed');

  if ($delete_query) {
    $message = 'Successfully removed';
  } else {
    $message = 'Question Removal Failed';
  }
}


if (isset($_POST['add'])) {
  $add_specialization = $_POST['add_specialization'];
  $add_subject = $_POST['add_subject'];
  $add_question = $_POST['add_question'];
  $add_option_a = $_POST['add_option_a'];
  $add_option_b = $_POST['add_option_b'];
  $add_option_c = $_POST['add_option_c'];
  $add_option_d = $_POST['add_option_d'];
  $add_answer = $_POST['add_answer'];

  $add_query = mysqli_query($conn, "INSERT INTO `questions`(`specialization`, `subject`, `question`, `option_a`, `option_b`, `option_c`, `option_d`, `answer`) 
  VALUES
  ('$add_specialization', '$add_subject', '$add_question', '$add_option_a', '$add_option_b', '$add_option_c', '$add_option_d', '$add_answer')");

  if ($add_query) {
    $message = 'Question Successfully Added';
  } else {
    $message = 'Failed to add the question. Please try again..';
  }
}


if (isset($_POST['update'])) {
  //Update Question
  $question_id = $_POST['question_id'];
  $specialization = $_POST['specialization'];
  $subject = $_POST['subject'];
  $question = $_POST['question'];
  $option_a = $_POST['option_a'];
  $option_b = $_POST['option_b'];
  $option_c = $_POST['option_c'];
  $option_d = $_POST['option_d'];
  $answer = $_POST['answer'];

  $update_query = mysqli_query(
    $conn,
    "UPDATE `questions` SET 
          specialization='$specialization', 
          subject='$subject',
          question='$question', 
          option_a='$option_a', 
          option_b='$option_b', 
          option_c='$option_c', 
          option_d='$option_d',
          answer='$answer'
      WHERE id='$question_id'"
  ) or die('query failed');

  if ($update_query) {
    $message = 'Question Updated Successfully';
  } else {
    $message = 'Failed to the update the question. Please try again..';
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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


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
          <h4><span class="me-2"><i class="bi bi-person-workspace"></i></span>List of Questions</h4>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12 mb-3">
          <div class="card">

            <div class="row card-header">
              <div class="d-flex justify-content-between bg-light">
                <div class="mt-2"><span><i class="bi bi-table me-2"></i></span> Question</div>
                <div>
                  <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Remove Questions
                      </a>
                      <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                          <a href="include/delete-script.php" class="dropdown-item" onclick="confirmation(event)"> All Question </a>
                          <a href="include/delete-wmad-script.php" class="dropdown-item" onclick="confirmation(event)"> WMAD Question </a>
                          <a href="include/delete-amg-script.php" class="dropdown-item" onclick="confirmation(event)"> AMG Question </a>
                          <a href="include/delete-smp-script.php" class="dropdown-item" onclick="confirmation(event)"> SMP Question </a>
                        </li>
                        <li>
                          <a class="dropdown-item" href="#"></a>
                        </li>
                      </ul>
                    </li>
                  </ul>
                </div>
              </div>
            </div>

            <div class="card-body">
              <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered data-table" style="width: 100%; text-align: center;">
                  <thead>
                    <tr>
                      <th>Specialization</th>
                      <th>Subject</th>
                      <th>Question</th>
                      <th>Choices</th>
                      <th>Answer</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php

                    $sql = "SELECT * FROM `questions`";
                    $result = mysqli_query($conn, $sql);

                    $questions = array();

                    while ($row = mysqli_fetch_assoc($result)) {
                      $questions[] = $row;
                    ?>
                      <tr>
                        <td><?php echo $row['specialization']; ?></td>
                        <td><?php echo $row['subject']; ?></td>
                        <td><?php echo $row['question']; ?></td>

                        <td class="p-3">
                          <?php
                          echo '<div class="row">';
                          echo '<div class="col-md-6">';
                          echo "a. " . $row['option_a'] . "<br>";
                          echo "b. " . $row['option_b'] . "<br>";
                          echo '</div>';

                          echo '<div class="col-md-6">';
                          echo "c. " . $row['option_c'] . "<br>";
                          echo "d. " . $row['option_d'] . "<br>";
                          echo '</div>';
                          echo '</div>';
                          ?>
                        </td>

                        <td><?php echo $row['answer']; ?></td>

                        <td>
                          <button type="button" class="btn btn-primary btn-sm ps-4 pe-4 my-1" data-bs-toggle="modal" data-bs-target="#editQuestion<?php echo $row['id']; ?>">Edit</button>
                          <a href="admin-manage-questions.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm ps-3 pe-3 my-1" onclick="confirmation(event)"> delete </a>
                        </td>
                      </tr>


                      <!-- Edit Question -->
                      <div class="modal fade" id="editQuestion<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content bg-light">
                            <div class="modal-header">
                              <h1 class="modal-title fs-4 fw-bold" id="exampleModalLabel">Edit Question</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body my-5">
                              <form action="admin-manage-questions.php" method="POST" enctype="multipart/form-data">

                                <div class="row g-3">
                                  <h6 class="g-1 px-2 fs-5 fw-bold">Question Details</h6>

                                  <input type="text" name="question_id" value="<?php echo $row['id']; ?>" hidden>

                                  <div class="col-md-6">
                                    <label for="inputSpecialization" class="form-label fw-bold">Specialization</label>
                                    <input type="text" class="form-control" id="inputSpecialization" name="specialization" value="<?php echo $row['specialization']; ?>">
                                  </div>
                                  <div class="col-md-6">
                                    <label for="inputSubject" class="form-label fw-bold">Subject</label>
                                    <input type="text" class="form-control" id="inputSubject" name="subject" value="<?php echo $row['subject']; ?>">
                                  </div>
                                  <div class="col-md-12">
                                    <label for="inputQuestion" class="form-label fw-bold">Question</label>
                                    <textarea class="form-control" id="inputQuestion" name="question" rows="3"><?php echo $row['question']; ?></textarea>
                                  </div>
                                </div>

                                <div class="row g-3 pt-4">
                                  <h6 class="g-1 px-2 fs-5 fw-bold">Choices Information</h6>
                                  <div class="col-md-6">
                                    <label for="inputA" class="form-label fw-bold">Option A</label>
                                    <input type="text" class="form-control" id="inputA" name="option_a" value="<?php echo $row['option_a']; ?>">
                                  </div>
                                  <div class="col-md-6">
                                    <label for="inputB" class="form-label fw-bold">Option B</label>
                                    <input type="text" class="form-control" id="inputB" name="option_b" value="<?php echo $row['option_b']; ?>">
                                  </div>
                                  <div class="col-md-6">
                                    <label for="inputC" class="form-label fw-bold">Option C</label>
                                    <input type="text" class="form-control" id="inputC" name="option_c" value="<?php echo $row['option_c']; ?>">
                                  </div>
                                  <div class="col-md-6">
                                    <label for="inputD" class="form-label fw-bold">Option D</label>
                                    <input type="text" class="form-control" id="inputD" name="option_d" value="<?php echo $row['option_d']; ?>">
                                  </div>
                                  <div class="col-md-12">
                                    <label for="inputAnswer" class="form-label fw-bold">Answer</label>
                                    <select name="answer" class="form-control" id="inputAnswer">
                                      <option disabled value="<?php echo $row['answer']; ?>">Answer: <?php echo $row['answer']; ?></option>
                                      <option value="option_a">Option A</option>
                                      <option value="option_b">Option B</option>
                                      <option value="option_c">Option C</option>
                                      <option value="option_d">Option D</option>
                                    </select>
                                  </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <input type="submit" class="btn btn-danger bg-danger my-3" value="Update" name="update">
                            </div>
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
                                          });
                                      </script>";
                              } else {
                                echo "<script>
                                          Swal.fire({
                                              icon: 'success',
                                              title: 'Success',
                                              text: '$message',
                                          });
                                      </script>";
                              }
                            }
                            ?>
                          </div>
                        </div>
                      </div>


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
  <button type="button" class="open-button" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Question</button>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content bg-light">
        <div class="modal-header">
          <h1 class="modal-title fs-4 fw-bold" id="exampleModalLabel">Add Question</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body my-3">
          <form action="admin-manage-questions.php" method="POST" enctype="multipart/form-data">

            <div class="row g-3">
              <h6 class="g-1 px-2 fs-5 fw-bold">Question Details</h6>

              <div class="col-md-6">
                <label for="inputSpecialization" class="form-label">Specialization</label>
                <select name="add_specialization" class="form-control" id="inputSpecialization">
                  <option disabled selected>Select the Specialization</option>
                  <option value="AMG">AMG</option>
                  <option value="SMP">SMP</option>
                  <option value="WMAD">WMAD</option>
                </select>
              </div>

              <div class="col-md-6">
                <label for="inputSubject" class="form-label">Subject</label>
                <input type="text" class="form-control" id="inputSubject" name="add_subject" value="">
              </div>
              <div class="col-md-12">
                <label for="inputQuestion" class="form-label">Question</label>
                <textarea class="form-control" id="inputQuestion" name="add_question" rows="3"></textarea>
              </div>
            </div>

            <div class="row g-3 pt-4">
              <h6 class="g-1 px-2 fs-5 fw-bold">Choices Information</h6>
              <div class="col-md-6">
                <label for="inputA" class="form-label">Option A</label>
                <input type="text" class="form-control" id="inputA" name="add_option_a" value="">
              </div>
              <div class="col-md-6">
                <label for="inputB" class="form-label">Option B</label>
                <input type="text" class="form-control" id="inputB" name="add_option_b" value="">
              </div>
              <div class="col-md-6">
                <label for="inputC" class="form-label">Option C</label>
                <input type="text" class="form-control" id="inputC" name="add_option_c" value="">
              </div>
              <div class="col-md-6">
                <label for="inputD" class="form-label">Option D</label>
                <input type="text" class="form-control" id="inputD" name="add_option_d" value="">
              </div>
              <div class="col-md-12">
                <label for="inputAnswer" class="form-label">Answer</label>
                <select name="add_answer" class="form-control" id="inputAnswer">
                  <option disabled selected>Select the Correct Answer</option>
                  <option value="option_a">Option A</option>
                  <option value="option_b">Option B</option>
                  <option value="option_c">Option C</option>
                  <option value="option_d">Option D</option>
                </select>
              </div>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-primary bg-danger my-3" value="Add" name="add">
        </div>
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
                      });
                  </script>";
          } else {
            echo "<script>
                      Swal.fire({
                          icon: 'success',
                          title: 'Success',
                          text: '$message',
                      });
                  </script>";
          }
        }
        ?>
      </div>
    </div>
  </div>



  <script src="./js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="./js/jquery-3.5.1.js"></script>
  <script src="./js/jquery.dataTables.min.js"></script>
  <script src="./js/dataTables.bootstrap5.min.js"></script>
  <script src="./js/script.js"></script>


  <script>
    function confirmation(ev) {
      ev.preventDefault();
      var urlToDirect = ev.currentTarget.getAttribute('href');

      console.log(urlToDirect);

      Swal.fire({
        title: 'Delete Question',
        text: 'Are you sure you want to delete this question?',
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
            title: 'Question Deleted',
            text: 'The question has been deleted successfully.',
            icon: 'success'
          }).then(() => {
            // Redirect to the desired URL after displaying the message
            window.location.href = urlToDirect;
          });
        }
      });
    }
  </script>
</body>

</html>