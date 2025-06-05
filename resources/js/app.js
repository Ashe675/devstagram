import "./bootstrap";
import "./components/alert";
import "./components/confirmDelete";
import "./components/dropzone";

window.addEventListener("beforeunload", () => {
    document.getElementById("page-loader").classList.remove("hidden");
});

initConfirmDelete();

document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("page-loader").classList.add("hidden");
    const menuButton = document.getElementById("mobile-menu-button");
    const mobileMenu = document.getElementById("mobile-menu");

    menuButton.addEventListener("click", () => {
        mobileMenu.classList.toggle("hidden");
        mobileMenu.classList.toggle("animate-fadeIn");
    });

    // Opcional: cierra el menú al hacer click fuera
    document.addEventListener("click", function (event) {
        if (
            !mobileMenu.contains(event.target) &&
            !menuButton.contains(event.target)
        ) {
            mobileMenu.classList.add("hidden");
        }
    });
});
