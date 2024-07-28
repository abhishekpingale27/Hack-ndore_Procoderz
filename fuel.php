<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "workshop_management";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch fuel consumption data
$sql = "SELECT vehicle_id, SUM(fuel_consumed) AS total_fuel FROM fuel_consumption GROUP BY vehicle_id";
$result = $conn->query($sql);

$emission_factor = 2.31; // kg CO2 per liter of gasoline
$data = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $carbon_footprint = $row['total_fuel'] * $emission_factor;
        $data[] = [
            'vehicle_id' => $row['vehicle_id'],
            'total_fuel' => $row['total_fuel'],
            'carbon_footprint' => $carbon_footprint
        ];
    }
} else {
    echo "0 results";
}
$conn->close();
?>


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

	<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/style.css">


	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
	</script>
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
			<!-- <div class="user-notification">
				<div class="dropdown">
					<a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
						<i class="icon-copy dw dw-notification"></i>
						<span class="badge notification-active"></span>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<div class="notification-list mx-h-350 customscroll">
							<ul>
								<li>
									<a href="#">
										<img src="vendors/images/img.jpg" alt="">
										<h3>John Doe</h3>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="vendors/images/photo1.jpg" alt="">
										<h3>Lea R. Frith</h3>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="vendors/images/photo2.jpg" alt="">
										<h3>Erik L. Richards</h3>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="vendors/images/photo3.jpg" alt="">
										<h3>John Doe</h3>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="vendors/images/photo4.jpg" alt="">
										<h3>Renee I. Hansen</h3>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="vendors/images/img.jpg" alt="">
										<h3>Vicki M. Coleman</h3>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div> -->
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
				<img src="TaskTrack2.png" alt="" class="dark-logo">
				<img src="TaskTrack2.png" alt="" class="light-logo">
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
							<!-- <li><a href="index2.html">Dashboard style 2</a></li> -->
						</ul>
					</li>
					<!-- <li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-edit2"></span><span class="mtext">Forms</span>
						</a>
						<ul class="submenu">
							<li><a href="form-basic.html">Form Basic</a></li>
							<li><a href="advanced-components.html">Advanced Components</a></li>
							<li><a href="form-wizard.html">Form Wizard</a></li>
							<li><a href="html5-editor.html">HTML5 Editor</a></li>
							<li><a href="form-pickers.html">Form Pickers</a></li>
							<li><a href="image-cropper.html">Image Cropper</a></li>
							<li><a href="image-dropzone.html">Image Dropzone</a></li>
						</ul>
					</li> -->
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
						<a href="expense.php" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-calendar1"></span><span class="mtext">Expense Tracking</span>
						</a>
					</li>
					<li>
						<a href="work-order.php" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-calendar1"></span><span class="mtext">Work-Order</span>
						</a>
					</li>
					<li>
						<a href="employee.php" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-calendar1"></span><span class="mtext">Employee Portal</span>
						</a>
					</li>
					<li>
						<a href="analytics.php" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-calendar1"></span><span class="mtext">Analytics</span>
						</a>
					</li>
					<!-- <li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-apartment"></span><span class="mtext"> UI Elements </span>
						</a>
						<ul class="submenu">
							<li><a href="ui-buttons.html">Buttons</a></li>
							<li><a href="ui-cards.html">Cards</a></li>
							<li><a href="ui-cards-hover.html">Cards Hover</a></li>
							<li><a href="ui-modals.html">Modals</a></li>
							<li><a href="ui-tabs.html">Tabs</a></li>
							<li><a href="ui-tooltip-popover.html">Tooltip &amp; Popover</a></li>
							<li><a href="ui-sweet-alert.html">Sweet Alert</a></li>
							<li><a href="ui-notification.html">Notification</a></li>
							<li><a href="ui-timeline.html">Timeline</a></li>
							<li><a href="ui-progressbar.html">Progressbar</a></li>
							<li><a href="ui-typography.html">Typography</a></li>
							<li><a href="ui-list-group.html">List group</a></li>
							<li><a href="ui-range-slider.html">Range slider</a></li>
							<li><a href="ui-carousel.html">Carousel</a></li>
						</ul>
					</li> -->
					<!-- <li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-paint-brush"></span><span class="mtext">Icons</span>
						</a>
						<ul class="submenu">
							<li><a href="font-awesome.html">FontAwesome Icons</a></li>
							<li><a href="foundation.html">Foundation Icons</a></li>
							<li><a href="ionicons.html">Ionicons Icons</a></li>
							<li><a href="themify.html">Themify Icons</a></li>
							<li><a href="custom-icon.html">Custom Icons</a></li>
						</ul>
					</li> -->
					<!-- <li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-analytics-21"></span><span class="mtext">Charts</span>
						</a>
						<ul class="submenu">
							<li><a href="highchart.html">Highchart</a></li>
							<li><a href="knob-chart.html">jQuery Knob</a></li>
							<li><a href="jvectormap.html">jvectormap</a></li>
							<li><a href="apexcharts.html">Apexcharts</a></li>
						</ul>
					</li> -->
					<!-- <li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-right-arrow1"></span><span class="mtext">Additional Pages</span>
						</a>
						<ul class="submenu">
							<li><a href="video-player.html">Video Player</a></li>
							<li><a href="login.html">Login</a></li>
							<li><a href="forgot-password.html">Forgot Password</a></li>
							<li><a href="reset-password.html">Reset Password</a></li>
						</ul>
					</li> -->
					<!-- <li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-browser2"></span><span class="mtext">Error Pages</span>
						</a>
						<ul class="submenu">
							<li><a href="400.html">400</a></li>
							<li><a href="403.html">403</a></li>
							<li><a href="404.html">404</a></li>
							<li><a href="500.html">500</a></li>
							<li><a href="503.html">503</a></li>
						</ul>
					</li> -->

					<!-- <li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-copy"></span><span class="mtext">Extra Pages</span>
						</a>
						<ul class="submenu">
							<li><a href="blank.html">Blank</a></li>
							<li><a href="contact-directory.html">Contact Directory</a></li>
							<li><a href="blog.html">Blog</a></li>
							<li><a href="blog-detail.html">Blog Detail</a></li>
							<li><a href="product.html">Product</a></li>
							<li><a href="product-detail.html">Product Detail</a></li>
							<li><a href="faq.html">FAQ</a></li>
							<li><a href="profile.html">Profile</a></li>
							<li><a href="gallery.html">Gallery</a></li>
							<li><a href="pricing-table.html">Pricing Tables</a></li>
						</ul>
					</li> -->
					<!-- <li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-list3"></span><span class="mtext">Multi Level Menu</span>
						</a>
						<ul class="submenu">
							<li><a href="javascript:;">Level 1</a></li>
							<li><a href="javascript:;">Level 1</a></li>
							<li><a href="javascript:;">Level 1</a></li>
							<li class="dropdown">
								<a href="javascript:;" class="dropdown-toggle">
									<span class="micon fa fa-plug"></span><span class="mtext">Level 2</span>
								</a>
								<ul class="submenu child">
									<li><a href="javascript:;">Level 2</a></li>
									<li><a href="javascript:;">Level 2</a></li>
								</ul>
							</li>
							<li><a href="javascript:;">Level 1</a></li>
							<li><a href="javascript:;">Level 1</a></li>
							<li><a href="javascript:;">Level 1</a></li>
						</ul>
					</li> -->
					<!-- <li>
						<a href="sitemap.html" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-diagram"></span><span class="mtext">Sitemap</span>
						</a>
					</li> -->
					<!-- <li>
						<a href="chat.html" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-chat3"></span><span class="mtext">Chat</span>
						</a>
					</li>
					<li>
						<a href="invoice.html" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-invoice"></span><span class="mtext">Invoice</span>
						</a>
					</li>
					<li>
						<div class="dropdown-divider"></div>
					</li>
					<li>
						<div class="sidebar-small-cap">Extra</div>
					</li>
					<li>
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-edit-2"></span><span class="mtext">Documentation</span>
						</a>
						<ul class="submenu">
							<li><a href="introduction.html">Introduction</a></li>
							<li><a href="getting-started.html">Getting Started</a></li>
							<li><a href="color-settings.html">Color Settings</a></li>
							<li><a href="third-party-plugins.html">Third Party Plugins</a></li>
						</ul>
					</li> -->
					<!-- <li>
						<a href="https://dropways.github.io/deskapp-free-single-page-website-template/" target="_blank" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-paper-plane1"></span>
							<span class="mtext">Landing Page <img src="vendors/images/coming-soon.png" alt="" width="25"></span>
						</a>
					</li> -->
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
								<h4>Fuel Management</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="blank.php">Fuel</a></li>
									<li class="breadcrumb-item active" aria-current="page">Manage</li>
								</ol>
							</nav>
						</div>
						<div class="col-md-6 col-sm-12 text-right">
							<div class="dropdown">
								<a class="btn btn-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
									January 2018
								</a>
								<!-- <div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="#">Export List</a>
									<a class="dropdown-item" href="#">Policies</a>
									<a class="dropdown-item" href="#">View Assets</a>
								</div> -->
							</div>
						</div>
					</div>
				</div>
				<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
                    <span><b>Fuel Bill & Requests Management</b></span><p></p>
					<button class="btn btn-primary"  type="button" data-toggle="modal" data-target="#formModal">+ New Fuel Reading</button>

    <!-- Modal structure -->
    <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">New Request</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="wizard-content">
                        <form id="newFuelReadingForm" class="tab-wizard wizard-circle wizard">
                            <h5>Employee ID</h5>
                            <section>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>ID :</label>
                                            <input type="text" class="form-control" name="employee_id">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Vehicle ID:</label>
                                            <input type="text" class="form-control" name="vehicle_id">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone Number :</label>
                                            <input type="text" class="form-control" name="phone_number">
                                        </div>
                                    </div>
                                </div>
								
                            </section>
                            <h5>Upload reading photo</h5>
							<p></p>
                            <section>
                                <div class="row">
                                    <div class="container">
                                        <h4>OCR Speedometer Reader</h4>
										<p></p>
                                        <input type="file" id="imageUpload" accept="image/*">
                                        <p></p>
                                        <button class="btn btn-secondary" onclick="uploadImage()">Upload Image</button>
                                        <p></p>
                                        <div id="loading">Loading...</div>
                                        <p></p>
                                        <div id="results">
                                            <h4>Detected Reading:</h4>
                                            <pre id="detectedText"></pre>
											<input type="text" class="form-control" name="meter">
                                        </div>
                                        <div id="errorMessage" class="error"></div>
                                    </div>
                                </div>
                            </section>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="submitForm()">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <button class="btn btn-primary" id="viewRequests">View Active requests</button>
<p></p>
    <!-- Active requests section -->
    <div id="activeRequests"></div>
				<button class="btn btn-primary">Previous History</button>
	</div>
                <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
                <p><b>Start new track</b></p>
				<button type="button" class="btn btn-primary" id="startTracking">Start Fuel Tracking</button>
    <p> </p>
    <div class="row clearfix">
        <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
            <div class="card card-box">
                <div class="card-body">
                    <h5 class="card-title weight-500">Distance</h5>
                    <p class="distance" style="font-size: 30px;">0 km</p>
                    <li class="list-group-item">Current Location <span id="currentLocation">00.00.00 , 11.11.11</span></li>
                    <p> </p>
                    <button class="btn btn-primary" id="stopTracking">Stop Tracking</button>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
            <div class="card card-box">
                <div class="card-body">
                    <h5 class="card-title weight-500">Fuel Consumption</h5>
                    <p class="fuel-consume" style="font-size: 25px;">0 lt</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Approx Milage <span>0</span></li>
                    <li class="list-group-item">Start Time <span id="startTime">0</span></li>
                    <li class="list-group-item">Running Time <span id="runningTime">0</span></li>
                </ul>
            </div>
        </div>
    </div>
    <div id="map"></div>

	<p>  </p>
                
                <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
                    Carbon footprints

				</div>
				<canvas id="carbonFootprintChart" width="400" height="200"></canvas>
                <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
				</div>
			</div>
			<div class="footer-wrap pd-20 mb-20 card-box">
			Procoderz
			</div>
		</div>
	</div>
	<!-- js -->
	<script>
        var ctx = document.getElementById('carbonFootprintChart').getContext('2d');
        var chartData = {
            labels: [<?php foreach($data as $d) { echo '"Vehicle '.$d['vehicle_id'].'",'; } ?>],
            datasets: [{
                label: 'Carbon Footprint (kg CO2)',
                data: [<?php foreach($data as $d) { echo $d['carbon_footprint'].','; } ?>],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        };
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: chartData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        function submitForm() {
            const formData = new FormData(document.getElementById('newFuelReadingForm'));
            
            fetch('save_fuel_reading.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Data saved successfully!');
                    $('#formModal').modal('hide');
                } else {
                    alert('Error saving data');
                }
            })
            .catch(error => console.error('Error:', error));
        }

        document.getElementById('viewRequests').addEventListener('click', function() {
            fetch('get_active_requests.php')
            .then(response => response.json())
            .then(data => {
                let requestsHtml = '<ul>';
                data.forEach(request => {
                    requestsHtml += `<li>${request.employee_id} - ${request.vehicle_id} - ${request.phone_number} -${request.meter} </li>`;
                });
                requestsHtml += '</ul>';
                document.getElementById('activeRequests').innerHTML = requestsHtml;
            })
            .catch(error => console.error('Error:', error));
        });
    </script>
	<script>
        let startCoords, endCoords, watchId;
        let startTime, endTime, runningTimer;
        let distanceTraveled = 0;

        document.getElementById('startTracking').addEventListener('click', startTracking);
        document.getElementById('stopTracking').addEventListener('click', stopTracking);

        function startTracking() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(startPosition, showError, { enableHighAccuracy: true });
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        function startPosition(position) {
            startTime = new Date();
            document.getElementById('startTime').innerText = startTime.toLocaleTimeString();

            const lat = position.coords.latitude;
            const lng = position.coords.longitude;
            startCoords = { lat: lat, lng: lng };
            endCoords = startCoords;

            map = L.map('map').setView([lat, lng], 13);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
            marker = L.marker([lat, lng]).addTo(map).bindPopup('Current Location').openPopup();

            watchId = navigator.geolocation.watchPosition(updatePosition, showError, { enableHighAccuracy: true });
            startStopwatch();
        }

        function stopTracking() {
            if (watchId) {
                navigator.geolocation.clearWatch(watchId);
                endTime = new Date();
                stopStopwatch();
            }
        }

        function updatePosition(position) {
            const lat = position.coords.latitude;
            const lng = position.coords.longitude;
            document.getElementById('currentLocation').innerText = `${lat} , ${lng}`;

            if (endCoords) {
                calculateDistance({ lat: endCoords.lat, lng: endCoords.lng }, { lat: lat, lng: lng });
            }
            endCoords = { lat: lat, lng: lng };

            marker.setLatLng([lat, lng]);
            map.setView([lat, lng], map.getZoom());
        }

        function calculateDistance(start, end) {
            const url = `https://router.project-osrm.org/route/v1/driving/${start.lng},${start.lat};${end.lng},${end.lat}?overview=false`;
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (data.routes.length > 0) {
                        const distance = data.routes[0].distance / 1000; // convert meters to kilometers
                        distanceTraveled += distance;
                        document.querySelector('.distance').innerText = `${distanceTraveled.toFixed(2)} km`;
                    } else {
                        console.error('Error fetching route:', data);
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function startStopwatch() {
            const startTimestamp = Date.now();
            runningTimer = setInterval(() => {
                const elapsed = Date.now() - startTimestamp;
                const hours = Math.floor(elapsed / 3600000);
                const minutes = Math.floor((elapsed % 3600000) / 60000);
                const seconds = Math.floor((elapsed % 60000) / 1000);
                document.getElementById('runningTime').innerText = `${hours}:${minutes < 10 ? '0' : ''}${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
            }, 1000);
        }

        function stopStopwatch() {
            clearInterval(runningTimer);
        }

        function showError(error) {
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    alert("User denied the request for Geolocation.");
                    break;
                case error.POSITION_UNAVAILABLE:
                    alert("Location information is unavailable.");
                    break;
                case error.TIMEOUT:
                    alert("The request to get user location timed out.");
                    break;
                case error.UNKNOWN_ERROR:
                    alert("An unknown error occurred.");
                    break;
            }
        }
    </script>
	<script>
	document.getElementById('imageUpload').addEventListener('change', function() {
    document.getElementById('results').style.display = 'none';
    document.getElementById('errorMessage').textContent = '';
});

function uploadImage() {
    const imageUpload = document.getElementById('imageUpload').files[0];
    if (!imageUpload) {
        alert('Please select an image to upload.');
        return;
    }

    const formData = new FormData();
    formData.append('file', imageUpload);
    formData.append('isOverlayRequired', false);
    formData.append('apikey', 'K81269351288957'); // Replace with your OCR.space API key
    formData.append('language', 'eng');

    document.getElementById('loading').style.display = 'block';
    document.getElementById('errorMessage').textContent = '';

    fetch('https://api.ocr.space/parse/image', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(result => {
        document.getElementById('loading').style.display = 'none';
        if (result.IsErroredOnProcessing) {
            document.getElementById('errorMessage').textContent = 'Error: ' + result.ErrorMessage[0];
        } else {
            const detectedText = result.ParsedResults[0].ParsedText;
            document.getElementById('detectedText').textContent = detectedText;
            document.getElementById('results').style.display = 'block';
        }
    })
    .catch(error => {
        document.getElementById('loading').style.display = 'none';
        document.getElementById('errorMessage').textContent = 'An error occurred while processing the image.';
        console.error('Error:', error);
    });
}
</script>
	<script src="vendors/scripts/core.js"></script>
	<script src="vendors/scripts/script.min.js"></script>
	<script src="vendors/scripts/process.js"></script>
	<script src="vendors/scripts/layout-settings.js"></script>
</body>
</html>