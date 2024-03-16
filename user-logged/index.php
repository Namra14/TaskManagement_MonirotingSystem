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
    <!--Main Css-->
    <link rel="stylesheet" href="../css/blog.css">
    <link rel="stylesheet" href="../css/style.css">



    <title>Specialization | Recommendation</title>


</head>

<body>

    <?php include 'header.php'; ?>

    <!--Showcase-->
    <section class="showcase bg-custom-img text-light p-5 text-center">
        <div class="container" id="showcase">
            <h3 class="lead pt-4 h3 text-light hidden">College of Computer Studies</h3>
            <h1 class="h1 text-center hidden">Specialization</h1>
            <h1 class="h1 text-center hidden">Recommendation</h1>

            <div class="container mt-5">
                <a href="recommendations.php" class="btn btn-button hidden">Get Started</a>

                <div class="image-container">
                    <img src="../img/icons/wmad.png" class="img-fluid d-none d-lg-block position1">
                    <img src="../img/icons/amg.png" class="img-fluid d-none d-lg-block position2">
                    <img src="../img/icons/smp.png" class="img-fluid bg-white d-none d-lg-block position3">
                    <img src="../img/icons/wmad3.png" class="img-fluid d-none d-lg-block position4">
                    <img src="../img/icons/amg2.png" class="img-fluid d-none d-lg-block position5">
                    <img src="../img/icons/smp2.png" class="img-fluid d-none d-lg-block position6">
                    <img src="../img/icons/amg3.png" class="img-fluid d-none d-lg-block position7">
                </div>

            </div>
        </div>
    </section>


    <!-- About -->
    <section class="bg-white text-dark p-5 text-center text-md-start" id="about">
        <div class="container">
            <div class="d-md-flex align-item-center justify-content-between">

                <div class="container about">
                    <h2 class="h2 text-secondary hidden">Specialization Recommendation System</h2>
                    <h4 class="display-5 text-dark py-2 hoverable-about hidden" id="about">About us</h4>
                    <p class="lead paragraph text-secondary hidden">
                        Welcome to our Specialization Recommendation System!
                        Utilizing cutting-edge AI and machine learning, we transform your aspirations into tailored learning paths.
                        Seamlessly navigating through skills and interests, we guide you towards success in an ever-changing landscape.
                        Your journey to expertise begins here.
                    </p>
                    <a href="aboutus.php" class="btn btn-button1 hidden">Learn More</a>
                </div>

                <div>

                </div>

                <img class="img-fluid my-5 hidden2" src="../img/computer-img2.png" alt="" id="aboutimg">
            </div>
        </div>
    </section>


    <!--FEATURES-->
    <section class="bg-white text-dark p-5 text-center">
        <div class="container hidden">
            <p>We present to you the</p>
            <h3 class="display-4 mb-5" id="feature">Features</h3>

            <div class="container features">
                <!--FirstRow-->
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="card border-light text-white custom-card rounded-4 overflow-hidden hidden">
                            <div class="container card-body">
                                <h1 class="custom-text text-dark mb-3" id="crd-head">Assessment</h1>
                                <p class="custom-p text-dark mb-5" id="crd-text">
                                    <span class="text-dark fw-semibold">Assessment Insights:</span>
                                    Recommendations based on quiz results, providing insights into an individual's knowledge and skills.
                                </p>
                                <a href="assessment.php" class="float-start custom-a1">Try now</a>
                            </div>
                            <div>
                                <img src="../img/f1.png" alt="" class="img-fluid float-end d-none d-lg-block custom-f1">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 mb-4">
                        <div class="col-md-12">
                            <div class="card border-light text-white custom-card custom-width rounded-4 overflow-hidden hidden2">
                                <div class="container card-body d-inline">
                                    <h1 class="custom-text text-dark mb-3" id="crd-head">Grade-based Recommendation</h1>
                                    <p class="custom-p-w text-align-justify pt-2 pb-5 text-dark" id="crd-text">
                                        <span class="text-dark fw-semibold">Grades as a Yardstick:</span>
                                        Recommendations guided by academic performance, using grades as a measure of proficiency.
                                    </p>
                                    <a href="recommendations/grade-based.php" class="float-start custom-a2">Try now</a>
                                </div>
                                <div class="d-inline">
                                    <img src="../img/f2.png" alt="" class="img-fluid float-end d-none d-lg-block custom-f2">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Second Row-->
                <div class="row">
                    <div class="col-md-8 mb-4">
                        <div class="col-md-12">
                            <div class="card border-light text-white custom-card1 rounded-4 overflow-hidden hidden">
                                <div class="container card-body d-inline">
                                    <h1 class="custom-text text-dark mb-3" id="crd-head">Preference-based Recommendation</h1>
                                    <p class="custom-p-w text-align-justify pt-2 pb-5 text-dark" id="crd-text">
                                        <span class="fw-semibold text-dark">Personalized Preferences:</span>
                                        Recommendations tailored to individual interests and preferences generated by an integrated OpenAI engine.
                                    </p>
                                    <a href="recommendations/preference.php" class="float-start custom-a3">Try now</a>
                                </div>
                                <div class="d-inline">
                                    <img src="../img/f3.png" alt="" class="img-fluid float-end d-none d-lg-block custom-f2">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card border-light text-white custom-card-final rounded-4 overflow-hidden hidden2">
                            <div class="container card-body d-inline">
                                <h1 class="custom-text text-dark mb-3" id="crd-head">Results</h1>
                                <p class="custom-p text-dark mb-5" id="crd-text">
                                    <span class="fw-semibold text-dark">View Recommendations:</span>
                                    View the results of your recommendations.
                                    These options can help you make better choices in picking the specializations.
                                </p>
                                <a href="profile.php" class="float-start custom-a4">Try now</a>
                            </div>
                            <div class="d-inline">
                                <img src="../img/f4.png" alt="" class="img-fluid float-end d-none d-lg-block custom-f1">
                            </div>
                        </div>
                    </div>
                </div>
    </section>


    <!-- Logos -->
    <section>
        <!--Organization logos-->
        <div class="container hidden2">
            <div class="row mt-5">
                <div class="col-2 animate-delay hidden2">
                    <img src="../img/logo-ccs.png" alt="Image 1" class="img-fluid custom-org animate-delay hidden2">
                </div>
                <div class="col-2">
                    <img src="../img/o2.jpg" alt="Image 2" class="img-fluid custom-org animate-delay hidden2">
                </div>
                <div class="col-2">
                    <img src="../img/o1.jpg" alt="Image 1" class="img-fluid custom-org animate-delay hidden2 rounded-circle">
                </div>
                <div class="col-2">
                    <img src="../img/logo-semi.jpg" alt="Image 2" class="img-fluid custom-org animate-delay hidden2 rounded-circle">
                </div>
                <div class="col-2">
                    <img src="../img/logo-echo.png" alt="Image 1" class="img-fluid custom-org animate-delay hidden2 rounded-circle bg-dark">
                </div>
                <div class="col-2">
                    <img src="../img/o2.jpg" alt="Image 2" class="img-fluid custom-org animate-delay hidden2">
                </div>
            </div>
        </div>
    </section>


    <!-- BLOGS -->
    <section class="bg-custom-img" id="blogs">
        <div class="container text-dark py-5 hidden">

            <div class="testimonial-slider rounded-4">
                <div id="carouselExampleControls" class="carousel slide carousel-dark" data-bs-ride="carousel">
                    <div class="container">
                        <div class="row">

                            <div class="col-md-4">
                                <div class="testimonial-title">
                                    <i class="bi bi-quote display-1"></i>
                                    <h2 class="fw-bold display-3">What our Students say</h2>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>

                            <div class="col-md-8">
                                <div class="carousel-inner">

                                    <div class="carousel-item active">
                                        <div class="card card-deck rounded-4 shadow">
                                            <div class="card-body">
                                                <h5 class="card-title display-5 text-center fw-semibold">Welcome to the Blogs Section</h5>

                                                <p class="lead card-text pt-3 pb-0" id="card-txt">Dive into our blog section, where we unravel captivating stories and dive deep into topics that matter. Our experts and enthusiasts bring you engaging perspectives, insightful advice, and a wealth of knowledge. Whether you're here to learn, be inspired, or simply explore, our carefully curated blogs offer an enriching experience for all.</p>

                                                <div class="text-center">
                                                    <a href="user-create-blogs.php" class="btn btn-button1 mb-1" id="blog-btn">Create a Blog</a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <?php foreach ($query as $q) { ?>
                                        <div class="carousel-item">
                                            <div class="card card-deck rounded-4 shadow">
                                                <div class="card-body">
                                                    <h5 class="card-title" id="card-title"><?php echo $q['title']; ?></h5>
                                                    <h6>by <?php echo $q['content_creator']; ?></h5>
                                                        <p class="lead card-text py-3" id="card-txt"><?php echo substr($q['content'], 0, 250); ?>...</p><br>
                                                        <a href="user-view-blogs.php?id=<?php echo $q['id'] ?>" class="btn btn-button1 btn-light">Read More <span class="text-danger">&rarr;</span></a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
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

    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MzjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="../js/index.js"></script>
    <script src="../js/app.js"></script>
</body>

</html>