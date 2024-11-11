<!-- SLIDER -->
<div class="container_slider">
    <div class="swiper SliderSwiper-slider">
        <div class="swiper-wrapper">
            @for ($i = 0; $i < 4; $i++)
                <div class="swiper-slide">
                    <div class="slider relative">
                        <img src="../img/slider.png" alt="" class="w-full">
                        <div class="absolute top-0 left-0 w-full h-full flex items-center justify-start">
                            <div class="w-full flex flex-col justify-center items-center gap-y-10">
                                <p class="text-white font-el font-bold text-xl sm:text-2xl md:text-[32px] lg:text-[62px]">Sứ Việt</p>
                                <p class="text-white font-el hidden sm:block text-sm lg:text-[42px]">Tinh hoa sứ Việt – Nâng tầm giá trị truyền thống</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
        <div class="absolute top-0">
            <div class="swiper-pagination"></div>
        </div>
    </div>
</div>
<!-- END SLIDER -->

<!-- Link Swiper's CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<style>
    .swiper-wrapper {
        height: auto;
    }
</style>
<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>
    var swiper_service = new Swiper(".SliderSwiper-slider", {
        slidesPerView: 1,
        spaceBetween: 0,
        loop: true,
        navigation: {
            nextEl: ".slide-btn-next",
            prevEl: ".slide-btn-prev",
        },
        pagination: {
            el: ".swiper-pagination",
            dynamicBullets: true,
        },
        autoplay: {
            delay: 2000,
        },
        centeredSlides: true,
        speed: 1000,
    });
</script>
