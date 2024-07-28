<?php
$host = 'localhost';
$dbname = 'workshop_management';
$username = 'root';
$password = '';

$employee_id = $_POST['employee_id'];
$date = $_POST['date'];
$status = $_POST['status'];
$action = $_POST['action'];

if ($action == 'add') {
    $sql = "INSERT INTO attendance (employee_id, date, status) VALUES (?, ?, ?)";
} elseif ($action == 'edit') {
    $id = $_POST['id'];
    $sql = "UPDATE attendance SET date = ?, status = ? WHERE id = ?";
}

$stmt = $conn->prepare($sql);
if ($action == 'add') {
    $stmt->bind_param("iss", $employee_id, $date, $status);
} elseif ($action == 'edit') {
    $stmt->bind_param("ssi", $date, $status, $id);
}

$stmt->execute();
echo "Success";
?>
