<?php
// Database configuration
$servername = "localhost";
$username = "luxuaqaj_mimi";
$password = "hoseaayub@322";
$dbname = "luxuaqaj_review";


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
<? include 'conn.php'; ?>
<? include 'header.php'; ?>
<? include 'home.php'; ?>



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
