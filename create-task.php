<?php
// Assuming you have a database connection set up
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $taskName = $_POST['taskName'];
    $taskDescription = $_POST['taskDescription'];
    $dueDate = $_POST['dueDate'];

    $sql = "INSERT INTO tasks (name, description, due_date) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $taskName, $taskDescription, $dueDate);

    if ($stmt->execute()) {
        echo json_encode(['message' => 'Task created successfully']);
    } else {
        http_response_code(500);
        echo json_encode(['message' => 'Failed to create task']);
    }
}
?>
