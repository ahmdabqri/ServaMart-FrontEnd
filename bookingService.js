console.log(availability);

function getDisabledDays(){

    switch(availability){

        case "Weekend":
            return [1,2,3,4,5];

        case "Weekdays":
        case "Monday - Friday":
            return [0,6];

        case "Monday":
            return [0,2,3,4,5,6];

        case "Tuesday":
            return [0,1,3,4,5,6];

        case "Wednesday":
            return [0,1,2,4,5,6];

        case "Thursday":
            return [0,1,2,3,5,6];

        case "Friday":
            return [0,1,2,3,4,6];

        case "Saturday":
            return [0,1,2,3,4,5];

        case "Sunday":
            return [1,2,3,4,5,6];

        default:
            return [];

    }

}

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

const dateInput = document.getElementById("bookingDate");

flatpickr("#bookingDate",{

    minDate:"today",

    disable:[

        function(date){

            console.log(date.toDateString(), date.getDay());

            return getDisabledDays().includes(date.getDay());

        }

    ],

    dateFormat:"Y-m-d",

    onChange:function(){

        loadBookedSlots();

    }

});