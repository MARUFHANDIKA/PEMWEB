// main.js — efek animasi ringan atau smooth scroll

document.addEventListener("DOMContentLoaded", function () {
    const links = document.querySelectorAll("a[href^='#']");
    for (let link of links) {
        link.addEventListener("click", function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute("href"));
            if (target) {
                window.scrollTo({
                    top: target.offsetTop - 70,
                    behavior: "smooth",
                });
            }
        });
    }
});
