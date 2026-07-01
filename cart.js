const checkboxes =
document.querySelectorAll(".item-checkbox");

const totalPrice =
document.getElementById("totalPrice");

checkboxes.forEach(box => {

    box.addEventListener(
        "change",
        updateTotal
    );

});

function updateTotal(){

    let total = 0;

    checkboxes.forEach(box => {

        if(box.checked){

            total += Number(
                box.dataset.price
            );

        }

    });

    totalPrice.textContent =
    total.toFixed(2);

}