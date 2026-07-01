
const tabs =
document.querySelectorAll(".tab-btn");

const contents =
document.querySelectorAll(".tab-content");

tabs.forEach(tab => {

    tab.addEventListener("click", () => {

        tabs.forEach(btn =>
            btn.classList.remove("active")
        );

        contents.forEach(content =>
            content.classList.remove("active-content")
        );

        tab.classList.add("active");

        const target =
        tab.id.replace("Tab","Content");

        document.getElementById(target)
        .classList.add("active-content");

    });

});

const purchaseButtons =
document.querySelectorAll(".purchase-btn");

const purchaseCards =
document.querySelectorAll(".purchase-card");

purchaseButtons.forEach(button => {

    button.addEventListener("click", () => {

        purchaseButtons.forEach(btn =>
            btn.classList.remove("active-purchase")
        );

        button.classList.add("active-purchase");

        const status =
        button.dataset.status;

        purchaseCards.forEach(card => {

            if(
                status === "all" ||
                card.dataset.status === status
            ){
                card.style.display = "flex";
            }
            else{
                card.style.display = "none";
            }

        });

    });

});