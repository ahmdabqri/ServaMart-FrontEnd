document.getElementById('forgot-formValidation').addEventListener('submit', function (e) {

    let valid = true;

    const email = document.getElementById('email');
    const emailError = document.getElementById('emailError');

    emailError.textContent = '';

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

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