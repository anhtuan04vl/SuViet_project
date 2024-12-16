@extends('desktop.master')

@section('content')
<!-- BREADCRUMD -->
<div class="container-main py-5 px-[5%] lg:px-0">
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="/inline-flex flex gap-2 items-center space-x-1">
            <li class="inline-flex items-center">
                <a href="/" class="text-teal-500 hover:text-teal-700">Trang chủ</a>
            </li>
            <li>
                <span class="flex w-1 h-1 bg-cmain rounded-full "></span>
            </li>
            <li>
                <a href="/product" class="text-gray-700 hover:text-gray-300">Sản phẩm</a>
            </li>
        </ol>
    </nav>
</div>
<!-- END BREADCRUMD -->

<div class="container-main py-5 px-[5%] lg:px-0">
    <!-- danh muc san pham -->
    <div class="cate_pdt bg-cmain6 px-10 rounded-[15px]">
        <h3 class=" pt-6 font-semibold font-el text-2xl">Danh Mục Sản Phẩm</h3>
        <div class="danhmuc flex flex-wrap pb-[45px] pt-[33px] gap-8 justify-center lg:justify-between">
            <!-- nd -->
            <!-- dl lấy từ providers bằng view1 -->
            @foreach ($categories as $sp)
                <div class="dm1 swipers-slide flex flex-col justify-center items-center gap-3">
                    <a href="{{ route('listcate', ['name' => $sp->name]) }}"
                        class="cursor-pointer rounded-full  bg-white /w-[12.5%] flex  justify-center">
                        <img src="{{ asset('img/images/' . $sp->images) }}" alt="" class="w-[100px] px-[19px] py-3">
                    </a>
                    <p>{{ $sp->name }}</p>
                </div>
            @endforeach

            <!-- end nd -->
        </div>
    </div>
    <!--end danh muc san pham -->

    <!-- filter -->
    <div class="filter_pdt py-5 flex gap-10">
        <div class="swap flex flex-col justify-start gap-1 items-start cursor-pointer">
            <select id="sortOption" onchange="location = this.value;" class="w-full p-3 border border-cmain3 rounded-[8px] bg-white text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="{{ route('product', ['sort' => 'default']) }}" {{ $sortOption == 'default' ? 'selected' : '' }}>Sắp xếp</option>
                <option value="{{ route('product', ['sort' => 'price_asc']) }}" {{ $sortOption == 'price_asc' ? 'selected' : '' }}>Giá tăng dần</option>
                <option value="{{ route('product', ['sort' => 'price_desc']) }}" {{ $sortOption == 'price_desc' ? 'selected' : '' }}>Giá giảm dần</option>
                <option value="{{ route('product', ['sort' => 'sold']) }}" {{ $sortOption == 'sold' ? 'selected' : '' }}>Sản phẩm bán chạy</option>
                <option value="{{ route('product', ['sort' => 'votes']) }}" {{ $sortOption == 'votes' ? 'selected' : '' }}>Được vote nhiều nhất</option>
            </select>
        </div>
    </div>
    <!--end filter -->

    <!-- san pham -->
    <div class="relative z-10 mt-5">
        <div
            class="flex flex-wrap gap-y-10 md:gap-y-20 justify-between /absolute top-0 gap-x-6 800:gap-x-2 cursor-pointer">
           
            @foreach ($allProduct as $aP)
                <div class="box1 swipers-slide w-[40%] md:w-[30%] 800:w-[23%]  flex flex-col items-center">
                    <a href="{{ route('product_detail', ['product_id' => $aP->product_id]) }}">
                        <img src="{{ asset('img/images/' . $aP->img) }}" alt=""
                            class="h-48 w-auto lg:object-cover object-contain">
                    </a>
                    <div class="ttl_1 swipers-slide flex flex-col items-center">
                        <a href="{{ route('product_detail', ['product_id' => $aP->product_id]) }}"
                            class="font-el font-extrabold text-base text-center truncate h-6 overflow-hidden">{{ $aP->name }}</a>
                        <!-- <p class="text-cmain3 text-sm font-el py-2 line-clamp-2 h-12 overflow-hidden text-center ">
                            {{ $aP->description }}
                        </p> -->
                        <p class="font-el font-extrabold text-base text-cmain">{{ number_format($aP->price) }} VNĐ</p>
                        <div class="flex items-center justify-center gap-4">
                            <form action="{{ route('add_to_cart') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $aP->product_id }}">
                                <input type="hidden" name="price" value="{{ $aP->price }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit"
                                    class="border group border-cmain hover:border-cmain7 hover:bg-cmain7 flex py-3 px-5 rounded-[39px] /w-full mt-3 items-center justify-center transition duration-300 ease-in-out">
                                    <p class="text-cmain group-hover:text-white">Thêm vào giỏ hàng</p>
                                </button>
                            </form>
                            {{-- <span class="flex w-1 h-1 bg-cmain rounded-full "></span> --}}
                            <form action="{{ route('wishlist.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $aP->product_id }}">
                                <button
                                    class="group border-cmain hover:border-cmain7 hover:bg-cmain7 flex py-3 px-5 rounded-[39px] /w-full mt-3 items-center justify-center transition duration-300 ease-in-out"
                                    type="submit"><svg class="transition-colors duration-300 group-hover:text-white"
                                        width="32" height="31" viewBox="0 0 32 31" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect width="32" height="31" rx="15.5" fill="#194569" fill-opacity="0.1" />
                                        <path
                                            d="M16.434 21.9343C16.196 22.0219 15.804 22.0219 15.566 21.9343C13.536 21.2112 9 18.1949 9 13.0826C9 10.8258 10.743 9 12.892 9C14.166 9 15.293 9.6427 16 10.636C16.707 9.6427 17.841 9 19.108 9C21.257 9 23 10.8258 23 13.0826C23 18.1949 18.464 21.2112 16.434 21.9343Z"
                                            stroke="#194569" stroke-width="1.2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg></button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

    <!-- end san pham -->
    <!-- phan trang -->
    <div class="flex justify-center items-center gap-4 mt-8 ">
        {{ $allProduct->links() }}
    </div>





    <!-- Bai viet lien quan -->
    <div class="bai_post">
        <div class="tlt_news flex justify-between items-center">
            <h4 class="font-el font-extrabold text-[32px]">Bài viết liên quan</h4>
            <a href="" class="flex py-[13px] px-10 rounded-[50px] gap-2 mt-2 items-center justify-center">
                <p class="text-black">Xem tất cả</p>
                <svg class="" width="23" height="13" viewBox="0 0 23 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 6.50098L22.1988 6.50098" stroke="black" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M16.8906 0.797033C17.0456 1.83527 17.5246 3.37885 18.475 4.66751C19.0203 5.40686 19.7289 6.07092 20.6227 6.49976C19.7289 6.92861 19.0203 7.59266 18.475 8.33201C17.5246 9.62068 17.0456 11.1642 16.8906 12.2025L17.8797 12.3501C18.0165 11.4337 18.4476 10.054 19.2798 8.92554C20.0709 7.8529 21.2003 7.03261 22.7878 6.99986C22.8565 7.00102 22.9258 7.00096 22.9959 6.99966L22.9866 6.49976L22.9959 5.99986C22.9258 5.99856 22.8565 5.99851 22.7878 5.99966C21.2003 5.96691 20.0709 5.14662 19.2798 4.07398C18.4476 2.94555 18.0165 1.56585 17.8797 0.649414L16.8906 0.797033Z"
                        fill="black" />
                </svg>
            </a>
        </div>
        <div class="news flex gap-5">
            @for ($i = 0; $i < 4; $i++)
                <div class="box_news1 w-[30%] flex gap-4">
                    <a herf="" class="news1s flex flex-col gap-3">
                        <img src="../img/news.png" alt="" class="w-full">
                        <div class="tlt_box1 flex flex-wrap">
                            <p class="text-base font-el font-semibold">"Ý TRÀ THƯỞNG NGUYỆT" VẸN TRÒN ĐÓN THU</p>
                            <p class="font-el text-cmain2 text-[12px]">10/04/2001</p>
                        </div>
                    </a>
                </div>
            @endfor
        </div>
    </div>
    <!-- End Bai viet lien quan -->

</div>
@endsection
<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- js trang -->

 <script>
        var swiper = new Swiper(".Cate2Swiper", {

        loop:true,
        breakpoints: {
            0: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            425: {
                slidesPerView: 4,
                spaceBetween: 20,
            },
            650: {
                slidesPerView: 5,
                spaceBetween: 25,
            },			
            800: {
                slidesPerView: 5,
                spaceBetween: 20,
            },
            1023: {
                slidesPerView: 7,
                spaceBetween: 20,
            },
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true, // Đảm bảo pagination có thể nhấn được
            dynamicBullets: true,
        },
        autoplay: {
            delay: 8000, // Tự động chuyển slide sau mỗi 3 giây
            disableOnInteraction: false,
        },
        });
    </script>


@push('styles')
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style>
        .swipers-slide a {
            transition: transform 0.3s ease-in-out;
        }

        .swipers-slide a:hover {
            transform: scale(1.2);
            /* Tăng kích thước khi hover */
        }
    </style>
@endpush