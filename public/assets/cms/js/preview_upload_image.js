$(document).ready(function() {
    let inpFileElement = document.getElementById('image');
    let resultElement = document.getElementById('imgPreview')
    let statusImg = document.getElementById('status-image')
    let fileTypes = ['image/png', 'image/jpg', 'image/svg', 'image/jpeg'];
    let maxSize = 7000000; // 7MB

    inpFileElement.addEventListener('change', function(e) {
        let files = e.target.files;
        let file = files[0];

        if (!fileTypes.includes(file.type)) {
            statusImg.innerText = 'Định dạng file không hợp lệ!';
            return;
        } else if (file.size > maxSize) {
            statusImg.innerText = 'Dung lượng file không được lớn hơn 7MB!';
            return;
        } else {
            statusImg.innerText = '';
            let fileReader = new FileReader();
            fileReader.readAsDataURL(file)

            fileReader.onload = function() {
                const urlCurent = fileReader.result

                resultElement.src = urlCurent;
                resultElement.style.display = 'block';
            }
        }

    })
})
