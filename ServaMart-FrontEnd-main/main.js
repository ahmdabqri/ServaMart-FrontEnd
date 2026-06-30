const searchInput = document.getElementById("search-input");
const cards = document.querySelectorAll(".product-card");
const noResult = document.getElementById("noResult");

searchInput.addEventListener("keyup", function(){

    const searchValue = searchInput.value.toLowerCase();

    let found = false;

    cards.forEach(card => {

        const title = card.querySelector("h3")
                          .textContent
                          .toLowerCase();

        if(title.includes(searchValue)){

            card.style.display = "block";
            found = true;

        }else{

            card.style.display = "none";

        }

    });

    if(found){
        noResult.style.display = "none";
    }else{
        noResult.style.display = "block";
    }

});