@extends('desktop.master')

@section('content')
<!-- breadcrumb -->
<div class="container-main py-5 px-[5%] lg:px-0">
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="/inline-flex flex gap-2 items-center space-x-1">
            <li class="inline-flex items-center">
                <a href="#" class="text-teal-500 hover:text-teal-700">Trang chủ</a>
            </li>
            <li>
                <span class="flex w-1 h-1 bg-cmain rounded-full "></span>
            </li>
            <li>
                <a href="#" class="text-gray-700 hover:text-gray-900">Tài khoản</a>
            </li>
            <li>
                <span class="flex w-1 h-1 bg-cmain rounded-full "></span>
            </li>
            <li>
                <a href="" class="text-gray-700 hover:text-gray-900">Đơn mua</a>
            </li>
        </ol>
    </nav>
</div>
<!-- end breadcrumb -->

<div class="container-main px-[5%] lg:px-0 ">
    <div class="flex  justify-between gap-5 py-10">
        <!-- Thanh bên trái -->
        <div class="w-1/4 bg-white p-4 shadow-md rounded-lg">
            <div class="flex items-center mb-6">
                <img src="../img/user.png" alt="">
                <div class="ml-4">
                    <h2 class="text-lg font-semibold">{{ auth()->user()->fullname }}</h2>
                    <a href="{{ route('update.showUser', ['users_id' => Auth::user()->users_id]) }}" class="text-blue-500 text-sm hover:underline">Sửa Hồ Sơ</a>
                </div>
            </div>
            <ul class="flex flex-col gap-5">
                <li><a href="#" class="flex items-center text-gray-700 hover:text-blue-500"><span class="mr-2">🔥</span>Ưu Đãi Dành Riêng Cho Bạn</a></li>
                <li><a href="#" class="flex items-center text-gray-700 hover:text-blue-500"><span class="mr-2">🎉</span>11.11 Sale Khủng Nhất Năm</a></li>
                <li><a href="#" class="flex items-center text-gray-700 hover:text-blue-500"><span class="mr-2">👤</span>Tài Khoản Của Tôi</a></li>
                <li><a href="{{ route('update.showoderdetail') }}" class="flex items-center text-red-500 font-semibold"><span class="mr-2">📦</span>Đơn Mua</a></li>
                <li><a href="#" class="flex items-center text-gray-700 hover:text-blue-500"><span class="mr-2">🔔</span>Thông Báo</a></li>
                <li><a href="#" class="flex items-center text-gray-700 hover:text-blue-500"><span class="mr-2">🎟️</span>Kho Voucher</a></li>
            </ul>
        </div>

        <!-- Khu vực chính -->
        <div class="w-3/4 bg-white p-6 ml-6 shadow-md rounded-lg hidden">
            <!-- Thanh điều hướng tab -->
            <div class="border-b border-gray-200">
                <nav class="flex space-x-4">
                    <a href="#" class="text-gray-700 px-3 py-2 hover:text-blue-500">Tất cả</a>
                    <a href="#" class="text-gray-700 px-3 py-2 hover:text-blue-500">Chờ thanh toán</a>
                    <a href="#" class="text-gray-700 px-3 py-2 hover:text-blue-500">Vận chuyển</a>
                    <a href="#" class="text-gray-700 px-3 py-2 hover:text-blue-500">Chờ giao hàng</a>
                    <a href="#" class="text-gray-700 px-3 py-2 hover:text-blue-500">Hoàn thành</a>
                    <a href="#" class="text-gray-700 px-3 py-2 hover:text-blue-500">Đã hủy</a>
                    <a href="#" class="text-red-500 font-semibold px-3 py-2 border-b-2 border-red-500">Trả hàng/Hoàn tiền</a>
                </nav>
            </div>

            <!-- Nội dung chính -->
            <div class="flex flex-col items-center justify-center h-64">
                <img src="https://img.icons8.com/color/96/clipboard.png" alt="No orders" class="mb-4">
                <p class="text-gray-600 text-lg">Bạn hiện không có yêu cầu Trả hàng/Hoàn tiền nào</p>
            </div>


        </div>

        <!-- Khu vực hiển thị tài khoản -->
        <div class="w-3/4 bg-white p-6 ml-6 shadow-md rounded-lg ">
            <!-- Tiêu đề -->
            <h2 class="text-2xl font-semibold mb-6 text-center">Thông tin tài khoản</h2>

            <!-- Hiển thị thông tin tài khoản -->
            <form action="{{ route('update.updateUser', ['users_id' => Auth::user()->users_id]) }}" method="POST" enctype="multipart/form-data" class="space-y-6">

                @csrf
                @method('PUT') <!-- Nếu là cập nhật, nên dùng PUT hoặc PATCH -->

                <!-- Hình ảnh tài khoản -->
                <div class="flex flex-col items-center mb-6">
                    <img
                        src="{{ Auth::user()->images ? asset(Auth::user()->images) : '../img/user.png' }}"
                        alt="User profile picture"
                        class="w-32 h-32 rounded-full mb-4 shadow-md"
                        id="profile-image"
                    >
                    <p class="text-gray-600 text-sm">Ảnh đại diện của bạn</p>
                    <input
                        type="file"
                        name="profile_image"
                        accept="image/*"
                        class="mt-2 p-2 border border-gray-300 rounded-lg cursor-pointer"
                        onchange="previewImage(event)"
                    >
                </div>

                <!-- Tên người dùng -->
                <div>
                    <label for="fullname" class="block text-gray-700 font-medium">Họ và tên</label>
                    <input
                        type="text"
                        id="fullname"
                        name="fullname"
                        class="mt-1 p-2 border border-gray-300 rounded-lg w-full focus:ring-blue-500 focus:border-blue-500"
                        value="{{ Auth::user()->fullname }}"
                        required
                    >
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-gray-700 font-medium">Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="mt-1 p-2 border border-gray-300 rounded-lg w-full focus:ring-blue-500 focus:border-blue-500"
                        value="{{ Auth::user()->email }}"
                        required
                    >
                </div>

                <!--Đổi  Mật khẩu -->
                <div>
                    <label for="password" class="block text-gray-700 font-medium">Mật khẩu mới</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="mt-1 p-2 border border-gray-300 rounded-lg w-full focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Nhập mật khẩu mới nếu muốn thay đổi"
                    >
                    <small class="text-gray-500">Để trống nếu không muốn thay đổi mật khẩu.</small>
                </div>


                <!-- Nút để cập nhật thông tin tài khoản -->
                <button
                    type="submit"
                    class="inline-block bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                >
                    Cập nhật thông tin
                </button>
            </form>


            <!-- Script xem trước hình ảnh -->
            <script>
                function previewImage(event) {
                    const reader = new FileReader();
                    reader.onload = function () {
                        const output = document.getElementById('profile-image');
                        output.src = reader.result;
                    };
                    reader.readAsDataURL(event.target.files[0]);
                }
            </script>


            <!-- Script xem trước hình ảnh -->
            <script>
                function previewImage(event) {
                    const reader = new FileReader();
                    reader.onload = function () {
                        const output = document.getElementById('profile-image');
                        output.src = reader.result;
                    };
                    reader.readAsDataURL(event.target.files[0]);
                }
            </script>

        </div>
        <!-- end -->
    </div>
</div>

@endsection
