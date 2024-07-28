<?php
$host = 'localhost';
$dbname = 'workshop_management';
$username = 'root';
$password = '';

$id = $_GET['id'];

$query = "SELECT * FROM employees WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

$employee = $result->fetch_assoc();

echo json_encode($employee);

$stmt->close();
$conn->close();
?>
