<?php
// Return the HTML form
echo '
<form id="taskForm">
    <div class="form-group">
        <label for="taskName">Task Name</label>
        <input type="text" class="form-control" id="taskName" name="taskName" required>
    </div>
    <div class="form-group">
        <label for="taskDescription">Task Description</label>
        <textarea class="form-control" id="taskDescription" name="taskDescription" required></textarea>
    </div>
    <div class="form-group">
        <label for="dueDate">Due Date</label>
        <input type="date" class="form-control" id="dueDate" name="dueDate" required>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>';
?>
