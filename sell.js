const productBtn =
document.getElementById("productBtn");

const serviceBtn =
document.getElementById("serviceBtn");

const conditionSection =
document.getElementById("conditionSection");

const serviceFields =
document.getElementById("serviceFields");

productBtn.addEventListener("click", () => {

    productBtn.classList.add("active");
    serviceBtn.classList.remove("active");

    conditionSection.style.display = "block";
    serviceFields.style.display = "none";

});

serviceBtn.addEventListener("click", () => {

    serviceBtn.classList.add("active");
    productBtn.classList.remove("active");

    conditionSection.style.display = "none";
    serviceFields.style.display = "block";

});

const postBtn =
document.querySelector(".post-btn");

postBtn.addEventListener("click", () => {

    const itemName =
    document.getElementById("itemName").value.trim();

    const category =
    document.getElementById("category").value;

    const description =
    document.getElementById("description").value.trim();

    const price =
    document.getElementById("price").value.trim();

    const location =
    document.getElementById("location");

    const availableDate =
    document.getElementById("availableDate");

    // reset error

    document.getElementById("itemNameError").textContent = "";
    document.getElementById("categoryError").textContent = "";
    document.getElementById("descriptionError").textContent = "";
    document.getElementById("priceError").textContent = "";
    document.getElementById("conditionError").textContent = "";
    document.getElementById("locationError").textContent = "";
    document.getElementById("dateError").textContent = "";

    let isValid = true;

    // Item Name

    if(itemName === ""){

        document.getElementById("itemNameError")
        .textContent = "Item name is required";

        isValid = false;
    }

    // Category

    if(category === ""){

        document.getElementById("categoryError")
        .textContent = "Please select a category";

        isValid = false;
    }

    // Description

    if(description === ""){

        document.getElementById("descriptionError")
        .textContent = "Description is required";

        isValid = false;
    }

    // Price

    if(price === ""){

    document.getElementById("priceError")
    .textContent = "Price is required";

    isValid = false;
}
else if(isNaN(price)){

    document.getElementById("priceError")
    .textContent =
    "Price must be a number";

    isValid = false;
}
else if(Number(price) <= 0){

    document.getElementById("priceError")
    .textContent =
    "Price must be greater than RM 0";

    isValid = false;
}

    if(productBtn.classList.contains("active")){

        const conditionSelected =
        document.querySelector(
        ".condition-buttons .active-condition");

        if(!conditionSelected){

            document.getElementById("conditionError")
            .textContent =
            "Please select item condition";

            isValid = false;
        }

    }

    if(serviceBtn.classList.contains("active")){

        if(location.value.trim() === ""){

            document.getElementById("locationError")
            .textContent =
            "Location is required";

            isValid = false;
        }

        if(availableDate.value === ""){

            document.getElementById("dateError")
            .textContent =
            "Available date is required";

            isValid = false;
        }
    }

    if(isValid){

        alert("Item Posted Successfully!");

    }

});

const conditionButtons =
document.querySelectorAll(
".condition-buttons button"
);

conditionButtons.forEach(button => {

    button.addEventListener("click", () => {

        conditionButtons.forEach(btn =>
            btn.classList.remove(
            "active-condition")
        );

        button.classList.add(
        "active-condition");

    });

});

const imageUploads =
document.querySelectorAll(".imageUpload");

imageUploads.forEach(input => {

    input.addEventListener("change", function(){

        const file = this.files[0];

        if(file){

            const photoBox =
            this.closest(".photo-box");

            const previewImage =
            photoBox.querySelector(".previewImage");

            const uploadText =
            photoBox.querySelector(".uploadText");

            const reader =
            new FileReader();

            reader.onload = function(e){

                previewImage.src =
                e.target.result;

                previewImage.style.display =
                "block";

                uploadText.style.display =
                "none";
            };

            reader.readAsDataURL(file);
        }

    });

});