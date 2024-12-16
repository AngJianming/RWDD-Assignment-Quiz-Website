// register.js

document.addEventListener('DOMContentLoaded', () => {
    const togglePassword1 = document.querySelector('#togglePassword1');
    const passwordInput1 = document.querySelector('#password1');

    togglePassword1.addEventListener('click', () => {
        // Toggle the type attribute
        const type = passwordInput1.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput1.setAttribute('type', type);

        // Toggle the eye icon
        togglePassword1.setAttribute('name', type === 'password' ? 'eye-off-outline' : 'eye-outline');
    });

    const togglePassword2 = document.querySelector('#togglePassword2');
    const passwordInput2 = document.querySelector('#password2');

    togglePassword2.addEventListener('click', () => {
        // Toggle the type attribute
        const type = passwordInput2.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput2.setAttribute('type', type);

        // Toggle the eye icon
        togglePassword2.setAttribute('name', type === 'password' ? 'eye-off-outline' : 'eye-outline');
    });
});
