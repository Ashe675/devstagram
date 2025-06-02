export function showAlert(type, title, text) {
    window.Swal.fire({
        icon: type,
        title: title,
        text: text,
        confirmButtonText: "OK",
        confirmButtonColor: type === 'error' ? '#d33' : '#3085d6',
    });
}