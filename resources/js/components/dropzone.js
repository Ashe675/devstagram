function initDropzone(path = '/uploads/posts/') {
    const dropzoneElement = document.getElementById("dropzone");
    if (!dropzoneElement) return;

    const dropzone = new window.Dropzone(dropzoneElement, {
        dictDefaultMessage: "Drag and drop files here or click to upload",
        acceptedFiles: ".jpg,.jpeg,.png,.gif,.pdf",
        dictRemoveFile: "Remove file",
        maxFiles: 1,
        maxFilesize: 5,
        uploadMultiple: false,
        addRemoveLinks: true,
        thumbnailHeight: 300,
        thumbnailWidth: 300,
        init: function () {
            const imageInput = document.getElementById("image");
            if (imageInput && imageInput.value.trim()) {
                const filename = imageInput.value;
                const mockFile = { name: filename, size: 1234 };
                this.emit("addedfile", mockFile);
                this.emit("thumbnail", mockFile, `${path}${filename}`);
                mockFile.previewElement.classList.add("dz-success", "dz-complete");
            }
        },
    });

    dropzone.on("success", (file, response) => {
        document.getElementById("image").value = response.image;
    });

    dropzone.on("removedfile", () => {
        document.getElementById("image").value = '';
    });

    return dropzone;
}

window.initDropzone = initDropzone;