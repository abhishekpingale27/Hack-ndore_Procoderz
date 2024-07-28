<?php
$host = 'localhost';
$dbname = 'workshop_management';
$username = 'root';
$password = '';

$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$role = $_POST['role'];
$status = $_POST['status'];
$action = $_POST['action'];

if ($action == 'add') {
    $query = "INSERT INTO employees (name, email, role, status) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $name, $email, $role, $status);
} else {
    $query = "UPDATE employees SET name = ?, email = ?, role = ?, status = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssi", $name, $email, $role, $status, $id);
}

$stmt->execute();

$stmt->close();
$conn->close();
?>
