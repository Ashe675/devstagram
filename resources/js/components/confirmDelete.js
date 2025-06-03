function initConfirmDelete() {
    document.addEventListener('DOMContentLoaded', () => {
        const deleteForms = document.querySelectorAll('.delete-form');

        deleteForms.forEach(form => {
            const submitButton = form.querySelector('.delete-button');

            if (!submitButton) return;

            submitButton.addEventListener('click', (e) => {
                e.preventDefault();
                
                window.Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
}

window.initConfirmDelete = initConfirmDelete;