<?php
// // Profile-Admin.php

session_start();
include '../Constants/Combine-admin.php';
include("../Database/connection.php");

// $_SESSION['admin_username'] = "testadminuser";
// $_SESSION['admin_email'] = "testadminuser@example.com";
// $_SESSION['admin_doj'] = "27 November 2024"
$email = $_SESSION['user_id'];
$username = $_SESSION['username'];

if (isset($_SESSION['username'])) {
    // Access session data (username and user_id should already be set)
    $username = $_SESSION['username'];
    $user_id = $_SESSION['user_id'];

    // Database connection (ensure $conn is defined properly)
    // include('connection.php'); // Include the database connection

    // Prepare the SQL statement to fetch the admin's email based on the username
    $stmt = $conn->prepare("SELECT admin_email, admin_doj FROM admin WHERE admin_username = ?");
    $stmt->bind_param("s", $username); // Bind the username parameter
    $stmt->execute();
    $stmt->bind_result($email, $doj);
    $stmt->fetch();

    // Close the statement
    $stmt->close();
}

// // Start the session and include necessary authentication checks
// session_start();

// // Include the database connection
// require '../Database/connection.php';

// // Check if the admin is logged in
// if (!isset($_SESSION['admin_id'])) {
//     // If not logged in, redirect to the login page
//     header("Location: ../Login/login.php");
//     exit();
// }

// // Fetch the admin's data from the database
// $admin_id = $_SESSION['admin_id'];
// $username = $email = $doj = $profilePic = "";

// // Initialize error messages
// $errors = [
//     'username' => '',
//     'email' => '',
//     'current_password' => '',
//     'new_password' => '',
//     'confirm_password' => '',
//     'profile_pic' => ''
// ];

// // Fetch admin details
// $stmt = $conn->prepare("SELECT admin_username, admin_email, admin_DOJ, admin_password FROM admin WHERE admin_id = ?");
// $stmt->bind_param("i", $admin_id);
// $stmt->execute();
// $stmt->bind_result($db_username, $db_email, $db_doj, $db_password);
// if ($stmt->fetch()) {
//     $username = htmlspecialchars($db_username);
//     $email = htmlspecialchars($db_email);
//     $doj = htmlspecialchars($db_doj);
// } else {
//     // If admin not found, destroy session and redirect to login
//     session_destroy();
//     header("Location: login.php");
//     exit();
// }
// $stmt->close();

// // Handle form submissions
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     // Logout
//     if (isset($_POST['logout'])) {
//         session_destroy();
//         header("Location: login.php");
//         exit();
//     }

//     // Update Profile
//     if (isset($_POST['update_profile'])) {
//         // Validate and sanitize input data
//         $new_username = trim($_POST['username']);
//         $new_email = trim($_POST['email']);

//         // Username validation
//         if (strlen($new_username) < 3) {
//             $errors['username'] = 'Username must be at least 3 characters.';
//         }

//         // Email validation
//         if (!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
//             $errors['email'] = 'Please enter a valid email address.';
//         }

//         // Check for existing email (unique)
//         if ($new_email !== $email) {
//             $stmt = $conn->prepare("SELECT admin_id FROM admin WHERE admin_email = ?");
//             $stmt->bind_param("s", $new_email);
//             $stmt->execute();
//             $stmt->store_result();
//             if ($stmt->num_rows > 0) {
//                 $errors['email'] = 'This email is already taken.';
//             }
//             $stmt->close();
//         }

//         // If no errors, update the profile
//         if (empty(array_filter($errors))) {
//             $stmt = $conn->prepare("UPDATE admin SET admin_username = ?, admin_email = ? WHERE admin_id = ?");
//             $stmt->bind_param("ssi", $new_username, $new_email, $admin_id);
//             if ($stmt->execute()) {
//                 $username = htmlspecialchars($new_username);
//                 $email = htmlspecialchars($new_email);
//                 echo "<script>alert('Profile updated successfully.');</script>";
//             } else {
//                 echo "<script>alert('Error updating profile. Please try again.');</script>";
//             }
//             $stmt->close();
//         }
//     }

//     // Change Password
//     if (isset($_POST['change_password'])) {
//         // Retrieve and sanitize inputs
//         $current_password = $_POST['current_password'];
//         $new_password = $_POST['new_password'];
//         $confirm_password = $_POST['confirm_password'];

//         // Validate inputs
//         if (empty($current_password)) {
//             $errors['current_password'] = 'Please enter your current password.';
//         }

//         if (!empty($new_password) && strlen($new_password) < 6) {
//             $errors['new_password'] = 'New password must be at least 6 characters.';
//         }

//         if ($new_password !== $confirm_password) {
//             $errors['confirm_password'] = 'Passwords do not match.';
//         }

//         // If no errors, verify current password and update
//         if (empty(array_filter($errors))) {
//             // Verify current password
//             if (password_verify($current_password, $db_password)) {
//                 // Hash the new password
//                 $hashed_new_password = password_hash($new_password, PASSWORD_BCRYPT);

//                 // Update the password in the database
//                 $stmt = $conn->prepare("UPDATE admin SET admin_password = ? WHERE admin_id = ?");
//                 $stmt->bind_param("si", $hashed_new_password, $admin_id);
//                 if ($stmt->execute()) {
//                     echo "<script>alert('Password changed successfully.');</script>";
//                 } else {
//                     echo "<script>alert('Error changing password. Please try again.');</script>";
//                 }
//                 $stmt->close();
//             } else {
//                 $errors['current_password'] = 'Incorrect current password.';
//             }
//         }
//     }

//     // Handle Profile Picture Upload
//     if (isset($_FILES['profile_pic'])) {
//         $file = $_FILES['profile_pic'];
//         if ($file['error'] === UPLOAD_ERR_OK) {
//             $fileTmpPath = $file['tmp_name'];
//             $fileName = basename($file['name']);
//             $fileSize = $file['size'];
//             $fileType = mime_content_type($fileTmpPath);

//             // Validate file type (allow only images)
//             $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
//             if (!in_array($fileType, $allowedTypes)) {
//                 $errors['profile_pic'] = 'Please upload a valid image file (JPEG, PNG, GIF, WEBP).';
//             }

//             // Validate file size (max 2MB)
//             if ($fileSize > 2 * 1024 * 1024) {
//                 $errors['profile_pic'] = 'Image size should not exceed 2MB.';
//             }

//             // If no errors, move the uploaded file
//             if (empty($errors['profile_pic'])) {
//                 $uploadDir = 'uploads/profile_pics/';
//                 // Ensure the upload directory exists
//                 if (!is_dir($uploadDir)) {
//                     mkdir($uploadDir, 0755, true);
//                 }

//                 // Generate a unique file name to prevent overwriting
//                 $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
//                 $newFileName = 'admin_' . $admin_id . '_' . time() . '.' . $fileExtension;
//                 $destPath = $uploadDir . $newFileName;

//                 if (move_uploaded_file($fileTmpPath, $destPath)) {
//                     // Optionally, delete the old profile picture if it's not the default
//                     // Assuming the default profile picture is 'default-profile.png'
//                     if ($profilePic !== 'default-profile.png' && file_exists($profilePic)) {
//                         unlink($profilePic);
//                     }

//                     // Update the profile picture path in the database
//                     $stmt = $conn->prepare("UPDATE admin SET admin_profile_pic = ? WHERE admin_id = ?");
//                     $stmt->bind_param("si", $destPath, $admin_id);
//                     if ($stmt->execute()) {
//                         $profilePic = htmlspecialchars($destPath);
//                         echo "<script>alert('Profile picture updated successfully.');</script>";
//                     } else {
//                         echo "<script>alert('Error updating profile picture. Please try again.');</script>";
//                     }
//                     $stmt->close();
//                 } else {
//                     $errors['profile_pic'] = 'There was an error uploading the file. Please try again.';
//                 }
//             }
//         } elseif ($file['error'] !== UPLOAD_ERR_NO_FILE) {
//             $errors['profile_pic'] = 'Error uploading file. Please try again.';
//         }
//     }
// }

// // Fetch the updated profile picture
// $stmt = $conn->prepare("SELECT admin_profile_pic FROM admin WHERE admin_id = ?");
// $stmt->bind_param("i", $admin_id);
// $stmt->execute();
// $stmt->bind_result($db_profile_pic);
// if ($stmt->fetch()) {
//     $profilePic = htmlspecialchars($db_profile_pic);
//     if (empty($profilePic)) {
//         $profilePic = "default-profile.png"; // Path to default profile picture
//     }
// } else {
//     $profilePic = "default-profile.png";
// }
// $stmt->close();

// // Close the database connection
// $conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Profile Settings</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Profile-Admin.css">
</head>

<body class="profile-body" data-theme="dark">
    <div class="home_ct">
        <div class="profile-container">
            <!-- Header with Title and Theme Toggle -->
            <div class="profile-header">
                <h2>Admin Profile</h2>
                <button class="theme-toggle" id="theme-toggle" aria-label="Toggle Theme">🌙</button>
            </div>

            <!-- Profile Picture Section -->
            <div class="profile-picture">
                <img src="<?php echo $profilePic; ?>" alt="Profile Picture">
                <label for="profile-pic-input" title="Change Profile Picture">📷</label>
                <input type="file" id="profile-pic-input" name="profile_pic" accept="image/*">
                <?php if (!empty($errors['profile_pic'])): ?>
                    <span class="error" id="profile-pic-error"><?php echo $errors['profile_pic']; ?></span>
                <?php endif; ?>
            </div>

            <!-- Profile Form -->
            <form class="profile-form" action="Profile-Admin.php" method="POST" enctype="multipart/form-data">
                <!-- Username -->
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" value="<?php echo $username; ?>" required>
                    <?php if (!empty($errors['username'])): ?>
                        <span class="error" id="username-error"><?php echo $errors['username']; ?></span>
                    <?php endif; ?>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>
                    <?php if (!empty($errors['email'])): ?>
                        <span class="error" id="email-error"><?php echo $errors['email']; ?></span>
                    <?php endif; ?>
                </div>

                <!-- Date of Joining -->
                <div class="form-group">
                    <label for="doj">Date of Joining</label>
                    <input type="text" id="doj" name="doj" value="<?php echo $doj; ?>" readonly>

                    <!-- <input type="text" id="doj" name="doj" value="<?php echo $_SESSION['admin_doj']; ?>" required> -->
                </div>

                <!-- Password Change Section -->
                <!-- <div class="form-group">
                    <label for="current-password">Current Password</label>
                    <input type="password" id="current-password" name="current_password" placeholder="Enter current password">
                    <?php if (!empty($errors['current_password'])): ?>
                        <span class="error" id="current-password-error"><?php echo $errors['current_password']; ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="new-password">New Password</label>
                    <input type="password" id="new-password" name="new_password" placeholder="Enter new password">
                    <?php if (!empty($errors['new_password'])): ?>
                        <span class="error" id="new-password-error"><?php echo $errors['new_password']; ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="confirm-password">Confirm New Password</label>
                    <input type="password" id="confirm-password" name="confirm_password" placeholder="Confirm new password">
                    <?php if (!empty($errors['confirm_password'])): ?>
                        <span class="error" id="confirm-password-error"><?php echo $errors['confirm_password']; ?></span>
                    <?php endif; ?>
                </div> -->

                <!-- Action Buttons -->
                <!-- <div style="display: flex; justify-content: space-between; align-items: center;">
                    <button type="submit" name="update_profile" class="btn">Save Changes</button>
                    <button type="submit" name="logout" class="btn logout-btn">Logout</button>
                </div> -->
            </form>

            <!-- Footer -->
            <div class="profile-footer">
                &copy; <?php echo date("Y"); ?> RWDD Assignment Quiz Website.<br>Group 10.
            </div>
        </div>
    </div>

    <!-- JavaScript for Interactivity -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {

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

            // Form Validation (Client-Side)
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