import "./bootstrap";

import { initConfirmDelete } from "./components/confirmDelete";

// Inicializar componentes
initConfirmDelete();

window.addEventListener("beforeunload", () => {
    document.getElementById("page-loader").classList.remove("hidden");
});

window.addEventListener("DOMContentLoaded", () => {
    document.getElementById("page-loader").classList.add("hidden");
});
