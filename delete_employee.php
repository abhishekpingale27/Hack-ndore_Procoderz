<?php
$host = 'localhost';
$dbname = 'workshop_management';
$username = 'root';
$password = '';

$id = $_POST['id'];

$query = "DELETE FROM employees WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();

$stmt->close();
$conn->close();
?>
