const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

// CHECK EMAIL FORM VALIDATION
const checkEmailForm = document.getElementById('forgot-formValidation');

if (checkEmailForm) {
    checkEmailForm.addEventListener('submit', function (e) {

        let valid = true;
        const email = document.getElementById('email');
        const emailError = document.getElementById('emailError');

        emailError.textContent = '';

        if (email.value.trim() === '') {
            emailError.textContent = 'Email is required.';
            valid = false;
        } else if (!emailPattern.test(email.value.trim())) {
            emailError.textContent = 'Please enter a valid email address.';
            valid = false;
        }

        if (!valid) {
            e.preventDefault();
        }

    });
}

// RESET PASSWORD FORM VALIDATION
const resetForm = document.getElementById('reset-formValidation');

if (resetForm) {
    resetForm.addEventListener('submit', function (e) {

        let valid = true;
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('confirmPassword');
        const passwordError = document.getElementById('passwordError');
        const confirmPasswordError = document.getElementById('confirmPasswordError');

        passwordError.textContent = '';
        confirmPasswordError.textContent = '';

        if (password.value === '') {
            passwordError.textContent = 'Password is required.';
            valid = false;
        } else if (password.value.length < 8) {
            passwordError.textContent = 'Password must be at least 8 characters.';
            valid = false;
        }

        if (confirmPassword.value === '') {
            confirmPasswordError.textContent = 'Please confirm your password.';
            valid = false;
        } else if (password.value !== confirmPassword.value) {
            confirmPasswordError.textContent = 'Passwords do not match.';
            valid = false;
        }

        if (!valid) {
            e.preventDefault();
        }

    });
}

// SHOW/HIDE PASSWORD TOGGLE
document.querySelectorAll('.togglePassword').forEach(function (icon) {
    icon.addEventListener('click', function () {
        const input = this.previousElementSibling;
        input.type = (input.type === 'password') ? 'text' : 'password';
    });
});