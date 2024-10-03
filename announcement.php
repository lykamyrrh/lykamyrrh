
<div class="main-container">
    <div class="main-content">
        <div id="announcements" class="section">
            <h2>Announcements</h2>
            <div class="color-block"></div>
            <form id="announcementForm" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <input type="text" id="announcementTitle" name="announcement_title" placeholder="Title" required />
                <textarea id="announcementContent" name="announcement_content" placeholder="Announcement content" required></textarea>
                <button type="submit" name="add_announcement">Add Announcement</button>
            </form>

            <h3>Current Announcements</h3>
            <div class="announcement-container">
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="announcementTableBody">
                        <?php
                        include 'dbconnect.php'; // Include your database connection file
                        
                        // Handle form submission for adding an announcement
                        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_announcement'])) {
                            $announcementTitle = $_POST['announcement_title'];
                            $announcementContent = $_POST['announcement_content'];

                            // Prepare and execute the SQL statement
                            $stmt = $pdo->prepare("INSERT INTO announcements (title, content) VALUES (:title, :content)");
                            $stmt->execute(['title' => $announcementTitle, 'content' => $announcementContent]);

                            // Redirect to the same page to avoid resubmission issues
                            header("Location: " . $_SERVER['PHP_SELF']);
                            exit;
                        }

                        // Fetch existing announcements
                        $stmt = $pdo->query("SELECT * FROM announcements ORDER BY created_at DESC");
                        if ($stmt->rowCount() > 0) {
                            while ($row = $stmt->fetch()) {
                                echo "<tr>
                                    <td>" . htmlspecialchars($row['title']) . "</td>
                                    <td>" . htmlspecialchars($row['content']) . "</td>
                                    <td>
                                        <form style='display:inline;' method='POST' action=''>
                                            <input type='hidden' name='announcement_id' value='" . $row['id'] . "' />
                                            <button type='submit' name='remove_announcement'>Remove</button>
                                        </form>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='3'>No announcements available.</td></tr>";
                        }

                        // Handle removal of an announcement
                        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_announcement'])) {
                            $announcementId = $_POST['announcement_id'];

                            // Prepare and execute the SQL statement
                            $stmt = $pdo->prepare("DELETE FROM announcements WHERE id = :id");
                            $stmt->execute(['id' => $announcementId]);
                            // Optionally, you can redirect to the same page to avoid resubmission issues
                            header("Location: " . $_SERVER['PHP_SELF']);
                            exit;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- End of Announcement Section -->
