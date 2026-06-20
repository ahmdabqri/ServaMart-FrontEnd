const slots =
document.querySelectorAll(".slot-btn");

let selectedSlot = null;

const selectedSlotText = document.getElementById("selectedSlotText");

slots.forEach(slot => {

    slot.addEventListener("click", () => {

        if(slot.classList.contains("unavailable")){
            return;
        }

        slots.forEach(btn =>
            btn.classList.remove("active")
        );

        slot.classList.add("active");

        selectedSlot = slot.dataset.slot;

        document.getElementById("bookingTime").value = selectedSlot;

        selectedSlotText.textContent = "Selected: " + selectedSlot;

    });

});

const bookingForm = document.getElementById("bookingForm");

bookingForm.addEventListener("submit", (e) => {

    const bookingDate = document.getElementById("bookingDate").value;

    document.getElementById("dateError").textContent = "";

    document.getElementById("slotError").textContent = "";

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

const dateInput =
document.querySelector(
'input[name="booking_date"]'
);

dateInput.addEventListener(
'change',
loadBookedSlots
);

function loadBookedSlots(){

    const selectedDate =
    dateInput.value;

    if(selectedDate === ""){
        return;
    }

    fetch(

    "getBookedSlots.php?date=" +
    selectedDate +
    "&service_id=" +
    serviceId

    )

    .then(response =>
        response.json()
    )

    .then(bookedSlots => {

        console.log(bookedSlots);

        document
        .querySelectorAll(".slot-btn")
        .forEach(btn => {

             console.log(btn.dataset.slot);

            btn.classList.remove(
                "unavailable"
            );

            btn.classList.remove(
            "active"
        );

            if(

            bookedSlots.includes(
            btn.dataset.slot
            )

            ){

                btn.classList.add(
                "unavailable"
                );

            }

        });

         selectedSlot = null;

    document.getElementById(
        "bookingTime"
    ).value = "";

    selectedSlotText.textContent = "";

    });

}