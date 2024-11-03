document.addEventListener("DOMContentLoaded", function () {
    const hamburger = document.querySelector(".hamburger");
    const menu = document.querySelector("#menu"); // ID referentie

    hamburger.addEventListener("click", function () {
        menu.classList.toggle("active"); // Toggle de actieve klasse
    });
});