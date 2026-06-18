const registerForm = document.getElementById("register-formValidation");

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

    // User Name kosong
    if(userName === ""){
        userNameError.textContent = "User Name is required";
        isValid = false;
    }

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

    // Confirm Password kosong
    if(confirmPassword === ""){
        confirmPasswordError.textContent = "Please confirm your password";
        isValid = false;
    }

    // Passwords match
    else if(password !== confirmPassword){
        confirmPasswordError.textContent = "Passwords do not match";
        isValid = false;
    }

    // Minimum password
    else if(password.length < 6){
        passwordError.textContent = "Password must be at least 6 characters";
        isValid = false;
    }

    if(isValid){

    registerForm.submit();

}


});

const toggleButtons = document.querySelectorAll(".togglePassword");

toggleButtons.forEach(button => {

    button.addEventListener("click", function(){

        const input =
            this.parentElement.querySelector("input");

        if(input.type === "password"){

            input.type = "text";
            this.src = "image/eye-svgrepo-com.svg";

        }else{

            input.type = "password";
            this.src = "image/eye-slash-svgrepo-com.svg";
        }

    });

});