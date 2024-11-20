@extends('desktop.master')

@section('slider')
    @include('desktop.template.slider')
@endsection

@section('coupon')
    @include('desktop.template.coupon')
@endsection

@section('content')
    <!-- DANH MUC SAN PHAM -->
    <div class="container-main bg-cmain6 rounded-[15px] ">
        <!-- swiper note -->
        <h3 class="pl-6 pt-6 font-semibold font-el text-2xl">Danh Mục Sản Phẩm</h3>
        <div class="danhmuc px-10 lg:px-20 flex flex-wrap pb-[45px] pt-[33px] gap-8 justify-center lg:justify-between">
            <!-- nd -->
            @for ($i = 0; $i < 8; $i++)
                <div class="dm1 flex flex-col justify-center items-center gap-3">
                    <div class="rounded-full bg-white /w-[12.5%] flex  justify-center">
                        <img src="../img/dm1.png" alt="" class="w-full px-5 py-5">
                    </div>
                    <p>Tô</p>
                </div>
            @endfor
            <!-- end nd -->
        </div>
    </div>
    <!-- END DANH MUC SAN PHAM -->

    <!-- SALE -->
    <div class="container-main py-10 px-[5%] lg:px-0">
        <div class="fsale flex-none 800:flex flex-wrap 800:flex-nowrap gap-28 lg:gap-24">
            <!-- left -->
            <div class="left_s bg-cmain6 w-[40%] relative rounded-[20px] hidden 800:flex justify-center">
                <img src="../img/sale_bn.webp" alt="" class="w-full rounded-[20px]">
                <div class="ttl absolute bottom-20   left-0 w-full h-full flex flex-col justify-end items-center">
                    <div class="bg-cmain6 p-20 rounded-[20px]">
                        <p class="font-el text-[48px] text-white font-bold">FASH SALE</p>
                        <p>Bắt đầu sau: <strong class="text-red-700">2:14:57</strong> </p>
                        <a href="{{ route('product') }}"
                            class="bg-cmain7 flex py-[13px] px-10 rounded-[50px] gap-2 mt-2 items-center justify-center">
                            <p class="text-white">Xem tất cả</p>
                            <svg class="" width="23" height="13" viewBox="0 0 23 13" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M0 6.50098L22.1988 6.50098" stroke="white" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M16.8906 0.797033C17.0456 1.83527 17.5246 3.37885 18.475 4.66751C19.0203 5.40686 19.7289 6.07092 20.6227 6.49976C19.7289 6.92861 19.0203 7.59266 18.475 8.33201C17.5246 9.62068 17.0456 11.1642 16.8906 12.2025L17.8797 12.3501C18.0165 11.4337 18.4476 10.054 19.2798 8.92554C20.0709 7.8529 21.2003 7.03261 22.7878 6.99986C22.8565 7.00102 22.9258 7.00096 22.9959 6.99966L22.9866 6.49976L22.9959 5.99986C22.9258 5.99856 22.8565 5.99851 22.7878 5.99966C21.2003 5.96691 20.0709 5.14662 19.2798 4.07398C18.4476 2.94555 18.0165 1.56585 17.8797 0.649414L16.8906 0.797033Z"
                                    fill="white" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <!-- end left -->
            <!-- right -->
            <div class="right_s w-full 800:w-[50%] ">
                <div class="cnt_tablet flex flex-col  lg:hidden">
                    <p class="font-el text-[48px] text-cmain">FASH SALE</p>
                    <p>Bắt đầu sau: <strong class="text-red-700">2:14:57</strong> </p>
                </div>
                <!-- Show 4 sản phẩm bằng view2 trong provider -->
                <div class="flex flex-wrap justify-between gap-y-[26px] gap-x-5">
                    @foreach ($products as $pro)
                        <div class="box1 w-[45%] flex flex-col items-center">
                            <a href="{{ route('product_detail', ['product_id' => $pro->product_id]) }}"><img
                                    src="{{ asset('img/images/' . $pro->img) }}"
                                    class="h-48 w-auto lg:object-cover object-contain" alt=""></a>
                            <div class="ttl_1 flex flex-col items-center">
                                <a href="{{ route('product_detail', ['product_id' => $pro->product_id]) }}"
                                    class="font-el font-extrabold text-base text-center">{{ $pro->name }}</a>
                                <p class="text-cmain3 text-sm font-el py-2 line-clamp-2 h-12 overflow-hidden text-center ">
                                    {{ $pro->description }}</p>
                                <p class="font-el font-extrabold text-base text-cmain">{{ number_format($pro->price) }} VNĐ
                                </p>
                                <div class="flex items-center justify-center gap-4">
                                    <form action="{{ route('add_to_cart') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $pro->product_id }}">
                                        <input type="hidden" name="price" value="{{ $pro->price }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit"
                                            class="border group border-cmain hover:border-cmain7 hover:bg-cmain7 flex py-3 px-5 rounded-[39px] /w-full mt-3 items-center justify-center transition duration-300 ease-in-out">
                                            <p class="text-cmain group-hover:text-white">Thêm vào giỏ hàng</p>
                                        </button>
                                    </form>
                                    {{-- <span class="flex w-1 h-1 bg-cmain rounded-full "></span> --}}
                                    <a href=""
                                        class="group border-cmain hover:border-cmain7 hover:bg-cmain7 flex py-3 px-5 rounded-[39px] /w-full mt-3 items-center justify-center transition duration-300 ease-in-out">
                                        <svg class="transition-colors duration-300 group-hover:text-white" width="32"
                                            height="31" viewBox="0 0 32 31" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect width="32" height="31" rx="15.5" fill="#194569"
                                                fill-opacity="0.1" />
                                            <path
                                                d="M16.434 21.9343C16.196 22.0219 15.804 22.0219 15.566 21.9343C13.536 21.2112 9 18.1949 9 13.0826C9 10.8258 10.743 9 12.892 9C14.166 9 15.293 9.6427 16 10.636C16.707 9.6427 17.841 9 19.108 9C21.257 9 23 10.8258 23 13.0826C23 18.1949 18.464 21.2112 16.434 21.9343Z"
                                                stroke="#194569" stroke-width="1.2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
            <div class="cnt_tablet flex justify-center mt-2 800:hidden">
                <a href=""
                    class="/bg-cmain7 flex py-[13px] w-full px-10 rounded-[50px] gap-2 mt-2 items-center justify-center">
                    <p class="text-cmain">Xem tất cả</p>
                    <svg class="" width="23" height="13" viewBox="0 0 23 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 6.50098L22.1988 6.50098" stroke="#194569" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M16.8906 0.797033C17.0456 1.83527 17.5246 3.37885 18.475 4.66751C19.0203 5.40686 19.7289 6.07092 20.6227 6.49976C19.7289 6.92861 19.0203 7.59266 18.475 8.33201C17.5246 9.62068 17.0456 11.1642 16.8906 12.2025L17.8797 12.3501C18.0165 11.4337 18.4476 10.054 19.2798 8.92554C20.0709 7.8529 21.2003 7.03261 22.7878 6.99986C22.8565 7.00102 22.9258 7.00096 22.9959 6.99966L22.9866 6.49976L22.9959 5.99986C22.9258 5.99856 22.8565 5.99851 22.7878 5.99966C21.2003 5.96691 20.0709 5.14662 19.2798 4.07398C18.4476 2.94555 18.0165 1.56585 17.8797 0.649414L16.8906 0.797033Z"
                            fill="#194569" />
                    </svg>
                </a>
            </div>
            <!-- end right -->
        </div>
    </div>
    <!-- END SALE -->

    <!-- BO SU TAP -->
    <div class="bstr ">
        <div class="relative z-10 ">
            <div class="container-main px-[5%] lg:px-0">
                <!-- <img src="img/bst_bn.png" alt=""> -->
                <div class="tltl relative z-10  flex flex-col  gap-4 py-5">
                    <p class="font-el font-extrabold text-base text-cmain">Trải nghiệm mua hàng</p>
                    <h4 class="text-[36px] font-el font-semibold text-cmain ">Bộ sưu tập tập Sứ Việt</h4>
                    <p class="text-base line-clamp-2 lg:line-clamp-none">Vẻ đẹp của nước men sáng, màu sứ trắng tinh khôi
                        và điểm xuyết những họa tiết hoa lá cách điệu sinh động, đã tạo nên sản phẩm có kiểu dáng đơn giản,
                        không cầu kỳ nhưng vẫn tôn lên sự đẳng cấp, tiện nghi của không gian trưng bày. Sự kết hợp hài hòa
                        giữa màu vàng đất mới lạ cùng màu xanh dương thân thuộc, mang đến cho mỗi sản phẩm sự trẻ trung,
                        hiện đại nhưng không kém phần sang trọng, thanh lịch.</p>
                </div>
                <!--  -->
                <div class="/container-main relative z-10 mt-5">
                    <div class="flex flex-wrap gap-y-10 md:gap-y-20 justify-between /absolute top-0 gap-x-6 800:gap-x-2">
                        <!-- Show 4 sản phẩm bằng view3 trong provider -->
                        @foreach ($collection as $bst)
                            <div class="box1 w-[40%] md:w-[30%] 800:w-[23%] flex flex-col items-center h-75">
                                <a href="{{ route('product_detail', ['product_id' => $bst->product_id]) }}"><img
                                        src="{{ asset('img/images/' . $bst->img) }}" alt=""
                                        class="h-48 w-auto lg:object-cover object-contain"></a>
                                <div class="ttl_1 flex flex-col items-center">
                                    <a href="{{ route('product_detail', ['product_id' => $bst->product_id]) }}"
                                        class="font-el font-extrabold text-base text-center">{{ $bst->name }}</a>
                                    <p
                                        class="text-cmain3 text-sm font-el py-2 line-clamp-2 h-12 overflow-hidden text-center ">
                                        {{ $bst->description }}</p>
                                    <p class="font-el font-extrabold text-base text-cmain">
                                        {{ number_format($bst->price) }} VNĐ</p>
                                    <div class="flex items-center justify-center gap-4">
                                        <form action="{{ route('add_to_cart') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $bst->product_id }}">
                                            <input type="hidden" name="price" value="{{ $bst->price }}">
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit"
                                                class="border group border-cmain hover:border-cmain7 hover:bg-cmain7 flex py-3 px-5 rounded-[39px] /w-full mt-3 items-center justify-center transition duration-300 ease-in-out">
                                                <p class="text-cmain group-hover:text-white">Thêm vào giỏ hàng</p>
                                            </button>
                                        </form>
                                        {{-- <span class="flex w-1 h-1 bg-cmain rounded-full "></span> --}}
                                        <a href=""
                                            class="group border-cmain hover:border-cmain7 hover:bg-cmain7 flex py-3 px-5 rounded-[39px] /w-full mt-3 items-center justify-center transition duration-300 ease-in-out">
                                            <svg class="transition-colors duration-300 group-hover:text-white"
                                                width="32" height="31" viewBox="0 0 32 31" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <rect width="32" height="31" rx="15.5" fill="#194569"
                                                    fill-opacity="0.1" />
                                                <path
                                                    d="M16.434 21.9343C16.196 22.0219 15.804 22.0219 15.566 21.9343C13.536 21.2112 9 18.1949 9 13.0826C9 10.8258 10.743 9 12.892 9C14.166 9 15.293 9.6427 16 10.636C16.707 9.6427 17.841 9 19.108 9C21.257 9 23 10.8258 23 13.0826C23 18.1949 18.464 21.2112 16.434 21.9343Z"
                                                    stroke="#194569" stroke-width="1.2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <!--  -->

                    </div>
                </div>
                <div class="flex justify-center mt-10">
                    <a href="{{ route('product') }}"
                        class="bg-cmain7 flex /py-[13px] /px-10 rounded-[50px] w-[183px] h-[53px] gap-2 mt-2 items-center justify-center">
                        <p class="text-white">Xem tất cả</p>
                        <svg class="" width="23" height="13" viewBox="0 0 23 13" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 6.50098L22.1988 6.50098" stroke="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M16.8906 0.797033C17.0456 1.83527 17.5246 3.37885 18.475 4.66751C19.0203 5.40686 19.7289 6.07092 20.6227 6.49976C19.7289 6.92861 19.0203 7.59266 18.475 8.33201C17.5246 9.62068 17.0456 11.1642 16.8906 12.2025L17.8797 12.3501C18.0165 11.4337 18.4476 10.054 19.2798 8.92554C20.0709 7.8529 21.2003 7.03261 22.7878 6.99986C22.8565 7.00102 22.9258 7.00096 22.9959 6.99966L22.9866 6.49976L22.9959 5.99986C22.9258 5.99856 22.8565 5.99851 22.7878 5.99966C21.2003 5.96691 20.0709 5.14662 19.2798 4.07398C18.4476 2.94555 18.0165 1.56585 17.8797 0.649414L16.8906 0.797033Z"
                                fill="white" />
                        </svg>
                    </a>
                </div>
            </div>
            <div class="img_bst absolute top-0 left-0 hidden md:block">
                <img src="../img/bst_bn.png" alt="">
            </div>
        </div>
    </div>
    <!-- END BO SU TAP -->

    <!-- TRAI NGHIEM DIEU KY -->
    <div class="bg-[#E7F6FF] my-14">
        <div class="container-main pt-20 pb-10 px-[5%] lg:px-0">
            <div class="flex flex-col 800:flex-row justify-between gap-y-5 800:gap-y-0">
                <!-- content -->
                <div class="exp_left w-full 800:w-[40%] ">
                    <div class="tiltle_exp flex flex-col gap-7 mb-8">
                        <p class="font-el font-extrabold text-base text-cmain">TRẢI NGHIỆM DIỆU KÌ</p>
                        <h4 class="font-el font-semibold text-[48px] text-cmain">Hành Trình Sứ Việt </h4>
                        <p class="text-base">Vẻ đẹp của nước men sáng, màu sứ trắng tinh khôi và điểm xuyết những họa
                            tiết hoa lá cách điệu sinh động, đã tạo nên sản phẩm có kiểu dáng đơn giản, không cầu kỳ
                            nhưng vẫn tôn lên sự đẳng cấp, tiện nghi của không gian trưng bày. Sự kết hợp hài hòa giữa
                            màu vàng đất mới lạ cùng màu xanh dương thân thuộc, mang đến cho mỗi sản phẩm sự trẻ trung,
                            hiện đại nhưng không kém phần sang trọng, thanh lịch.</p>
                    </div>
                    <a href=""
                        class="bg-cmain7 flex rounded-[15px] w-[183px] h-[53px] gap-2 mt-2 items-center justify-center">
                        <p class="text-white">Xem tất cả</p>
                        <svg class="" width="23" height="13" viewBox="0 0 23 13" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 6.50098L22.1988 6.50098" stroke="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M16.8906 0.797033C17.0456 1.83527 17.5246 3.37885 18.475 4.66751C19.0203 5.40686 19.7289 6.07092 20.6227 6.49976C19.7289 6.92861 19.0203 7.59266 18.475 8.33201C17.5246 9.62068 17.0456 11.1642 16.8906 12.2025L17.8797 12.3501C18.0165 11.4337 18.4476 10.054 19.2798 8.92554C20.0709 7.8529 21.2003 7.03261 22.7878 6.99986C22.8565 7.00102 22.9258 7.00096 22.9959 6.99966L22.9866 6.49976L22.9959 5.99986C22.9258 5.99856 22.8565 5.99851 22.7878 5.99966C21.2003 5.96691 20.0709 5.14662 19.2798 4.07398C18.4476 2.94555 18.0165 1.56585 17.8797 0.649414L16.8906 0.797033Z"
                                fill="white" />
                        </svg>
                    </a>
                </div>
                <!--swiper note -->
                <!-- <div class="exp_right w-full 800:w-[50%] flex-none 800:flex-col">
                                <img src="../img/lysu.png" alt="" class="rounded-2xl w-full h-[70%] object-contain ">
                                <div class="ct flex gap-2 justify-center items-center mt-4 w-full">
                                    <p class="text-cmain font-el font-semibold text-[36px]">Ly Sứ</p>
                                    <p class="text-cmain3">Ly sứ dưỡng sinh 0.48 L (K2) + nắp ống hút
                                        - Đại dương</p>
                                </div>
                            </div> -->
                <div class="exp_right w-full 800:w-[50%] flex-none 800:flex-col">
                    <div class="swiper InforSwiper">
                        <div class="swiper-wrapper">
                            @for ($i = 0; $i < 8; $i++)
                                <div class="swiper-slide">
                                    <img src="../img/lysu.png" alt=""
                                        class="rounded-2xl w-full h-[70%] object-contain ">
                                    <div class="ct flex flex-col gap-2 justify-center /items-center mt-4 w-full">
                                        <p class="text-cmain font-el font-semibold text-[36px]">Ly Sứ</p>
                                        <p class="text-cmain3">Ly sứ dưỡng sinh 0.48 L (K2) + nắp ống hút
                                            - Đại dương</p>
                                    </div>
                                </div>
                            @endfor
                        </div>
                        <div class="mt-10">
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--END TRAI NGHIEM DIEU KY -->

    <!-- THONG TIN SAN PHAM -->
    <div class="container-main py-5 px-[5%] lg:px-0">
        <h4 class="text-base font-el font-extrabold text-cmain">Thông tin về sản phẩm</h4>
        <div class="inf flex flex-col 800:flex-row justify-between ">
            <div class="info_left w-full 800:w-[50%]">
                <div class="box_info mt-9 flex flex-col gap-9">
                    <div class="box1 flex flex-col md:flex-row items-center gap-5">
                        <img src="../img/infor.png" alt="" class="rounded-[15px] w-full">
                        <div class="tt_box flex flex-col gap-2">
                            <p
                                class="text-[10px] text-white bg-cmain px-2 py-1 rounded-[5px] w-[52px] h-[21px] font-el font-semibold">
                                Review</p>
                            <p class="text-base text-cmain line-clamp-3 sm:line-clamp-none font-el font-semibold">Sứ
                                dưỡng sinh Healthycook là dòng sản phẩm đột phá độc đáo,kết tinh của...</p>
                            <div class="re flex items-center gap-2">
                                <p class="text-[12px] text-[#888888]">10/04/2001</p>
                                <span class="hidden sm:flex w-1  h-1 bg-cmain rounded-full "></span>
                                <p class="text-[12px] hidden sm:flex text-[#888888]">Bui Anh Tuan</p>
                            </div>
                        </div>
                    </div>
                    <div class="box1 flex flex-col md:flex-row items-center gap-5">
                        <img src="../img/infor.png" alt="" class="rounded-[15px] w-full">
                        <div class="tt_box flex flex-col gap-2">
                            <p
                                class="text-[10px] text-white bg-cmain px-2 py-1 rounded-[5px] w-[52px] h-[21px] font-el font-semibold">
                                Review</p>
                            <p class="text-base text-cmain line-clamp-3 sm:line-clamp-none font-el font-semibold">Sứ
                                dưỡng sinh Healthycook là dòng sản phẩm đột phá độc đáo,kết tinh của...</p>
                            <div class="re flex items-center gap-2">
                                <p class="text-[12px] text-[#888888]">10/04/2001</p>
                                <span class="hidden sm:flex w-1  h-1 bg-cmain rounded-full "></span>
                                <p class="text-[12px] hidden sm:flex text-[#888888]">Bui Anh Tuan</p>
                            </div>
                        </div>
                    </div>
                    <div class="box1 flex flex-col md:flex-row items-center gap-5">
                        <img src="../img/infor.png" alt="" class="rounded-[15px] w-full">
                        <div class="tt_box flex flex-col gap-2">
                            <p
                                class="text-[10px] text-white bg-cmain px-2 py-1 rounded-[5px] w-[52px] h-[21px] font-el font-semibold">
                                Review</p>
                            <p class="text-base text-cmain line-clamp-3 sm:line-clamp-none font-el font-semibold">Sứ
                                dưỡng sinh Healthycook là dòng sản phẩm đột phá độc đáo,kết tinh của...</p>
                            <div class="re flex items-center gap-2">
                                <p class="text-[12px] text-[#888888]">10/04/2001</p>
                                <span class="hidden sm:flex w-1  h-1 bg-cmain rounded-full "></span>
                                <p class="text-[12px] hidden sm:flex text-[#888888]">Bui Anh Tuan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="infor_right w-full 800:w-[40%] mt-9">
                <img src="../img/botra.png" alt="" class="w-full">
                <div class="ttl_infor flex flex-col gap-5 mt-3">
                    <p class="text-2xl text-cmain font-el font-semibold">Bộ Trà Diệp Lục 0.8L - Camellia - sự hình
                        thành của sự đẳng cấp</p>
                    <p class="text-base">Diệp Lục khắc họa sinh động vẻ đẹp mộc mạc, dân giã của hình ảnh hoa, lá trong
                        thiên nhiên. Những cành hoa, chiếc lá được nghệ thuật hóa một</p>
                    <p class="text-[12px] text-[#888888]">Xem chi tiet...</p>
                </div>
            </div>
        </div>
    </div>
    <!--END THONG TIN SAN PHAM -->

    <!-- cCONTACT -->
    <!--Cứ đổ bth nữa t xử lý spiwer sau -->
    <div class="container-main px-[5%] lg:px-0 bg-cmain6 rounded-[15px] mb-10">
        <div class="flex justify-between items-center p-8 text-center gap-5">
            <!-- Contact us -->
            <div class="w-1/4 relative group cursor-pointer">
                <span
                    class="absolute bg-cmain h-1 w-0 left-0 -top-2 group-hover:w-full transition-all duration-300"></span>
                <h3 class="text-xl font-semibold mb-2">Liên hệ với chúng tôi</h3>
                <p class="text-gray-500">
                    Liên hệ trực tiếp với chúng tôi qua email hoặc bạn có thể ghé thăm văn phòng của chúng tôi.
                </p>
            </div>

            <!-- Leave a message -->
            <div class="w-1/4 relative group cursor-pointer">
                <span
                    class="absolute bg-cmain h-1 w-0 left-0 -top-2 group-hover:w-full transition-all duration-300"></span>
                <h3 class="text-xl font-semibold mb-2">Để lại lời nhắn của bạn</h3>
                <p class="text-gray-500">
                    Nếu bạn có bất kỳ câu hỏi nào hay cần đội ngũ sale của chúng tôi hỗ trợ hãy cho chúng tôi biết.
                </p>
            </div>

            <!-- Sign up for updates -->
            <div class="w-1/4 relative group cursor-pointer">
                <span
                    class="absolute bg-cmain h-1 w-0 left-0 -top-2 group-hover:w-full transition-all duration-300"></span>
                <h3 class="text-xl font-semibold mb-2">Đăng ký nhận thông tin</h3>
                <p class="text-gray-500">
                    Đừng bỏ lỡ các chương trình ưu đãi và các sản phẩm và nhiều ưu đãi mới nhất từ chúng tôi bạn nhé.
                </p>
            </div>

            <!-- Member benefits -->
            <div class="w-1/4 relative group cursor-pointer">
                <span
                    class="absolute bg-cmain h-1 w-0 left-0 -top-2 group-hover:w-full transition-all duration-300"></span>
                <h3 class="text-xl font-semibold mb-2">Quyền lợi thành viên</h3>
                <p class="text-gray-500">
                    Chương trình khách hàng thân thiết Minh Long_VIP tại cửa hàng với nhiều quyền lợi và ưu đãi đặc
                    quyền.
                </p>
            </div>
        </div>
    </div>
    <!-- END CONTACT -->
@endsection

@push('styles')
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
@endpush


@push('scripts')
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".InforSwiper", {
            // slidesPerView: 2,
            // spaceBetween: 15,
            centeredSlides: true,
            loop: true,
            breakpoints: {
                0: {
                    slidesPerView: 1,
                    spaceBetween: 10,
                },
                425: {
                    slidesPerView: 1,
                    spaceBetween: 20,
                },
                650: {
                    slidesPerView: 2,
                    spaceBetween: 30,
                },
                800: {
                    slidesPerView: 2,
                    spaceBetween: 15,
                },
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });
    </script>
@endpush
