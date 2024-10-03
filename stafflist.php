
<div id="stafflist" class="section">
    <h2>Staff List</h2>
    <div class="color-block">
        <button onclick="openAddStaffModal()" class="btn btn-primary">Add Staff</button>
        <div>
            <input type="text" id="searchStaff" placeholder="Search Staff..." onkeyup="searchStaff()">
        </div>
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
                // Fetch staff list from your database (replace with your actual database query
                try {
                    $stmt = $pdo->prepare("SELECT * FROM `staff_list`"); // Replace `staff_list` with your actual table name
                    $stmt->execute();
                    $staffs = $stmt->fetchAll(PDO::FETCH_ASSOC);

                
                    foreach ($staffs as $staff) {
                        echo "<tr>";
                        echo "<td>" . $staff['staff_id'] . "</td>";
                        echo "<td>" . $staff['staff_name'] . "</td>";
                        echo "<td>" . $staff['department'] . "</td>";
                        echo "<td>" . $staff['year_started'] . "</td>";
                        echo "<td>
                                <div class='button-group'>
                                    <button onclick='openEditStaffModal(" . json_encode($staff) . ")' class='btn btn-secondary'>Edit</button>
                                    <button onclick='deleteStaff(" . $staff['staff_id'] . ")' class='btn btn-danger'>Delete</button>
                                </div>
                            </td>";
                        echo "</tr>";
                    }
                }catch (PDOException $e) {
                        echo "Database error: " . $e->getMessage();
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
    // Include the search functions here
    function searchStudents() {
        const input = document.getElementById('searchStudent');
        const filter = input.value.toLowerCase();
        const table = document.getElementById('studentTableBody');
        const rows = table.getElementsByTagName('tr');

        for (let i = 0; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName('td');
            let found = false;

            for (let j = 0; j < cells.length; j++) {
                if (cells[j]) {
                    const cellValue = cells[j].textContent || cells[j].innerText;
                    if (cellValue.toLowerCase().indexOf(filter) > -1) {
                        found = true;
                        break; // Break if a match is found
                    }
                }
            }
            rows[i].style.display = found ? "" : "none"; // Show or hide row
        }
    }

    function searchStaff() {
        const input = document.getElementById('searchStaff');
        const filter = input.value.toLowerCase();
        const table = document.getElementById('staffTableBody');
        const rows = table.getElementsByTagName('tr');

        for (let i = 0; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName('td');
            let found = false;

            for (let j = 0; j < cells.length; j++) {
                if (cells[j]) {
                    const cellValue = cells[j].textContent || cells[j].innerText;
                    if (cellValue.toLowerCase().indexOf(filter) > -1) {
                        found = true;
                        break; // Break if a match is found
                    }
                }
            }
            rows[i].style.display = found ? "" : "none"; // Show or hide row
        }
    }

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
        <td>
            <div class="button-group">
                <button onclick='openEditStaffModal(${JSON.stringify(staff)})' class='btn btn-secondary'>Edit</button>
                <button onclick='deleteStaff("${staff.staff_id}")' class='btn btn-danger'>Delete</button>
            </div>
        </td>
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

    function deleteStaff(staffId) {
    if (confirm('Are you sure you want to delete this staff member?')) {
        // Make an API call to delete the staff member from the database
        fetch('delete_staff.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ staff_id: staffId }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Staff deleted successfully!');
                removeStaffFromTable(staffId);
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    }
}

function removeStaffFromTable(staffId) {
    const tableBody = document.getElementById('staffTableBody');
    const rows = tableBody.getElementsByTagName('tr');

    for (let row of rows) {
        if (row.cells[0].innerText == staffId) {
            tableBody.removeChild(row); // Remove the row from the table
            break;
        }
    }
}

</script>
