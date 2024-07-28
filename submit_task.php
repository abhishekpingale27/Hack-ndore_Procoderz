<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    echo 'Unauthorized';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $start_date = $_POST['start_date'];
    $due_date = $_POST['due_date'];
    $recurring_schedule = $_POST['recurring_schedule'];
    $priority = $_POST['priority'];
    $worker = $_POST['worker'];
    $additional_worker = $_POST['additional_worker'];
    $location = $_POST['location'];
    $requisites = $_POST['requisites'];
    $purchase_orders = $_POST['purchase_orders'];

    $stmt = $conn->prepare("
        INSERT INTO tasks (title, description, start_date, due_date, recurring_schedule, priority, worker, additional_worker, location, requisites, purchase_orders) 
        VALUES (:title, :description, :start_date, :due_date, :recurring_schedule, :priority, :worker, :additional_worker, :location, :requisites, :purchase_orders)
    ");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':start_date', $start_date);
    $stmt->bindParam(':due_date', $due_date);
    $stmt->bindParam(':recurring_schedule', $recurring_schedule);
    $stmt->bindParam(':priority', $priority);
    $stmt->bindParam(':worker', $worker);
    $stmt->bindParam(':additional_worker', $additional_worker);
    $stmt->bindParam(':location', $location);
    $stmt->bindParam(':requisites', $requisites);
    $stmt->bindParam(':purchase_orders', $purchase_orders);

    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'Error: ' . $stmt->errorInfo()[2];
    }
}
?>
