const tabs =
document.querySelectorAll(".admin-btn");

const contents =
document.querySelectorAll(".admin-content");

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