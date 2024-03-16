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
$query2 = mysqli_query($conn, "SELECT * FROM `students_acc` 
		WHERE userid='" . $_SESSION['id'] . "'");
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
    <!--Carousel-->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../css/carousel.css">
    <!--Main Css-->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/history.css">


    <title>About Us</title>


</head>

<body>

    <!--Navbar-->
    <?php include 'header.php' ?>

    <!-- About -->
    <section class="bg-white text-dark p-0 text-center text-md-start" id="about">
        <div class="container">
            <div class="d-md-flex align-item-center justify-content-between">

                <div class="container about hidden">
                    <h2 class="h2 text-secondary">Specialization Recommendation System</h2>
                    <h4 class="display-5 text-dark py-2 hoverable-about" id="about">About us</h4>
                    <p class="lead paragraph text-secondary">
                        Welcome to our Specialization Recommendation System!
                        Utilizing cutting-edge AI and machine learning, we transform your aspirations into suitable learning paths.
                        Seamlessly navigating through skills and interests, we guide you towards success in an ever-changing landscape.
                        Your journey to expertise begins here.
                    </p>
                    <a href="recommendations.php" class="btn btn-button1">Get Started</a>
                </div>

                <img class="img-fluid my-5 hidden2" src="../img/computer-img2.png" alt="" id="aboutimg">
            </div>
        </div>
    </section>

    <!--Card for advertising-->
    <section>
        <div class="container my-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card border border-0 shadow overflow-hidden hidden" id="abcard">

                        <div class="row">
                            <div class="col-md-6 p-5">
                                <h2 class="text-center">Our founder's story in <br>producing good students</h2>
                                <p class="card-text">
                                    Guided by unwavering dedication and vision, our founder set out on a transformative journey to nurture exceptional students.
                                    Our educational approach emphasizes both academic excellence and character development, producing graduates who excel in their
                                    fields while embodying strong ethical values.
                                </p>

                                <div class="card mt-5 shadow d-none d-lg-block" id="smallcard">
                                    <div class="card-body p-3">
                                        <p class="card-text1 text-secondary lh-1">Data Label <span><i style="margin-left: 140px;" class="bi bi-emoji-laughing text-white border p-2 bg-custom-color rounded-3"></i></span></p>
                                        <p class="card-text2 lh-1">23, 000</p>
                                        <p class="card-text3 text-secondary lh-1"><i class="bi bi-caret-up-fill text-success"></i><span class="fw-bold"> 5.96%</span> period of change</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 p-5">
                                <div class="container">
                                    <p class="card-text">
                                        Our institution's dedication to academic rigor and nurturing empathy, social responsibility, and compassion has shaped graduates
                                        who excel professionally while being responsible, empathetic, and socially conscious citizens. This enduring legacy, established
                                        by our founder, remains at the core of our institution, molding students into exceptional individuals who positively impact the world.
                                    </p>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card-body p-3 shadow d-none d-lg-block" id="card2">
                                            <p class="card-text4"><i class="fa-solid fa-person person ps-3"></i>+ 10,567</p>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="card-body p-3 shadow d-none d-lg-block" id="card3">
                                            <p class="card-text4"><i class="fa-solid fa-person person ps-3"></i>+ 2,456</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <img src="../img/dean-img.png" alt="deanpicture" class="img d-none d-lg-block dean">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>



    <!--History-->
    <section class="container">
        <div class="container text-dark p-5 text-center">
            <h3 class="display-4 p-2" id="feature">Our History</h3>
            <div class="timeline">


                <div class="container1 left-container">
                    <img src="../img/h1.png" alt="" class="historylogo">
                    <div class="text-box">
                        <h2>2018</h2>
                        <p>
                            Separation of the Bachelor of Science in Information Technology program from the College of Engineering and Industrial Technology (CEIT).
                            Creation of the College of Computer Studies and Education (CCSE).
                        </p>
                        <span class="left-container-arrow"></span>
                    </div>
                </div>

                <div class="container1 right-container">
                    <img src="../img/h2.png" alt="" class="historylogo">
                    <div class="text-box">
                        <h2>2020</h2>
                        <p>
                            Renaming of the College to the College of Computer Studies and Information Technology.
                            Introduction of new programs including Associate in Computer Technology, Associate in Computer Secretarial, and Bachelor of Science in Secretarial Administration.
                            Commencement of extension programs and community support initiatives.
                        </p>
                        <span class="right-container-arrow"></span>
                    </div>
                </div>

                <div class="container1 left-container">
                    <img src="../img/h1.png" alt="" class="img-fluid historylogo">
                    <div class="text-box">
                        <h2>2022</h2>
                        <p>
                            Ms. Catherine A. Castillo becomes the new College dean.
                            Rebranding of the College as the College of Computer Studies.
                            Continuation of the sense of camaraderie among faculty members initiated by Dr. Mario R. Briones.
                            Introduction of new academic programs, including Bachelor of Science in Computer Science and Master of Science in Information Technology.
                            Faculty members' increasing involvement in research, writing, and presentations at conferences.
                            Expansion of extension programs to reach a broader audience.
                        </p>
                        <span class="left-container-arrow"></span>
                    </div>
                </div>

                <div class="container1 right-container">
                    <img src="../img/h2.png" alt="" class="historylogo">
                    <div class="text-box">
                        <h2>2020</h2>
                        <p>
                            Mr. Ronnel A. dela Cruz assumes the position of College Dean.
                            Sustained high performance of the College, consistently ranking among the Top 3 Performing Colleges in the university since 2014.
                            Prioritization of research presentations, collaborations, and publications.
                            Focus on program offerings, particularly the Master of Science in Infrastructure Management and Technology, aimed at enhancing graduate competency.
                            Ongoing commitment to intensify research productivity, promote technology transfer, and implement extension programs.
                            Strong support for students' holistic development to enhance their employability and produce globally competitive graduates.
                        </p>
                        <span class="right-container-arrow"></span>
                    </div>
                </div>


            </div>
    </section>


    <!--Video-->
    <div class="embed-responsive embed-responsive-16by9 mx-auto">
        <iframe class="embed-responsive-item custom-video" src="../img/video.mp4" allowfullscreen></iframe>
    </div>

    <br><br><br>

    <!--Carousel-->
    <section class="container-fluid hero-section">
        <div class="container">
            <div class="row">

                <div class="col-lg-12 col-12">
                    <div class="text-center mb-5 pb-2">
                        <h1 class="text-light">Our Team</h1>
                    </div>

                    <div class="owl-carousel owl-theme">

                        <div class="owl-carousel-info-wrap item">
                            <img src="../img/a2.jpg" class="owl-carousel-image img-fluid" alt="">
                            <div class="owl-carousel-info">
                                <h4 class="mb-2">James</h4>
                                <span class="badge">Front-End</span>
                            </div>
                            <div class="social-share">
                                <ul class="social-icon">
                                    <li class="social-icon-item">
                                        <a href="https://www.facebook.com/SantiagoAngeless" class="social-icon-link"><i class="bi bi-facebook"></i></a>
                                    </li>
                                    <li class="social-icon-item">
                                        <a href="https://www.instagram.com/james_otiago/" class="social-icon-link bi-instagram"></a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="owl-carousel-info-wrap item">
                            <img src="../img/a1.jpg" class="owl-carousel-image img-fluid" alt="">
                            <div class="owl-carousel-info">
                                <h4 class="mb-2">Paolo</h4>
                                <span class="badge">Back-End</span>
                            </div>
                            <div class="social-share">
                                <ul class="social-icon">
                                    <li class="social-icon-item">
                                        <a href="https://www.facebook.com/starpatricknot" class="social-icon-link"><i class="bi bi-facebook"></i></a>
                                    </li>
                                    <li class="social-icon-item">
                                        <a href="https://www.instagram.com/patricc.not.star/" class="social-icon-link bi-instagram"></a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="owl-carousel-info-wrap item">
                            <img src="../img/a3.jpg" class="owl-carousel-image img-fluid" alt="">
                            <div class="owl-carousel-info">
                                <h4 class="mb-2">Josef</h4>
                                <span class="badge">Project Manager</span>
                            </div>
                            <div class="social-share">
                                <ul class="social-icon">
                                    <li class="social-icon-item">
                                        <a href="https://www.facebook.com/kasparov21" class="social-icon-link"><i class="bi bi-facebook"></i></a>
                                    </li>
                                    <li class="social-icon-item">
                                        <a href="https://www.instagram.com/jsfgbrl/" class="social-icon-link bi-instagram"></a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="owl-carousel-info-wrap item">
                            <img src="../img/a2.jpg" class="owl-carousel-image img-fluid" alt="">
                            <div class="owl-carousel-info">
                                <h4 class="mb-2">James</h4>
                                <span class="badge">Front-End</span>
                            </div>
                            <div class="social-share">
                                <ul class="social-icon">
                                    <li class="social-icon-item">
                                        <a href="https://www.facebook.com/SantiagoAngeless" class="social-icon-link"><i class="bi bi-facebook"></i></a>
                                    </li>
                                    <li class="social-icon-item">
                                        <a href="https://www.instagram.com/james_otiago/" class="social-icon-link bi-instagram"></a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="owl-carousel-info-wrap item">
                            <img src="../img/a1.jpg" class="owl-carousel-image img-fluid" alt="">
                            <div class="owl-carousel-info">
                                <h4 class="mb-2">Paolo</h4>
                                <span class="badge">Back-End</span>
                            </div>
                            <div class="social-share">
                                <ul class="social-icon">
                                    <li class="social-icon-item">
                                        <a href="https://www.facebook.com/starpatricknot" class="social-icon-link"><i class="bi bi-facebook"></i></a>
                                    </li>
                                    <li class="social-icon-item">
                                        <a href="https://www.instagram.com/patricc.not.star/" class="social-icon-link bi-instagram"></a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="owl-carousel-info-wrap item">
                            <img src="../img/a3.jpg" class="owl-carousel-image img-fluid" alt="">
                            <div class="owl-carousel-info">
                                <h4 class="mb-2">Josef</h4>
                                <span class="badge">Project Manager</span>
                            </div>
                            <div class="social-share">
                                <ul class="social-icon">
                                    <li class="social-icon-item">
                                        <a href="https://www.facebook.com/kasparov21" class="social-icon-link"><i class="bi bi-facebook"></i></a>
                                    </li>
                                    <li class="social-icon-item">
                                        <a href="https://www.instagram.com/jsfgbrl/" class="social-icon-link bi-instagram"></a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>


    <br><br><br><br><br><br>


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


    <?php include 'footer.php' ?>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/19c4905dc2.js" crossorigin="anonymous"></script>
    <!-- Add Bootstrap JS and jQuery links here -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="../js/jquery.min.js"></script>
    <script src="../js/owl.carousel.min.js"></script>
    <script src="../js/custom.js"></script>
    <script src="../js/app.js"></script>
</body>

</html>