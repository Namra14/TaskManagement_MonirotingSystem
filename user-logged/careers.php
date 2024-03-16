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

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <style>
    /* Custom CSS to change the color of the active pagination link */
    .page-item.active .page-link {
        background-color: #FF8551; /* Replace with your desired background color */
        border-color: #ffff; /* Replace with your desired border color */
        color: white !important; /* Replace with your desired text color */
    }
    </style>

    <script>
        $(document).ready(function() {
            // Fetch the JSON data
            $.getJSON("../json/careers.json", function(data) {
                var galleryItems = data; // Store all items in galleryItems
                var itemsPerPage = 6; // Number of items to display per page
                var currentPage = 1; // Current page

                function shuffleArray(array) {
                    // Fisher-Yates shuffle algorithm
                    for (var i = array.length - 1; i > 0; i--) {
                        var j = Math.floor(Math.random() * (i + 1));
                        [array[i], array[j]] = [array[j], array[i]];
                    }
                }

                function updateItems() {
                    var searchTerm = $("#search-input").val().toLowerCase();

                    // Filter data based on the search term
                    var filteredData = galleryItems.filter(function(item) {
                        var itemText = item.job_name.toLowerCase() + ' ' + item.Specialization.toLowerCase() + ' ' + item.main_description.toLowerCase() + ' ' + item.short_description.toLowerCase();
                        return itemText.includes(searchTerm);
                    });

                    // Shuffle the filteredData array
                    shuffleArray(filteredData);

                    // Calculate the total number of pages
                    var totalPages = Math.ceil(filteredData.length / itemsPerPage);

                    // Display items for the current page
                    var startIndex = (currentPage - 1) * itemsPerPage;
                    var endIndex = startIndex + itemsPerPage;
                    var itemsToDisplay = filteredData.slice(startIndex, endIndex);

                    var galleryItemsHTML = '';

                    // Iterate over the items to display
                    itemsToDisplay.forEach(function(item) {
                        galleryItemsHTML += '<div class="col-md-4">' +
                                                '<div class="card mb-4 h-100">' +
                                                    '<div class="card-header">' + item.Specialization + '</div>' +
                                                    '<div class="card-body">' +
                                                        '<h5 class="card-title">' + item.job_name + '</h5>' +
                                                        '<div class="container">' +
                                                            '<p class="card-text">' + item.short_description + '</p>' +
                                                        '</div>' +
                                                    '</div>' +
                                                    '<div class="card-salary text-center my-4">' +
                                                        'Average Salary: <span class="fw-bold text-dark">' + item.salary + '</span> per year' +
                                                    '</div>' +
                                                    '<div class="card-footer">' +
                                                        '<a href="#" class="btn bg-custom-color text-light icon-link-hover">Go somewhere</a>' +
                                                    '</div>' +
                                                '</div>' +
                                            '</div>';
                    });

                    // Replace the gallery items in the HTML
                    $('#portfolio-items').html(galleryItemsHTML);

                    // Update pagination controls
                    generatePagination(totalPages);
                }

                // Initial rendering of items and pagination controls
                updateItems();

                // Listen for changes in the search input
                $("#search-input").on("input", updateItems);

                // Function to generate pagination controls
                function generatePagination(totalPages) {
                    var paginationHTML = '';

                    // Add Previous button
                    if (currentPage > 1) {
                        paginationHTML += '<li class="page-item"><a class="page-link" href="#">Previous</a></li>';
                    }

                    // Add page numbers
                    for (var i = 1; i <= totalPages; i++) {
                        paginationHTML += '<li class="page-item' + (i === currentPage ? ' active' : '') + '"><a class="page-link" href="#">' + i + '</a></li>';
                    }

                    // Add Next button
                    if (currentPage < totalPages) {
                        paginationHTML += '<li class="page-item"><a class="page-link" href="#">Next</a></li>';
                    }

                    // Replace the pagination controls in the HTML
                    $('#pagination').html(paginationHTML);

                    // Add click handlers to pagination links
                    $('.page-link').click(function(e) {
                        e.preventDefault();
                        var pageText = $(this).text();
                        if (pageText === 'Previous' && currentPage > 1) {
                            currentPage--;
                        } else if (pageText === 'Next' && currentPage < totalPages) {
                            currentPage++;
                        } else {
                            currentPage = parseInt(pageText);
                        }
                        updateItems();
                    });
                }
            });
        });
    </script>


    <title>Careers</title>


</head>

<body class="bg-custom-img">

    <?php include 'header.php'; ?>

    <section>

        <div class="grid-portfolio" id="portfolio">
            <div class="container my-5">
                <div class="input-group mb-4 w-25">
                    <input type="text" class="form-control" id="search-input" placeholder="Search...">
                </div>
                <div class="row g-4 hidden" id="portfolio-items">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">Featured</div>
                            <div class="card-body">
                                <h5 class="card-title">Special title treatment</h5>
                                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            </div>
                            <div class="card-footer">
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="my-5">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center" id="pagination"></ul>
                    </nav>
                </div>
            </div>
        </div>

    </section>


    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MzjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="../js/index.js"></script>
    <script src="../js/app.js"></script>
</body>

</html>