<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if user is not logged in
    header('Location: login.php');
    exit;
}
?>

<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include database connection file
include('db_connection.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $title = $conn->real_escape_string(trim($_POST['title']));
    $taskDate = $conn->real_escape_string(trim($_POST['taskDate']));
    $startTime = $conn->real_escape_string(trim($_POST['startTime']));
    $endTime = $conn->real_escape_string(trim($_POST['endTime']));

    // Validate the form data
    if (empty($title) || empty($taskDate) || empty($startTime) || empty($endTime)) {
        die('All fields are required.');
    }

    // Insert order into the database
    $stmt = $conn->prepare("INSERT INTO work_orders (title, task_date, start_time, end_time) VALUES (?, ?, ?, ?)");
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("ssss", $title, $taskDate, $startTime, $endTime);
    if (!$stmt->execute()) {
        die('Execute failed: ' . htmlspecialchars($stmt->error));
    }
    
    // Get the last inserted work order ID
    $workOrderId = $stmt->insert_id;

    // Insert tasks into the database
    if (isset($_POST['tasks'])) {
        foreach ($_POST['tasks'] as $task) {
            $task = $conn->real_escape_string(trim($task));
            if (!empty($task)) {
                $stmt = $conn->prepare("INSERT INTO work_order_tasks (work_order_id, task_description) VALUES (?, ?)");
                if ($stmt === false) {
                    die('Prepare failed: ' . htmlspecialchars($conn->error));
                }
                $stmt->bind_param("is", $workOrderId, $task);
                if (!$stmt->execute()) {
                    die('Execute failed: ' . htmlspecialchars($stmt->error));
                }
            }
        }
    }

    // Insert assets into the database
    if (isset($_POST['assets']) && isset($_POST['asset_numbers'])) {
        foreach ($_POST['assets'] as $index => $asset) {
            $quantity = intval($_POST['asset_numbers'][$index]);
            $asset = $conn->real_escape_string(trim($asset));
            if (!empty($asset) && $quantity > 0) {
                $stmt = $conn->prepare("INSERT INTO work_order_assets (work_order_id, asset_type, quantity) VALUES (?, ?, ?)");
                if ($stmt === false) {
                    die('Prepare failed: ' . htmlspecialchars($conn->error));
                }
                $stmt->bind_param("isi", $workOrderId, $asset, $quantity);
                if (!$stmt->execute()) {
                    die('Execute failed: ' . htmlspecialchars($stmt->error));
                }
            }
        }
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();

    // Redirect to the work order page
    header("Location: workord.php");
    exit();
}
?>


<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>DeskApp - Bootstrap Admin Dashboard HTML Template</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="vendors/images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="vendors/images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="vendors/images/favicon-16x16.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/style.css">


	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
	</script>
</head>
<body>
	

	<div class="header">
		<div class="header-left">
			<div class="menu-icon dw dw-menu"></div>
			<div class="search-toggle-icon dw dw-search2" data-toggle="header_search"></div>
			<div class="header-search">
				<form>
					<div class="form-group mb-0">
						<i class="dw dw-search2 search-icon"></i>
						<input type="text" class="form-control search-input" placeholder="Search Here">
						<div class="dropdown">
							<a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
								<i class="ion-arrow-down-c"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-right">
								<div class="form-group row">
									<label class="col-sm-12 col-md-2 col-form-label">From</label>
									<div class="col-sm-12 col-md-10">
										<input class="form-control form-control-sm form-control-line" type="text">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-12 col-md-2 col-form-label">To</label>
									<div class="col-sm-12 col-md-10">
										<input class="form-control form-control-sm form-control-line" type="text">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-12 col-md-2 col-form-label">Subject</label>
									<div class="col-sm-12 col-md-10">
										<input class="form-control form-control-sm form-control-line" type="text">
									</div>
								</div>
								<div class="text-right">
									<button class="btn btn-primary">Search</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="header-right">
			<div class="dashboard-setting user-notification">
				<div class="dropdown">
					<a class="dropdown-toggle no-arrow" href="javascript:;" data-toggle="right-sidebar">
						<i class="dw dw-settings2"></i>
					</a>
				</div>
			</div>
			  
			<div class="user-info-dropdown">
				<div class="dropdown">
					<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
						<span class="user-icon">
							<img src="vendors/images/photo1.jpg" alt="">
						</span>
						<span class="user-name"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
						<a class="dropdown-item" href="profile.html"><i class="dw dw-user1"></i> Profile</a>
						<a class="dropdown-item" href="profile.html"><i class="dw dw-settings2"></i> Setting</a>
						<a class="dropdown-item" href="faq.html"><i class="dw dw-help"></i> Help</a>
						<a class="dropdown-item" href="logout.php"><i class="dw dw-logout"></i> Log Out</a>
					</div>
				</div>
			</div>
			
		</div>
	</div>

	<div class="right-sidebar">
		<div class="sidebar-title">
			<h3 class="weight-600 font-16 text-blue">
				Layout Settings
				<span class="btn-block font-weight-400 font-12">User Interface Settings</span>
			</h3>
			<div class="close-sidebar" data-toggle="right-sidebar-close">
				<i class="icon-copy ion-close-round"></i>
			</div>
		</div>
		<div class="right-sidebar-body customscroll">
			<div class="right-sidebar-body-content">
				<h4 class="weight-600 font-18 pb-10">Header Background</h4>
				<div class="sidebar-btn-group pb-30 mb-10">
					<a href="javascript:void(0);" class="btn btn-outline-primary header-white active">White</a>
					<a href="javascript:void(0);" class="btn btn-outline-primary header-dark">Dark</a>
				</div>

				<h4 class="weight-600 font-18 pb-10">Sidebar Background</h4>
				<div class="sidebar-btn-group pb-30 mb-10">
					<a href="javascript:void(0);" class="btn btn-outline-primary sidebar-light ">White</a>
					<a href="javascript:void(0);" class="btn btn-outline-primary sidebar-dark active">Dark</a>
				</div>

				<h4 class="weight-600 font-18 pb-10">Menu Dropdown Icon</h4>
				<div class="sidebar-radio-group pb-10 mb-10">
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebaricon-1" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-1" checked="">
						<label class="custom-control-label" for="sidebaricon-1"><i class="fa fa-angle-down"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebaricon-2" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-2">
						<label class="custom-control-label" for="sidebaricon-2"><i class="ion-plus-round"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebaricon-3" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-3">
						<label class="custom-control-label" for="sidebaricon-3"><i class="fa fa-angle-double-right"></i></label>
					</div>
				</div>

				<h4 class="weight-600 font-18 pb-10">Menu List Icon</h4>
				<div class="sidebar-radio-group pb-30 mb-10">
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-1" name="menu-list-icon" class="custom-control-input" value="icon-list-style-1" checked="">
						<label class="custom-control-label" for="sidebariconlist-1"><i class="ion-minus-round"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-2" name="menu-list-icon" class="custom-control-input" value="icon-list-style-2">
						<label class="custom-control-label" for="sidebariconlist-2"><i class="fa fa-circle-o" aria-hidden="true"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-3" name="menu-list-icon" class="custom-control-input" value="icon-list-style-3">
						<label class="custom-control-label" for="sidebariconlist-3"><i class="dw dw-check"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-4" name="menu-list-icon" class="custom-control-input" value="icon-list-style-4" checked="">
						<label class="custom-control-label" for="sidebariconlist-4"><i class="icon-copy dw dw-next-2"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-5" name="menu-list-icon" class="custom-control-input" value="icon-list-style-5">
						<label class="custom-control-label" for="sidebariconlist-5"><i class="dw dw-fast-forward-1"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-6" name="menu-list-icon" class="custom-control-input" value="icon-list-style-6">
						<label class="custom-control-label" for="sidebariconlist-6"><i class="dw dw-next"></i></label>
					</div>
				</div>

				<div class="reset-options pt-30 text-center">
					<button class="btn btn-danger" id="reset-settings">Reset Settings</button>
				</div>
			</div>
		</div>
	</div>

	<div class="left-side-bar">
		<div class="brand-logo">
			<a href="index.html">
				<img src="vendors/images/deskapp-logo.svg" alt="" class="dark-logo">
				<img src="vendors/images/deskapp-logo-white.svg" alt="" class="light-logo">
			</a>
			<div class="close-sidebar" data-toggle="left-sidebar-close">
				<i class="ion-close-round"></i>
			</div>
		</div>
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul id="accordion-menu">
					<li class="dropdown">
						<a href="index2.php" class="dropdown-toggle">
							<span class="micon dw dw-house-1"></span><span class="mtext">Home</span>
						</a>
						<!-- <ul class="submenu">
							<li><a href="index.html">Dashboard style 1</a></li>
							<li><a href="index2.html">Dashboard style 2</a></li>
						</ul> -->
					</li>

                    <li class="dropdown">
						<a href="workrd.php" class="dropdown-toggle">
							<span class="micon dw dw-edit2"></span><span class="mtext" href='workrd.php' >Work Order</span>
						</a>
						<!-- <ul class="submenu">
							<li><a href="index.html">Dashboard style 1</a></li>
							<li><a href="index2.html">Dashboard style 2</a></li>
						</ul> -->
                    <li class="dropdown">
						<a href="fuelman.php:;" class="dropdown-toggle">
							<span class="micon dw dw-house-1"></span><span class="mtext"href='fuelman.php'>Fuel Tracking</span>
						</a>	
					</li>
                    <li class="dropdown">
						<a href="roaster.php" class="dropdown-toggle">
							<span class="micon dw dw-house-1"></span><span class="mtext"href='fuelman.php'>Roster Management</span>
						</a>	
					</li>
					
				</ul>
			</div>
		</div>
	</div>
	
	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				 <div class="container mt-4">
        <h2>Work Orders</h2>
        <button class="btn btn-primary" id="createTaskBtn" data-toggle="modal" data-target="#createTaskModal">Create New Task</button>

                    <!-- Modal for Creating Work Order -->
                    <div class="modal fade" id="createTaskModal" tabindex="-1" role="dialog" aria-labelledby="createTaskModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="createTaskModalLabel">Create New Work Order</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="workOrderForm" method="POST" action="create_work_order.php">
                                        <div class="form-group">
                                            <label for="title">Title:</label>
                                            <textarea id="title" name="title" class="form-control" rows="3" required></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="dateOfTask">Date of Task:</label>
                                            <input type="date" id="dateOfTask" name="dateOfTask" class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="timeFrom">Time From:</label>
                                            <input type="time" id="timeFrom" name="timeFrom" class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="timeTo">Time To:</label>
                                            <input type="time" id="timeTo" name="timeTo" class="form-control" required>
                                        </div>

                                        <h5>Tasks</h5>
                                        <table id="tasksTable">
                                            <thead>
                                                <tr>
                                                    <th>Task Description</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><input type="text" name="tasks[]" class="form-control" required></td>
                                                    <td><button type="button" class="btn btn-danger btn-remove" onclick="removeRow(this)">Remove</button></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <button type="button" class="btn btn-primary" id="addTaskButton">Add Task</button>

                                        <h5 class="mt-4">Asset Requirements</h5>
                                        <table id="assetsTable">
                                            <thead>
                                                <tr>
                                                    <th>Asset</th>
                                                    <th>Number</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <select name="assets[]" class="form-control" required>
                                                            <option value="crane">Crane</option>
                                                            <option value="jcb">JCB</option>
                                                            <option value="bus">Bus</option>
                                                            <option value="machinery">Machinery</option>
                                                            <option value="equipment">Equipment</option>
                                                        </select>
                                                    </td>
                                                    <td><input type="number" name="asset_numbers[]" class="form-control" required></td>
                                                    <td><button type="button" class="btn btn-danger btn-remove" onclick="removeRow(this)">Remove</button></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <button type="button" class="btn btn-primary" id="addAssetButton">Add Asset</button>

                                        <div class="form-group mt-4">
                                            <button type="submit" class="btn btn-success">Submit Work Order</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        document.getElementById('addTaskButton').addEventListener('click', function() {
            const tableBody = document.getElementById('tasksTable').getElementsByTagName('tbody')[0];
            const newRow = tableBody.insertRow();
            const cell1 = newRow.insertCell(0);
            const cell2 = newRow.insertCell(1);

            cell1.innerHTML = '<input type="text" name="tasks[]" class="form-control" required>';
            cell2.innerHTML = '<button type="button" class="btn btn-danger btn-remove" onclick="removeRow(this)">Remove</button>';
        });

        document.getElementById('addAssetButton').addEventListener('click', function() {
            const tableBody = document.getElementById('assetsTable').getElementsByTagName('tbody')[0];
            const newRow = tableBody.insertRow();
            const cell1 = newRow.insertCell(0);
            const cell2 = newRow.insertCell(1);
            const cell3 = newRow.insertCell(2);

            cell1.innerHTML = `
                <select name="assets[]" class="form-control" required>
                    <option value="crane">Crane</option>
                    <option value="jcb">JCB</option>
                    <option value="bus">Bus</option>
                    <option value="machinery">Machinery</option>
                    <option value="equipment">Equipment</option>
                </select>
            `;
            cell2.innerHTML = '<input type="number" name="asset_numbers[]" class="form-control" required>';
            cell3.innerHTML = '<button type="button" class="btn btn-danger btn-remove" onclick="removeRow(this)">Remove</button>';
        });

        function removeRow(button) {
            const row = button.parentElement.parentElement;
            row.parentElement.removeChild(row);
        }
    </script>


        <div class="pd-20 card-box mb-30">
            <div class="clearfix mb-20">
                <div class="pull-left">
                    <h4 class="text-blue h4">Work Orders Table</h4>
                    
                
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">SR No</th>
                            <th scope="col">Work ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Start Date</th>
                            <th scope="col">Due Date</th>
                            <th scope="col">Recurrence</th>
                            <th scope="col">Priority</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="workOrderTableBody">
                        <!-- Work orders will be dynamically inserted here -->
                    </tbody>
                </table>
            </div>
            <div class="collapse collapse-box" id="responsive-table">
                <div class="code-box">
                    <div class="clearfix">
                        <a href="javascript:;" class="btn btn-primary btn-sm code-copy pull-left" data-clipboard-target="#responsive-table-code"><i class="fa fa-clipboard"></i> Copy Code</a>
                        <a href="#responsive-table" class="btn btn-primary btn-sm pull-right" rel="content-y" data-toggle="collapse" role="button"><i class="fa fa-eye-slash"></i> Hide Code</a>
                    </div>
                    <pre><code class="xml copy-pre" id="responsive-table-code">
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">SR No</th>
                <th scope="col">Work ID</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Start Date</th>
                <th scope="col">Due Date</th>
                <th scope="col">Recurrence</th>
                <th scope="col">Priority</th>
                <th scope="col">Status</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody id="workOrderTableBody">
            <!-- Work orders will be dynamically inserted here -->
        </tbody>
    </table>
</div>


 
                    </code></pre>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Task Modal -->
    <div class="modal fade" id="createTaskModal" tabindex="-1" role="dialog" aria-labelledby="createTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createTaskModalLabel">Create New Work Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="workOrderForm" method="POST" action="workrd.php">
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <textarea id="title" name="title" class="form-control" rows="3" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="taskDate">Date of Task:</label>
                        <input type="date" id="taskDate" name="taskDate" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="startTime">Time From:</label>
                        <input type="time" id="startTime" name="startTime" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="endTime">Time To:</label>
                        <input type="time" id="endTime" name="endTime" class="form-control" required>
                    </div>

                    <h5>Tasks</h5>
                    <table id="tasksTable">
                        <thead>
                            <tr>
                                <th>Task Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="text" name="tasks[]" class="form-control" required></td>
                                <td><button type="button" class="btn btn-danger btn-remove" onclick="removeRow(this)">Remove</button></td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-primary" id="addTaskButton">Add Task</button>

                    <h5 class="mt-4">Asset Requirements</h5>
                    <table id="assetsTable">
                        <thead>
                            <tr>
                                <th>Asset</th>
                                <th>Number</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select name="assets[]" class="form-control" required>
                                        <option value="crane">Crane</option>
                                        <option value="jcb">JCB</option>
                                        <option value="bus">Bus</option>
                                        <option value="machinery">Machinery</option>
                                        <option value="equipment">Equipment</option>
                                    </select>
                                </td>
                                <td><input type="number" name="asset_numbers[]" class="form-control" required></td>
                                <td><button type="button" class="btn btn-danger btn-remove" onclick="removeRow(this)">Remove</button></td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-primary" id="addAssetButton">Add Asset</button>

                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-success">Submit Work Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</div>

</div>

            </div>
        </div>
    </div>
				<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
				</div>
			</div>
			<div class="footer-wrap pd-20 mb-20 card-box">
				DeskApp - Bootstrap 4 Admin Template By <a href="https://github.com/dropways" target="_blank">Ankit Hingarajiya</a>
			</div>
		</div>
	</div>
	<!-- js -->
	<script src="vendors/scripts/core.js"></script>
	<script src="vendors/scripts/script.min.js"></script>
	<script src="vendors/scripts/process.js"></script>
	<script src="vendors/scripts/layout-settings.js"></script>
</body>
</html>





