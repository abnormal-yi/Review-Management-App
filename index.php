<?php
// Prevent caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>
<?php

// Database configuration
$servername = "localhost";
$username = "luxuaqaj_hoseaayub";
$password = "hoseaayub@322";
$dbname = "luxuaqaj_reviews_app";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    error_log("Database connection error: " . $conn->connect_error);
    die("An error occurred. Please try again later.");
}

$conn->set_charset("utf8");

// Pagination configuration
$limit = 6; // Number of reviews per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Search filter
$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
$search_query = $search ? "WHERE comments LIKE '%$search%'" : '';

// Get total reviews count
$count_sql = "SELECT COUNT(*) as total FROM reviews $search_query";
$count_result = $conn->query($count_sql);
$total_reviews = $count_result->fetch_assoc()['total'];
$total_pages = ceil($total_reviews / $limit);

// Fetch reviews with limit and offset
$sql = "SELECT * FROM reviews $search_query ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="google-site-verification" content="EIB2EbKznAnR0TF5xCWfsHsEy7b-TMC4bMLSVaiiSrQ" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Luxury Reviews</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
 

  <!-- Fonts -->
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">

  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Bocor
  * Template URL: https://bootstrapmade.com/bocor-bootstrap-template-nice-animation/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<? include 'header.php'; ?>
<? include 'home.php'; ?>
<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="index.php" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">Luxury Reviews</h1>
        <span>.</span>
      </a>

    

      <a class="btn-getstarted" href="index.php">Get Started</a>

    </div>
  </header>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="index.html" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">Luxury Reviews</h1>
        <span>.</span>
      </a>

      <nav id="navmenu" class="navmenu">

        <i class="mobile-nav-toggle d-xl-none "></i>
      </nav>

      <a class="btn-getstarted" href="index.php">Get Started</a>

    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">

      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center" data-aos="fade-in">
            <h1>Your New Digital Experience with Luxury Webs</h1>
            <p>We value your opinion! Share your experience with our services to help us improve</p>
            <div class="d-flex">
              <a href="#service" class="btn-get-started">Get Started</a>
            </div>
          </div>
          <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="100">
            <img src="assets/img/hero-img.png" class="img-fluid animated" alt="">
          </div>
        </div>
      </div>

    </section><!-- /Hero Section -->

    <!-- Clients Section -->
    <section id="clients" class="clients section light-background">

      <div class="container">

        <div class="swiper init-swiper">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 2,
                  "spaceBetween": 40
                },
                "480": {
                  "slidesPerView": 3,
                  "spaceBetween": 60
                },
                "640": {
                  "slidesPerView": 4,
                  "spaceBetween": 80
                },
                "992": {
                  "slidesPerView": 6,
                  "spaceBetween": 120
                }
              }
            }
          </script>
          <div class="swiper-wrapper align-items-center">
            <div class="swiper-slide"><img src="assets/img/clients/client-1.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-2.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-3.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-4.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-5.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-6.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-7.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-8.png" class="img-fluid" alt=""></div>
          </div>
        </div>

      </div>

    </section><!-- /Clients Section -->


    </div>

    </div>

    </section><!-- /Featured Services Section -->

    <!-- Features Section -->
    <section id="features" class="features section">

      <!-- Section Title ->
      <div class="container section-title" data-aos="fade-up">
        <h2>Why Your Review Matters:</h2>
        <p>Help Us Improve and Serve You Better!"</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4 align-items-center features-item">
          <div class="col-md-5 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="100">
            <img src="assets/img/features-1.svg" class="img-fluid" alt="">
          </div>
          <div class="col-md-7" data-aos="fade-up" data-aos-delay="100">
            <h3>Why Your Review Matters to Us</h3>
            <p class="fst-italic">
              Your feedback helps us improve and better serve you. By sharing your experience, you not only guide others but also contribute to our growth. Here's why your review makes a difference:
            </p>
            <ul>
              <li><i class="bi bi-check"></i><span> Your insights allow us to understand what we're doing right and where we can improve.</span></li>
              <li><i class="bi bi-check"></i><span> Your review helps others make informed decisions about our services.</span></li>
              <li><i class="bi bi-check"></i><span> Positive feedback motivates us to continue delivering top-notch service and experiences.</span></li>
            </ul>
          </div>
          </div>



    </section><!-- /Features Section -->
    
</main>




   <!-- Section Title -->
   <div class="container section-title" data-aos="fade-up">
        <h2> Select favorate Reviews & Feedback</h2>
        <p>Dive into real customer experiences and see why we're the preferred choice. Browse through detailed feedback and select the ones that resonate with you</p>
      </div><!-- End Section Title -->
<div class="container mt-5 mb-5">
    <!-- Filter and Search Bar -->
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex flex-row justify-content-between align-items-center filters">
              
                <div class="right-sort">
                    <form method="GET" action="" class="d-flex">
                        <input type="text" name="search" class="form-control" placeholder="Search reviews" value="<?php echo htmlspecialchars($search); ?>">
                        <button type="submit" class="btn btn-secondary" style="background-color: #FDC134; border-color: #FDC134;">
            <i class="bi bi-search"></i>
                    </form>
                </div>
            </div>
        </div>
    </div>

   
   <!-- Reviews Display -->
<div class="row mt-4">
    <?php
    // Check if there are reviews in the database
    if ($result && $result->num_rows > 0) {
        // Loop through each review
        while ($row = $result->fetch_assoc()) {
            ?>
            <!-- Review Card -->
            <div class='col-md-6 mb-4'>
                <div class='p-card bg-white p-3 rounded shadow-sm'>
                    <!-- Display Review ID -->
                    <h5 class='mt-2'>Review: <?php echo htmlspecialchars($row['review_id']); ?></h5>
                    <!-- Display Comments -->
                    <p><i><?php echo htmlspecialchars($row['comments']); ?></i></p>
                    <!-- Action Buttons -->
                    <div class='d-flex justify-content-between align-items-center stats'>
                        <!-- Copy Button -->
                        <button class='btn btn-sm btn-primary copy-btn' 
                                data-id='<?php echo htmlspecialchars($row['review_id']); ?>' 
                                data-comment='<?php echo htmlspecialchars($row['comments']); ?>'>
                            <i class='fas fa-copy'></i> Copy
                        </button>
                        <!-- Post Button -->
                        <button class='btn btn-sm btn-success post-btn' 
                                data-id='<?php echo htmlspecialchars($row['review_id']); ?>'>
                            <i class='fas fa-paper-plane'></i> Post
                        </button>
                    </div>
                </div>
            </div>
            <?php
        }
    } else {
        // Message if no reviews are found
        echo "<p class='text-center'>No reviews found</p>";
    }
    ?>
</div>


    <!-- Pagination -->
    <div class="d-flex justify-content-end text-right mt-3">
        <nav>
            <ul class="pagination">
                <?php
                // Determine the range of pages to show
                $range = 5; // Number of page links to show around the current page
                $start_page = max(1, $page - floor($range / 2)); // Start page number
                $end_page = min($total_pages, $start_page + $range - 1); // End page number

                // Display "Previous" button
                if ($page > 1) {
                    echo "<li class='page-item'><a class='page-link' href='?page=" . ($page - 1) . "&search=" . urlencode($search) . "' aria-label='Previous'><span aria-hidden='true'>&laquo;</span></a></li>";
                }

                // Display page numbers
                for ($i = $start_page; $i <= $end_page; $i++) {
                    echo "<li class='page-item " . ($i == $page ? 'active' : '') . "'><a class='page-link' href='?page=$i&search=" . urlencode($search) . "'>$i</a></li>";
                }

                // Display "Next" button
                if ($page < $total_pages) {
                    echo "<li class='page-item'><a class='page-link' href='?page=" . ($page + 1) . "&search=" . urlencode($search) . "' aria-label='Next'><span aria-hidden='true'>&raquo;</span></a></li>";
                }
                ?>
            </ul>
        </nav>
    </div>
</div>

<footer id="footer" class="footer dark-background">
    <div class="container">
      
     
     
      <div class="copyright">
        <span>Copyright</span> <strong class="px-1 sitename">Luxury Reviews</strong> <span>All Rights Reserved</span>
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        Designed by <a href="https://luxurywebs.com/">Luxury Webs </a>
      </div>
    </div>
  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

 

<script>
// JavaScript for handling copy and post functionality
document.addEventListener('DOMContentLoaded', function() {
    let copiedReviews = {};  // Track copied comments per review

    // Handle copy button click
    document.querySelectorAll('.copy-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            const comment = this.getAttribute('data-comment');
            const id = this.getAttribute('data-id');

            // Copy the comment to clipboard
            navigator.clipboard.writeText(comment).then(() => {
                alert('Comment copied to clipboard!');
                copiedReviews[id] = true;  // Mark this review as copied
            }).catch(err => {
                console.error('Failed to copy text: ', err);
            });
        });
    });

    // Handle post button click
    document.querySelectorAll('.post-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');

            if (!copiedReviews[id]) {
                alert('You must copy the review first before posting.');
                return;  // Prevent posting if the review wasn't copied
            }

            // Confirm posting
            if (confirm('Do you want to post this review to Google Business Profile?')) {
                fetch(`post_review.php?id=${id}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Redirect to Google Business Profile after posting
                            window.location.href = data.redirect_url;

                            // After posting, delete the review
                            fetch(`delete_review.php?id=${id}`)
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        alert('Review posted and deleted successfully!');
                                        this.closest('.col-md-4').remove(); // Remove the review from UI
                                    } else {
                                        alert('THANK YOU.');
                                    }
                                });
                        } else {
                            alert('Error: ' + data.message);
                        }
                    });
            }
        });
    });
});


</script>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

<!-- Close database connection -->
<?php $conn->close(); ?>

<!-- Styles for Buttons and Layout -->
<style>
    .copy-btn {
        border: 2px solid; #223b51e6;
        background-color: #223b51e6;
        color: white;
        padding: 8px 12px;
    }

    .post-btn {
        background-color: #28a745;
        border: 2px solid #218838;
        color: white;
        padding: 8px 12px;
    }

    .stats button {
        margin-right: 10px; /* Space between buttons */
    }

    .col-md-4 {
        padding-bottom: 20px; /* Space below each card */
    }

    .pagination .page-item.active .page-link {
        background-color: #223b51e6;
        border-color: #223b51e6;
    }

    .pagination .page-link {
        color: #28a745;
    }

    .pagination .page-link:hover {
        background-color: #28a745;;
        color: white;
    }
</style>
