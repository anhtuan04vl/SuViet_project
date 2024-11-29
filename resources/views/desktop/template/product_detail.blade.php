@extends('desktop.master')

@section('content')
    <!-- breadcrumb -->
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
                    <a href="{{ route('product') }}"
                        class="text-gray-700 hover:text-gray-900">Sản phẩm</a>
                </li>
                <li>
                    <span class="flex w-1 h-1 bg-cmain rounded-full "></span>
                </li>
                <li>
                    <a href="{{ route('product_detail', ['product_id' => $sp->name]) }}"
                        class="text-gray-700 hover:text-gray-900">{{ $sp->name }}</a>
                </li>
            </ol>
        </nav>
    </div>
    <!-- end breadcrumb -->

    <!-- san pham -->
    <div class="container-main px-[5%] lg:px-0">
        <div class="p-6 flex flex-col md:flex-row  rounded-lg mt-10 gap-10">
            <!-- Phần Bên Trái: Hình Ảnh Sản Phẩm -->
            <div class="md:w-1/2">
                <!-- Hình ảnh chính -->
                <div class="relative mb-6 flex justify-center">
                    <img id="main-image" class="w-[70%] rounded-lg " src="{{ asset('img/images/' . $sp->img) }}"
                        alt="Hình ảnh sản phẩm chính">
                    <!-- Nút điều hướng trái -->
                    <!-- <button class="absolute top-1/2 left-0 p-2 bg-gray-200 rounded-full -translate-y-1/2 hover:bg-gray-300">
                        &lt;
                    </button> -->
                    <!-- Nút điều hướng phải -->
                    <!-- <button
                        class="absolute top-1/2 right-0 p-2 bg-gray-200 rounded-full -translate-y-1/2 hover:bg-gray-300">
                        &gt;
                    </button> -->
                </div>

                <!-- Hình ảnh nhỏ -->
                <!-- <div class="flex space-x-4">
                    @for ($i = 0; $i < 4; $i++)
                        <div class="w-16 h-16 overflow-hidden rounded-lg">
                            <img class="w-16 h-16 object-cover rounded-lg border cursor-pointer" src="../img/chen1.png"
                                onclick="changeMainImage('../img/chen1.png')" alt="Thumbnail 1">
                        </div>
                    @endfor
                </div> -->
            </div>

            <!-- Phần Bên Phải: Thông Tin Sản Phẩm -->
            <div class="md:w-1/2 p-6">
                <h1 class="text-2xl font-bold mb-2">{{ $sp->name }}</h1>
                <p class="text-gray-600 text-lg mb-2">{{ $category->name }}</p>

                <!-- Đánh giá -->
                <div class="flex items-center mb-4">
                    <span class="text-yellow-500">&#9733;</span>
                    <span class="text-yellow-500">&#9733;</span>
                    <span class="text-yellow-500">&#9733;</span>
                    <span class="text-yellow-500">&#9733;</span>
                    <span class="text-yellow-500">&#9734;</span>
                    <p class="ml-2 text-sm text-gray-500">(5 đánh giá)</p>
                </div>

                <!-- Giá -->
                <div class="flex items-center space-x-4 mb-4">
                    <span class="text-2xl font-bold text-cmain">{{ number_format($sp->price) }} VNĐ</span>
                    <span class="text-gray-500 line-through">{{ number_format($sp->sale) }} VNĐ</span>
                </div>

                <!-- Tùy chọn màu sắc -->
                <div class="mb-4">
                    <h2 class="text-xl font-semibold mb-4 text-cmain">Chi tiết về sản phẩm: {{ $sp->name }}</h2>
                    <p class="text-gray-600 mb-4">
                        {{ $sp->description }}
                    </p>
                </div>

                <!-- Tùy chọn kích thước -->
                <!-- <div class="mb-4">
                <span class="block text-sm font-semibold text-gray-700 mb-2">Kích thước</span>
                    <div id="size-options" class="flex space-x-2">
                        <button class="px-3 py-2 border rounded bg-gray-50 text-gray-600" onclick="selectSize(this)">5 x 6 cm</button>
                        <button class="px-3 py-2 border rounded bg-gray-50 text-gray-600" onclick="selectSize(this)">9 x 6 cm</button>
                        <button class="px-3 py-2 border rounded bg-gray-50 text-gray-600" onclick="selectSize(this)">12 x 9 cm</button>
                    </div>
                </div> -->

                <!-- Chọn số lượng -->
                <div class="mb-6">
                    <span class="block text-sm font-semibold text-gray-700 mb-2">Số lượng</span>
                    <div class="flex items-center space-x-2">
                        <button class="px-3 py-2 border rounded bg-gray-200" onclick="decreaseQuantity()">-</button>
                        <input id="quantity" type="text" value="1"
                            class="w-12 text-center border rounded px-2 py-2" readonly>
                        <button class="px-3 py-2 border rounded bg-gray-200" onclick="increaseQuantity()">+</button>
                    </div>
                </div>

                <!-- Nút hành động -->
                <div class="flex space-x-4">

                    <form class="flex space-x-4" action="{{ route('add_to_cart') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $sp->product_id }}">
                        <input type="hidden" name="price" value="{{ $sp->price }}">
                        <input type="hidden" name="quantity" value="quantity">
                        <button type="submit"
                            class="flex items-center justify-center px-6 py-3 bg-cmain text-white rounded hover:bg-blue-700">
                            <p class="text-white group-hover:text-white">Thêm vào giỏ hàng</p>
                        </button>
                        <button
                            class="flex items-center justify-center px-6 py-3 bg-cmain text-white rounded hover:bg-blue-700">
                            Mua ngay
                        </button>
                    </form>

                </div>
            </div>
        </div>
        <hr>
    </div>
    <!-- end san pham -->

    <!-- thong tin sanpham -->
    <div class="container-main my-5 px-[5%] lg:px-0">
        <div class="w-full ">
            <!-- Tabs -->
            <div class="/border-b border-gray-200">
                <ul class="flex justify-start space-x-8">
                    <li>
                        <a href="#" class="py-2 tab-link text-blue-600 border-b-2 border-blue-600" data-tab="info">
                            Thông tin sản phẩm
                        </a>
                    </li>
                    {{-- <li>
                        <a href="#" class="py-2 tab-link text-gray-500 hover:text-blue-600" data-tab="guide">
                            Hướng dẫn sử dụng
                        </a>
                    </li>
                    <li>
                        <a href="#" class="py-2 tab-link text-gray-500 hover:text-blue-600" data-tab="ingredients">
                            Thành phần
                        </a>
                    </li> --}}
                </ul>
            </div>

            <!-- Content -->
            <div class="mt-4">
                <!-- Thông tin sản phẩm -->
                <div class="tab-content" id="info" style="display: block;">
                    <h3 class="text-lg font-bold">{{ $sp->name }}</h3>
                    <p class="text-gray-600 mt-2">
                        {{ $sp->short_description }}
                    </p>
                    <p class="text-gray-600 mt-2">
                        {{ $sp->description }}
                    </p>
                </div>

                {{-- <!-- Hướng dẫn sử dụng -->
                <div class="tab-content" id="guide" style="display: none;">
                    <h3 class="text-lg font-bold">Hướng dẫn sử dụng</h3>
                    <p class="text-gray-600 mt-2">
                        Để đạt được hiệu quả tốt nhất, sử dụng kem 2 lần mỗi ngày: vào buổi sáng và buổi tối.
                    </p>
                    <p class="text-gray-600 mt-2">
                        - Sau khi làm sạch da, thoa một lượng vừa đủ kem lên mặt và cổ, massage nhẹ nhàng để kem thẩm thấu.
                    </p>
                    <p class="text-gray-600 mt-2">
                        - Sử dụng kem chống nắng sau khi bôi kem vào ban ngày để bảo vệ da khỏi tác động của ánh nắng mặt
                        trời.
                    </p>
                </div>

                <!-- Thành phần -->
                <div class="tab-content" id="ingredients" style="display: none;">
                    <h3 class="text-lg font-bold">Thành phần</h3>
                    <p class="text-gray-600 mt-2">
                        Sản phẩm chứa các thành phần chính sau:
                    </p>
                    <ul class="list-disc list-inside text-gray-600 mt-2">
                        <li>Arbutin 7%: Ức chế hình thành melanin, giúp giảm thâm nám và làm sáng da.</li>
                        <li>Vitamin C: Kích thích sản sinh collagen, giúp da săn chắc và phục hồi tổn thương.</li>
                        <li>Chiết xuất từ dâu tằm: Giúp chống oxi hóa, làm dịu da và giảm tình trạng kích ứng.</li>
                    </ul>
                </div> --}}

                <!-- Button "Xem thêm" -->
                <!-- <a href="#" class="text-blue-600 font-bold flex items-center mt-4">
                    Xem thêm
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1-8V7a1 1 0 112 0v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H7a1 1 0 110-2h3z" clip-rule="evenodd" />
                    </svg>
                </a> -->
            </div>
        </div>
    </div>
    <!-- end thong tin sanpham -->

    <!-- Binh luan -->
    <div class="container-main px-[5%] lg:px-0">
        <div class="bg-gray-50 p-6">
            <!-- Header Section -->
            <div class="flex justify-center items-center space-x-6 bg-white shadow-md rounded-t-md p-6">
                <!-- <button class="text-lg font-semibold text-blue-700 border-b-4 border-blue-700 pb-2">Đánh giá từ khách
                    hàng</button> -->
                <button class="text-lg font-semibold text-gray-500">Bình Luận về sản phẩm</button>
            </div>

            <!-- Overall Rating Section -->


            <!-- Review Cards -->
            <div class="bg-white shadow-md rounded-md p-6 mt-4">
                <!-- Single Review -->
                <div class="flex items-start space-x-4">
                    <img src="../img/user.png" alt="user avatar" class="h-12 w-12 rounded-full">
                    <div class="flex-grow">
                        <div class="flex justify-between items-center">
                            <div>
                                <div class="font-semibold">Anh Tuấn dzai</div>
                                <div class="text-sm text-gray-500">2024-10-19 23:57</div>
                            </div>
                            <div class="flex items-center space-x-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" viewBox="0 0 24 24"
                                    fill="currentColor">
                                    <path
                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                </svg>

                                <!-- Add more stars -->
                            </div>
                        </div>
                       
                        <div class="mt-2 flex space-x-2">
                            <img src="../img/cmt.png" alt="product image 1" class="h-20 w-20 object-cover">
                            <img src="../img/cmt2.png" alt="product image 2" class="h-20 w-20 object-cover">
                        </div>
                        <input type="text" class="mt-2 p-2 border border-gray-600 rounded-lg w-full">
                        <!-- <div class="mt-2 text-sm text-gray-500 flex items-center">
                            <img src="../img/user.png" alt="user avatar" class="h-8 w-8 rounded-full">
                            Chào bạn, cảm ơn bạn đã tin tưởng và sử dụng sản phẩm của Sứ Việt
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end binh luan -->

    <!-- Bai viet lien quan -->
    <div class="container-main px-[5%] lg:px-0">
        <div class="bai_post">
            <div class="tlt_news flex justify-between items-center">
                <h4 class="font-el font-extrabold text-[32px]">Bài viết liên quan</h4>
                <a href="" class="flex py-[13px] px-10 rounded-[50px] gap-2 mt-2 items-center justify-center">
                    <p class="text-black">Xem tất cả</p>
                    <svg class="" width="23" height="13" viewBox="0 0 23 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
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
    </div>

    <!-- End Bai viet lien quan -->
@endsection

<!-- them js cho trang -->


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Lấy tất cả các liên kết tab
        const tabLinks = document.querySelectorAll('.tab-link');
        const tabContents = document.querySelectorAll('.tab-content');

        tabLinks.forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault(); // Ngăn không cho trang tải lại

                // Xóa class "active" của tất cả các tab và ẩn tất cả nội dung
                tabLinks.forEach(item => {
                    item.classList.remove('text-blue-600', 'border-b-2',
                        'border-blue-600');
                    item.classList.add('text-gray-500');
                });

                tabContents.forEach(content => {
                    content.style.display = 'none';
                });

                // Thêm class "active" cho tab được click
                this.classList.add('text-blue-600', 'border-b-2', 'border-blue-600');
                this.classList.remove('text-gray-500');

                // Hiển thị nội dung tương ứng
                const tabId = this.getAttribute('data-tab');
                document.getElementById(tabId).style.display = 'block';
            });
        });
    });


    // Hàm thay đổi hình ảnh chính khi nhấn vào ảnh phụ
    function changeMainImage(imageSrc) {
        const mainImage = document.getElementById('main-image');
        mainImage.src = imageSrc;
    }

    // Hàm xử lý khi chọn màu sắc
    function selectColor(button) {
        // Loại bỏ tất cả các trạng thái chọn của các nút khác
        const buttons = document.querySelectorAll('#color-options button');
        buttons.forEach(btn => {
            btn.classList.remove('bg-blue-600', 'text-white');
            btn.classList.add('bg-gray-50', 'text-gray-600');
        });

        // Thêm trạng thái chọn cho nút được click
        button.classList.remove('bg-gray-50', 'text-gray-600');
        button.classList.add('bg-cmain', 'text-white');
    }

    // Hàm xử lý khi chọn kích thước
    function selectSize(button) {
        // Loại bỏ tất cả các trạng thái chọn của các nút khác
        const buttons = document.querySelectorAll('#size-options button');
        buttons.forEach(btn => {
            btn.classList.remove('bg-blue-600', 'text-white');
            btn.classList.add('bg-gray-50', 'text-gray-600');
        });

        // Thêm trạng thái chọn cho nút được click
        button.classList.remove('bg-gray-50', 'text-gray-600');
        button.classList.add('bg-cmain', 'text-white');
    }

    // Hàm tăng số lượng sản phẩm
    function increaseQuantity() {
        const quantityInput = document.getElementById('quantity');
        let quantity = parseInt(quantityInput.value);
        quantity++;
        quantityInput.value = quantity;
    }
    // Hàm giảm số lượng sản phẩm, không cho phép giảm dưới 1
    function decreaseQuantity() {
        const quantityInput = document.getElementById('quantity');
        let quantity = parseInt(quantityInput.value);
        if (quantity > 1) {
            quantity--;
            quantityInput.value = quantity;
        }
    }
</script>
