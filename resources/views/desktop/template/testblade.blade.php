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