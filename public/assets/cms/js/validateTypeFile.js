$('input[type=file]').on('change', function () {
    const allowedTypes = ["image/jpeg", "image/jpg", "image/png", "image/gif", "image/bmp", "image/tiff"];
    const maxFileSize = 10 * 1024 * 1024; // 10MB in bytes
    const file = this.files[0];
    const fileType = file.type;
    const fileSize = file.size;

    if (!allowedTypes.includes(fileType)) {
        Swal.fire('Error', 'Only JPEG, PNG, GIF, BMP, and TIFF image types are allowed!', 'error');
        $(this).val("");
    } else if (fileSize > maxFileSize) {
        Swal.fire('Error', 'File size exceeds the limit of 10MB!', 'error');
        $(this).val("");
    }
});
