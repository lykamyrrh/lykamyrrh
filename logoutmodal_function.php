
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
  ment.getElementById("logoutModal").style.display = "none";
}

// Confirm logout functionality
document.getElementById("confirmLogout").addEventListener("click", function() {
    // Perform logout actions
    window.location.href = 'login.php'; // Redirect to your login script
});
</script>

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
