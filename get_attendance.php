<?php
$host = 'localhost';
$dbname = 'workshop_management';
$username = 'root';
$password = '';

$id = $_GET['id'];

$query = "SELECT * FROM attendance WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

$attendance = $result->fetch_assoc();

echo json_encode($attendance);

$stmt->close();
$conn->close();
?>
