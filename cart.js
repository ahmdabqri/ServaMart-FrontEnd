const checkboxes =
document.querySelectorAll(".item-checkbox");

const totalPrice =
document.getElementById("totalPrice");

checkboxes.forEach(box => {

    box.addEventListener("change", updateTotal);

});

function updateTotal(){

    let total = 0;

    checkboxes.forEach(box => {

        if(box.checked){

            const price =
            Number(box.dataset.price);

            const cartItem =
            box.closest(".cart-item");

            const qty =
            Number(
                cartItem.querySelector(".qty")
                .textContent
            );

            total += price * qty;

        }

    });

    totalPrice.textContent =
    total.toFixed(2);

}

const plusButtons =
document.querySelectorAll(".plus-btn");

const minusButtons =
document.querySelectorAll(".minus-btn");

plusButtons.forEach(button => {

    button.addEventListener("click", function(){

        const qtySpan =
        this.previousElementSibling;

        let qty =
        Number(qtySpan.textContent);

        qty++;

        qtySpan.textContent = qty;

        updateTotal();

    });

});

minusButtons.forEach(button => {

    button.addEventListener("click", function(){

        const qtySpan =
        this.nextElementSibling;

        let qty =
        Number(qtySpan.textContent);

        if(qty > 1){

            qty--;

            qtySpan.textContent = qty;

            updateTotal();

        }

    });

});