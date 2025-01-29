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