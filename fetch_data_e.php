<?php
$host = 'localhost';
$dbname = 'workshop_management';
$username = 'root';
$password = '';

$query = "SELECT * FROM employees";
$result = $conn->query($query);

$employees = array();
while ($row = $result->fetch_assoc()) {
    $employees[] = $row;
}

echo json_encode($employees);

$conn->close();
?>
