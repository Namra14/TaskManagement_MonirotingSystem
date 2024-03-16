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

$query = mysqli_query($conn, "SELECT * FROM `students_acc` WHERE grade_based IS NOT NULL");
$admin_query = mysqli_query($conn, "SELECT * FROM `admin_acc` WHERE admin_acc.admin_id = $session_id");
$fetch = mysqli_fetch_assoc($admin_query);

//Upload Grades Dataset
if (isset($_POST['upload_dataset'])) {
    //Update Profile Picture
    $dataset_upload_date = $_POST['dataset_upload_date'];
    $insert_dataset = $_FILES['insert_dataset']['name'];
    $insert_dataset_size = $_FILES['insert_dataset']['size'];
    $insert_dataset_tmp_name = $_FILES['insert_dataset']['tmp_name'];
    $insert_dataset_folder = '../user-logged/recommendations/dataset/' . $insert_dataset;

    if (!empty($insert_dataset)) {
        if ($insert_dataset_size > 2000000) {
            $message = 'File size is too large. Please try again..';
        } else {
            $message = 'Dataset Successfully Uploaded to the server!';
            $insert_dataset_query = mysqli_query($conn, "INSERT INTO `grades_dataset` (dataset_name, dataset_upload_date) VALUES  ('$insert_dataset', '$dataset_upload_date')") or die('query failed');
            if ($insert_dataset_query) {
                move_uploaded_file($insert_dataset_tmp_name, $insert_dataset_folder);
            }
        }
    }
}

//Update Grades Dataset that is fed to the ML Model
if (isset($_POST['update_dataset'])) {
    $ml_dataset_update = $_POST['update_ml_dataset'];
    $ml_update_query = mysqli_query($conn, "UPDATE `ml_feed_dataset` SET uploaded_dataset_name='$ml_dataset_update' WHERE id='1'");

    if ($ml_update_query) {
        $message = 'Dataset Updated Successfully!';
    } else {
        $message = 'Failed to update dataset. Please try again..';
    }
}

if (isset($_GET['delete'])) {

    $delete_id = $_GET['delete'];
    $select_query = mysqli_query($conn, "SELECT * FROM `grades_dataset` WHERE grades_dataset.id = $delete_id") or die('query failed');
    $select_row = mysqli_fetch_assoc($select_query);
    $ds_name = $select_row['dataset_name'];

    $file_path = "../user-logged/recommendations/dataset/" . $ds_name;
    if (!unlink($file_path)) {
    } else {
        $delete_query = mysqli_query($conn, "DELETE FROM `grades_dataset` WHERE grades_dataset.id = $delete_id") or die('query failed');

        if ($delete_query) {
            $message = 'Dataset Removed Successfully';
        } else {
            $message = 'Dataset deletion failed. Please try again..';
        };
    }
};



$data_query = mysqli_query($conn, "SELECT * FROM `grades_dataset`");
$data_row = mysqli_fetch_assoc($data_query);

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
        #btnExport {
            padding: 5px 15px;
            margin-top: 5px;
            margin-bottom: 5px;
            border: none;
            background-color: green;
            color: #fff;
            border-radius: 3px;
        }
    </style>

</head>

<body>

    <!-- navigation -->
    <?php include "navigation.php";
    ?>
    <!-- navigation -->

    <main class="mt-5 pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 mt-2 mb-2">
                    <h4><span class="me-2"><i class="bi bi-people"></i></span>List of Grades</h4>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mb-3">
                    <nav class="my-2">
                        <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Grades Data Table</button>
                            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Update ML Dataset</button>
                            <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Dataset List</button>
                        </div>
                    </nav>
                    <div class="tab-content border bg-light" id="nav-tabContent">
                        <div class="tab-pane fade active show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="">
                                <div class="row card-header mx-0">
                                    <div class="d-flex justify-content-between">
                                        <div class="mt-2"><span><i class="fa-solid fa-server"></i></span> Data</div>
                                        <div>
                                            <button id="btnExport" type="button"><i class="fa fa-file-csv"></i> Export Data</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="table" class="table table-striped data-table" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th class="fs-6">ITEC102</th>
                                                    <th class="fs-6">ITEC103</th>
                                                    <th class="fs-6">ITEC205</th>
                                                    <th class="fs-6">ITEL201</th>
                                                    <th class="fs-6">ITEC204</th>
                                                    <th class="fs-6">ITEP204</th>
                                                    <th class="fs-6">GEC106</th>
                                                    <th class="fs-6">ITEP205</th>
                                                    <th class="fs-6">ITEL203</th>
                                                    <th class="fs-6">GEC108</th>
                                                    <th class="fs-6">ITEP203</th>
                                                    <th class="fs-6">ITEP207</th>
                                                    <th class="fs-6">Student's Choice</th>
                                                    <th class="fs-6">Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($query as $row) {
                                                ?>
                                                    <tr>
                                                        <td class="fs-6"><?php echo $row['itec102']; ?></td>
                                                        <td class="fs-6"><?php echo $row['itec103']; ?></td>
                                                        <td class="fs-6"><?php echo $row['itec205']; ?></td>
                                                        <td class="fs-6"><?php echo $row['itel201']; ?></td>
                                                        <td class="fs-6"><?php echo $row['itec204']; ?></td>
                                                        <td class="fs-6"><?php echo $row['itep204']; ?></td>
                                                        <td class="fs-6"><?php echo $row['gec106']; ?></td>
                                                        <td class="fs-6"><?php echo $row['itep205']; ?></td>
                                                        <td class="fs-6"><?php echo $row['itel203']; ?></td>
                                                        <td class="fs-6"><?php echo $row['gec108']; ?></td>
                                                        <td class="fs-6"><?php echo $row['itep203']; ?></td>
                                                        <td class="fs-6"><?php echo $row['itep207']; ?></td>
                                                        <td class="fs-6"><?php echo $row['student_choice']; ?></td>
                                                        <td><?php echo $row['finalization_date']; ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="bg-transparent p-3">
                                <h4 class="mb-0"><i class="bi bi-gear-fill"></i> Machine Learning Configuration</h4>
                            </div>
                            <div class="container-fluid bg-custom-color rounded-4 text-dark border">
                                <div class="row m-3 p-3 bg-white">
                                    <div class="col-md-3">
                                        <h1 class="display-3 fw-semibold mx-5">Instruction</h1>
                                    </div>
                                    <div class="col-md-9 px-5">
                                        <p class="lead">
                                            To update the machine learning model with a new dataset from the server, first is to export the dataset
                                            from the grades data table, upload the exported dataset, update the model, test and monitor its performance,
                                            then document the changes for reference.
                                        </p>
                                    </div>
                                </div>
                                <div class="row m-2 p-2">
                                    <div class="col-md-6 mb-3">
                                        <div class="container-fluid bg-white rouded-4 p-4 text-dark rounded-bottom-5">
                                            <form method="POST" action="#" enctype="multipart/form-data">

                                                <div class="mb-3">
                                                    <label for="insert_dataset" class="form-label">Upload the Exported Dataset</label>
                                                    <input type="file" class="form-control" id="insert_dataset" name="insert_dataset" accept=".csv">

                                                    <?php
                                                    $month = date('m');
                                                    $day = date('d');
                                                    $year = date('Y');

                                                    $today = $year . '-' . $month . '-' . $day;
                                                    ?>

                                                    <input type="date" value="<?php echo $today; ?>" class="form-control" id="date" name="dataset_upload_date" hidden>
                                                </div>

                                                <input type="submit" class="btn btn-primary" name="upload_dataset" value="Upload Dataset">
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="container-fluid bg-white rouded-4 p-4 text-dark rounded-bottom-5">
                                                <form method="POST" action="#" enctype="multipart/form-data">

                                                    <div class="mb-3">
                                                        <label for="update_ml_dataset" class="form-label">Update Machine Learning Dataset</label>

                                                        <select class="form-select" id="inputYear" aria-label="Floating label disabled select example" name="update_ml_dataset" required>
                                                            <?php foreach ($data_query as $data_row) { ?>
                                                                <option value="<?php echo $data_row['dataset_name']; ?>"><?php echo $data_row['dataset_name']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>

                                                    <input type="submit" class="btn btn-warning text-light" name="update_dataset" value="Update Dataset">
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                </div>


                            </div>
                        </div>

                        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                            <div class="row card-header mx-0">
                                <div class="bg-transparent p-3">
                                    <h4 class="mb-0"><i class="bi bi-clipboard-data"></i> Dataset List</h4>
                                </div>
                            </div>
                            <div class="card-body pt-3">
                                <table id="table" class="table table-striped data-table" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th class="fs-6">ID</th>
                                            <th class="fs-6">Dataset Name</th>
                                            <th class="fs-6">Upload Date</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($data_query as $data_row) {
                                        ?>
                                            <tr>
                                                <td class="fs-6"><?php echo $data_row['id']; ?></td>
                                                <td class="fs-6"><?php echo $data_row['dataset_name']; ?></td>
                                                <td class="fs-6"><?php echo $data_row['dataset_upload_date']; ?></td>
                                                <td class="">
                                                    <a href="admin-grades-data.php?delete=<?php echo $data_row['id']; ?>" class="text-danger pe-3" onclick="confirmation(event)"><i class="fa-solid fa-xmark fs-4"></i></a>
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
    </main>

    <script>
        class csvExport {
            constructor(table, header = true) {
                this.table = table;
                this.rows = Array.from(table.querySelectorAll("tr"));
                if (!header && this.rows[0].querySelectorAll("th").length) {
                    this.rows.shift();
                }
            }

            exportCsv() {
                const lines = [];
                const ncols = this._longestRow();
                for (const row of this.rows) {
                    let line = "";
                    for (let i = 0; i < ncols - 1; i++) { // Adjusted loop to exclude the last column
                        if (row.children[i] !== undefined) {
                            line += csvExport.safeData(row.children[i]);
                        }
                        line += i !== ncols - 2 ? "," : "";
                    }
                    lines.push(line);
                }
                return lines.join("\n");
            }

            _longestRow() {
                return this.rows.reduce((length, row) => (row.childElementCount > length ? row.childElementCount : length), 0);
            }

            static safeData(td) {
                let data = td.textContent;
                data = data.replace(/"/g, `""`);
                data = /[",\n"]/.test(data) ? `"${data}"` : data;
                return data;
            }
        }

        const btnExport = document.querySelector("#btnExport");
        const tableElement = document.querySelector("#table");

        btnExport.addEventListener("click", () => {
            const obj = new csvExport(tableElement);
            const csvData = obj.exportCsv();
            const currentDate = new Date().toISOString().slice(0, 10);
            const fileName = `grades_data_${currentDate}.csv`;

            const blob = new Blob([csvData], {
                type: "text/csv"
            });
            const url = URL.createObjectURL(blob);
            const a = document.createElement("a");
            a.href = url;
            a.download = fileName;
            a.click();

            setTimeout(() => {
                URL.revokeObjectURL(url);
            }, 500);
        });
    </script>


    <?php
    // Use an if-else statement to display SweetAlert2 message for success or failure
    if (!empty($message)) {
        if (strpos($message, 'Error') !== false) {
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
                    }).then(function () {
                        // Reload the page after the SweetAlert2 modal is closed
                        window.location.href = 'admin-grades-data.php';
                    });
                </script>";
        }
    }
    ?>


    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="./js/jquery-3.5.1.js"></script>
    <script src="./js/jquery.dataTables.min.js"></script>
    <script src="./js/dataTables.bootstrap5.min.js"></script>
    <script src="./js/script.js"></script>
    <script src="https://kit.fontawesome.com/2895031f15.js" crossorigin="anonymous"></script>


</body>

</html>