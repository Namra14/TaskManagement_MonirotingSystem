<?php

include "../include/config.php";
include "header.php";

#error_reporting(0);

session_start();

if (!isset($_SESSION['id']) || (trim($_SESSION['id']) == '')) {
    header('location:index.php');
    $_SESSION['message'] = "<script>alert('Please Login!')</script>";
    exit();
}

$query = mysqli_query($conn, "SELECT * FROM `students_acc` 
		WHERE userid='" . $_SESSION['id'] . "'");
$row = mysqli_fetch_assoc($query);

include "../include/logic.php";

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Blog</title>

    <!-- Animation bootstrap.min -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
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
    <link rel="stylesheet" href="../css/blog.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <div class="container p-5 my-5 bg-dark text-white animate__animated animate__fadeIn animate__slower">
        <div class="container mt-2">
            <h1 class="text-center">Update Blog</h1>
            <?php foreach ($query as $q) { ?>
                <form method="POST">
                    <input type="text" hidden value='<?php echo $q['id'] ?>' name="id">
                    <textarea placeholder="Blog Title" class="form-control my-3 bg-light text-dark text-center" name="title" cols="30" rows="2">
                    	<?php echo $q['title'] ?>                   		
                    </textarea>
                    <textarea name="intro" placeholder="Insert your Introduction here" class="form-control my-3 bg-light text-dark" cols="30" rows="4">
                        <?php echo $q['introduction'] ?>
                    </textarea>
                    <textarea name="main_content" class="form-control my-3 bg-light text-dark" cols="30" rows="15">
                        <?php echo $q['content'] ?>                            
                    </textarea>
                    <textarea name="conclusion" placeholder="Insert your Conclusion here" class="form-control my-3 bg-light text-dark" cols="30" rows="7">
                        <?php echo $q['conclusion'] ?>                          
                    </textarea>
                    <button style="border-radius: 10px;"><a href="index.php#blogs" style="margin: 0;" class="btn btn-light">Go Back</a></button>
                    <button name="update" style="border-radius: 10px; margin-left: 10px;"><a style="margin: 0;" class="btn btn-light">Update</a></button>
                </form>
            <?php } ?>
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
                      }).then((result) => {
                        if (result.isConfirmed) {
                            // Redirect to another page here
                            window.location.href = 'index.php#blogs';
                        }
                    });
                  </script>";
                }
            }
            ?>
        </div>
    </div>


    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>