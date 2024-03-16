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

$query = mysqli_query($conn, "SELECT * FROM `contact`");
$admin_query = mysqli_query($conn, "SELECT * FROM `admin_acc` WHERE admin_id = $session_id");
$fetch = mysqli_fetch_assoc($admin_query);


if (isset($_GET['delete'])) {

    $delete_id = $_GET['delete'];
    $delete_query = mysqli_query($conn, "DELETE FROM `contact` WHERE id = $delete_id ") or die('query failed');

    if ($delete_query) {
        $message[] =
            ' <div class="alert alert-success alert-dismissible fade show" role="alert">
              <i class="bi bi-check-circle-fill"></i> Message Deleted!
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    } else {
        $message[] =
            ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <i class="bi bi-exclamation-triangle-fill"></i> Message Deletion Failed!
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
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


    <title>Admin - Specialization | Recommendation</title>

</head>

<body>

    <!-- navigation -->
    <?php include "navigation.php"; ?>
    <!-- navigation -->

    <main class="mt-5 pt-3">
        <div class="container-fluid">

            <?php

            if (isset($message)) {
                foreach ($message as $message) {
                    echo $message;
                }
            }

            ?>

            <div class="row">
                <div class="col-md-12 mb-3">
                    <div class="card">
                        <div class="card-header fs-3">
                            <span><i class="bi bi-chat-right-quote-fill"></i></span> Messages
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped data-table" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>Message ID</th>
                                            <th>Name</th>
                                            <th>email</th>
                                            <th>Message</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                                            <tr>
                                                <td><?php echo $row['id'] ?></td>
                                                <td><?php echo $row['full_name'] ?></td>
                                                <td><?php echo $row['email'] ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-sm ps-4 pe-4 my-1" data-bs-toggle="modal" data-bs-target="#viewMessage<?php echo $row['id']; ?>">View</button>
                                                    <a href="admin-view-messages.php?delete='<?php echo $row["id"]; ?>'" class="btn btn-danger btn-sm ps-3 pe-3" onclick="return confirm(" are your sure you want to delete this?");"> Delete </a>
                                                </td>
                                            </tr>

                                            <!-- Edit Question -->
                                            <div class="modal fade" id="viewMessage<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content bg-light">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-4 fw-bold" id="exampleModalLabel">Message</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p class="fw-bold fs-6">Sender: <?php echo $row['full_name']; ?></p>
                                                            <div class="container bg-white rounded pt-4 pb-2">
                                                                <p><?php echo $row['message']; ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary " data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
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

</body>

</html>