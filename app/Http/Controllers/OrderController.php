<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
use App\Models\User;
use App\Models\Contact;
use App\Models\PaymentMethod;
use App\Models\OrderItem;
use App\Models\CartDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Notification;  // Model Notification (nếu bạn có tạo bảng lưu thông báo)


use Alert;  // Thêm dòng này vào đầu controller
class OrderController extends Controller
{
    public $orderResult;
    public function showOrder($users_id)
    {
        $users_id = auth()->id();
        // Lấy thông tin giỏ hàng của người dùng
        $cart = Cart::where('users_id', $users_id)->first();
    
        // Kiểm tra nếu giỏ hàng không tồn tại
        if (!$cart || $cart->total_price == 0) {
            session()->flash('alert', [
                'type' => 'warning',
                'title' => 'Cảnh báo!',
                'message' => 'Giỏ hàng của bạn trống!'
            ]);
            return redirect()->route('home'); // Điều hướng về trang chủ hoặc trang khác
        }
    
        // Lấy thông tin chi tiết của giỏ hàng
        $cartDetails = CartDetail::where('cart_id', $cart->cart_id)
            ->with('product') // Giả sử bạn có mối quan hệ với Product model
            ->get();
    
        // Tính tổng giá
        $totalPrice = $cartDetails->sum(function ($detail) {
            return $detail->price * $detail->quantity;
        });
    
        // Tạo dữ liệu để hiển thị ở view
        return view('desktop.template.order', compact('cart', 'cartDetails', 'totalPrice'));
    }
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
    
            $userId = Auth::id();
            $contactId = $request->input('contact_id');
            $paymentMethodId = $request->input('payment_method_id');
    
            \Log::info('Payment method ID from request: ', [$paymentMethodId]);
    
            // Kiểm tra nếu payment_method_id hợp lệ
            $paymentMethod = PaymentMethod::find($paymentMethodId);
            if (!$paymentMethod) {
                throw new \Exception('Payment method not found.');
            }
    
            $couponId = $request->input('coupon_id');
            $orderStatusId = 1; // Ví dụ: 1 là trạng thái "đang chờ"
            $orderDate = now();
    
            // Tính tổng tiền và phí vận chuyển
            $total = $request->input('total') ?? Cart::where('users_id', $userId)->first()->total_price ?? 0;
            $priceShip = 40000;
    
            // Nếu không có contact_id, tạo mới contact
            if (is_null($contactId)) {
                $newContact = Contact::create([
                    'users_id' => $userId,
                    'phone' => $request->input('phone'),
                    'email' => $request->input('email'),
                    'address' => $request->input('address'),
                    'district' => $request->input('district'),
                    'city' => $request->input('city'),
                    'is_default' => true,
                ]);
    
                $contactId = $newContact->contact_id; // Gán lại contact_id sau khi tạo
            }
    
            // Tạo đơn hàng
            $order = Order::create([
                'users_id' => $userId,
                'contact_id' => $contactId,
                'payment_method_id' => $paymentMethodId,
                'coupon_id' => $couponId,
                'total' => $total + $priceShip, // Tính tổng bao gồm cả phí ship
                'is_payment_status' => false,
                'price_ship' => $priceShip,
                'order_date' => $orderDate,
                'order_status_id' => $orderStatusId,
            ]);

            //dd($order);
            
            // Kiểm tra nếu đơn hàng không được tạo thành công
            if (!$order || !$order->order_id) {
                throw new \Exception('Order could not be created.');
            }
    
            // Thêm sản phẩm vào `order_items`
            $cartItems = CartDetail::where('cart_id', Cart::where('users_id', $userId)->value('cart_id'))->get();
    
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->order_id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'sale' => $item->sale ?? 0,
                ]);
            }
    
            //Xóa giỏ hàng sau khi đặt hàng thành công
            Cart::where('users_id', $userId)
                ->where('total_price', '>', 0) // Thay điều kiện nếu cần
                ->delete();
                DB::commit();

                

            //kiem tra pt thanh toan
            $this->orderResult = $order;
            if($order->payment_method_id ==1)
            {
                return  $this->payment_vnpay();
            }else{
                session()->flash('alert', [
                    'type' => 'success',
                    'title' => 'Đơn hàng đã đặt thành công!',
                    'message' => 'Cám ơn bạn đã đặt hàng!'
                ]);
                return redirect()->route('home');
            }

            
        } catch (\Exception $e) {
            DB::rollBack();
    
            session()->flash('alert', [
                'type' => 'danger',
                'title' => 'Lỗi!',
                'message' => 'Đặt hàng thất bại. Lỗi: ' . $e->getMessage()
            ]);
            return redirect()->route('home');
        }
    }


    public function payment_vnpay()
    {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('vnpay.return');
        $vnp_TmnCode = "9VI6E3TE";//Mã website tại VNPAY 
        $vnp_HashSecret = "CBLGET7R2AGD94YN58XGB227VD481VI0"; //Chuỗi bí mật

        $vnp_TxnRef = $this->orderResult->order_id; // Mã đơn hàng; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY $_POST['order_id']
        $vnp_OrderInfo = 'Thanh toán đơn hàng';
        $vnp_OrderType = 'Bill Payment';
        $vnp_Amount = $this->orderResult->total * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
            
        );
        
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }
        
        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        
        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);
            header('Location: ' . $vnp_Url);
                die();
            // if (isset($_POST['redirect'])) {
            //     header('Location: ' . $vnp_Url);
            //     die();
            // } else {
            //     echo json_encode($returnData);
            // }
            // vui lòng tham khảo thêm tại code demo
    }

    public function vnpayReturn(Request $request)
    {
        $inputData = $request->all();

        $vnp_HashSecret = "CBLGET7R2AGD94YN58XGB227VD481VI0"; // Chuỗi bí mật
        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHash']);
        unset($inputData['vnp_SecureHashType']);
        ksort($inputData);
        $hashData = "";
        foreach ($inputData as $key => $value) {
            $hashData .= urlencode($key) . '=' . urlencode($value) . '&';
        }
        $hashData = rtrim($hashData, '&');

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        if ($secureHash == $vnp_SecureHash) {
            if ($inputData['vnp_ResponseCode'] == '00') {

                $order = Order::find($_GET['vnp_TxnRef']);
                $order->is_payment_status = 1;
                $order->save();

                session()->flash('alert', [
                    'type' => 'success',
                    'title' => 'Thanh toán qua VNPay thành công!',
                    'message' => 'Cám ơn bạn đã đặt hàng!'
                ]);
                return redirect()->route('home');
            } else {
                session()->flash('alert', [
                    'type' => 'error',
                    'title' => 'Thanh toán thất bại!',
                    'message' => 'Giao dịch không thành công. Vui lòng thử lại.'
                ]);
                return redirect()->route('home');
            }
        } else {
            session()->flash('alert', [
                'type' => 'error',
                'title' => 'Lỗi bảo mật!',
                'message' => 'Dữ liệu trả về không hợp lệ.'
            ]);
            return redirect()->route('home');
        }
    }
        

    //thong ke
    public function statistics()
    {
        $totalOrders = Order::count(); // Tổng số đơn hàng
        $totalRevenue = Order::sum('total'); // Tổng doanh thu
        $ordersByStatus = Order::select('status', DB::raw('count(*) as count'))
                                ->groupBy('status')
                                ->get(); // Đơn hàng theo trạng thái
        $ordersByMonth = Order::select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as count'))
                                ->groupBy('month')
                                ->get(); // Đơn hàng theo tháng
    
        return view('admin.template.dashboard', compact('totalOrders', 'totalRevenue', 'ordersByStatus', 'ordersByMonth'));
    }
    

  

}
