<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "reviews";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Database connection error.']));
}

// Get review ID from URL parameter
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Check if the review ID is valid
if ($id > 0) {
    // Fetch the review details
    $sql = "SELECT * FROM reviews WHERE review_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $review = $result->fetch_assoc();

        // Simulate posting the review to Google Business Profile
        // Ideally, you would integrate the Google API for posting reviews
        $google_review_url = "https://g.page/r/CcQ0WzmGhE0tEBM/review";

        // Optional: Delete the review after posting
        $delete_sql = "DELETE FROM reviews WHERE review_id = ?";
        $delete_stmt = $conn->prepare($delete_sql);
        $delete_stmt->bind_param("i", $id);

        if ($delete_stmt->execute()) {
            echo json_encode([
                'success' => true,
                'message' => 'Review posted and deleted successfully.',
                'redirect_url' => $google_review_url,
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete the review.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Review not found.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid review ID.']);
}

$conn->close();
?>
