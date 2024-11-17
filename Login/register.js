function togglePasswordVisibility(passwordFieldId, iconId) {
    const passwordInput = document.getElementById(passwordFieldId);
    const toggleIcon = document.getElementById(iconId);

    toggleIcon.addEventListener('click', function () {
        // Toggle the input type between password and text
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

        // Toggle the icon between eye and eye-off
        toggleIcon.setAttribute('name', type === 'password' ? 'eye-off-outline' : 'eye-outline');
    });
}

// Initialize toggle functionality for both password fields
togglePasswordVisibility('password1', 'togglePassword1');
togglePasswordVisibility('password2', 'togglePassword2');