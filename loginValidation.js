const loginForm = document.getElementById("login-formValidation");

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

    // format email
    else if(!email.includes("@")){
        emailError.textContent = "Please enter a valid email";
        isValid = false;
    }

    // Password kosong
    if(password === ""){
        passwordError.textContent = "Password is required";
        isValid = false;
    }

    // Minimum password
    else if(password.length < 6){
        passwordError.textContent = "Password must be at least 6 characters";
        isValid = false;
    }

     if(!isValid){
        event.preventDefault();
    }

});

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