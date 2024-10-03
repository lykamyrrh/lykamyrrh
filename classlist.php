<div id="classlist" class="section">
    <h2>Class List</h2>
        <button onclick="openAddStudentModal()" class="btn btn-primary">Add Student</button>
            <input type="text" id="searchStudent" placeholder="Search Student..." onkeyup="searchStudents()">
    </div>
        <table class="class-list-table">
            <thead>
                <tr>
                    <th>Reference No.</th>
                    <th>Student Name</th>
                    <th>Class Level</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="studentTableBody">
            
                <?php
                foreach ($students as $student) {
                    echo "<tr>";
                    echo "<td>" . $student['reference_no'] . "</td>";
                    echo "<td><a href='student_profile.php?reference_no=" . urlencode($student['reference_no']) . "'>" . htmlspecialchars($student['student_name']) . "</a></td>";
                    echo "<td>" . $student['class_level'] . "</td>";
                    echo "<td>
                            <div class='button-group'>
                                <button onclick='deleteStudent(" . $student['reference_no'] . ")' class='btn btn-danger'>Delete</button>
                            </div>
                        </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        </div>

</div>

<!-- Modal -->
<div class="modal" id="addStudentModal" style="display: none;">
    <div class="modal-content">
        <span class="close" onclick="closeAddStudentModal()">&times;</span>
        <h2>Add New Student</h2>
        <form id="addStudentForm">
            <label for="student_name">Student Name:</label>
            <input type="text" id="student_name" name="student_name" required><br>

            <label for="class_level">Class Level:</label>
            <input type="text" id="class_level" name="class_level" required><br>

            <button type="submit" class="btn btn-success">Add Student</button>
        </form>
    </div>
</div>


<script>
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
                        break;
                    }
                }
            }
            rows[i].style.display = found ? "" : "none";
        }
    }

    function openAddStudentModal() {
        document.getElementById('addStudentModal').style.display = 'block';
    }

    function closeAddStudentModal() {
        document.getElementById('addStudentModal').style.display = 'none';
    }

    // Ensure this is included inside a <script> tag
    document.addEventListener('DOMContentLoaded', () => {
    const addStudentForm = document.getElementById('addStudentForm');

    if (addStudentForm) {
        addStudentForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission
            const formData = new FormData(this); // Collect form data

            fetch('submit_student.php', { // Your PHP file to handle the form
                method: 'POST',
                body: formData,
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                return response.json(); // Parse the JSON response
            })
            .then(data => {
                console.log(data); // Log the response
                if (data.success) {
                    alert('Student added successfully!');
                    addStudentToTable(data.student);
                    closeAddStudentModal();
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => console.error('Error:', error)); // Log any errors
        });
    }
});

    function addStudentToTable(student) {
        const tableBody = document.getElementById('studentTableBody');
        let row = document.createElement('tr');
        row.innerHTML = `
            <td>${student.reference_no}</td>
            <td><a href='student_profile.php?reference_no=${encodeURIComponent(student.reference_no)}'>${student.student_name}</a></td>
            <td>${student.class_level}</td>
            <td>
                <div class="button-group">
                    <button onclick='deleteStudent("${student.reference_no}")' class='btn btn-danger'>Delete</button>
                </div>
            </td>
        `;
        tableBody.appendChild(row);
    }

    function deleteStudent(reference_no) {
        if (confirm('Are you sure you want to delete this student?')) {
            fetch(`delete_student.php?reference_no=${reference_no}`, {
                method: 'POST',
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Student deleted successfully!');
                    removeStudentFromTable(reference_no);
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        }
    }

    function removeStudentFromTable(reference_no) {
        const tableBody = document.getElementById('studentTableBody');
        const rows = tableBody.getElementsByTagName('tr');

        for (let row of rows) {
            if (row.cells[0].innerText == reference_no) {
                tableBody.removeChild(row);
                break;
            }
        }
    }
</script>
