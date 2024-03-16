<?php
error_reporting(0);
include "../include/config.php";
include "../include/logic.php";

session_start();

$session_id = $_SESSION['id'];
if (!isset($_SESSION['id']) || (trim($_SESSION['id']) == '')) {
    header('location:../user-login.php');
    $_SESSION['message'] = "<script>alert('Please Login!')</script>";
    exit();
}

$query = mysqli_query($conn, "SELECT * FROM `students_acc` 
                                  WHERE userid='" . $_SESSION['id'] . "'");

$row = mysqli_fetch_assoc($query);

$full_name = $row['fullname'];

if (isset($_POST['submit'])) {
    $fullname = $full_name;
    $email = $_POST['email'];
    $message = $_POST['message'];

    $insert_query = mysqli_query($conn, "INSERT INTO `contact` (full_name, email, message) 
    VALUES
    ('$fullname', '$email', '$message')");

    if ($insert_query) {
        $msg = 'Message Sent!';
    } else {
        $_msg = 'Failed to send message. Please try again..';
    }
}

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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <title>Contact</title>


</head>

<body>

    <!--Navbar-->
    <?php include 'header.php'; ?>

    <!--CONTACT-->
    <section class="bg-custom-img">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 login-section border-light m-5 hidden">
                    <div class="login-form">
                        <h2 class="text-light text-center text-md-start my-4 get fs-3">Get in touch with Admin</h2>
                        <form method="POST" action="contact.php">
                            <div class="mb-3">
                                <label for="username" class="form-label text-light">Your name</label>
                                <input type="text" class="form-control" id="username" name="username" value="<?php echo $full_name; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label text-light">Your email</label>
                                <input type="text" class="form-control" placeholder="youremail@email.com" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label text-light">How can we help?</label>
                                <textarea class="form-control" placeholder="Enter your message here" id="message" name="message" rows="4"></textarea>
                            </div>
                            <div class="d-flex justify-content-center align-items-center mt-4 mb-4">
                                <button type="submit" name="submit" class="btn btn-success" id="send">Send my message</button>
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
                                                text: '$msg',
                                            });
                                        </script>";
                            } else {
                                echo "<script>
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Success',
                                                text: '$msg',
                                            });
                                        </script>";
                            }
                        }
                        ?>

                    </div>
                </div>

                <div class="col-md-3 py-4">
                    <img src="../img/contactimg.png" alt="" height="600px" width="600px" class="image-fluid cimg d-none d-lg-block hidden2">
                </div>
            </div>
        </div>
    </section>

    <!--Contact cards-->
    <section class="my-5">
        <div class="container hidden">
            <h5 class="c-heading py-5">Get in touch anytime</h5>
            <div class="row">
                <div class="col-md-3">
                    <div class="card" id="fc">
                        <div class="card-body">
                            <h5 class="card-title" id="cont">Email</h5>
                            <p class="card-text" id="cp"><i class="bi bi-envelope clogo"></i> youremail@emial.com</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card" id="fc">
                        <div class="card-body">
                            <h5 class="card-title" id="cont"> Phone</h5>
                            <p class="card-text" id="cp"><i class="bi bi-telephone clogo"> </i> +1 (123) 456-78990</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card" id="fc">
                        <div class="card-body">
                            <h5 class="card-title" id="cont">Fax</h5>
                            <p class="card-text" id="cp"><i class="bi bi-file-earmark clogo"> </i> (123) 456-78990</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card" id="fc">
                        <div class="card-body">
                            <h5 class="card-title" id="cont">Address</h5>
                            <p class="card-text" id="cp"><i class="bi bi-geo-alt clogo"></i> PH</p>
                        </div>
                    </div>
                </div>
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