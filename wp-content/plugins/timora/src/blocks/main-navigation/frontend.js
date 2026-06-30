document.addEventListener("DOMContentLoaded", () => {
    const timoraNavigation = document.querySelector(".timora-navigation");

    if (!timoraNavigation) {
        return;
    }

    window.addEventListener("scroll", () => {
        if (window.scrollY > 200) {
            timoraNavigation.classList.add("scrolled");
        } else {
            timoraNavigation.classList.remove("scrolled");
        }
    })

})

