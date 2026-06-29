const loginForm = document.getElementById("login-formValidation");

if(loginForm){
loginForm.addEventListener("submit", function(event){

    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value.trim();

    const emailError = document.getElementById("emailError");
    const passwordError = document.getElementById("passwordError");

    emailError.textContent = "";
    passwordError.textContent = "";

    let isValid = true;

    // Email kosong
    if(email === ""){
        emailError.textContent = "Email is required";
        isValid = false;
    }

    // Check if it is the admin OR a valid UTeM student domain
    else if(email !== "admin@gmail.com" && !email.toLowerCase().endsWith("@student.utem.edu.my")){
        emailError.textContent = "Access denied. Use your UTeM Student or Admin email.";
        isValid = false;
    }

    // Password kosong
    if(password === ""){
        passwordError.textContent = "Password is required";
        isValid = false;
    }

    // Minimum password
    else if(password.length < 8){
        passwordError.textContent = "Password must be at least 8 characters";
        isValid = false;
    }

    if(!isValid){
        event.preventDefault();
    }

});
}

const passwordInput = document.getElementById("password");
const togglePassword = document.getElementById("togglePassword");

let isVisible = false;

togglePassword.addEventListener("click", function(){

    if(!isVisible){

        passwordInput.type = "text";

        togglePassword.src = "image/eye-svgrepo-com.svg";

        isVisible = true;

    }else{

        passwordInput.type = "password";

        togglePassword.src = "image/eye-slash-svgrepo-com.svg";

        isVisible = false;
    }

});