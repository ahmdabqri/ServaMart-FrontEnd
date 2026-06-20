const slots =
document.querySelectorAll(".slot-btn");

let selectedSlot = null;

const selectedSlotText = document.getElementById("selectedSlotText");

slots.forEach(slot => {

    if(!slot.classList.contains("unavailable")){

        slot.addEventListener("click", () => {

            slots.forEach(btn =>
                btn.classList.remove("active")
            );

            slot.classList.add("active");

           selectedSlot = slot.textContent;

            document.getElementById("bookingTime").value = selectedSlot;

            selectedSlotText.textContent = "Selected: " + selectedSlot;

        });

    }

});

const bookingForm =
document.getElementById("bookingForm");

bookingForm.addEventListener("submit", (e) => {

    const bookingDate =
    document.getElementById("bookingDate").value;

    document.getElementById("dateError")
    .textContent = "";

    document.getElementById("slotError")
    .textContent = "";

    let isValid = true;

    if(bookingDate === ""){

        document.getElementById("dateError")
        .textContent =
        "Please select a date";

        isValid = false;
    }

    if(selectedSlot === null){

        document.getElementById("slotError")
        .textContent =
        "Please select a time slot";

        isValid = false;
    }

    if(!isValid){

        e.preventDefault();

    }

});