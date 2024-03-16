<?php
		
	if(isset($_POST['login'])){

		session_start();
		@include "config.php";

		$school_id = mysqli_real_escape_string($conn, $_POST['school_id']);
		$password = mysqli_real_escape_string($conn, md5($_POST['password']));

		$query = mysqli_query($conn, "SELECT * FROM `students_acc` 
		WHERE school_id='$school_id' && password='$password'");

		if (mysqli_num_rows($query) == 0){
			$_SESSION['message'] = "<script>alert('Login Failed. User not Found!')</script>";
			header('location:../user-login.php');
		}
		else{
			$row = mysqli_fetch_array($query);
			$_SESSION['id'] = $row['userid'];
			header('location:../user-logged/index.php');
		}

	}
	else{
		header('location:index.php');
		$_SESSION['message'] = "<script>alert('Please Login!')</script>";
	}

?>

