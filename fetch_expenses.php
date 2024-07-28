<?php
$servername = "localhost";
$username = "root"; // Change to your database username
$password = ""; // Change to your database password
$dbname = "workshop_management";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from database
$sql = "SELECT * FROM expenses";
$result = $conn->query($sql);

$expenses = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $expenses[] = $row;
    }
}

echo json_encode($expenses);

$conn->close();
?>
