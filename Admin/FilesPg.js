// FilesPg.js

document.addEventListener('DOMContentLoaded', () => {
    const uploadArea = document.getElementById('uploadArea');
    const fileInput = document.getElementById('fileInput');
    const uploadButton = document.getElementById('uploadButton');
    const modal = document.querySelector('.modal');
    const btnClose = document.querySelector('.btn-close');
    const btnCancel = document.querySelector('.btn-secondary');

    let filesToUpload = [];

    // Prevent default behaviors for drag-and-drop events
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, preventDefaults, false);
        document.body.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    // Add highlight on dragenter and dragover
    ['dragenter', 'dragover'].forEach(eventName => {
        uploadArea.addEventListener(eventName, () => {
            uploadArea.classList.add('highlight');
        }, false);
    });

    // Remove highlight on dragleave and drop
    ['dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, () => {
            uploadArea.classList.remove('highlight');
        }, false);
    });

    // Handle dropped files
    uploadArea.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        handleFiles(files);
    }

    // Handle click to open file selector
    uploadArea.addEventListener('click', () => {
        fileInput.click();
    });

    // Handle file selection via dialog
    fileInput.addEventListener('change', () => {
        const files = fileInput.files;
        handleFiles(files);
    });

    // Handle files
    function handleFiles(files) {
        const fileArray = [...files];
        const validFiles = validateFiles(fileArray);

        if (validFiles.length > 0) {
            filesToUpload = filesToUpload.concat(validFiles);
            displaySelectedFiles();
        }
    }

    // Validate files
    function validateFiles(files) {
        const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        const maxSize = 5 * 1024 * 1024; // 5MB
        let validFiles = [];

        files.forEach(file => {
            if (validTypes.includes(file.type)) {
                if (file.size <= maxSize) {
                    validFiles.push(file);
                } else {
                    displayFeedback(`Error: ${file.name} exceeds the 5MB size limit.`, 'error');
                }
            } else {
                displayFeedback(`Error: ${file.name} is not a supported image format.`, 'error');
            }
        });

        return validFiles;
    }

    // Display selected files (optional: enhance UI to show selected files)
    function displaySelectedFiles() {
        // Implement UI updates to show selected files if desired
        // For example, list the file names in the modal
        console.log('Files ready to upload:', filesToUpload);
    }

    // Display feedback messages
    function displayFeedback(message, type) {
        // You can implement in-modal messages or other UI elements instead of alerts
        alert(message); // Simple alert for demonstration
        // Alternatively, implement a div with class 'upload-feedback' to show messages
    }

    // Upload files to the server
    function uploadFiles() {
        if (filesToUpload.length === 0) {
            displayFeedback('No files selected for upload.', 'error');
            return;
        }

        const formData = new FormData();

        filesToUpload.forEach((file, index) => {
            formData.append(`file${index}`, file);
        });

        // Disable upload button and show uploading status
        uploadButton.disabled = true;
        uploadButton.textContent = 'Uploading...';

        fetch('Combine-admin.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            uploadButton.disabled = false;
            uploadButton.textContent = 'Upload File';
            if (data.success) {
                displayFeedback('Files uploaded successfully!', 'success');
                // Reset the upload area
                filesToUpload = [];
                fileInput.value = '';
                // Optionally, update the UI to reflect successful upload
            } else {
                displayFeedback(`Error uploading files: ${data.message}`, 'error');
            }
        })
        .catch(error => {
            uploadButton.disabled = false;
            uploadButton.textContent = 'Upload File';
            console.error('Error:', error);
            displayFeedback('An error occurred while uploading files.', 'error');
        });
    }

    // Handle upload button click
    uploadButton.addEventListener('click', () => {
        uploadFiles();
    });

    // Handle modal close actions
    btnClose.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    btnCancel.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    // Optional: Close modal when clicking outside of it
    window.addEventListener('click', (e) => {
        if (e.target == modal) {
            modal.style.display = 'none';
        }
    });
});
