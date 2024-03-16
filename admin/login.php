<?php
		
	if(isset($_POST['login'])){

		session_start();
		@include "config.php";

		$admin_username = mysqli_real_escape_string($conn, $_POST['admin_username']);
		$password = mysqli_real_escape_string($conn, md5($_POST['password']));

		$query = mysqli_query($conn, "SELECT * FROM `admin_acc` WHERE admin_username='$admin_username' && password='$password'");

		if (mysqli_num_rows($query) == 0){
			$_SESSION['message'] = "<script>alert('Login Failed. User not Found!')</script>";
			header('location:../admin/index.php');
		}
		else{
			$row = mysqli_fetch_array($query);
			$_SESSION['id'] = $row['admin_id'];
			header('location:../admin/admin-dashboard.php');
		}

	}
	else{
		header('location:index.php');
		$_SESSION['message'] = "<script>alert('Please Login!')</script>";
	}

?>

