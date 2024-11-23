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
use Alert;  // Thêm dòng này vào đầu controller
class OrderController extends Controller
{
    public function showOrder($users_id)
    {
        $users_id = auth()->id();
        // Lấy thông tin giỏ hàng của người dùng
        $cart = Cart::where('users_id', $users_id)->first();

        // Kiểm tra nếu giỏ hàng không tồn tại
        if (!$cart) {
            session()->flash('alert', [
                'type' => 'warning',
                'title' => 'Cảnh báo!',
                'message' => 'Giỏ hàng của bản trống!'
            ]);
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
        if (!PaymentMethod::where('payment_method_id', $paymentMethodId)->exists()) {
            throw new \Exception('Invalid payment method ID.');
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

        // Ghi nhận thông tin đơn hàng
        \Log::info('Order data: ', $order->toArray());

        // Kiểm tra nếu đơn hàng không được tạo thành công
        if (!$order || !$order->order_id) {
            throw new \Exception('Order could not be created. Check if all required fields are provided.');
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

        // Xóa giỏ hàng sau khi đặt hàng thành công
        Cart::where('users_id', $userId)
        ->where('total_price', '>', 0) // Thay điều kiện nếu cần (vd: == 0 hoặc >= 100000)
        ->delete();

        DB::commit();

        // return response()->json([
        //     'success' => true,
        //     'message' => 'Order placed successfully',
        //     'order_id' => $order->order_id,
        // ]);
        session()->flash('alert', [
           'type' => 'success',
            'title' => 'Đơn hàng đã đặt thành công!',
            'message' => 'Cám ơn bạn đã đặt hàng!'
            
        ]);
        return redirect()->route('home');
    } catch (\Exception $e) {
        DB::rollBack();

        return response()->json([
            'success' => false,
            'message' => 'Failed to place order',
            'error' => $e->getMessage(),
        ], 500);
    }
}




}
