<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "luxuaqaj_hoseaayub";
$password = "hoseaayub@322";
$dbname = "luxuaqaj_reviews_app";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection error: ' . $conn->connect_error]);
    exit;
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    // Check if the review exists
    $check_sql = "SELECT * FROM reviews WHERE review_id = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("i", $id);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows > 0) {
        // Proceed to delete
        $sql = "DELETE FROM reviews WHERE review_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Review deleted successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'THAN KYOU ' . $stmt->error]);
        }
        $stmt->close();
    } else {
        // Review was already deleted
        echo json_encode(['success' => false, 'message' => 'This review was already deleted or does not exist.']);
    }

    $check_stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'THANKYOU.']);
}

$conn->close();
?>
