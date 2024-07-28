<?php
// Database connection settings
$host = 'localhost';       // Replace with your database host
$dbname = 'workshop_management';  // Replace with your database name
$username = 'root'; // Replace with your database username
$password = ''; // Replace with your database password

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $taskId = $_POST['task_id'];
    $employeeId = $_POST['employee_id'];
    $roleId = $_POST['role_id'];

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare('INSERT INTO task_assignments (task_id, role_id, employee_id) VALUES (?, ?, ?)');
        $stmt->execute([$taskId, $roleId, $employeeId]);

        echo json_encode(['status' => 'success']);
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
}
?>
