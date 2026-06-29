const registerForm = document.getElementById("register-formValidation");

if (registerForm) {
    registerForm.addEventListener("submit", function(event){

        const userName = document.getElementById("userName").value.trim();
        const email = document.getElementById("email").value.trim();
        const password = document.getElementById("password").value.trim();
        const confirmPassword = document.getElementById("confirmPassword").value.trim();

        const userNameError = document.getElementById("userNameError");
        const emailError = document.getElementById("emailError");
        const passwordError = document.getElementById("passwordError");
        const confirmPasswordError = document.getElementById("confirmPasswordError");

        userNameError.textContent = "";
        emailError.textContent = "";
        passwordError.textContent = "";
        confirmPasswordError.textContent = "";

        let isValid = true;

        // USERNAME VALIDATION
        if(userName === ""){
            userNameError.textContent = "Please enter your name";
            isValid = false;
        }

        // EMAIL VALIDATION
        if(email === ""){
            emailError.textContent = "Please enter your email";
            isValid = false;
        }
        // CHECK IF EMAIL MATCHES STUDENT EMAIL
        else if(!email.toLowerCase().endsWith("@student.utem.edu.my")){
            emailError.textContent = "Only @student.utem.edu.my emails are allowed";
            isValid = false;
        }

        // PASSWORD VALIDATION
        if(password === ""){
            passwordError.textContent = "Please enter a password";
            isValid = false;
        } else if(password.length < 8){
            passwordError.textContent = "Password must be at least 8 characters";
            isValid = false;
        }

        // CONFIRM PASSWORD VALIDATION
        if(confirmPassword === ""){
            confirmPasswordError.textContent = "Please confirm your password";
            isValid = false;
        } else if(password !== confirmPassword){
            confirmPasswordError.textContent = "Passwords do not match";
            isValid = false;
        }

        // IF VALIDATES FAILS, STOP FORM SUBMISSION 
        if (!isValid) {
            event.preventDefault();
        }
    });
}

// TOGGLE PASSWORD VISIBILITY
const toggleButtons = document.querySelectorAll(".togglePassword");
toggleButtons.forEach(button => {
    button.addEventListener("click", function(){
        const input = this.parentElement.querySelector("input");
        if(input.type === "password"){
            input.type = "text";
            this.src = "image/eye-svgrepo-com.svg";
        } else {
            input.type = "password";
            this.src = "image/eye-slash-svgrepo-com.svg";
        }
    });
});