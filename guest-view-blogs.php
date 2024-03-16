<?php

	include "include/config.php";

	error_reporting(0);
    
	include "include/logic.php";

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>View Blogs</title>
	
    <!-- Animation bootstrap.min -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
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
</head>
	
<body>

    <?php include 'include/header.php'; ?>
		
	<div class="container mt-5">

        <?php foreach($query as $q){?>
            <div class="bg-dark p-5 rounded-lg text-white text-center animate__animated animate__backInDown animate__slow">
                <h1><?php echo $q['title'];?></h1>

                <?php if($row['fullname'] == $q['content_creator'] ){ ?>
	                <div class="d-flex mt-2 justify-content-center align-items-center animate__animated animate__backInDown animate__slow">
	                    <a href="guest-view-blogs.php?id=<?php echo $q['id']?>" class="btn btn-light btn-sm" style="width:7%" name="edit">Edit</a>	                    
	                    <form method="POST">
	                        <input type="text" hidden value='<?php echo $q['id']?>' name="id">
	                        <button class="btn btn-danger btn-sm ml-2" name="delete">Delete</button>
	                    </form>                  
	                </div>
                <?php } ?>

            </div>
            <p class="mt-5 border-left border-dark pl-3 animate__animated animate__backInLeft animate__slower"><?php echo $q['introduction'];?></p>
            <p class="mt-5 border-left border-dark pl-3 animate__animated animate__backInRight animate__slower"><?php echo $q['content'];?></p>
            <p class="mt-5 border-left border-dark pl-3  animate__animated animate__backInUp animate__slower"><?php echo $q['conclusion'];?></p>
        <?php } ?>    

        <a href="index.php#blogs" class="btn btn-outline-dark my-3 mb-5  animate__animated animate__backInUp animate__slower">Go Back</a>
   </div>


	<!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/19c4905dc2.js" crossorigin="anonymous"></script>
    <!-- Add Bootstrap JS and jQuery links here -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="js/jquery.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/app.js"></script>
</body>
</html>