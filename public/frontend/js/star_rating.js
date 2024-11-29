$(document).on('click', '#send-feedback', function () {
    let message = $('#message-feedback').val();
    $.ajax({
        url: '/feedback',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            message: message,
            rating: $('#rating').val()
        },
        success: function (response) {
            if (response.code === 200) {
                alert('Gửi phản hồi thành công!');
                $('#message-feedback').val('');
                $('#exampleModal').modal('hide');
            } else {
                alert(response.message);
            }
        },
        error: function (error) {
            console.log(error);
        }
    })
});

document.addEventListener("DOMContentLoaded", function () {
    // Reset nội dung khi modal đóng
    const exampleModal = document.getElementById("exampleModal");
    exampleModal.addEventListener("hidden.bs.modal", function () {
        document.getElementById("message-feedback").value = ""; // Reset textarea
        document.getElementById("rating").value = "";
        // Reset trạng thái sao
        const stars = document.querySelectorAll("#star_rating .star_rating");
        stars.forEach((star) => {
            star.classList.remove("hover");
        });
    })

    const stars = document.querySelectorAll("#star_rating .star_rating");

    let currentRating = 0; // Lưu trữ giá trị đánh giá hiện tại
    // Xử lý hover
    stars.forEach((star, index) => {
        star.addEventListener("mouseover", () => {
            highlightStars(index + 1); // Highlight từ đầu đến ngôi sao hiện tại
        });

        star.addEventListener("mouseout", () => {
            highlightStars(currentRating); // Quay lại trạng thái hiện tại
        });
        // Xử lý click để chọn sao
        star.addEventListener("click", () => {
            currentRating = index + 1; // Lưu giá trị sao được chọn
            highlightStars(currentRating); // Hiển thị đánh giá
            $('#rating').val(currentRating);
        });
    });

    // Hàm tô màu các sao từ 1 đến số `rating`
    function highlightStars(rating) {
        stars.forEach((star, index) => {
            if (index < rating) {
                star.classList.add("hover"); // Tô màu sao
            } else {
                star.classList.remove("hover"); // Xóa màu nếu không nằm trong phạm vi rating
            }
        });
    }
});
