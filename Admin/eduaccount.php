<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Educator Account</title>
    <link rel="stylesheet" href="eduaccount.css">
    <!-- <?php include '../Constants/Combine-admin.php'; ?> -->
    <?php include 'Combine-admin.php'; ?>
</head>

<body>
    <h1>Manage Educator Account</h1>
    <table id="educatorTable">
        <thead>
            <tr>
                <th>Educator ID</th>
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
                    <label for="editEducatorID">Educator ID:</label><br>
                    <input type="text" id="editEducatorID" disabled>
                </div>
                <div class="edit-each-section">
                    <label for="editEducatorName">Educator Name:</label><br>
                    <input type="text" id="editEducatorName">
                </div>
                <div class="edit-each-section">
                    <label for="editEducatorContact">Contact Number:</label><br>
                    <input type="text" id="editEducatorContact"y>
                </div>
                <div class="edit-each-section">
                    <label for="editEducatorEmail">Email Address:</label><br>
                    <input type="text" id="editEducatorEmail">
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
                    const updatedEmail = document.getElementById('editEducatorEmail').value;

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
                const educatorID = row.children[0].innerText;
                const educatorName = row.children[1].innerText;
                const educatorContact = row.children[2].innerText;
                const educatorEmail = row.children[3].innerText;

                // Populate the form with the current details
                document.getElementById('editEducatorID').value = educatorID;
                document.getElementById('editEducatorName').value = educatorName;
                document.getElementById('editEducatorContact').value = educatorContact;
                document.getElementById('editEducatorEmail').value = educatorEmail;

                // Show the edit section
                editSection.style.display = 'block';
                currentRow = row; // Save the current row reference
            });
        });

        // Save button event listener
        saveButton.addEventListener('click', function () {
            // Get updated details from the form
            const updatedEducatorName = document.getElementById('editEducatorName').value;
            const updatedEducatorContact = document.getElementById('editEducatorContact').value;
            const updatedEducatorEmail = document.getElementById('editEducatorEmail').value;

            // Validation
            const namePattern = /^[A-Za-z\s]+$/; // Name must contain only alphabets and spaces
            const contactPattern = /^\d{3}-\d{7,8}$/; // Contact must be in the format 123-4567890
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Simple email validation

             // Validate educator name
            if (!namePattern.test(updatedEducatorName)) {
                alert('Educator name must contain only alphabets and spaces.');
                return;
            }

            // Validate contact number
            if (!contactPattern.test(updatedEducatorContact)) {
                alert('Contact number must starts from 3 digits, followed by "-" then followed by 7-8 characters');
                return;
            }

            // Validate email address
            if (!emailPattern.test(updatedEducatorEmail)) {
                alert('Please enter a valid email address.');
                return;
            }

             // Confirmation before updating
            const confirmation = confirm('Are you sure you want to update the educator details?');
            if (!confirmation) {
                return; // If the user cancels, exit the function
            }

            // Update the table row
            currentRow.children[1].innerText = updatedEducatorName;
            currentRow.children[2].innerText = updatedEducatorContact;
            currentRow.children[3].innerText = updatedEducatorEmail;

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