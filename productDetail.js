const thumbnails = document.querySelectorAll(".thumbnail");
const mainImage = document.querySelector(".main-image");

thumbnails.forEach(thumbnail => {

    thumbnail.addEventListener("click", () => {

        mainImage.src = thumbnail.src;

        thumbnails.forEach(t =>
            t.classList.remove("active")
        );

        thumbnail.classList.add("active");

    });

});