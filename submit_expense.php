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

// Get form data
$title = $_POST['title'];
$hsn_no = $_POST['hsn_no'];
$amount = $_POST['amount'];
$transaction_date = $_POST['transaction_date'];
$payment_method = $_POST['payment_method'];
$transaction_id = $_POST['transaction_id'];
$vendor_gstin = $_POST['vendor_gstin'];
$categories = isset($_POST['categories']) ? implode(",", $_POST['categories']) : '';
$department = $_POST['department'];
$description = $_POST['description'];

// Handle file upload
$receipt_path = '';
if (isset($_FILES['receipt']) && $_FILES['receipt']['error'] == 0) {
    $upload_dir = 'uploads/';
    $receipt_path = $upload_dir . basename($_FILES['receipt']['name']);
    move_uploaded_file($_FILES['receipt']['tmp_name'], $receipt_path);
}

// Insert data into database
$sql = "INSERT INTO expenses (title, hsn_no, amount, transaction_date, payment_method, transaction_id, vendor_gstin, category, department, description, receipt_path)
        VALUES ('$title', '$hsn_no', '$amount', '$transaction_date', '$payment_method', '$transaction_id', '$vendor_gstin', '$categories', '$department', '$description', '$receipt_path')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => $conn->error]);
}

$conn->close();
?>
