<style>
    .movie-slider {
        padding-bottom: 50px;
    }
    .movie-slider .image {
        height: 350px;
        margin-bottom: 20px;
    }
    .movie-slider .image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 12px;
    }
    .movie-slider .image-title {
        font-size: 20px;
        color: #FFFFFF;
        font-size: 20px;
        background-color: rgba(0, 0, 0, 0.7);
        position: absolute;
        bottom: 36px;
    }
    .movie-slider .slick-initialized .slick-slide {
        margin: 0 10px;
    }
    .movie-slider .slick-arrow {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        border: none;
        width: 50px;
        height: 50px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 20px;
        line-height: 1;
        z-index: 5;
        transition: all 0.2s linear;
        background-color: rgba(0, 0, 0, 0.1);
    }
    .movie-slider .slick-prev {
        left: 2px;
        color: red;
        border-radius: 4px;
    }
    .movie-slider .slick-next {
        right: 2px;
        color: red;
        border-radius: 4px;
    }
    .movie-slider .slick-dots {
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translate(-50%, 0);
        display: flex !important;
        align-items: center;
        justify-content: center;
        gap: 0 20px;
        list-style: none;
    }
    .movie-slider .slick-dots button {
        font-size: 0;
        width: 15px;
        height: 15px;
        border-radius: 100rem;
        border: none;
        outline: none;
        transition: all 0.2s linear;
    }
    .movie-slider .slick-dots .slick-active button {
        background-color: #2cccff;
    }

    .play-movie {
        background-color: rgba(0, 0, 0, 0.2);
        position: absolute;
        top: 0;
        width: 100%;
        height: 100%;
        color: red;
        z-index: 100;
        display: none;
        border-radius: 8px;
    }
    .play-movie p i {
        position: absolute;
        top: 30%;
        left: 50%;
        transform: translateX(-50%);
        font-size: 40px;
        width: 50px;
        height: 50px;
        border-radius: 100%;
        border: 1px solid #5d4c44;
        text-align: center;
        padding-top: 4px;
        cursor: pointer;
    }
    .play-movie div {
        position: absolute;
        bottom: 0;
        width: 100%;
    }
    .play-movie a i {
        color: #3abbbd !important;
    }
    .image-item:hover .play-movie {
        display: block;
    }
    .play-movie .movie-title {
        font-size: 24px;
        display: block;
        width: 100%;
        position: absolute;
        bottom: 40px;
        text-align: center;
        color: #fff3cd;
    }
    .movie-trailer {
        position: absolute;
        top: 0;
        left: 0;
        justify-content: center;
        align-items: center;
        width: 100%;
        min-height: 100vh;
        background-color: rgba(0, 0, 0, 0.7);
        display: none;
    }
    .play-movie-trailer {
        min-width: 700px;
        min-height: 700px;
    }
</style>

<div class="movie-slider">
    @foreach($movies as $key => $item)
        <div class="image-item">
            <div class="image" style="position: relative;">
                <img
                    src="{{ asset($item->banner) }}"
                    alt=""
                />
                <div class="play-movie" data-url="{{ $item->trailer }}">
                    @if(!empty($item->trailer))
                        <p><i class="fa-solid fa-play" title="Xem trailer"></i></p>
                    @endif
                    <p class="movie-title">{{ $item->name }}</p>
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('web.movie.show', ['id' => $item->id]) }}" class="btn btn-danger">Xem chi tiết</a>
                        <a href="" class="btn btn-danger ms-4"><i class="fas fa-phone me-1 text-secondary"></i>Mua vé</a>
                    </div>
                </div>
            </div>
            <h3 class="image-title">{{ $item->name }}</h3>
        </div>
    @endforeach
</div>
<div class="movie-trailer">
    <div class="play-movie-trailer">

    </div>
</div>
<script>
    $(document).ready(function () {
        $(".movie-slider").slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            infinite: true,
            arrows: true,
            draggable: false,
            prevArrow: `<button type='button' class='slick-prev slick-arrow'><ion-icon name="arrow-back-outline"></ion-icon></button>`,
            nextArrow: `<button type='button' class='slick-next slick-arrow'><ion-icon name="arrow-forward-outline"></ion-icon></button>`,
            dots: true,
            responsive: [
                {
                    breakpoint: 1025,
                    settings: {
                        slidesToShow: 1,
                    },
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 3,
                        arrows: false,
                        infinite: false,
                    },
                },
            ],
            // autoplay: true,
            // autoplaySpeed: 3000,
        });
        $('.play-movie').on('click', function () {
            $('.movie-trailer').css('display', 'flex');
            let htmlYtb = $(this).data('url');
            $('.play-movie-trailer').html(htmlYtb);
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        })
        $(document).on('click', '.movie-trailer', function () {
            if (!$(this).hasClass('play-movie-trailer')) {
                $('.movie-trailer').hide();
                $('.play-movie-trailer').empty();
            }
        });
    });
</script>
