<?php

$host = 'localhost';
$dbname = 'workshop_management';
$username = 'root';
$password = '';

$id = $_POST['id'];
$employee_id = $_POST['employee_id'];
$date = $_POST['date'];
$status = $_POST['status'];
$action = $_POST['action'];

if ($action == 'add') {
    $query = "INSERT INTO attendance (employee_id, date, status) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iss", $employee_id, $date, $status);
} else {
    $query = "UPDATE attendance SET date = ?, status = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssi", $date, $status, $id);
}

$stmt->execute();

$stmt->close();
$conn->close();
?>
