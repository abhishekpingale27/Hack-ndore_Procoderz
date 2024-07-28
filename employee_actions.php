<?php
$host = 'localhost';
$dbname = 'workshop_management';
$username = 'root';
$password = 'your_password';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $action = $_POST['action'];
        $id = $_POST['id'] ?? null;
        $name = $_POST['name'] ?? null;
        $email = $_POST['email'] ?? null;
        $role = $_POST['role'] ?? null;
        $status = $_POST['status'] ?? null;

        if ($action == 'add') {
            $stmt = $pdo->prepare("INSERT INTO employees (name, email, role, status) VALUES (?, ?, ?, ?)");
            $stmt->execute([$name, $email, $role, 'active']);
        } elseif ($action == 'edit') {
            $stmt = $pdo->prepare("UPDATE employees SET name = ?, email = ?, role = ?, status = ? WHERE id = ?");
            $stmt->execute([$name, $email, $role, $status, $id]);
        } elseif ($action == 'deactivate') {
            $stmt = $pdo->prepare("UPDATE employees SET status = 'inactive' WHERE id = ?");
            $stmt->execute([$id]);
        }
    }
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
