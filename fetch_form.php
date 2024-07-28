<?php
header('Content-Type: application/json');

// Form HTML content
$formHtml = '
    <form id="taskForm" method="POST" action="submit_task.php">
        <label for="task_name">Task Name:</label>
        <input type="text" id="task_name" name="task_name" required><br><br>
        
        <label for="task_description">Task Description:</label>
        <textarea id="task_description" name="task_description" required></textarea><br><br>
        
        <label for="task_due_date">Due Date:</label>
        <input type="date" id="task_due_date" name="task_due_date" required><br><br>
        
        <input type="submit" value="Create Task">
    </form>
';

echo json_encode(['form' => $formHtml]);
?>
