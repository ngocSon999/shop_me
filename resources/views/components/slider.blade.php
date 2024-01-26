<style>
    .image-slider {
        padding-bottom: 50px;
    }
    .image {
        height: 450px;
        margin-bottom: 20px;
    }
    .image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 12px;
    }
    .image-title {
        font-size: 20px;
        color: #FFFFFF;
        font-size: 20px;
        background-color: rgba(0, 0, 0, 0.7);
        position: absolute;
        bottom: 36px;
    }
    .slick-initialized .slick-slide {
        margin: 0 10px;
    }
    .slick-arrow {
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
    .slick-arrow:hover {
        background-color: #2cccff;
        color: white;
    }
    .slick-prev {
        left: 2px;
        color: red;
        border-radius: 4px;
    }
    .slick-next {
        right: 2px;
        color: red;
        border-radius: 4px;
    }
    .slick-dots {
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
    .slick-dots button {
        font-size: 0;
        width: 15px;
        height: 15px;
        border-radius: 100rem;
        border: none;
        outline: none;
        transition: all 0.2s linear;
    }
    .slick-dots .slick-active button {
        background-color: #2cccff;
    }
s
</style>
<div class="image-slider">
    @foreach($movies as $key => $item)
    <div class="image-item">
        <div class="image">
            <img
                src="{{ asset($item->banner) }}"
                alt=""
            />
        </div>
        <h3 class="image-title">{{ $item->name }}</h3>
    </div>
    @endforeach
</div>
<script>
    $(document).ready(function () {
        $(".image-slider").slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: true,
            arrows: true,
            draggable: false,
            prevArrow: `<button type='button' class='slick-prev slick-arrow'><ion-icon name="arrow-back-outline"></ion-icon></button>`,
            nextArrow: `<button type='button' class='slick-next slick-arrow'><ion-icon name="arrow-forward-outline"></ion-icon></button>`,
            dots: true,
            // responsive: [
            //     {
            //         breakpoint: 1025,
            //         settings: {
            //             slidesToShow: 3,
            //         },
            //     },
            //     {
            //         breakpoint: 480,
            //         settings: {
            //             slidesToShow: 1,
            //             arrows: false,
            //             infinite: false,
            //         },
            //     },
            // ],
            autoplay: true,
            autoplaySpeed: 3000,
        });
    });

</script>
