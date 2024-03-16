<?php

session_start();
include "include/config.php";

if (isset($_POST['submit'])) {
	$school_id = mysqli_real_escape_string($conn, $_POST['school_id']);
	$fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
	$year_lvl = mysqli_real_escape_string($conn, $_POST['year_lvl']);
	$password = mysqli_real_escape_string($conn, md5($_POST['password']));
	$cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));

	$select = mysqli_query($conn, "SELECT * FROM `students_acc` WHERE school_id = '$school_id' AND password = '$password'") or die("query failed");

	if ($password == $cpass) {
		if (mysqli_num_rows($select) > 0) {
			$message = 'User already exists! Please try again';
		} else {
			mysqli_query($conn, "INSERT INTO `students_acc` (school_id, fullname, year_lvl, password) VALUES ('$school_id','$fullname','$year_lvl', '$password')") or die("query failed");
			$message = "User Registration Complete!";
		}
	} else {
		$message = "Password not matched! Please try again!";
	}
}

?>



<!doctype html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


	<link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
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
	<link rel="stylesheet" href="css/blog.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/login.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<style>
		.overlay {
			position: fixed;
			top: 0;
			bottom: 0;
			left: 0;
			right: 0;
			background: rgba(0, 0, 0, 0.7);
			transition: visibility 0s, opacity 0.5s ease-in-out;
			visibility: hidden;
			opacity: 0;
			z-index: 9999;
		}

		.overlay:target {
			visibility: visible;
			opacity: 1;
		}

		.modal-content {
			margin-top: 10%;
			margin-left: 37%;
			padding: 1%;
			width: 30%;
			background-color: #e7e7e7;
			border-radius: 5px;
		}

		.modal-content p {
			text-align: left;
			font-size: 16px;
			padding-left: 4%;
			padding-right: 4%;
		}

		.overlay:target {
			visibility: visible;
			opacity: 1;
		}
	</style>

	<title>Login/Register</title>


</head>

<body>

	<div class="section">
		<div class="container">
			<div class="row full-height justify-content-center">
				<div class="col-12 text-center align-self-center py-5">
					<div class="section pb-5 pt-5 pt-sm-2 text-center">

						<h6 class="mb-0 py-3">
							<span class="text-dark bg-light border rounded-pill me-3 p-2">Log In </span>
							<span class="text-dark bg-light border rounded-pill me-3 p-2">Sign Up</span>
						</h6>
						<input class="checkbox" type="checkbox" id="reg-log" name="reg-log" />
						<label for="reg-log"></label>

						<div class="card-3d-wrap mx-auto">
							<div class="card-3d-wrapper">

								<form class="card-front" action="include/login.php" method="POST">
									<div class="center-wrap">
										<div class="section text-center text-dark">
											<h4 class="mb-4 pb-3">Log In</h4>
											<div class="form-group my-3">
												<input type="text" class="form-style" placeholder="School ID" name="school_id">
												<i class="input-icon uil uil-at"></i>
											</div>
											<div class="form-group mt-2">
												<input type="password" class="form-style" placeholder="Password" name="password">
												<i class="input-icon uil uil-lock-alt"></i>
											</div>
											<input type="submit" value="Login" name="login" class="btn mt-4 text-light"></input>
										</div>
									</div>
								</form>

								<form class="card-back" action="" name="register" method="POST" id="register">
									<div class="center-wrap">
										<div class="section text-center text-dark">
											<h4 class="my-3 pb-3">Sign Up</h4>
											<div class="form-group">
												<input type="text" class="form-style" placeholder="Full Name" id="fullname" name="fullname">
												<i class="input-icon uil uil-user"></i>
											</div>
											<div class="form-group mt-2">
												<input type="text" class="form-style" placeholder="School ID" id="school_id" name="school_id">
												<i class="input-icon uil uil-at"></i>
											</div>
											<div class="form-group mt-2">
												<select class="form-style" id="year_lvl" name="year_lvl">
													<option selected disabled>Year Level</option>
													<option value="1ST YEAR">1ST YEAR</option>
													<option value="2ND YEAR">2ND YEAR</option>
													<option value="3RD YEAR">3RD YEAR</option>
													<option value="4TH YEAR">4TH YEAR</option>
												</select>
												<i class="input-icon fa-solid fa-graduation-cap mx-1"> </i>
											</div>
											<div class="form-group mt-2">
												<input type="password" class="form-style" placeholder="Password" id="password" name="password">
												<i class="input-icon uil uil-lock-alt"></i>
											</div>
											<div class="form-group mt-2">
												<input type="password" class="form-style" placeholder="Confirm Password" id="cpassword" name="cpassword">
												<i class="input-icon uil uil-lock-alt"></i>
											</div>
											<div class="form-group mt-2">
												<label for="terms">
													<p>By signing up, you agree to our <a href="user-login.php#divOne">Terms and Agreements</a></p>
												</label>
											</div>
											<input type="submit" value="Sign Up" name="submit" class="btn text-light" onclick="return validateForm()"></input>
										</div>
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
				</div>
			</div>
		</div>
	</div>

	<div class="container-fluid overlay" id="divOne">
		<div class="modal-content">
			<h4 class="text-dark my-3">Terms and Agreement</h4>
			<p class="text-dark">
				By signing up for the Specializations Recommendation System, you agree to our terms and conditions.
				You must provide accurate information during registration, maintain the confidentiality of your account, and agree
				to our data collection and privacy policy. The specialization recommendations provided are advisory and should not
				replace professional academic or career counseling. <br><br> All system content is protected by copyright, and you may not
				use it without permission. We reserve the right to terminate or suspend accounts at our discretion, and we encourage
				feedback for improvement. You are responsible for reviewing and accepting any updated terms, and you acknowledge the
				system is provided "as is," with no warranties.
			</p>
			<hr>
			<a class="btn btn-primary text-light px-3" href="#">Close</a>
		</div>
	</div>


</body>

</html>