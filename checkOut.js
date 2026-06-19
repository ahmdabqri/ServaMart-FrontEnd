const checkoutForm =
document.getElementById("checkOut-formValidation");

checkoutForm.addEventListener("submit", function(event){

    event.preventDefault();

    const fullName =
    document.getElementById("fullName").value.trim();

    const phone =
    document.getElementById("phone").value.trim();

    const email =
    document.getElementById("email").value.trim();

    const address =
    document.getElementById("address").value.trim();

    const city =
    document.getElementById("city").value.trim();

    const state =
    document.getElementById("state").value.trim();

    const postcode =
    document.getElementById("postcode").value.trim();

    const payment =
    document.querySelector('input[name="payment"]:checked');

    const fullNameError = document.getElementById("fullNameError");
    const phoneError = document.getElementById("phoneError");
    const emailError = document.getElementById("emailError");
    const addressError = document.getElementById("addressError");
    const cityError = document.getElementById("cityError");
    const stateError = document.getElementById("stateError");
    const postcodeError = document.getElementById("postcodeError");
    const paymentError = document.getElementById("paymentError");

    // reset error
    fullNameError.textContent = "";
    phoneError.textContent = "";
    emailError.textContent = "";
    addressError.textContent = "";
    cityError.textContent = "";
    stateError.textContent = "";
    postcodeError.textContent = "";
    paymentError.textContent = "";

    let isValid = true;

    if(fullName === ""){
        fullNameError.textContent = "Full name is required";
        isValid = false;
    }

    if(phone === ""){
        phoneError.textContent = "Phone number is required";
        isValid = false;
    }

    if(email === ""){
        emailError.textContent = "Email is required";
        isValid = false;
    }

    if(address === ""){
        addressError.textContent = "Address is required";
        isValid = false;
    }

    if(city === ""){
        cityError.textContent = "City is required";
        isValid = false;
    }

    if(state === ""){
        stateError.textContent = "State is required";
        isValid = false;
    }

    if(postcode === ""){
        postcodeError.textContent = "Postcode is required";
        isValid = false;
    }

    if(!payment){
        paymentError.textContent =
        "Please select a payment method";
        isValid = false;
    }

    if(isValid){

        alert("Order placed successfully!");
        window.location.href = "orderSuccess.html";

    }

});