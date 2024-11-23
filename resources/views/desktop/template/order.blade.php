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
                <a href="{{ route('show_cart', ['users_id' => Auth::id()]) }}" class="text-gray-700 hover:text-gray-900">Giỏ hàng</a>
            </li>
            <li>
                <span class="flex w-1 h-1 bg-cmain rounded-full "></span>
            </li>
            <li>
                <a href="#" class="text-gray-700 hover:text-gray-900">Thanh toán</a>
            </li>
        </ol>
    </nav>
</div>
<!-- end breadcrumb -->

    <!-- THANH TOAN -->
    <div class="container-main pb-10 px-[5%] lg:px-0">
        <form action="{{ route('order.add') }}" method="POST">
            @csrf <!-- Include CSRF token for security -->

            <!-- Hidden inputs for contact_id, coupon_id, and total -->
            <input type="hidden" name="contact_id" value="{{ $contactId ?? '' }}" />
            <input type="hidden" name="coupon_id" value="{{ $couponId ?? '' }}" />
            <input type="hidden" name="total" value="{{ $totalPrice ?? 0 }}" />

            <!-- Thông tin thanh toán -->
            <div class="flex flex-wrap lg:flex-nowrap justify-between gap-5 p-0 lg:p-6">
                <div class="w-full lg:w-1/2 bg-white p-6 border rounded-lg">
                    <h2 class="text-2xl 800:text-[28px] text-cmain font-el font-semibold mb-6">Thông tin thanh toán</h2>

                    <!-- Full Name -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Họ & Tên*</label>
                        <input type="text" name="fullname" class="mt-1 block w-full px-2 py-3 border-gray-300 rounded-md shadow-sm"
                               placeholder="Nhập họ và tên của bạn" required />
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Email*</label>
                        <input type="email" name="email" class="mt-1 block w-full px-2 py-3 border-gray-300 rounded-md shadow-sm"
                               placeholder="Nhập địa chỉ email của bạn" required />
                    </div>

                    <!-- City -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Tỉnh/Thành phố*</label>
                        <select name="city" class="mt-1 block w-full px-2 py-3 border-gray-300 rounded-md shadow-sm" required>
                            <option value="">--Tỉnh/Thành phố--</option>
                            <option value="Hà Nội">Hà Nội</option>
                            <option value="Hồ Chí Minh">Hồ Chí Minh</option>
                            <option value="Đà Nẵng">Đà Nẵng</option>
                            <option value="Cần Thơ">Cần Thơ</option>
                            <option value="Hải Phòng">Hải Phòng</option>
                            <option value="Hạ Long">Hạ Long</option>
                            <option value="Bà Rịa-Vũng Tàu">Bà Rịa-Vũng Tàu</option>
                            <option value="Bắc Giang">Bắc Giang</option>
                            <option value="Bắc Kạn">Bắc Kạn</option>
                            <option value="Bạc Liêu">Bạc Liêu</option>
                            <option value="Bắc Ninh">Bắc Ninh</option>
                            <option value="Bến Tre">Bến Tre</option>
                            <option value="Bình Dương">Bình Dương</option>
                            <option value="Bình Phước">Bình Phước</option>
                            <option value="Bình Thuận">Bình Thuận</option>
                            <option value="Cao Bằng">Cao Bằng</option>
                            <option value="Cà Mau">Cà Mau</option>
                            <option value="Đắk Lắk">Đắk Lắk</option>
                            <option value="Đắk Nông">Đắk Nông</option>
                            <option value="Điện Biên">Điện Biên</option>
                            <option value="Đồng Nai">Đồng Nai</option>
                            <option value="Đồng Tháp">Đồng Tháp</option>
                            <option value="Gia Lai">Gia Lai</option>
                            <option value="Hà Giang">Hà Giang</option>
                            <option value="Hà Nam">Hà Nam</option>
                            <option value="Hải Dương">Hải Dương</option>
                            <option value="Hòa Bình">Hòa Bình</option>
                            <option value="Hưng Yên">Hưng Yên</option>
                            <option value="Khánh Hòa">Khánh Hòa</option>
                            <option value="Kiên Giang">Kiên Giang</option>
                            <option value="Kon Tum">Kon Tum</option>
                            <option value="Lai Châu">Lai Châu</option>
                            <option value="Lâm Đồng">Lâm Đồng</option>
                            <option value="Lạng Sơn">Lạng Sơn</option>
                            <option value="Lào Cai">Lào Cai</option>
                            <option value="Long An">Long An</option>
                            <option value="Nam Định">Nam Định</option>
                            <option value="Nghệ An">Nghệ An</option>
                            <option value="Ninh Bình">Ninh Bình</option>
                            <option value="Ninh Thuận">Ninh Thuận</option>
                            <option value="Phú Thọ">Phú Thọ</option>
                            <option value="Phú Yên">Phú Yên</option>
                            <option value="Quảng Bình">Quảng Bình</option>
                            <option value="Quảng Nam">Quảng Nam</option>
                            <option value="Quảng Ngãi">Quảng Ngãi</option>
                            <option value="Quảng Ninh">Quảng Ninh</option>
                            <option value="Quảng Trị">Quảng Trị</option>
                            <option value="Sóc Trăng">Sóc Trăng</option>
                            <option value="Sơn La">Sơn La</option>
                            <option value="Tây Ninh">Tây Ninh</option>
                            <option value="Thái Bình">Thái Bình</option>
                            <option value="Thái Nguyên">Thái Nguyên</option>
                            <option value="Thanh Hóa">Thanh Hóa</option>
                            <option value="Thừa Thiên-Huế">Thừa Thiên-Huế</option>
                            <option value="Tiền Giang">Tiền Giang</option>
                            <option value="Trà Vinh">Trà Vinh</option>
                            <option value="Tuyên Quang">Tuyên Quang</option>
                            <option value="Vĩnh Long">Vĩnh Long</option>
                            <option value="Vĩnh Phúc">Vĩnh Phúc</option>
                            <option value="Yên Bái">Yên Bái</option>
                        </select>
                    </div>


                    <!-- District -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Quận/Huyện*</label>
                        <input type="text" name="district" class="mt-1 block w-full px-2 py-3 border-gray-300 rounded-md shadow-sm"
                               placeholder="Nhập quận/huyện của bạn" required />
                    </div>

                    <!-- Address -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Địa chỉ*</label>
                        <input type="text" name="address" class="mt-1 block w-full px-2 py-3 border-gray-300 rounded-md shadow-sm"
                               placeholder="Đường/số nhà.." required />
                    </div>

                    <!-- Phone Number -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Số điện thoại*</label>
                        <div class="flex">
                            <span class="inline-flex items-center px-2 py-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">+84</span>
                            <input type="text" name="phone" class="mt-1 block w-full px-2 py-3 border-gray-300 rounded-r-md shadow-sm"
                                   placeholder="Nhập số điện thoại của bạn" required />
                        </div>
                    </div>

                     <!-- Payment Method -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Phương thức thanh toán*</label>
                        <div class="flex flex-wrap lg:flex-nowrap gap-3 justify-between">
                            <label class="pay flex cursor-pointer">
                                <input type="radio" name="payment_method_id" value="1" class="mr-2" required>
                                <button class="text-gray-800 font-medium">VN Pay</button>
                            </label>
                            <label class="meet flex cursor-pointer">
                                <input type="radio" name="payment_method_id" value="2" class="mr-2">
                                <button class="text-gray-800 font-medium">Thanh toán khi nhận hàng</button>
                            </label>
                        </div>
                    </div>

                    <!-- Delivery Method -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Phương thức giao hàng*</label>
                        <div class="flex flex-wrap lg:flex-nowrap gap-3 justify-between">
                            <label class="pay flex cursor-pointer">
                                <input type="radio" name="delivery_method" value="1" class="mr-2" required>
                                <span class="text-gray-800 font-medium">Giao hàng hỏa tốc</span>
                            </label>
                            <label class="meet flex cursor-pointer">
                                <input type="radio" name="delivery_method" value="2" class="mr-2">
                                <span class="text-gray-800 font-medium">Giao hàng tiết kiệm</span>
                            </label>
                        </div>
                    </div>

                     <button type="submit" class="w-full bg-cmain text-white py-2 rounded-lg mt-4">Cập nhật thông tin</button>
                </div>
                
                <!-- Order Summary -->
                <div class="w-full lg:w-1/2 bg-white p-0 lg:p-6 rounded-lg">
                    <h2 class="text-xl font-semibold mb-6">Đơn hàng của bạn</h2>
                    <div class="mb-2 flex justify-between">
                        <span class="text-sm text-gray-600">Thông tin sản phẩm</span>
                        <span class="text-sm text-gray-800">Tạm tính:</span>
                    </div>
                    @foreach ($cartDetails as $detail)
                        <div class="mb-2 flex justify-between">
                            <span class="text-sm text-gray-600">{{ $detail->product->name }} * {{ $detail->quantity }}</span>
                            <span class="text-sm text-gray-800">{{ number_format($detail->price, 0, ',', '.') }} VNĐ</span>
                        </div>
                    @endforeach
                    <div class="mb-2 flex justify-between">
                        <span class="text-sm text-gray-600">Tạm tính</span>
                        <span class="text-sm text-gray-800">{{ number_format($totalPrice, 0, ',', '.') }} VNĐ</span>
                    </div>
                    <div class="mb-2 flex justify-between">
                        <span class="text-sm text-gray-600">Đã giảm giá</span>
                        <span class="text-sm text-green-600" id="discount"></span>
                    </div>

                    <div class="mb-2 flex justify-between">
                        <span class="text-sm text-gray-600">Phương thức giao hàng</span>
                        <span class="text-sm text-gray-800">Giao hàng tiết kiệm</span>
                    </div>

                    <div class="mb-2 flex justify-between">
                        <span class="text-sm text-gray-600">Phí giao hàng</span>
                        <span class="text-sm text-gray-800">40.000 VNĐ</span>
                    </div>

                    <div class="border-t border-gray-300 my-4"></div>

                    <div class="mb-6 flex justify-between">
                        <span class="text-lg font-semibold text-gray-800">Tổng thanh toán:</span>
                        <!-- <span class="text-lg font-semibold text-gray-800">{{ number_format($totalPrice + 40000, 0, ',', '.') }} VNĐ</span> -->
                        <span class="text-lg font-semibold text-gray-800" id="discountedTotal"></span>
                    </div>

                    <button type="submit" name="cod" class="w-full bg-cmain text-white py-2 rounded-lg">Thanh Toán</button>
                    <hr>
                    <button type="submit" name="vn_pay" class="w-full bg-cmain text-white py-2 rounded-lg">Thanh Toán qua VN Pay</button>
                </div>
            </div>
        </form>
        
    </div>
    <!-- END THANH TOAN -->

    <script>
        function formatNumber(number) {
            return new Intl.NumberFormat('en-US', { style: 'decimal', minimumFractionDigits: 0 }).format(number);
        }
        let price = JSON.parse(localStorage.getItem('DISCOUNT'));
        let discountedTotal = Math.floor(JSON.parse(localStorage.getItem('DISCOUNT')).discountedTotal);
        console.log(discountedTotal);
        document.getElementById('discount').textContent = `${formatNumber(price.discount)} VNĐ`;
        document.getElementById('discountedTotal').textContent = `${formatNumber(discountedTotal+40000)} VNĐ`;

    </script>
@endsection
