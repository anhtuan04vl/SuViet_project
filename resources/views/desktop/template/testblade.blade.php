<div class="swiper InforSwiper">
    <div class="swiper-wrapper">
        <div class="swiper-slide">
            <div class="exp_right w-full 800:w-[50%] flex-none 800:flex">
                <div class="sli_right">
                    <img src="../img/lysu.png" alt="" class="rounded-[20px] w-full">
                    <div class="ct flex gap-2 items-center mt-4 w-full">
                        <p class="text-cmain font-el font-semibold text-[36px]">Ly Sứ</p>
                        <p class="text-cmain3">Ly sứ dưỡng sinh 0.48 L (K2) + nắp ống hút 
                            - Đại dương</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="swiper-pagination"></div>
</div>


// public function payment_vnpay(Request $request)
    // {
    //     // Mã website tại VNPAY
    //     $vnp_TmnCode = "9VI6E3TE";  // Mã website của bạn từ VNPAY
        
    //     // Các tham số khác
    //     $vnp_SecureHash = $request->input('vnp_SecureHash');
    //     $vnp_TxnRef = $request->input('vnp_TxnRef');
    //     $vnp_Amount = $request->input('vnp_Amount');
    //     $vnp_ResponseCode = $request->input('vnp_ResponseCode');
    //     $vnp_OrderInfo = $request->input('vnp_OrderInfo');
        
        
    //     $vnp_HashSecret = "CBLGET7R2AGD94YN58XGB227VD481VI0"; // Chuỗi bí mật của bạn
        
    //     $inputData = $request->except('vnp_SecureHash'); // Tất cả tham số trả về ngoại trừ vnp_SecureHash

    //     // Tạo lại chuỗi hash từ các tham số trả về
    //     ksort($inputData);
    //     $hashdata = "";
    //     foreach ($inputData as $key => $value) {
    //         $hashdata .= urlencode($key) . "=" . urlencode($value) . "&";
    //     }
    //     $hashdata = rtrim($hashdata, "&");

    //     // Tính toán hash và kiểm tra với hash trả về từ VNPAY
    //     $vnpSecureHashCompare = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
        
    //     if ($vnp_SecureHash === $vnpSecureHashCompare && $vnp_ResponseCode == '00') {
    //         // Thanh toán thành công
    //         // Lưu đơn hàng vào cơ sở dữ liệu và thực hiện các hành động cần thiết (ví dụ: cập nhật trạng thái đơn hàng)
            
    //         // Lấy thông tin đơn hàng từ database
    //         $order = Order::find($vnp_TxnRef);
    //         if ($order) {
    //             // Cập nhật trạng thái đơn hàng (ví dụ: thành công)
    //             $order->status = 'paid';
    //             $order->save();
                
    //             // Sau khi thanh toán thành công, xóa giỏ hàng
    //             session()->forget('cart'); // Xóa giỏ hàng khỏi session

    //             // Thông báo người dùng
    //             session()->flash('alert', [
    //                 'type' => 'success',
    //                 'title' => 'Thanh toán thành công!',
    //                 'message' => 'Giỏ hàng của bạn đã được thanh toán và trống!'
    //             ]);
    //         }
    //     } else {
    //         // Thanh toán thất bại, xử lý lỗi
    //         // Có thể cập nhật trạng thái đơn hàng thành "failed"
    //         $order = Order::find($vnp_TxnRef);
    //         if ($order) {
    //             $order->status = 'failed';
    //             $order->save();
    //         }

    //         // Thông báo người dùng thanh toán thất bại
    //         session()->flash('alert', [
    //             'type' => 'danger',
    //             'title' => 'Thanh toán thất bại!',
    //             'message' => 'Có lỗi xảy ra trong quá trình thanh toán.'
    //         ]);
    //     }

    //     // Quay lại trang chủ hoặc trang khác
    //     return redirect()->route('home');
    // }


    http://127.0.0.1:8000/?vnp_Amount=2000000&vnp_BankCode=NCB&vnp_BankTranNo=VNP14696533&vnp_CardType=ATM&vnp_OrderInfo=Thanh+to%C3%A1n+%C4%91%C6%A1n+h%C3%A0ng&vnp_PayDate=20241125154901&vnp_ResponseCode=00&vnp_TmnCode=9VI6E3TE&vnp_TransactionNo=14696533&vnp_TransactionStatus=00&vnp_TxnRef=32&vnp_SecureHash=58479f07452e9ccc0dff5031d9da20c330997939ddb8307eb5c2fdb2b9b0ef740174110db76a659710027c2c4a0deb0299a0747c2a0c8d75dfb07972664972da



    <div class="bg-white shadow-md rounded-b-md p-6">
                <div class="flex items-center space-x-4">
                    <div class="text-5xl font-bold">5.0</div>
                    <div class="flex items-center space-x-1">
                        <!-- Star Ratings -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" viewBox="0 0 24 24"
                            fill="currentColor">
                            <path
                                d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                        </svg>
                        <!-- Repeat the star icon for 5 stars -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" viewBox="0 0 24 24"
                            fill="currentColor">
                            <path
                                d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" viewBox="0 0 24 24"
                            fill="currentColor">
                            <path
                                d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" viewBox="0 0 24 24"
                            fill="currentColor">
                            <path
                                d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" viewBox="0 0 24 24"
                            fill="currentColor">
                            <path
                                d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                        </svg>
                        <!-- More stars as needed -->
                    </div>
                    <span class="text-gray-500">(1k đánh giá)</span>
                </div>

                <!-- Star Rating Breakdown -->
                <div class="mt-4">
                    <div class="space-y-2">
                        <!-- Star Rows -->
                        <div class="flex items-center">
                            <span class="w-12 text-sm">5 sao</span>
                            <div class="flex-grow h-3 bg-gray-200 rounded-full ml-2">
                                <div class="h-3 bg-blue-600 rounded-full w-[99%]"></div>
                            </div>
                            <span class="ml-2 text-sm">990</span>
                        </div>
                        <div class="flex items-center">
                            <span class="w-12 text-sm">4 sao</span>
                            <div class="flex-grow h-3 bg-gray-200 rounded-full ml-2">
                                <div class="h-3 bg-gray-400 rounded-full w-[1%]"></div>
                            </div>
                            <span class="ml-2 text-sm">8</span>
                        </div>
                        <div class="flex items-center">
                            <span class="w-12 text-sm">3 sao</span>
                            <div class="flex-grow h-3 bg-gray-200 rounded-full ml-2">
                                <div class="h-3 bg-gray-400 rounded-full w-[0.5%]"></div>
                            </div>
                            <span class="ml-2 text-sm">2</span>
                        </div>
                        <div class="flex items-center">
                            <span class="w-12 text-sm">2 sao</span>
                            <div class="flex-grow h-3 bg-gray-200 rounded-full ml-2">
                                <div class="h-3 bg-gray-400 rounded-full w-[0%]"></div>
                            </div>
                            <span class="ml-2 text-sm">0</span>
                        </div>
                        <div class="flex items-center">
                            <span class="w-12 text-sm">1 sao</span>
                            <div class="flex-grow h-3 bg-gray-200 rounded-full ml-2">
                                <div class="h-3 bg-gray-400 rounded-full w-[0%]"></div>
                            </div>
                            <span class="ml-2 text-sm">0</span>
                        </div>
                    </div>
                </div>

                <!-- Sorting Options -->
                <div class="flex justify-start items-center mt-4">
                    <span class="text-sm text-gray-600 mr-4">Lọc theo:</span>
                    <div class="space-x-2">
                        <button class="border rounded-full px-3 py-1 text-sm bg-blue-600 text-white">Tất cả</button>
                        <button class="border rounded-full px-3 py-1 text-sm">5 sao (990)</button>
                        <button class="border rounded-full px-3 py-1 text-sm">4 sao (8)</button>
                        <button class="border rounded-full px-3 py-1 text-sm">3 sao (2)</button>
                        <button class="border rounded-full px-3 py-1 text-sm">2 sao (0)</button>
                        <button class="border rounded-full px-3 py-1 text-sm">1 sao (0)</button>
                    </div>
                </div>
            </div>











            <div class="swiper CateSwiper">
                <div class="swiper-wrapper">
                    @foreach ($categories as $sp)
                    <div class="swiper-slide">
                        <div class="dm1 swipers-slide flex flex-col justify-center items-center gap-3">
                            <a href="{{ route('listcate', ['name' => $sp->name]) }}" class="cursor-pointer rounded-full  bg-white /w-[12.5%] flex  justify-center">
                                <img src="{{ asset('img/images/' . $sp->images) }}" alt=""
                                    class="w-[100px] px-[19px] py-3">
                            </a>
                            <p>{{ $sp->name }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="swiper-scrollbar"></div>
            </div>



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






    <!-- product page demo -->

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