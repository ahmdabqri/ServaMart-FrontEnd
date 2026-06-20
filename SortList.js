const sortSelect = document.getElementById("sort");
const productGrid = document.getElementById("product-grid");

sortSelect.addEventListener("change", function () {

    const cards = Array.from(
        document.querySelectorAll(".product-card")
    );

    if (this.value === "low-high") {

        cards.sort((a, b) => {

            const priceA = parseFloat(
                a.querySelector(".price").dataset.price
            );

            const priceB = parseFloat(
                b.querySelector(".price").dataset.price
            );

            return priceA - priceB;
        });

    }

    else if (this.value === "high-low") {

        cards.sort((a, b) => {

            const priceA = parseFloat(
                a.querySelector(".price").dataset.price
            );

            const priceB = parseFloat(
                b.querySelector(".price").dataset.price
            );

            return priceB - priceA;
        });

    }

    else if (this.value === "latest") {
 
        cards.sort((a, b) => {
 
            const idA = parseInt(a.dataset.id, 10);
            const idB = parseInt(b.dataset.id, 10);
 
            return idB - idA;
        });
    }

    cards.forEach(card => productGrid.appendChild(card));

});