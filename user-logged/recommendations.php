<?php
   error_reporting(0);
   include "../include/config.php";
   include "../include/logic.php";

   session_start();

    $session_id = $_SESSION['id'];
	if(!isset($_SESSION['id']) || (trim($_SESSION['id']) == '')){
		header('location:../user-login.php');
		$_SESSION['message'] = "<script>alert('Please Login!')</script>";
		exit();
	}
	$query2 = mysqli_query($conn, "SELECT * FROM `students_acc` 
		WHERE userid='".$_SESSION['id']."'");
	$row = mysqli_fetch_assoc($query2);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!--Fonts-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kdam+Thmor+Pro&family=Lato:wght@400;700;900&family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!--Main Css-->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/history.css">


    <title>Recommendations</title>


</head>
<body>

    <?php include 'header.php'; ?>


    <!--3based Cards-->
    <section class="container my-5">
    <div class="container">
    <h3 class="card-title text-center display-4 p-3 fw-semibold hidden" id="recomm">Recommendations</h3>  
        
    <div class="animate-delay row row-cols-1 row-cols-md-3 g-5 my-4">
        <div class="col animate-delay hidden">
            <div class="card p-3 h-100 rounded-4" id="card-based">
                <div class="card-body">
                    <h5 class="card-title fs-3 text-center fw-normal my-4">Grade-based</h5>
                    <h3 class="text-center percent mb-4">10%</h3>
                    <p class="card-text text-center ct">Of students follow this recommendation</p>

                    <ul class="info">
                        <li>
                            <i class="bi bi-check-lg"></i> other info
                        </li>
                        <li>
                            <i class="bi bi-check-lg"></i> other info
                        </li>
                        <li>
                            <i class="bi bi-check-lg"></i> other info
                        </li>
                    </ul>

                    <div class="text-center">
                        <a href="recommendations/grade-based.php" class="btn btn-outline-success getstarted rounded-4">Get started</a>
                    </div>

                </div>
            </div>
        </div>
        <div class="col animate-delay hidden">
            <div class="card p-3 h-100 rounded-4" id="card-based">
                <div class="card-body text">
                    <h5 class="card-title fs-3 text-center fw-normal my-4 based">Assessment-based</h5>
                    <h3 class="text-center percent mb-4">50%</h3>
                    <p class="card-text ct">Of students follow this recommendation</p>

                    <ul class="info">
                        <li>
                            <i class="bi bi-check-lg"></i> other info
                        </li>
                        <li>
                            <i class="bi bi-check-lg"></i> other info
                        </li>
                        <li>
                            <i class="bi bi-check-lg"></i> other info
                        </li>
                    </ul>

                    <div class="text-center">
                        <a href="assessment.php" class="btn btn-outline-success getstarted rounded-4">Get started</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col animate-delay hidden">
            <div class="card p-3 h-100 rounded-4" id="card-based">
                <div class="card-body">
                    <h5 class="card-title fs-3 text-center fw-normal my-4">Preference-based</h5>
                    <h3 class="text-center percent mb-4">40%</h3>
                    <p class="card-text ct">Of students follow this recommendation</p>

                    <ul class="info">
                        <li>
                            <i class="bi bi-check-lg"></i> other info
                        </li>
                        <li>
                            <i class="bi bi-check-lg"></i> other info
                        </li>
                        <li>
                            <i class="bi bi-check-lg"></i> other info
                        </li>
                    </ul>

                    <div class="text-center">
                        <a href="recommendations/preference.php" class="btn btn-outline-success getstarted rounded-4">Get started</a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    </section>

    <!--Table-->
    <section>
        <div class="container my-5 hidden">
            <div class="table-responsive-sm">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col" class="th1">Compare<br>Recommendations</th>
                        <th scope="col" class="th2">Grade-based<br><span class="p1">10%</span></th>
                        <th scope="col" class="th3">Assessment-based<br><span class="p2">50%</span></th>
                        <th scope="col" class="th4">Preference-based<br><span class="p3">40%</span></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row" class="row1">Team libraries </th>
                        <td>yes</td>
                        <td>no</td>
                        <td>yes</td>
                    </tr>
                    <tr>
                        <th scope="row" class="row2">Analytic platforms</th>
                        <td>yes</td>
                        <td>no</td>
                        <td>yes</td>
                    </tr>
                    <tr>
                        <th scope="row" class="row3">System analytics</th>
                        <td>yes</td>
                        <td>no</td>
                        <td>yes</td>
                    </tr>
                    <tr>
                        <th scope="row" class="row4">Advance support services</th>
                        <td>yes</td>
                        <td>no</td>
                        <td>yes</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>


    <!--FOOTER-->
    <!--Subscribe newsletter-->
    <div class="container my-5">
        <div class="row justify-content-center mb-4">
            <div class="col-md-6">
                <h2 class="text-center mb-4 subs">Subscribe to Our Newsletter</h2>
                    <form>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Input your email" aria-label="Input your email" aria-describedby="subscribeButton">
                        <div class="input-group-append">
                                <button class="btn btn-orange subsbtn" type="button" id="subscribeButton">Subscribe</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>


    <!-- Add Bootstrap JS and jQuery links here -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MzjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="../js/index.js"></script>
    <script src="../js/app.js"></script>
</body>
</html>