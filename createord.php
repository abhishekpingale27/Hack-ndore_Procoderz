

<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include database connection file
include('db_connection.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $title = $_POST['title'];
    $taskDate = $_POST['taskDate'];
    $startTime = $_POST['startTime'];
    $endTime = $_POST['endTime'];

    // Validate the form data
    if (empty($title) || empty($taskDate) || empty($startTime) || empty($endTime)) {
        die('All fields are required.');
    }

    // Insert order into the database
    $stmt = $conn->prepare("INSERT INTO orders (title, task_date, start_time, end_time) VALUES (?, ?, ?, ?)");
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("ssss", $title, $taskDate, $startTime, $endTime);
    if (!$stmt->execute()) {
        die('Execute failed: ' . htmlspecialchars($stmt->error));
    }
    
    // Get the last inserted order ID
    $orderId = $stmt->insert_id;

    // Insert tasks into the database
    if (isset($_POST['tasks'])) {
        foreach ($_POST['tasks'] as $task) {
            if (!empty($task)) {
                $stmt = $conn->prepare("INSERT INTO order_tasks (order_id, description) VALUES (?, ?)");
                if ($stmt === false) {
                    die('Prepare failed: ' . htmlspecialchars($conn->error));
                }
                $stmt->bind_param("is", $orderId, $task);
                if (!$stmt->execute()) {
                    die('Execute failed: ' . htmlspecialchars($stmt->error));
                }
            }
        }
    }

    // Insert assets into the database
    if (isset($_POST['assets']) && isset($_POST['asset_numbers'])) {
        foreach ($_POST['assets'] as $index => $asset) {
            $quantity = $_POST['asset_numbers'][$index];
            if (!empty($asset) && !empty($quantity)) {
                $stmt = $conn->prepare("INSERT INTO order_assets (order_id, asset_type, quantity) VALUES (?, ?, ?)");
                if ($stmt === false) {
                    die('Prepare failed: ' . htmlspecialchars($conn->error));
                }
                $stmt->bind_param("isi", $orderId, $asset, $quantity);
                if (!$stmt->execute()) {
                    die('Execute failed: ' . htmlspecialchars($stmt->error));
                }
            }
        }
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();

    // Redirect to the work order page
    header("Location: workord.php");
    exit();
}
?>
