import "./bootstrap";
import "./components/alert";
import "./components/confirmDelete";
import "./components/dropzone";

window.addEventListener("beforeunload", () => {
    document.getElementById("page-loader").classList.remove("hidden");
});

window.addEventListener("DOMContentLoaded", () => {
    document.getElementById("page-loader").classList.add("hidden");
});

initConfirmDelete()