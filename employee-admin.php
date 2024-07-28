<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Admin - Employee Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="vendors/styles/core.css">
    <link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="vendors/styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="header">
        <div class="header-left">
            <div class="menu-icon dw dw-menu"></div>
            <div class="search-toggle-icon dw dw-search2" data-toggle="header_search"></div>
        </div>
        <div class="header-right">
            <div class="user-info-dropdown">
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                        <span class="user-icon">
                            <img src="vendors/images/photo1.jpg" alt="">
                        </span>
                        <span class="user-name">Admin</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                        <a class="dropdown-item" href="profile.html"><i class="dw dw-user1"></i> Profile</a>
                        <a class="dropdown-item" href="login.html"><i class="dw dw-logout"></i> Log Out</a>
                    </div>
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
        </div>
        <div class="menu-block customscroll">
            <div class="sidebar-menu">
                <ul id="accordion-menu">
                    <li class="dropdown">
                        <a href="index.php" class="dropdown-toggle no-arrow">
                            <span class="micon dw dw-house-1"></span><span class="mtext">Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="employee.php" class="dropdown-toggle no-arrow">
                            <span class="micon dw dw-calendar1"></span><span class="mtext">Employee Management</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="title">
                                <h4>Employee Management</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Employee Management</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
                    <table id="employeeTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="employeeTableBody">
                            <!-- Data will be populated here from fetch_data.php -->
                        </tbody>
                    </table>

                    <button class="btn btn-primary" onclick="showAddEmployeeModal()">Add Employee</button>
                </div>
            </div>

            <!-- Add/Edit Attendance Modal -->
            <div id="attendanceModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="attendanceForm">
                            <div class="modal-header">
                                <h5 class="modal-title" id="attendanceModalTitle">Add Attendance</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" id="attendanceId" name="id">
                                <input type="hidden" id="attendanceEmployeeId" name="employee_id">
                                <input type="hidden" id="attendanceAction" name="action">
                                <div class="form-group">
                                    <label for="attendanceDate">Date</label>
                                    <input type="date" id="attendanceDate" name="date" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="attendanceStatus">Status</label>
                                    <select id="attendanceStatus" name="status" class="form-control" required>
                                        <option value="present">Present</option>
                                        <option value="absent">Absent</option>
                                        <option value="leave">Leave</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div id="calendar"></div>

            <div class="footer-wrap pd-20 mb-20 card-box">
                HackIndore - ProCoderz
            </div>
        </div>
    </div>

    <!-- Add/Edit Employee Modal -->
    <div id="employeeModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="employeeForm">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitle">Add Employee</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="employeeId" name="id">
                        <input type="hidden" id="employeeAction" name="action">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <input type="text" id="role" name="role" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select id="status" name="status" class="form-control" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="vendors/scripts/core.js"></script>
    <script src="vendors/scripts/script.min.js"></script>
    <script src="vendors/scripts/process.js"></script>
    <script src="vendors/scripts/layout-settings.js"></script>

    <script>
        $(document).ready(function () {
            fetchEmployees();
            initializeCalendar();

            $('#employeeForm').on('submit', function (e) {
                e.preventDefault();
                saveEmployee();
            });

            $('#attendanceForm').on('submit', function (e) {
                e.preventDefault();
                saveAttendance();
            });
        });

        function fetchEmployees() {
            $.ajax({
                url: 'fetch_data.php',
                method: 'GET',
                dataType: 'json',
                success: function (response) {
                    let tableBody = $('#employeeTableBody');
                    tableBody.empty();
                    response.forEach(function (employee) {
                        let row = `
                            <tr>
                                <td>${employee.name}</td>
                                <td>${employee.email}</td>
                                <td>${employee.role}</td>
                                <td>${employee.status}</td>
                                <td>
                                    <button class="btn btn-sm btn-primary" onclick="editEmployee(${employee.id})">Edit</button>
                                    <button class="btn btn-sm btn-danger" onclick="deleteEmployee(${employee.id})">Delete</button>
                                    <button class="btn btn-sm btn-secondary" onclick="manageAttendance(${employee.id}, '${employee.name}')">Attendance</button>
                                </td>
                            </tr>
                        `;
                        tableBody.append(row);
                    });
                }
            });
        }

        function saveEmployee() {
            let formData = $('#employeeForm').serialize();
            $.ajax({
                url: 'save_employee.php',
                method: 'POST',
                data: formData,
                success: function (response) {
                    $('#employeeModal').modal('hide');
                    fetchEmployees();
                }
            });
        }

        function editEmployee(id) {
            $.ajax({
                url: 'get_employee.php',
                method: 'GET',
                data: { id: id },
                dataType: 'json',
                success: function (employee) {
                    $('#employeeId').val(employee.id);
                    $('#name').val(employee.name);
                    $('#email').val(employee.email);
                    $('#role').val(employee.role);
                    $('#status').val(employee.status);
                    $('#employeeAction').val('edit');
                    $('#modalTitle').text('Edit Employee');
                    $('#employeeModal').modal('show');
                }
            });
        }

        function deleteEmployee(id) {
            if (confirm('Are you sure you want to delete this employee?')) {
                $.ajax({
                    url: 'delete_employee.php',
                    method: 'POST',
                    data: { id: id },
                    success: function (response) {
                        fetchEmployees();
                    }
                });
            }
        }

        function manageAttendance(employeeId, employeeName) {
            $('#attendanceEmployeeId').val(employeeId);
            $('#attendanceModalTitle').text(`Manage Attendance for ${employeeName}`);
            $('#attendanceModal').modal('show');
        }

        function saveAttendance() {
            let formData = $('#attendanceForm').serialize();
            $.ajax({
                url: 'save_attendance.php',
                method: 'POST',
                data: formData,
                success: function (response) {
                    $('#attendanceModal').modal('hide');
                    fetchAttendance();
                }
            });
        }

        function initializeCalendar() {
            $('#calendar').fullCalendar({
                events: function (start, end, timezone, callback) {
                    $.ajax({
                        url: 'fetch_attendance.php',
                        dataType: 'json',
                        success: function (response) {
                            var events = [];
                            $(response).each(function () {
                                events.push({
                                    id: this.id,
                                    title: this.status,
                                    start: this.date,
                                    allDay: true
                                });
                            });
                            callback(events);
                        }
                    });
                },
                eventClick: function (event) {
                    editAttendance(event.id);
                }
            });
        }

        function editAttendance(id) {
            $.ajax({
                url: 'get_attendance.php',
                method: 'GET',
                data: { id: id },
                dataType: 'json',
                success: function (attendance) {
                    $('#attendanceId').val(attendance.id);
                    $('#attendanceEmployeeId').val(attendance.employee_id);
                    $('#attendanceDate').val(attendance.date);
                    $('#attendanceStatus').val(attendance.status);
                    $('#attendanceAction').val('edit');
                    $('#attendanceModalTitle').text('Edit Attendance');
                    $('#attendanceModal').modal('show');
                }
            });
        }
    </script>
</body>
</html>
