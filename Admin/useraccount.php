<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Student Account</title>
    <link rel="stylesheet" href="useraccount.css">
    <!-- <?php include '../Constants/Combine-admin.php'; ?> -->
    <?php include 'Combine-admin.php'; ?>
</head>

<body>
    <h1>Manage Student Account</h1>
    <table id="studentTable">
        <thead>
            <tr>
                <th>Student ID</th>
                <th>Name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <!-- take data from sql -->
                <td>12345</td>
                <td>Jayden Sea</td>
                <td>012-3456789</td>
                <td data-email="jayden.sea@example.com"></td>
                <td>
                    <div class="action-btn">
                        <button class="edit-btn">Edit Acc</button>
                        <button class="dlt-btn">Delete Acc</button>
                    </div>
                </td>
            </tr>
            <tr>
                <td>67890</td>
                <td>Elvan Foo</td>
                <td>012-3456789</td>
                <td data-email="elvan.foo@example.com"></td>
                <td>
                    <div class="action-btn">
                        <button class="edit-btn">Edit Acc</button>
                        <button class="dlt-btn">Delete Acc</button>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="edit-section" id="editSection">
        <h2>Edit User Details</h2>
        <div class="edit-box">
            <form id="editForm">
                <div class="edit-each-section">
                    <label for="editStudentID">Student ID:</label><br>
                    <input type="text" id="editStudentID" disabled>
                </div>
                <div class="edit-each-section">
                    <label for="editStudentName">Student Name:</label><br>
                    <input type="text" id="editStudentName">
                </div>
                <div class="edit-each-section">
                    <label for="editStudentContact">Contact Number:</label><br>
                    <input type="text" id="editStudentContact"y>
                </div>
                <div class="edit-each-section">
                    <label for="editStudentEmail">Email Address:</label><br>
                    <input type="text" id="editStudentEmail">
                </div>
                    <button type="button" class="save-btn" id="saveBtn">Save</button>
            </form>
        </div>
    </div>
    <script>

        document.addEventListener('DOMContentLoaded', () => {
            const emailCells = document.querySelectorAll('td[data-email]');

            // Format emails
            emailCells.forEach(cell => {
                const email = cell.getAttribute('data-email');
                const [localPart, domainPart] = email.split('@'); // Split at the '@' symbol
                cell.innerHTML = `${localPart}<br>@${domainPart}`; // Add line break
            });

            // Update email formatting after edits
            saveButton.addEventListener('click', function () {
                if (currentRow) {
                    const updatedEmail = document.getElementById('editStudentEmail').value;

                    // Reformat the email in the table
                    const [localPart, domainPart] = updatedEmail.split('@');
                    currentRow.querySelector('td[data-email]').innerHTML = `${localPart}<br>@${domainPart}`;
                    currentRow.querySelector('td[data-email]').setAttribute('data-email', updatedEmail);
                }
            });
        });

        // Select elements
        const editButtons = document.querySelectorAll('.edit-btn');
        const deleteButtons = document.querySelectorAll('.dlt-btn');
        const editSection = document.getElementById('editSection');
        const editForm = document.getElementById('editForm');
        const saveButton = document.getElementById('saveBtn');

        let currentRow = null;

        // Add event listeners to Edit buttons
        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                // const row = this.parentElement.parentElement;
                const row = this.closest('tr');
                const studentID = row.children[0].innerText;
                const studentName = row.children[1].innerText;
                const studentContact = row.children[2].innerText;
                const studentEmail = row.children[3].innerText;

                // Populate the form with the current details
                document.getElementById('editStudentID').value = studentID;
                document.getElementById('editStudentName').value = studentName;
                document.getElementById('editStudentContact').value = studentContact;
                document.getElementById('editStudentEmail').value = studentEmail;

                // Show the edit section
                editSection.style.display = 'block';
                currentRow = row; // Save the current row reference
            });
        });

        // Save button event listener
        saveButton.addEventListener('click', function () {
            // Get updated details from the form
            const updatedStudentName = document.getElementById('editStudentName').value;
            const updatedStudentContact = document.getElementById('editStudentContact').value;
            const updatedStudentEmail = document.getElementById('editStudentEmail').value;

            // Validation
            const namePattern = /^[A-Za-z\s]+$/; // Name must contain only alphabets and spaces
            const contactPattern = /^\d{3}-\d{7,8}$/; // Contact must be in the format 123-4567890
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Simple email validation

             // Validate student name
            if (!namePattern.test(updatedStudentName)) {
                alert('Student name must contain only alphabets and spaces.');
                return;
            }

            // Validate contact number
            if (!contactPattern.test(updatedStudentContact)) {
                alert('Contact number must starts from 3 digits, followed by "-" then followed by 7-8 characters');
                return;
            }

            // Validate email address
            if (!emailPattern.test(updatedStudentEmail)) {
                alert('Please enter a valid email address.');
                return;
            }

             // Confirmation before updating
            const confirmation = confirm('Are you sure you want to update the student details?');
            if (!confirmation) {
                return; // If the user cancels, exit the function
            }

            // Update the table row
            currentRow.children[1].innerText = updatedStudentName;
            currentRow.children[2].innerText = updatedStudentContact;
            currentRow.children[3].innerText = updatedStudentEmail;

            // Hide the edit section
            editSection.style.display = 'none';
        });

          // Add event listeners to Delete buttons
        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const row = this.closest('tr');

                // Confirm before deleting
                const confirmation = confirm('Are you sure you want to delete this record?');
                if (!confirmation) {
                    return; // Exit if user cancels
                }

                // Remove the row
                row.remove();
            });
        });
    </script>
</body>

</html>