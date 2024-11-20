<!-- MENU -->
<div class="sticky top-0 z-[999] bg-white " style="align-self: flex-start;">
    <div class="container-main px-[5%] lg:px-0">
        <div class="flex justify-between /items-center /py-[10px]">
            <div class="lg:hidden relative flex items-center">
                <!-- Toggle Button -->
                <div class="block lg:hidden w-[72px] 400:w-[99px]">
                    <a id="menuToggle"
                        class="flex flex-col items-start justify-center py-1 ml-0 text-black md:py-2 header-menu-btn menu-footer-item h-[60px] rounded-full cursor-pointer">
                        <svg class="w-[25px] sm:w-[40px] h-auto" width="40px" height="40px" viewBox="0 0 24 24"
                            clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="m13 16.745c0-.414-.336-.75-.75-.75h-9.5c-.414 0-.75.336-.75.75s.336.75.75.75h9.5c.414 0 .75-.336.75-.75zm9-5c0-.414-.336-.75-.75-.75h-18.5c-.414 0-.75.336-.75.75s.336.75.75.75h18.5c.414 0 .75-.336.75-.75zm-4-5c0-.414-.336-.75-.75-.75h-14.5c-.414 0-.75.336-.75.75s.336.75.75.75h14.5c.414 0 .75-.336.75-.75z"
                                fill="#194569" />
                        </svg>
                    </a>
                </div>
                <!-- Modal Menu -->
                <div id="modal-menu"
                    class="fixed inset-0 z-50 hidden bg-gray-800 bg-opacity-75 opacity-0 transition-opacity duration-300 ease-in-out">
                    <div
                        class="bg-white w-3/4 md:w-1/3 h-full shadow-lg transform transition-transform duration-300 ease-in-out">
                        <!-- Close Button -->
                        <div class="flex items-center justify-end p-4 bg-cmain">
                            <button id="closeMenu" class="text-black">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <!-- Search Bar -->
                        <div class="p-4">
                            <input type="text" id="keyword_mobile" placeholder="Search..."
                                class="w-full rounded-full p-2 border border-gray-300 focus:outline-none">
                            <button class="absolute top-0 right-6 p-2 text-gray-500">
                                <!-- <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path d="M11.3385 19.6769C15.9437 19.6769 19.6769 15.9437 19.6769 11.3385C19.6769 6.73326 15.9437 3 11.3385 3C6.73326 3 3 6.73326 3 11.3385C3 15.9437 6.73326 19.6769 11.3385 19.6769Z" stroke="#232323" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M21 21L18 18" stroke="#232323" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg> -->
                            </button>
                        </div>

                        <!-- Menu Items -->
                        <ul class="p-4 space-y-4 text-lg">
                            <li><a href="brand-pdt" class="block text-black">Trang Chủ</a></li>
                            <li><a href="Men_pdt" class="block text-black">Giới thiệu</a></li>
                            <li><a href="Women_pdt" class="block text-black">Sản phẩm</a></li>
                            <li><a href="Uni_pdt" class="block text-black">Tin tức</a></li>
                            <li><a href="Body_pdt" class="block text-black">Liên hệ ngay</a></li>
                            <li><a href="login" class="block text-black">Đăng nhập</a></li>
                        </ul>
                        <hr>
                        <!-- Footer -->
                        <div class="menu-side-footer">
                            <div class=" text-center text-black menu-side-footer-copyright">
                                © 2024. Thiết kế bởi Sứ Việt </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- logo -->
            <div class="logo">
                <a href="{{ route('home') }}" class="flex justify-center"> <img src="../img/Logo (1).png"
                        alt="" class="/w-[70%] sm:w-full"></a>
            </div>
            <!-- menu -->
            <div class="menu_des hidden lg:flex gap-8 items-center ">
                <div class="menu">
                    <ul class="flex gap-12  items-center">
                        <li><a href="{{ route('home') }}"
                                class="text-black font-el font-semibold text-[13px] 2xl:text-base hover:text-cmain flex items-center gap-1">Trang
                                chủ</a></li>
                        <li><a href="{{ route('about') }}"
                                class="text-black font-el font-semibold text-[13px] 2xl:text-base hover:text-cmain flex items-center gap-1">Giới
                                Thiệu</a></li>

                        <li class="relative group ">
                            <a href="{{ route('product') }}"
                                class="text-black font-el font-semibold text-[13px] 2xl:text-base hover:text-cmain flex items-center gap-1">Sản
                                phẩm <svg width="18" height="19" viewBox="0 0 18 19" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4.70435 7.25L9.20435 11.75L13.7043 7.25" stroke="#454545"
                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg></a>
                            <ul
                                class="absolute top-full bg-white invisible opacity-0 group-hover:visible transition-all duration-300 group-hover:opacity-100 w-[200px]">
                                @foreach ($categories as $cate)
                                    <li class="px-4 py-2 "><a href="{{ route('listcate', ['name' => $cate->name]) }}"
                                            class="text-black  font-el font-semibold text-[13px] 2xl:text-base hover:text-cmain ">{{ $cate->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>

                        <li><a href="{{ route('blog') }}"
                                class="text-black font-el font-semibold text-[13px] 2xl:text-base hover:text-cmain flex items-center gap-1">Tin
                                tức</a></li>
                        <li><a href="{{ route('contact') }}"
                                class="text-white font-el font-semibold text-[13px] 2xl:text-base px-5 py-3 rounded-[10px] bg-[#194569] flex items-center gap-1">Liên
                                hệ ngay</a></li>
                    </ul>
                </div>
                <!-- //////////////////////// -->
                <div class="sgv flex gap-6 items-center ">
                    <!-- cart -->
                    <div class="cart fix_cart_count relative">
                        @if (Auth::check())
                            <a href="{{ route('show_cart', ['users_id' => Auth::id()]) }}">
                                <svg width="25" height="24" viewBox="0 0 25 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_7_350)">
                                        <path
                                            d="M2.41594 20.1932C3.88077 22 6.60708 22 12.0597 22H12.9403C18.3929 22 21.1192 22 22.5841 20.1932M2.41594 20.1932C0.951113 18.3864 1.45354 15.6433 2.45839 10.1571C3.17299 6.25564 3.53029 4.30491 4.88678 3.15245M2.41594 20.1932C2.41594 20.1932 2.41594 20.1932 2.41594 20.1932ZM22.5841 20.1932C24.0489 18.3864 23.5465 15.6433 22.5416 10.1571C21.827 6.25565 21.4697 4.30491 20.1132 3.15245M22.5841 20.1932C22.5841 20.1932 22.5841 20.1932 22.5841 20.1932ZM20.1132 3.15245C18.7567 2 16.8179 2 12.9403 2H12.0597C8.18208 2 6.24328 2 4.88678 3.15245M20.1132 3.15245C20.1132 3.15245 20.1132 3.15245 20.1132 3.15245ZM4.88678 3.15245C4.88678 3.15245 4.88678 3.15245 4.88678 3.15245Z"
                                            stroke="#454545" stroke-width="2" />
                                        <path
                                            d="M8.5 8C9.08225 9.16519 10.6533 10 12.5 10C14.3467 10 15.9178 9.16519 16.5 8"
                                            stroke="#454545" stroke-width="2" stroke-linecap="round" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_7_350">
                                            <rect width="24" height="24" fill="white"
                                                transform="translate(0.5)" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </a>
                        @else
                            <a href="{{ route('loginUsers') }}"><svg width="25" height="24"
                                    viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_7_350)">
                                        <path
                                            d="M2.41594 20.1932C3.88077 22 6.60708 22 12.0597 22H12.9403C18.3929 22 21.1192 22 22.5841 20.1932M2.41594 20.1932C0.951113 18.3864 1.45354 15.6433 2.45839 10.1571C3.17299 6.25564 3.53029 4.30491 4.88678 3.15245M2.41594 20.1932C2.41594 20.1932 2.41594 20.1932 2.41594 20.1932ZM22.5841 20.1932C24.0489 18.3864 23.5465 15.6433 22.5416 10.1571C21.827 6.25565 21.4697 4.30491 20.1132 3.15245M22.5841 20.1932C22.5841 20.1932 22.5841 20.1932 22.5841 20.1932ZM20.1132 3.15245C18.7567 2 16.8179 2 12.9403 2H12.0597C8.18208 2 6.24328 2 4.88678 3.15245M20.1132 3.15245C20.1132 3.15245 20.1132 3.15245 20.1132 3.15245ZM4.88678 3.15245C4.88678 3.15245 4.88678 3.15245 4.88678 3.15245Z"
                                            stroke="#454545" stroke-width="2" />
                                        <path
                                            d="M8.5 8C9.08225 9.16519 10.6533 10 12.5 10C14.3467 10 15.9178 9.16519 16.5 8"
                                            stroke="#454545" stroke-width="2" stroke-linecap="round" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_7_350">
                                            <rect width="24" height="24" fill="white"
                                                transform="translate(0.5)" />
                                        </clipPath>
                                    </defs>
                                </svg></a>
                        @endif
                        </a>
                    </div>
                    <!-- search -->
                    <div class="search">
                        <div class="relative inline-block">
                            <!-- Icon Search -->
                            <div class="cursor-pointer" onclick="toggleSearch()">
                                <svg width="25" height="24" viewBox="0 0 25 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="12" cy="11.5" r="9.5" stroke="#454545"
                                        stroke-width="2" />
                                    <path d="M20.5 20L22.5 22" stroke="#454545" stroke-width="2"
                                        stroke-linecap="round" />
                                </svg>
                            </div>
                            <!-- Search Box -->
                            <form action="{{ route('search') }}" method="GET" class="">
                                @csrf
                                <div id="searchBox"
                                    class="absolute top-full right-0 mt-10 hidden bg-white p-4 shadow-lg rounded-lg">
                                    <input id="keyword" type="text" name="query"
                                        value="{{ request('query') }}"
                                        class="border border-gray-300 p-2 rounded-md focus:ring-2 focus:ring-orange-500 focus:outline-none mb-2"
                                        placeholder="Tìm kiếm..." />
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="account group relative">
                        <svg width="25" height="24" viewBox="0 0 25 24s" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9.42231 10.625C10.7789 10.625 11.9535 10.1384 12.9135 9.17834C13.8732 8.21853 14.3599 7.0441 14.3599 5.68734C14.3599 4.33097 13.8734 3.15643 12.9134 2.19625C11.9533 1.23655 10.7788 0.75 9.42231 0.75C8.06551 0.75 6.89104 1.23655 5.93122 2.19641C4.9714 3.15627 4.48465 4.33085 4.48465 5.68734C4.48465 7.0441 4.97136 8.21869 5.93126 9.17854C6.8914 10.1382 8.06603 10.625 9.42231 10.625ZM6.78081 3.04584C7.51729 2.30932 8.3813 1.95133 9.42231 1.95133C10.4632 1.95133 11.3273 2.30932 12.0639 3.04584C12.8005 3.78248 13.1586 4.6466 13.1586 5.6873C13.1586 6.72831 12.8005 7.59232 12.0639 8.32895C11.3273 9.06563 10.4632 9.42362 9.42231 9.42362C8.38158 9.42362 7.51765 9.06547 6.78081 8.32895C6.04413 7.59248 5.68598 6.72835 5.68598 5.68734C5.68598 4.6466 6.04413 3.78248 6.78081 3.04584ZM18.0618 16.5135C18.0341 16.1141 17.9782 15.6783 17.8957 15.2182C17.8125 14.7546 17.7054 14.3164 17.5771 13.9158C17.4445 13.5018 17.2645 13.093 17.0416 12.7012C16.8106 12.2945 16.5391 11.9404 16.2344 11.6491C15.9158 11.3443 15.5258 11.0992 15.0747 10.9204C14.6252 10.7426 14.127 10.6525 13.5942 10.6525C13.3849 10.6525 13.1825 10.7383 12.7917 10.9928C12.5139 11.1738 12.2352 11.3534 11.9557 11.5318C11.6872 11.7029 11.3234 11.8632 10.874 12.0083C10.4356 12.1502 9.99051 12.2222 9.551 12.2222C9.11185 12.2222 8.66669 12.1502 8.22799 12.0083C7.77915 11.8633 7.41519 11.703 7.14709 11.5319C6.83598 11.3331 6.55451 11.1517 6.31035 10.9926C5.91981 10.7382 5.71741 10.6523 5.50817 10.6523C4.97513 10.6523 4.47716 10.7425 4.0278 10.9206C3.57704 11.099 3.18682 11.3441 2.86791 11.6492C2.56325 11.9408 2.29174 12.2947 2.06088 12.7012C1.83834 13.093 1.65816 13.5016 1.52551 13.916C1.39739 14.3165 1.29028 14.7546 1.20708 15.2182C1.12448 15.6777 1.06867 16.1136 1.04096 16.514C1.01373 16.9054 1 17.3129 1 17.7245C1 18.7946 1.34017 19.6609 2.01099 20.2998C2.67352 20.9304 3.55001 21.25 4.61618 21.25H14.4871C15.5529 21.25 16.4294 20.9303 17.0921 20.2999C17.7631 19.6614 18.1033 18.7948 18.1033 17.7244C18.1031 17.3113 18.0892 16.9039 18.0618 16.5135ZM16.2638 19.4295C15.8261 19.8461 15.2448 20.0487 14.4869 20.0487H4.61622C3.85815 20.0487 3.27695 19.8461 2.83932 19.4297C2.41002 19.0209 2.20137 18.4631 2.20137 17.7245C2.20137 17.3404 2.21403 16.9611 2.23941 16.597C2.26408 16.2398 2.31461 15.8474 2.38956 15.4304C2.46351 15.0186 2.55764 14.6321 2.66963 14.2823C2.7771 13.9468 2.92364 13.6146 3.10538 13.2946C3.27883 12.9896 3.47838 12.7279 3.6986 12.5171C3.9046 12.3199 4.16425 12.1585 4.47015 12.0375C4.75307 11.9254 5.07106 11.8641 5.41624 11.8549C5.45828 11.8773 5.53323 11.92 5.65459 11.9991C5.90155 12.1601 6.18619 12.3437 6.5009 12.5446C6.85564 12.7708 7.31261 12.975 7.85862 13.1513C8.41681 13.3318 8.98613 13.4234 9.5512 13.4234C10.1163 13.4234 10.6857 13.3318 11.2437 13.1515C11.7901 12.9749 12.247 12.7708 12.6022 12.5443C12.9242 12.3385 13.2009 12.1602 13.4478 11.9991C13.5692 11.9201 13.6441 11.8773 13.6862 11.8549C14.0315 11.8641 14.3495 11.9254 14.6326 12.0374C14.9383 12.1585 15.198 12.32 15.404 12.5171C15.6242 12.7278 15.8237 12.9895 15.9972 13.2948C16.1791 13.6146 16.3258 13.947 16.4331 14.2821C16.5452 14.6325 16.6395 15.0188 16.7134 15.4302C16.7881 15.848 16.8388 16.2406 16.8635 16.5972C16.889 16.9599 16.9018 17.3393 16.902 17.7245C16.9018 18.4632 16.6931 19.021 16.2638 19.4295Z"
                                fill="#828282" stroke="#828282" stroke-width="0.2" />
                        </svg>
                        <ul
                            class="absolute top-[65px] right-0 bg-white invisible opacity-0 group-hover:visible group-hover:opacity-100 transition-all duration-300 w-[200px] shadow-lg rounded-md">
                            @if (!Auth::check())
                                <li class="px-4 py-2">
                                    <a href="{{ route('loginUsers') }}"
                                        class="text-black font-el font-semibold text-[13px] 2xl:text-base hover:text-cmain">
                                        Đăng nhập
                                    </a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="px-4 py-2">
                                        <a href="{{ route('register') }}"
                                            class="text-black font-el font-semibold text-[13px] 2xl:text-base hover:text-cmain">
                                            Đăng ký
                                        </a>
                                    </li>
                                @endif
                            @else
                                <li class="px-4 py-2">
                                    <span class="text-black font-el font-semibold text-[13px] 2xl:text-base">Xin chào,
                                        {{ Auth::user()->fullname }}</span>
                                </li>
                                <li class="px-4 py-2">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                            class="text-black font-el font-semibold text-[13px] 2xl:text-base hover:text-cmain">
                                            {{ __('Đăng xuất') }}
                                        </button>
                                    </form>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <!--icon moblie -->
            <div class="sgv flex lg:hidden gap-6 /items-center justify-center items-center">
                <!-- cart -->
                <div class="cart fix_cart_count relative">
                    <a href="{{ route('cart') }}"><svg width="25" height="24" viewBox="0 0 25 24"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_7_350)">
                                <path
                                    d="M2.41594 20.1932C3.88077 22 6.60708 22 12.0597 22H12.9403C18.3929 22 21.1192 22 22.5841 20.1932M2.41594 20.1932C0.951113 18.3864 1.45354 15.6433 2.45839 10.1571C3.17299 6.25564 3.53029 4.30491 4.88678 3.15245M2.41594 20.1932C2.41594 20.1932 2.41594 20.1932 2.41594 20.1932ZM22.5841 20.1932C24.0489 18.3864 23.5465 15.6433 22.5416 10.1571C21.827 6.25565 21.4697 4.30491 20.1132 3.15245M22.5841 20.1932C22.5841 20.1932 22.5841 20.1932 22.5841 20.1932ZM20.1132 3.15245C18.7567 2 16.8179 2 12.9403 2H12.0597C8.18208 2 6.24328 2 4.88678 3.15245M20.1132 3.15245C20.1132 3.15245 20.1132 3.15245 20.1132 3.15245ZM4.88678 3.15245C4.88678 3.15245 4.88678 3.15245 4.88678 3.15245Z"
                                    stroke="#454545" stroke-width="2" />
                                <path d="M8.5 8C9.08225 9.16519 10.6533 10 12.5 10C14.3467 10 15.9178 9.16519 16.5 8"
                                    stroke="#454545" stroke-width="2" stroke-linecap="round" />
                            </g>
                            <defs>
                                <clipPath id="clip0_7_350">
                                    <rect width="24" height="24" fill="white" transform="translate(0.5)" />
                                </clipPath>
                            </defs>
                        </svg></a>

                    <span
                        class="count-cart ajax-count-cart text-white bg-cmain min-w-[20px] min-h-[20px] flex items-center justify-center rounded-[20px] text-[9px] absolute -top-2 -right-3 leading-[16px]"></span>
                </div>
                <!-- search -->
                <div class="search">
                    <div class="relative inline-block">
                        <!-- Icon Search -->
                        <div class="cursor-pointer" onclick="toggleSearch()">
                            <svg width="25" height="24" viewBox="0 0 25 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle cx="12" cy="11.5" r="9.5" stroke="#454545" stroke-width="2" />
                                <path d="M20.5 20L22.5 22" stroke="#454545" stroke-width="2"
                                    stroke-linecap="round" />
                            </svg>
                        </div>
                        <!-- Search Box -->
                        <div id="searchBox"
                            class="absolute top-full right-0 mt-7 hidden bg-white p-4 shadow-lg rounded-lg">
                            <input id="keyword" type="text"
                                class="border border-gray-300 p-2 rounded-md focus:ring-2 focus:ring-orange-500 focus:outline-none mb-2"
                                placeholder="Tìm kiếm..." />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MENU -->

<!-- js trang -->
<script>
    const menuToggle = document.getElementById('menuToggle');
    const modalMenu = document.getElementById('modal-menu');
    const closeMenu = document.getElementById('closeMenu');

    // Mở menu với hiệu ứng
    menuToggle.addEventListener('click', (e) => {
        modalMenu.classList.remove('hidden', 'opacity-0');
        modalMenu.classList.add('opacity-100');
    });

    // Đóng menu với hiệu ứng
    const closeMenuFunction = () => {
        modalMenu.classList.remove('opacity-100');
        modalMenu.classList.add('opacity-0');
        setTimeout(() => {
            modalMenu.classList.add('hidden');
        }, 400); // Chờ 300ms để hoàn tất hiệu ứng
    };

    // Đóng khi click vào nút đóng
    closeMenu.addEventListener('click', closeMenuFunction);

    // Đóng khi click ra ngoài menu
    modalMenu.addEventListener('click', (e) => {
        if (e.target === modalMenu) {
            closeMenuFunction();
        }
    });
</script>

<script>
    function toggleSearch() {
        var searchBox = document.getElementById('searchBox');
        if (searchBox.classList.contains('hidden')) {
            searchBox.classList.remove('hidden');
        } else {
            searchBox.classList.add('hidden');
        }
    }
</script>
