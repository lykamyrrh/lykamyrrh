<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // If the session doesn't exist, redirect to the login page
    header('Location: login.php');
    exit();
}

// Optionally, you can retrieve user information if needed
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Shechaniah Academic Management System - Dashboard</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=LineAwesome:wght@500&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@600;700&display=swap" />
    <link rel="stylesheet" href="dashboard.css" />
</head>
<body>
    <header>
        <div class="header-content">
            <div class="left-section">
            <img src="img/SHECHANIAH LOGO 1.png" alt="School Logo" class="logo" />
                <div class="text-section">
                    <span class="shechaniah-academic-management-system">Shechaniah Academic <br /> Management System</span>
                    <span class="divider">|</span>
                    <span class="dashboard" id="header-title"></span>
                </div>
            </div>
            <div class="right-section">
                <div class="user-info">
                    <span class="joeme-ochia">Joeme Ochia</span>
                    <span class="admin">Admin</span>
                </div>
            </div>
        </div>
    </header>

    <aside class="sidebar">
        <ul>
            <li><a href="#" onclick="showSection('dashboard')">Dashboard</a></li>
            <li><a href="#" onclick="showSection('finance')">Finance</a></li>
            <li><a href="#" onclick="showSection('payment')">Payment</a></li>
            <li><a href="#" onclick="showSection('classlist')">Class List</a></li>
            <li><a href="#" onclick="showSection('stafflist')">Staff List</a></li>
            <li><a href="#" onclick="showSection('register')">Registration</a></li>
            <button onclick="openLogoutModal()">Logout</button>
        </ul>
    </aside>
    
            <!-- New right block for the dashboard -->
            <div class="right-block" id="right-block">
                <div class="square first-square">
                    <h2 class="square-title">Total number of Students</h2>
                    <input type="text" class="student-input" placeholder="Enter number">
                </div>
                <div class="square second-square"></div>
            </div>
            
    <div class="main-container">
        <div class="main-content">
            <div id="dashboard" class="section">
                <h2>Class List</h2>
                <div class="color-block">
                    <table class="class-list-table">
                        <thead>
                            <tr>
                                <th>Reference No.</th>
                                <th>Student Name</th>
                                <th>Gender</th>
                                <th>Class Level</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>John Doe</td>
                                <td>Male</td>
                                <td>Elementary</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
    
            <div id="finance" class="section">
                <h2>Finance Overview</h2>
                <div class="finance-buttons">
                    <button class="finance-btn">Total Cash in</button>
                    <button class="finance-btn">Finance Breakdown</button>
                    <button class="finance-btn">Finance Summary</button>
                </div>
                <div class="color-block">
                    <table class="finance-table">
                        <thead>
                            <tr>
                                <th>Student Name</th>
                                <th>Description</th>
                                <th>Date</th>
                                <th>Transaction ID</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Ariah Malahchi Ochia</td>
                                <td>Tuition Fee</td>
                                <td>2024-01-15</td>
                                <td>145654</td>
                                <td>$200</td>
                            </tr>
                            <tr>
                                <td>Maria Aligato</td>
                                <td>Library Fee</td>
                                <td>2024-01-20</td>
                                <td>2578321</td>
                                <td>$50</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="classlist" class="section">
            <link rel="stylesheet" type="text/css" href="classlist.css">
    <h2>Class List</h2>
    <div class="color-block">
    <button onclick="openAddModal()">Add Student</button> <!-- Button to open add modal -->
        <table class="class-list-table">
            <thead>
                <tr>
                    <th>Reference No.</th>
                    <th>Student Name</th>
                    <th>Gender</th>
                    <th>Class Level</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="studentTableBody">
                <?php
                // Assuming you fetch the class list from a database
                $students = [
                    ['reference_no' => 1, 'student_name' => 'John Doe', 'gender' => 'Male', 'class_level' => 'Elementary'],
                    ['reference_no' => 2, 'student_name' => 'Maria Aligato', 'gender' => 'Female', 'class_level' => 'Secondary']
                ];

                foreach ($students as $student) {
                    echo "<tr>";
                    echo "<td>" . $student['reference_no'] . "</td>";
                    echo "<td>" . $student['student_name'] . "</td>";
                    echo "<td>" . $student['gender'] . "</td>";
                    echo "<td>" . $student['class_level'] . "</td>";
                    echo "<td><button onclick='openEditModal(" . json_encode($student) . ")'>Edit</button></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal for Adding and Editing Students -->
<div id="studentModal" style="display: none;">
    <h2 id="modalTitle">Add Student</h2>
    <form id="studentForm">
        <input type="hidden" id="reference_no" name="reference_no">
        <div>
            <label for="student_name">Student Name:</label>
            <input type="text" id="student_name" name="student_name" required>
        </div>
        <div>
            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>
        <div>
            <label for="class_level">Class Level:</label>
            <input type="text" id="class_level" name="class_level" required>
        </div>
        <button type="submit" id="submitBtn">Submit</button>
        <button type="button" onclick="closeModal()">Cancel</button>
    </form>
</div>

<script>
    function openAddModal() {
        document.getElementById('modalTitle').innerText = 'Add Student';
        document.getElementById('studentForm').reset();
        document.getElementById('reference_no').value = ''; // Clear reference number for new entry
        document.getElementById('studentModal').style.display = 'block';
        document.getElementById('submitBtn').innerText = 'Add Student';
    }

    function openEditModal(student) {
        document.getElementById('modalTitle').innerText = 'Edit Student';
        document.getElementById('student_name').value = student.student_name;
        document.getElementById('gender').value = student.gender;
        document.getElementById('class_level').value = student.class_level;
        document.getElementById('reference_no').value = student.reference_no; // Set reference number for editing
        document.getElementById('studentModal').style.display = 'block';
        document.getElementById('submitBtn').innerText = 'Update Student';
    }

    function closeModal() {
        document.getElementById('studentModal').style.display = 'none';
    }

    document.getElementById('studentForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission
        const formData = new FormData(this);

        fetch('submit_student.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            // Handle success or failure
            if (data.success) {
                alert('Student added/updated successfully!');
                addStudentToTable(data.student);
                closeModal();
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    });

    function addStudentToTable(student) {
        const tableBody = document.getElementById('studentTableBody');
        let row = document.createElement('tr');
        row.innerHTML = `
            <td>${student.reference_no}</td>
            <td>${student.student_name}</td>
            <td>${student.gender}</td>
            <td>${student.class_level}</td>
            <td><button onclick='openEditModal(${JSON.stringify(student)})'>Edit</button></td>
        `;
        tableBody.appendChild(row);
    }
</script>

<div id="stafflist" class="section">
    <link rel="stylesheet" type="text/css" href="stafflist.css">
    <h2>Staff List</h2>
    <div class="color-block">
        <!-- Add Staff Button -->
        <button onclick="openAddStaffModal()" class="btn btn-primary">Add Staff</button>

        <table class="class-list-table">
            <thead>
                <tr>
                    <th>Staff ID</th>
                    <th>Staff Name</th>
                    <th>Department</th>
                    <th>Year Started</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="staffTableBody">
                <?php
                // Fetch staff list from a database (assumed here as an array)
                $staffs = [
                    ['staff_id' => 1, 'staff_name' => 'John Doe', 'department' => 'Math', 'year_started' => '2022'],
                    ['staff_id' => 2, 'staff_name' => 'Maria Aligato', 'department' => 'Science', 'year_started' => '2023']
                ];

                foreach ($staffs as $staff) {
                    echo "<tr>";
                    echo "<td>" . $staff['staff_id'] . "</td>";
                    echo "<td>" . $staff['staff_name'] . "</td>";
                    echo "<td>" . $staff['department'] . "</td>";
                    echo "<td>" . $staff['year_started'] . "</td>";
                    echo "<td><button onclick='openEditStaffModal(" . json_encode($staff) . ")' class='btn btn-secondary'>Edit</button></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal for Adding Staff -->
<div class="modal" id="addStaffModal" style="display: none;">
    <div class="modal-content">
        <span class="close" onclick="closeAddStaffModal()">&times;</span>
        <h2>Add New Staff</h2>
        <form id="addStaffForm">
            <label for="staff_name">Staff Name:</label>
            <input type="text" id="staff_name" name="staff_name" required><br>

            <label for="department">Department:</label>
            <input type="text" id="department" name="department" required><br>

            <label for="year_started">Year Started:</label>
            <input type="text" id="year_started" name="year_started" required><br>

            <button type="submit" class="btn btn-success">Add Staff</button>
        </form>
    </div>
</div>

<!-- Modal for Editing Staff -->
<div class="modal" id="editStaffModal" style="display: none;">
    <div class="modal-content">
        <span class="close" onclick="closeEditStaffModal()">&times;</span>
        <h2>Edit Staff</h2>
        <form id="editStaffForm">
            <input type="hidden" id="edit_staff_id" name="staff_id">
            
            <label for="edit_staff_name">Staff Name:</label>
            <input type="text" id="edit_staff_name" name="staff_name" required><br>

            <label for="edit_department">Department:</label>
            <input type="text" id="edit_department" name="department" required><br>

            <label for="edit_year_started">Year Started:</label>
            <input type="text" id="edit_year_started" name="year_started" required><br>

            <button type="submit" class="btn btn-success">Save Changes</button>
        </form>
    </div>
</div>

<script>
    function openAddStaffModal() {
        document.getElementById('addStaffModal').style.display = 'block';
    }

    function closeAddStaffModal() {
        document.getElementById('addStaffModal').style.display = 'none';
    }

    function openEditStaffModal(staff) {
        document.getElementById('edit_staff_id').value = staff.staff_id;
        document.getElementById('edit_staff_name').value = staff.staff_name;
        document.getElementById('edit_department').value = staff.department;
        document.getElementById('edit_year_started').value = staff.year_started;
        document.getElementById('editStaffModal').style.display = 'block';
    }

    function closeEditStaffModal() {
        document.getElementById('editStaffModal').style.display = 'none';
    }

    // Handle Add Staff Form Submission
    document.getElementById('addStaffForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission
        const formData = new FormData(this);

        fetch('submit_staff.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Staff added successfully!');
                addStaffToTable(data.staff);
                closeAddStaffModal();
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    });

    // Handle Edit Staff Form Submission
    document.getElementById('editStaffForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission
        const formData = new FormData(this);

        fetch('submit_staff.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Staff updated successfully!');
                updateStaffInTable(data.staff);
                closeEditStaffModal();
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    });

    function addStaffToTable(staff) {
        const tableBody = document.getElementById('staffTableBody');
        let row = document.createElement('tr');
        row.innerHTML = `
            <td>${staff.staff_id}</td>
            <td>${staff.staff_name}</td>
            <td>${staff.department}</td>
            <td>${staff.year_started}</td>
            <td><button onclick='openEditStaffModal(${JSON.stringify(staff)})' class='btn btn-secondary'>Edit</button></td>
        `;
        tableBody.appendChild(row);
    }

    function updateStaffInTable(staff) {
        const tableBody = document.getElementById('staffTableBody');
        const rows = tableBody.getElementsByTagName('tr');
        
        for (let row of rows) {
            if (row.cells[0].innerText == staff.staff_id) {
                row.cells[1].innerText = staff.staff_name;
                row.cells[2].innerText = staff.department;
                row.cells[3].innerText = staff.year_started;
                break;
            }
        }
    }
</script>

<!-- Logout Confirmation Modal -->
<div id="logoutModal" style="display: none;">
    <div class="modal-content">
        <span class="close" onclick="closeLogoutModal()">&times;</span>
        <p>Are you sure you want to logout?</p>
        <button id="confirmLogout">Yes, Logout</button>
        <button onclick="closeLogoutModal()">Cancel</button>
    </div>
</div>

<script>
// Function to open the logout modal
function openLogoutModal() {
    document.getElementById("logoutModal").style.display = "block";
}

// Function to close the logout modal
function closeLogoutModal() {
    document.getElementById("logoutModal").style.display = "none";
}

// Confirm logout functionality
document.getElementById("confirmLogout").addEventListener("click", function() {
    // Perform logout actions
    window.location.href = 'login.php'; // Redirect to your login script
});
</script>

        </div>
    </div>
               
    <script>
        function loginUser(event) {
            event.preventDefault(); // Prevent form submission
            
            // Mock login check (replace with your actual authentication logic)
            const username = event.target[0].value;
            const password = event.target[1].value;

            if (username === "admin" && password === "password") { // Example credentials
                document.getElementById("login").style.display = "none";
                document.getElementById("sidebar").style.display = "block";
                document.getElementById("user-info").style.display = "block";
                document.getElementById("header-title").textContent = "Dashboard"; // Set header title
                document.getElementById("main-container").style.display = "block";
                showSection('dashboard'); // Show dashboard
            } else {
                document.getElementById("loginError").textContent = "Invalid username or password.";
            }
        }

        function showSection(section) {
            const sections = document.querySelectorAll('.section');
            sections.forEach(function(sec) {
                sec.style.display = 'none';
            });
            const selectedSection = document.getElementById(section);
            if (selectedSection) {
                selectedSection.style.display = 'block';
            }
            localStorage.setItem('lastSection', section);

            const headerTitle = document.getElementById('header-title');
            switch (section) {
                case 'finance':
                    headerTitle.textContent = 'Finance';
                    break;
                case 'dashboard':
                    headerTitle.textContent = 'Dashboard';
                    break;
                case 'payment':
                    headerTitle.textContent = 'Payment';
                    break;
                case 'classlist':
                    headerTitle.textContent = 'Class List';
                    break;
                case 'stafflist':
                    headerTitle.textContent = 'Staff List';
                    break;
                    case 'register':
                    headerTitle.textContent = 'Registration';
                    break;
                case 'logout':
                    headerTitle.textContent = 'Logout';
                    break;
            }
        }

        window.onload = function() {
            const lastSection = localStorage.getItem('lastSection') || 'login';
            showSection(lastSection);
        };
    </script>
</body>
</html>
