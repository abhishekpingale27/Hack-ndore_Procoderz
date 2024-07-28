<?php
session_start();

// Database configuration
$host = 'localhost';
$db = 'workshop_management';
$user = 'root';
$pass = '';

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
        // Get form data
        $username_email = isset($_POST['username_email']) ? trim($_POST['username_email']) : '';
        $password = isset($_POST['password']) ? trim($_POST['password']) : '';

        // Validate data
        if (empty($username_email) || empty($password)) {
            $_SESSION['error_message'] = "All fields are required.";
            header('Location: login.php');
            exit;
        }

        // Prepare SQL statement
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username_email OR email = :username_email");
        $stmt->bindParam(':username_email', $username_email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['role'] = $role;
            
            // Redirect based on role
            if ($_SESSION['role'] == 'Admin'||$user['role']=='Admin') {
                header("Location: index2.php");
            } else {
                header("Location: index.php");
            }
            exit;

            // Redirect to admin page
            header('Location: index2.php');
            exit;
        } else {
            $_SESSION['error_message'] = "Invalid username/email or password.";
            header('Location: login.php');
            exit;
        }
    }
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
