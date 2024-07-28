<?php
include 'db_connection.php';

$employee_id = $_GET['employee_id'];

$sql = "SELECT * FROM attendance WHERE employee_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $employee_id);
$stmt->execute();
$result = $stmt->get_result();

$attendance = array();
while ($row = $result->fetch_assoc()) {
    $attendance[] = $row;
}

echo json_encode($attendance);
?>
