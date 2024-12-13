<?php
// Profile-Admin.php

// Start the session and include necessary authentication checks
session_start();

// Placeholder variables. Replace these with actual data retrieval logic.
$username = "adminUser";
$email = "admin@example.com";
$doj = "2023-01-15";
$profilePic = "default-profile.png"; // Path to default profile picture

// Handle form submissions (e.g., logout, update profile, change password)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['logout'])) {
        // Handle logout logic
        session_destroy();
        header("Location: login.php");
        exit();
    }

    if (isset($_POST['update_profile'])) {
        // Handle profile update logic
        // Validate and sanitize input data
        // Update user information in the database
    }

    if (isset($_POST['change_password'])) {
        // Handle password change logic
        // Validate current password, new password, and confirmation
        // Update password in the database
    }

    if (isset($_FILES['profile_pic'])) {
        // Handle profile picture upload
        // Validate and save the uploaded file
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Profile Settings</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Profile-Admin.css">
    <?php include '../Constants/Combine-admin.php' ?>
</head>

<body data-theme="dark">
    <header>
        <div class="navbar">
            <div class="logo">
                <img src="../img/Code-Combat (trans) logo.png" alt="Logo" />
            </div>
        </div>
    </header>

    <div class="sidebar">
        <div class="logo_content">
            <div class="logo">
            </div>
            <i class="ms-Icon ms-Icon--CollapseMenu" id="btn"></i>
        </div>
        <ul class="nav_list">
            <li>
                <a href="dashboard.php">
                    <i class="ms-Icon ms-Icon--WaffleOffice365"></i>
                    <span class="links_name">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>
            <li>
                <a href="useraccount.php">
                    <i class="ms-Icon ms-Icon--Contact"></i>
                    <span class="links_name">Manage User</span>
                </a>
                <span class="tooltip">Manage User</span>
            </li>
            <li>
                <a href="userperformance.php">
                    <i class="ms-Icon ms-Icon--PieDouble"></i>
                    <span class="links_name">Performance</span>
                </a>
                <span class="tooltip">Performance</span>
            </li>
            <li>
                <a href="eduaccount.php">
                    <i class="ms-Icon ms-Icon--Chat"></i>
                    <span class="links_name">Manage Educator</span>
                </a>
                <span class="tooltip">Manage Educator</span>
            </li>
            <li>
                <a href="#">
                    <i class="ms-Icon ms-Icon--FabricFolder"></i>
                    <span class="links_name">Files</span>
                </a>
                <span class="tooltip">Files</span>
            </li>
            <li>
                <a href="../Admin/rankedquiz.php">
                    <i class="fa-solid fa-circle-plus"></i>
                    <span class="links_name">Add Quiz</span>
                </a>
                <span class="tooltip">Add Quiz</span>
            </li>
        </ul>
        <div class="profile_content">
            <div class="profile">
                <div class="profile_details">
                    <img src="../img/Profile Pic.png" alt="Profile Picture">
                    <div class="name_job">
                        <div class="name">USER</div>
                        <div class="job">Admin</div>
                    </div>
                </div>
                <i class="ms-Icon ms-Icon--SignOut" id="log_out"></i>
            </div>
        </div>
    </div>

    <div class="home_content">
        <div class="profile-container">
            <!-- Header with Title and Theme Toggle -->
            <div class="profile-header">
                <h2>Admin Profile</h2>
                <button class="theme-toggle" id="theme-toggle" aria-label="Toggle Theme">🌙</button>
            </div>

            <!-- Profile Picture Section -->
            <div class="profile-picture">
                <img src="<?php echo htmlspecialchars($profilePic); ?>" alt="Profile Picture">
                <label for="profile-pic-input" title="Change Profile Picture">📷</label>
                <input type="file" id="profile-pic-input" accept="image/*">
            </div>

            <!-- Profile Form -->
            <form class="profile-form" action="Profile-Admin.php" method="POST" enctype="multipart/form-data">
                <!-- Username -->
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
                    <span class="error" id="username-error"></span>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                    <span class="error" id="email-error"></span>
                </div>

                <!-- Date of Joining -->
                <div class="form-group">
                    <label for="doj">Date of Joining</label>
                    <input type="text" id="doj" name="doj" value="<?php echo htmlspecialchars($doj); ?>" readonly>
                </div>

                <!-- Password Change Section -->
                <div class="form-group">
                    <label for="current-password">Current Password</label>
                    <input type="password" id="current-password" name="current_password" placeholder="Enter current password">
                    <span class="error" id="current-password-error"></span>
                </div>

                <div class="form-group">
                    <label for="new-password">New Password</label>
                    <input type="password" id="new-password" name="new_password" placeholder="Enter new password">
                    <span class="error" id="new-password-error"></span>
                </div>

                <div class="form-group">
                    <label for="confirm-password">Confirm New Password</label>
                    <input type="password" id="confirm-password" name="confirm_password" placeholder="Confirm new password">
                    <span class="error" id="confirm-password-error"></span>
                </div>

                <!-- Action Buttons -->
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <button type="submit" name="update_profile" class="btn">Save Changes</button>
                    <button type="submit" name="logout" class="btn logout-btn">Logout</button>
                </div>
            </form>

            <!-- Footer -->
            <div class="profile-footer">
                &copy; <?php echo date("Y"); ?> RWDD Assignment Quiz Website.<br>Group 10.
            </div>
        </div>
    </div>

    <footer>
        <div class="copyright">
            <h6>© 2024 BatttleCombat.com FAQ | Privacy Policy | Terms of Service | RWDD Assignment Quiz Website</h4>
        </div>
    </footer>

    <!-- JavaScript for Interactivity -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Sidebar Toggle
            const btn = document.getElementById("btn");
            const sidebar = document.querySelector(".sidebar");

            if (btn && sidebar) {
                btn.addEventListener('click', function(event) {
                    sidebar.classList.toggle("active");
                    // Toggle aria-expanded for accessibility
                    const isActive = sidebar.classList.contains("active");
                    btn.setAttribute('aria-expanded', isActive);
                    event.stopPropagation();
                });

                // Prevent clicks inside the sidebar from closing it
                sidebar.addEventListener('click', function(event) {
                    event.stopPropagation();
                });

                // Close sidebar when clicking outside of it
                document.addEventListener('click', function(event) {
                    if (sidebar.classList.contains("active")) {
                        sidebar.classList.remove("active");
                        btn.setAttribute('aria-expanded', 'false');
                    }
                });
            }

            // Theme Toggle
            const themeToggle = document.getElementById('theme-toggle');
            const body = document.body;

            if (themeToggle) {
                // Initialize theme based on localStorage
                const savedTheme = localStorage.getItem('theme') || 'dark';
                body.setAttribute('data-theme', savedTheme);
                themeToggle.textContent = savedTheme === 'dark' ? '☀️' : '🌙';

                themeToggle.addEventListener('click', () => {
                    const currentTheme = body.getAttribute('data-theme');
                    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                    body.setAttribute('data-theme', newTheme);
                    themeToggle.textContent = newTheme === 'dark' ? '☀️' : '🌙';
                    localStorage.setItem('theme', newTheme);
                });
            }

            // Profile Picture Upload Preview
            const profilePicInput = document.getElementById('profile-pic-input');
            const profilePicImage = document.querySelector('.profile-picture img');
            const profilePicError = document.getElementById('profile-pic-error');

            if (profilePicInput && profilePicImage) {
                profilePicInput.addEventListener('change', (event) => {
                    const file = event.target.files[0];
                    if (file && file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            profilePicImage.src = e.target.result;
                            if (profilePicError) profilePicError.textContent = '';
                        }
                        reader.readAsDataURL(file);
                    } else {
                        if (profilePicError) {
                            profilePicError.textContent = 'Please select a valid image file.';
                            profilePicError.style.color = 'var(--error-color)';
                        }
                        // Reset the file input
                        profilePicInput.value = '';
                    }
                });
            }

            // Form Validation
            const profileForm = document.querySelector('.profile-form');

            if (profileForm) {
                profileForm.addEventListener('submit', function(event) {
                    // Clear previous errors
                    const errorElements = profileForm.querySelectorAll('.error');
                    errorElements.forEach(el => el.textContent = '');

                    let valid = true;

                    // Username validation
                    const usernameInput = document.getElementById('username');
                    if (usernameInput) {
                        const username = usernameInput.value.trim();
                        if (username.length < 3) {
                            const errorEl = document.getElementById('username-error');
                            if (errorEl) {
                                errorEl.textContent = 'Username must be at least 3 characters.';
                            }
                            valid = false;
                        }
                    }

                    // Email validation
                    const emailInput = document.getElementById('email');
                    if (emailInput) {
                        const email = emailInput.value.trim();
                        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (!emailRegex.test(email)) {
                            const errorEl = document.getElementById('email-error');
                            if (errorEl) {
                                errorEl.textContent = 'Please enter a valid email address.';
                            }
                            valid = false;
                        }
                    }

                    // Password validation (if any password fields are filled)
                    const currentPassword = document.getElementById('current-password')?.value;
                    const newPassword = document.getElementById('new-password')?.value;
                    const confirmPassword = document.getElementById('confirm-password')?.value;

                    if (currentPassword || newPassword || confirmPassword) {
                        if (!currentPassword) {
                            const errorEl = document.getElementById('current-password-error');
                            if (errorEl) {
                                errorEl.textContent = 'Please enter your current password.';
                            }
                            valid = false;
                        }
                        if (newPassword && newPassword.length < 6) {
                            const errorEl = document.getElementById('new-password-error');
                            if (errorEl) {
                                errorEl.textContent = 'New password must be at least 6 characters.';
                            }
                            valid = false;
                        }
                        if (newPassword && confirmPassword && newPassword !== confirmPassword) {
                            const errorEl = document.getElementById('confirm-password-error');
                            if (errorEl) {
                                errorEl.textContent = 'Passwords do not match.';
                            }
                            valid = false;
                        }
                    }

                    if (!valid) {
                        event.preventDefault();
                        // Focus on the first error element for accessibility
                        const firstError = profileForm.querySelector('.error:not(:empty)');
                        if (firstError) {
                            const inputId = firstError.id.replace('-error', '');
                            const inputEl = document.getElementById(inputId);
                            if (inputEl) {
                                inputEl.focus();
                            }
                        }
                    }
                });
            }
        });
    </script>
</body>

</html>