<!-- BANNER COUPON -->
<div class="container-main px-[5%] lg:px-0">
    <!-- Swiper -->
        <div class="swiper CouponSwiper">
            <div class="swiper-wrapper">
                @for ($i = 0; $i < 8; $i++)
                <div class="swiper-slide">
                    <div class="py-12 /cursor-pointer">
                        <a href="#coupon"> <img src="../img/coupon.png" alt="" class="/w-full"></a>
                    </div>
                </div>
                @endfor
            </div>
            <!-- Thêm phần pagination nếu bạn muốn hiển thị -->
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <!-- END BANNER COUPON -->

    <!-- Link Swiper's CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<style>
    .swiper-wrapper {
        height: auto;
        width: 320px;
    }
</style>
<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper(".CouponSwiper", {

		loop:true,
		breakpoints: {
			0: {
				slidesPerView: 1,
				spaceBetween: 10,
			},
			425: {
				slidesPerView: 2,
				spaceBetween: 20,
			},
			650: {
				slidesPerView: 2,
				spaceBetween: 30,
			},			
			800: {
				slidesPerView: 4,
				spaceBetween: 40,
			},
		},
        pagination: {
            el: ".swiper-pagination",
            clickable: true, // Đảm bảo pagination có thể nhấn được
            dynamicBullets: true,
        },
        autoplay: {
            delay: 3000, // Tự động chuyển slide sau mỗi 3 giây
            disableOnInteraction: false,
        },
    });
  </script>