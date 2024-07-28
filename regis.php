<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="styles.css">

    <style>

        body {
    font-family: Arial, sans-serif;
    background: url('background-image.jpg') no-repeat center center fixed;
    background-size: cover;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 600px;
    margin: 50px auto;
    padding: 20px;
    background: rgba(255, 255, 255, 0.8); /* White with 80% opacity */
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    margin-bottom: 20px;
    text-align: center;
    color: #333;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    color: #333;
}

.form-group input[type="text"],
.form-group input[type="email"],
.form-group input[type="password"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

.form-group .radio-group {
    display: flex;
    gap: 15px;
}

.form-group .radio-group label {
    display: flex;
    align-items: center;
}

.form-group .radio-group input[type="radio"] {
    margin-right: 5px;
}

.btn {
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

.btn:hover {
    background-color: #0056b3;
}

body {
    font-family: Arial, sans-serif;
    background: url('src/images/regbg.png') no-repeat center center fixed;
    background-size: cover;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 600px;
    margin: 50px auto;
    padding: 20px;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    margin-bottom: 20px;
    text-align: center;
    color: #333;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    color: #333;
}

.form-group input[type="text"],
.form-group input[type="email"],
.form-group input[type="password"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

.form-group .radio-group {
    display: flex;
    gap: 15px;
}

.form-group .radio-group label {
    display: flex;
    align-items: center;
}

.form-group .radio-group input[type="radio"] {
    margin-right: 5px;
}

.btn {
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

.btn:hover {
    background-color: #0056b3;
}

/* body {
    font-family: Arial, sans-serif;
    background: url('background-image.jpg') no-repeat center center fixed;
    background-size: cover;
    margin: 0;
    padding: 0;
} */

.container {
    max-width: 600px;
    margin: 50px auto;
    padding: 20px;
    background: rgba(255, 255, 255, 0.8); /* White with 80% opacity */
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    margin-bottom: 20px;
    text-align: center;
    color: #333;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    color: #333;
}

.form-group input[type="text"],
.form-group input[type="email"],
.form-group input[type="password"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

.form-group .radio-group {
    display: flex;
    gap: 15px;
}

.form-group .radio-group label {
    display: flex;
    align-items: center;
}

.form-group .radio-group input[type="radio"] {
    margin-right: 5px;
}

.btn {
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

.btn:hover {
    background-color: #0056b3;
}



    </style>
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <form action="regis.php" method="post">
            <div class="form-group">
                <label for="email">Email Address*</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="username">Username*</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required>
            </div>
            <div class="form-group">
                <label for="password">Password*</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password*</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your password" required>
            </div>
            <div class="form-group">
                <label for="full_name">Full Name*</label>
                <input type="text" id="full_name" name="full_name" placeholder="Enter your full name" required>
            </div>
            <div class="form-group">
                <label>Gender*</label>
                <input type="radio" id="male" name="gender" value="Male" required>
                <label for="male">Male</label>
                <input type="radio" id="female" name="gender" value="Female" required>
                <label for="female">Female</label>
            </div>
            <div class="form-group">
                <label for="city">City</label>
                <input type="text" id="city" name="city" placeholder="Enter your city">
            </div>
            <div class="form-group">
                <label for="state">State</label>
                <input type="text" id="state" name="state" placeholder="Enter your state">
            </div>
            <div class="form-group">
                <label for="bank_account_number">Bank Account Number*</label>
                <input type="text" id="bank_account_number" name="bank_account_number" placeholder="Enter your bank account number" required>
            </div>
            <div class="form-group">
                <label for="ifsc_code">IFSC Code*</label>
                <input type="text" id="ifsc_code" name="ifsc_code" placeholder="Enter your IFSC code" required>
            </div>
            <div class="form-group">
                <label for="bank_name">Bank Name*</label>
                <input type="text" id="bank_name" name="bank_name" placeholder="Enter your bank name" required>
            </div>
            <div class="form-group">
                <label for="bank_branch">Bank Branch*</label>
                <input type="text" id="bank_branch" name="bank_branch" placeholder="Enter your bank branch" required>
            </div>
            <div class="form-group">
                <label for="upi_id">UPI ID*</label>
                <input type="text" id="upi_id" name="upi_id" placeholder="Enter your UPI ID" required>
            </div>
            <!-- <div class="form-group">
                <label for="role">Role*</label>
                <select id="role" name="role" required>
                    <option value="" disabled selected>Select your role</option>
                    <option value="Admin">Admin</option>
                    <option value="Employee">Employee</option>
                </select>
            </div> -->
            <div class="form-group">
                <button type="submit" class="btn">Register</button>
            </div>
        </form>
    </div>
</body>
</html>


<?php
require 'db_connection.php'; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form inputs
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $full_name = $_POST['full_name'];
    $gender = $_POST['gender'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $bank_account_number = $_POST['bank_account_number'];
    $ifsc_code = $_POST['ifsc_code'];
    $bank_name = $_POST['bank_name'];
    $bank_branch = $_POST['bank_branch'];
    $upi_id = $_POST['upi_id'];
    $role = 'Employee';

    // Validate password confirmation
    if ($password !== $confirm_password) {
        die("Passwords do not match.");
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute the SQL query
    $stmt = $conn->prepare("INSERT INTO users (email, username, password, full_name, gender, city, state, bank_account_number, ifsc_code, bank_name, bank_branch, upi_id, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssssss", $email, $username, $hashed_password, $full_name, $gender, $city, $state, $bank_account_number, $ifsc_code, $bank_name, $bank_branch, $upi_id, $role);

    // Debug statement to check the role value
    echo "Role being assigned: " . $role;

    if ($stmt->execute()) {
        // Registration successful
        $_SESSION['message'] = "Registration successful.";
        header('Location: login.php');
        exit;
    } else {
        // Error occurred
        $_SESSION['error'] = "Error: " . $stmt->error;
        header('Location: error_page.php'); // Redirect to an error page or show a message
        exit;
    }
    
    // End output buffering and flush output
    ob_end_flush();

    $stmt->close();
    $conn->close();
}

?>

