@extends('desktop.master')

@section('content')
<!-- BREADCRUMD -->
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
                <a href="#" class="text-gray-700 hover:text-gray-900">Giỏ hàng</a>
            </li>
            <li></li>
                <span class="flex w-1 h-1 bg-cmain rounded-full "></span>
            </li>
            <li>
                <a href="#" class="text-gray-700 hover:text-gray-900">Thanh toán</a>
            </li>
        </ol>
    </nav>
</div>
<!-- END BREADCRUMD -->

<!-- THANH TOAN -->
<div class="container-main pb-10 px-[5%] lg:px-0">
    <div class="flex flex-wrap lg:flex-nowrap justify-between gap-5 p-0 lg:p-6">
        <!-- Thong tin chi tiet Form -->
        <div class="w-full lg:w-1/2 bg-white p-6 border rounded-lg">
            <h2 class="text-2xl 800:text-[28px] text-cmain font-el font-semibold mb-6">Thông tin thanh toán</h2>
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Họ & Tên*</label>
                <input type="text" class="mt-1 block w-full px-2 py-3 border-gray-300 rounded-md shadow-sm" placeholder="Nhập họ & tên" />
            </div>
        
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Email*</label>
                <input type="email" class="mt-1 block w-full px-2 py-3 border-gray-300 rounded-md shadow-sm" placeholder="name@gmail.com" />
            </div>
    
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Tỉnh/Thành phố*</label>
                <select class="mt-1 block w-full px-2 py-3 border-gray-300 rounded-md shadow-sm">
                <option>--Tỉnh/Thành phố--</option>
                <option>Hồ Chí Minh</option>
                <option>Hà Nội</option>
                <option>Hạ Long</option>
                <option>Đà Nẵng</option>
                <!-- Add other countries here -->
                </select>
            </div>
    
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Quận/Huyện*</label>
                <select class="mt-1 block w-full px-2 py-3 border-gray-300 rounded-md shadow-sm">
                <option>--Quận/Huyện--</option>
                <option>Hà Nội</option>
                <option>Hạ Long</option>
                <option>Đà Nẵng</option>
                <!-- Add other countries here -->
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Địa chỉ*</label>
                <input type="text" class="mt-1 block w-full px-2 py-3 border-gray-300 rounded-md shadow-sm" placeholder="Đường/số nhà.." />
            </div>
        
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Số điện thoại*</label>
                <div class="flex">
                <span class="inline-flex items-center px-2 py-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">+84</span>
                <input type="text" class="mt-1 block w-full px-2 py-3 border-gray-300 rounded-r-md shadow-sm" placeholder="123-456-7890" />
                </div>
            </div>
            
            <!-- <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Ghi chu don hang</label>
                <textarea class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm w-full /h-[120px]"></textarea>
            </div> -->

            <!-- phuong thuc thanh toan -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Phương thức thanh toán*</label>
                <div class="flex flex-wrap lg:flex-nowrap gap-3 justify-between">
                    <!-- the tin dung -->
                    <a href="" class="pay flex">
                        <input type="radio" name="payment" id="credit-card" checked class="mr-2">
                        <div class="flex flex-col">
                            <!-- <input type="radio" name="payment" id="credit-card" checked class="mr-2"> -->
                            <label for="credit-card" class="text-gray-800 font-medium">Thẻ tín dụng</label>
                            <p class="text-gray-600 text-sm">Thanh toán bằng thẻ tín dụng</p>
                        </div>
                    </a>
                    <!-- end the tin dung -->
                    <!-- khi nhan hang -->
                    <div class="meet flex cursor-pointer">
                        <input type="radio" name="payment" id="payment-on-delivery" class="mr-2">
                        <div class="flex flex-col">
                            <!-- <input type="radio" name="payment" id="payment-on-delivery" class="mr-2"> -->
                            <label for="payment-on-delivery" class="text-gray-800 font-medium">Thanh toán khi nhận hàng</label>
                            <p class="text-gray-600 text-sm">Hãy hỗ trợ shipper bằng cách tips cho họ</p>
                        </div>
                    </div>
                    <!-- end khi nhan hang -->
                </div>
            </div>
            <hr class="py-2">
            <!-- phuong thuc giao hang -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Phương thức giao hàng*</label>
                <div class="flex flex-wrap lg:flex-nowrap gap-3 justify-between">
                    <!-- the tin dung -->
                    <a href="" class="pay flex">
                        <input type="radio" name="delivery" id="delivery-now" checked class="mr-2">
                        <div class="flex flex-col">
                            <!-- <input type="radio" name="payment" id="credit-card" checked class="mr-2"> -->
                            <label for="credit-card" class="text-gray-800 font-medium">Giao hàng hỏa tốc</label>
                            <p class="text-gray-600 text-sm">Áp dụng nội thành - Nhận trong ngày</p>
                        </div>
                    </a>
                    <!-- end the tin dung -->
                    <!-- khi nhan hang -->
                    <div class="meet flex cursor-pointer">
                        <input type="radio" name="delivery" id="delivery-save-money" class="mr-2">
                        <div class="flex flex-col">
                            <!-- <input type="radio" name="payment" id="payment-on-delivery" class="mr-2"> -->
                            <label for="payment-on-delivery" class="text-gray-800 font-medium">Giao hàng tiết kiệm</label>
                            <p class="text-gray-600 text-sm">Nội thành 1 đến 2 ngày. Tỉnh 3 đến 4 ngày</p>
                        </div>
                    </div>
                    <!-- end khi nhan hang -->
                    <!--  -->
                </div>
            </div>
            <button class="w-full bg-cmain text-white py-2 rounded-lg mt-4">Cập nhật thông tin</button>
        </div>
        <!-- end thong tin -->

    
        <!-- đơn hàng   -->
        <div class="w-full lg:w-1/2 bg-white p-0 lg:p-6  rounded-lg">

            <h2 class="text-xl font-semibold mb-6">Đơn hàng của bạn</h2>
            
            <div class="mb-2 flex justify-between">
                <span class="text-sm text-gray-600">Thông tin sản phẩm</span>
                <span class="text-sm text-gray-800">Tạm tính:</span>
            </div>

            <div class="mb-2 flex justify-between">
                <span class="text-sm text-gray-600 ">Chén cơm 11.2 cm - Jasmine Ly's - Trắng Ngà</span>
                <span class="text-sm text-gray-800">1.760.000 VNĐ</span>
            </div>
    
            <div class="mb-2 flex justify-between">
                <span class="text-sm text-gray-600">Tạm tính</span>
                <span class="text-sm text-gray-800">1.760.000 VNĐ</span>
            </div>

            <div class="mb-2 flex justify-between">
                <span class="text-sm text-gray-600">Đã giảm giá</span>
                <span class="text-sm text-green-600">0 VNĐ</span>
            </div>
    
            <div class="mb-2 flex justify-between">
                <span class="text-sm text-gray-600">Phương thức giao hàng</span>
                <span class="text-sm text-gray-800">Giao hàng tiết kiệm</span>
            </div>

            <div class="mb-2 flex justify-between">
                <span class="text-sm text-gray-600">Giao hàng</span>
                <span class="text-sm text-gray-800">Miễn phí vận chuyển</span>
            </div>
        
            <div class="border-t border-gray-300 my-4"></div>
        
            <div class="mb-6 flex justify-between">
                <span class="text-lg font-semibold text-gray-800">Tổng thanh toán:</span>
                <span class="text-lg font-semibold text-gray-800">1.760.000 VNĐ</span>
            </div>
        
            <button class="w-full bg-cmain text-white py-2 rounded-lg">Thanh Toán</button>
    
            <p class="text-sm text-gray-600 mt-4">Nhấn "Đặt hàng" đồng nghĩa với việc bạn đồng ý tuân theo <a href="#" class="text-blue-600">Điều khoản Sứ Việt.</a></p>
        </div>
        <!-- end đơn hàng -->
    </div>
</div>
<!-- END THANH TOAN -->

@endsection