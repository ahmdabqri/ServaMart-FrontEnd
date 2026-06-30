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

            selectedSlot =
            slot.textContent;

            selectedSlotText.textContent =
            "Selected: " + selectedSlot;

        });

    }

});

const bookBtn =
document.getElementById("bookBtn");

bookBtn.addEventListener("click", () => {

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

    if(isValid){

        const confirmBooking =
            confirm(
            "Confirm booking on " +
            bookingDate +
            " at " +
            selectedSlot + " ?"
            );

            if(confirmBooking){

                alert(
                "Booking Successful!"
                );

                window.location.href =
                "bookings.html";

}

    }

});


const bookingDate =
document.getElementById("bookingDate");

const today =
new Date().toISOString().split("T")[0];

bookingDate.min = today;