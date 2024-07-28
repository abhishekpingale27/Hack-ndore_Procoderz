<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>Employee</title>

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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


	
</head>
<body>
	<!-- <div class="pre-loader">
		<div class="pre-loader-box">
			<div class="loader-logo"><img src="vendors/images/deskapp-logo.svg" alt=""></div>
			<div class='loader-progress' id="progress_div">
				<div class='bar' id='bar1'></div>
			</div>
			<div class='percent' id='percent1'>0%</div>
			<div class="loading-text">
				Loading...
			</div>
		</div>
	</div> -->

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
						<span class="user-name">Ross C. Lopez</span>
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
						<a class="dropdown-item" href="profile.html"><i class="dw dw-user1"></i> Profile</a>
						<a class="dropdown-item" href="profile.html"><i class="dw dw-settings2"></i> Setting</a>
						<a class="dropdown-item" href="faq.html"><i class="dw dw-help"></i> Help</a>
						<a class="dropdown-item" href="login.html"><i class="dw dw-logout"></i> Log Out</a>
					</div>
				</div>
			</div>
			<div class="github-link">
				<!-- <a href="https://github.com/dropways/deskapp" target="_blank"><img src="vendors/images/github.svg" alt=""></a> -->
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
			<a href="index.php">
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
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-house-1"></span><span class="mtext">Home</span>
						</a>
						<ul class="submenu">
							<li><a href="blank.php">Dashboard</a></li>
					
						</ul>
					</li>
				
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-library"></span><span class="mtext">Task Management</span>
						</a>
						<ul class="submenu">
							<li><a href="basic-table.php">Tasks</a></li>
							<!-- <li><a href="datatable.html">DataTables</a></li> -->
						</ul>
					</li>
					<li class="dropdown">
						<a href="fuel.php" class="dropdown-toggle no arrow">
							<span class="micon dw dw-library"></span><span class="mtext">Fuel Management</span>
						</a>
						
					</li>
					<li>
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-calendar1"></span><span class="mtext">Expense Tracking</span>
						</a>
							<ul class="submenu">
							<li><a href="exp-analysis.php">Analysis</a></li>
						
						</ul>
						
					</li>
                    <li>
						<a href="employee.php" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-calendar1"></span><span class="mtext">Employee Portal</span>
						</a>
					</li>
					<li>
						<a href="work-order.php" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-calendar1"></span><span class="mtext">Work-Order</span>
						</a>
					</li>

					<li>
						<a href="analytics.php" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-calendar1"></span><span class="mtext">Analytics</span>
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
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Expense Tracker</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="blank.php">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">New Expense</li>
								</ol>
							</nav>
							<!-- horizontal Basic Forms Start -->
				<div class="pd-20 card-box mb-30">
					<div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue h4"> Add new expense</h4>
							<p class="mb-30">element </p>
						</div>
						<div class="pull-right">
						</div>
					</div>
					<form action="submit_expense.php" method="post" enctype="multipart/form-data" id="expenseForm">
    <div class="form-group">
        <label>Title of Expense</label>
        <input class="form-control" type="text" name="title" placeholder="Title">
    </div>
    <div class="form-group">
        <label>HSN no.</label>
        <input class="form-control" type="number" name="hsn_no" value="9963">
    </div>
    <div class="form-group">
        <label>Transaction Amount</label>
        <input class="form-control" type="number" name="amount" value="00">
    </div>
    <div class="form-group">
        <label>Transaction Date</label>
        <input class="form-control" type="date" name="transaction_date">
    </div>
    <div class="form-group">
        <label>Payment Method</label>
        <select class="form-control" name="payment_method">
            <option value="Credit Card/ Debit Card/ Net Banking/UPI">Credit Card/ Debit Card/ Net Banking/UPI</option>
            <option value="CASH">CASH</option>
            <option value="Cheque">Cheque</option>
            <option value="Bank Transfer">Bank Transfer</option>
        </select>
    </div>
    <div class="form-group">
        <label>Transaction ID</label>
        <input class="form-control" type="text" name="transaction_id" placeholder="Readonly input here…">
    </div>
    <div class="form-group">
        <label>Vendor GSTIN</label>
        <input type="text" class="form-control" name="vendor_gstin" placeholder="Disabled input">
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <label class="weight-600">Category</label>
                <div class="custom-control custom-checkbox mb-5">
                    <input type="checkbox" class="custom-control-input" name="categories[]" value="Raw Material" id="customCheck1">
                    <label class="custom-control-label" for="customCheck1">Raw Material</label>
                </div>
                <div class="custom-control custom-checkbox mb-5">
                    <input type="checkbox" class="custom-control-input" name="categories[]" value="Rent" id="customCheck2">
                    <label class="custom-control-label" for="customCheck2">Rent</label>
                </div>
                <div class="custom-control custom-checkbox mb-5">
                    <input type="checkbox" class="custom-control-input" name="categories[]" value="Fuel" id="customCheck3">
                    <label class="custom-control-label" for="customCheck3">Fuel</label>
                </div>
                <div class="custom-control custom-checkbox mb-5">
                    <input type="checkbox" class="custom-control-input" name="categories[]" value="Labour" id="customCheck4">
                    <label class="custom-control-label" for="customCheck4">Labour</label>
                </div>
                <div class="custom-control custom-checkbox mb-5">
                    <input type="checkbox" class="custom-control-input" name="categories[]" value="Machinery" id="customCheck5">
                    <label class="custom-control-label" for="customCheck5">Machinery</label>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label>Department</label>
        <select class="form-control" name="department">
            <option value="Administration">Administration</option>
            <option value="PWD">PWD</option>
            <option value="Health and Sanitation">Health and Sanitation</option>
            <option value="Housing and Urban Development">Housing and Urban Development</option>
            <option value="Transportation">Transportation</option>
            <option value="Water and Sewage">Water and Sewage</option>
        </select>
    </div>
    <div class="form-group">
        <label>Description of Expense</label>
        <textarea class="form-control" name="description"></textarea>
    </div>
    <div class="form-group">
        <label>Upload Transaction Proof/ Digital Receipt</label>
        <div class="custom-file">
            <input type="file" class="custom-file-input" name="receipt">
            <label class="custom-file-label">Choose file</label>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<!-- Modal for Success Message -->
<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Success</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                New expense recorded successfully.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

				
				</div>
			</div>
		</div>
	</div>
				
	<h1>Expense Analysis</h1>
    <table id="expenseTable">
        <thead>
            <tr>
                <th>Title</th>
                <th>HSN No</th>
                <th>Amount</th>
                <th>Transaction Date</th>
                <th>Payment Method</th>
                <th>Transaction ID</th>
                <th>Vendor GSTIN</th>
                <th>Category</th>
                <th>Department</th>
                <th>Description</th>
                <th>Receipt</th>
            </tr>
        </thead>
        <tbody>
            <!-- Data will be populated here -->
        </tbody>
    </table>

    <h2>Total Expenses: <span id="totalExpenses"></span></h2>
    <h2>Category-wise Expenses:</h2>
    <div id="categoryExpenses"></div>

	<div>
        <canvas id="expenseByCategory"></canvas>
    </div>
    <div>
        <canvas id="expenseByDepartment"></canvas>
    </div>
    <div>
        <canvas id="expenseByPaymentMethod"></canvas>
    </div>
    
	<script>
        fetch('fetch_expenses.php')
            .then(response => response.json())
            .then(data => {
                const categories = {};
                const departments = {};
                const paymentMethods = {};
                
                data.forEach(expense => {
                    if (categories[expense.category]) {
                        categories[expense.category] += parseFloat(expense.amount);
                    } else {
                        categories[expense.category] = parseFloat(expense.amount);
                    }

                    if (departments[expense.department]) {
                        departments[expense.department] += parseFloat(expense.amount);
                    } else {
                        departments[expense.department] = parseFloat(expense.amount);
                    }

                    if (paymentMethods[expense.payment_method]) {
                        paymentMethods[expense.payment_method] += parseFloat(expense.amount);
                    } else {
                        paymentMethods[expense.payment_method] = parseFloat(expense.amount);
                    }
                });

                const ctx1 = document.getElementById('expenseByCategory').getContext('2d');
                new Chart(ctx1, {
                    type: 'bar',
                    data: {
                        labels: Object.keys(categories),
                        datasets: [{
                            label: 'Expenses by Category',
                            data: Object.values(categories),
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                const ctx2 = document.getElementById('expenseByDepartment').getContext('2d');
                new Chart(ctx2, {
                    type: 'pie',
                    data: {
                        labels: Object.keys(departments),
                        datasets: [{
                            label: 'Expenses by Department',
                            data: Object.values(departments),
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false
                    }
                });

                const ctx3 = document.getElementById('expenseByPaymentMethod').getContext('2d');
                new Chart(ctx3, {
                    type: 'doughnut',
                    data: {
                        labels: Object.keys(paymentMethods),
                        datasets: [{
                            label: 'Expenses by Payment Method',
                            data: Object.values(paymentMethods),
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false
                    }
                });
            })
            .catch(error => console.error('Error fetching data:', error));
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('fetch_expenses.php')
                .then(response => response.json())
                .then(data => {
                    const tableBody = document.querySelector('#expenseTable tbody');
                    const totalExpensesElement = document.getElementById('totalExpenses');
                    const categoryExpensesElement = document.getElementById('categoryExpenses');

                    let totalExpenses = 0;
                    let categoryExpenses = {};

                    data.forEach(expense => {
                        totalExpenses += parseFloat(expense.amount);

                        if (!categoryExpenses[expense.category]) {
                            categoryExpenses[expense.category] = 0;
                        }
                        categoryExpenses[expense.category] += parseFloat(expense.amount);

                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${expense.title}</td>
                            <td>${expense.hsn_no}</td>
                            <td>${expense.amount}</td>
                            <td>${expense.transaction_date}</td>
                            <td>${expense.payment_method}</td>
                            <td>${expense.transaction_id}</td>
                            <td>${expense.vendor_gstin}</td>
                            <td>${expense.category}</td>
                            <td>${expense.department}</td>
                            <td>${expense.description}</td>
                            <td><a href="${expense.receipt_path}" target="_blank">View Receipt</a></td>
                        `;
                        tableBody.appendChild(row);
                    });

                    totalExpensesElement.textContent = totalExpenses.toFixed(2);

                    for (const category in categoryExpenses) {
                        const div = document.createElement('div');
                        div.textContent = `${category}: ${categoryExpenses[category].toFixed(2)}`;
                        categoryExpensesElement.appendChild(div);
                    }
                })
                .catch(error => console.error('Error fetching data:', error));
        });
    </script>
	<script>
$(document).ready(function() {
    $('#expenseForm').on('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        var formData = new FormData(this);

        $.ajax({
            url: 'submit_expense.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                var result = JSON.parse(response);
                if (result.success) {
                    $('#successModal').modal('show');
                } else {
                    alert('Error: ' + result.error);
                }
            }
        });
    });
});
</script>
					



                                
<script>
        function formatDate(date) {
            const options = { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' };
            return new Intl.DateTimeFormat('en-US', options).format(date);
        }

        document.addEventListener('DOMContentLoaded', (event) => {
            const now = new Date();
            const dateString = formatDate(now);
            document.getElementById('dropdownMenuButton').textContent = dateString;
        });
    </script>

								<!-- <div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="#">Export List</a>
									<a class="dropdown-item" href="#">Policies</a>
									<a class="dropdown-item" href="#">View Assets</a>
								</div> -->
							</div>
						</div>
					</div>
				</div>
				
            

			</div>
            <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
            
            </div>
            
			<div class="footer-wrap pd-20 mb-20 card-box">
			Procoderz
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