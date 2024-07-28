<?php
header('Content-Type: application/json');
$servername = "localhost";
$username = "root";  // Replace with your MySQL username
$password = "";  // Replace with your MySQL password
$dbname = "workshop_management";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$employee_id = $_POST['employee_id'];
$vehicle_id = $_POST['vehicle_id'];
$phone_number = $_POST['phone_number'];
$meter = $_POST['meter'];

// Insert data into database
$sql = "INSERT INTO fuel_readings (employee_id, vehicle_id, phone_number,meter) VALUES ('$employee_id', '$vehicle_id', '$phone_number','$meter')";

$response = [];
if ($conn->query($sql) === TRUE) {
    $response['success'] = true;
} else {
    $response['success'] = false;
    $response['error'] = $conn->error;
}

// Close connection
$conn->close();

// Output response as JSON
echo json_encode($response);
?>
