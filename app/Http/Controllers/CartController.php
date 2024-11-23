<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Cart;
use App\Models\CartDetail;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function cart()
    {
        return view('desktop.template.cart');
    }
    public function getCartItemCount($userId)
    {
        // Tìm giỏ hàng của người dùng
        $cart = Cart::where('users_id', $userId)->first();

        if (!$cart) {
            return 0; // Nếu không có giỏ hàng, trả về 0
        }

        // Tính tổng số lượng sản phẩm trong giỏ hàng
        return CartDetail::where('cart_id', $cart->cart_id)->sum('quantity');
    }

    // Show cart for a specific user by their user ID
    public function showCart($users_id)
    {
        $currentUserId = auth()->id();

        // Fetch the cart for the authenticated user
        $cart = Cart::with('details.product')->where('users_id', $currentUserId)->first();

        if (!$cart) {
            return view('desktop.template.cart', [
                'cart' => null,
                'message' => 'Giỏ hàng của bạn hiện đang trống.'
            ]);
        }

        return view('desktop.template.cart', [
            'cart' => $cart,
            'message' => null
        ]);
        // Fetch the cart for the user with the given ID
        $cart = Cart::with('details')->where('users_id', $users_id)->first();

        // Check if the cart exists
        if (!$cart) {
            // If the cart is empty, return the view with a message
            return view('desktop.template.cart', [
                'cart' => null, // Assign null to $cart
                'message' => 'Giỏ hàng trống' // Message for empty cart
            ]);
        }

        // If the cart has products, return the view with the cart data
        return view('desktop.template.cart', [
            'cart' => $cart, // Assign the cart to $cart
            'message' => null // No message to display
        ]);
        foreach ($cart->details as $detail) {
            $totalPrice += $detail->price * $detail->quantity;
        }
    }



    public function addToCart(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('loginUsers')->with('error', 'Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng.');
        }

        $userId = Auth::id();
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1); // Default to 1 if no quantity specified
        $price = $request->input('price');


        DB::beginTransaction();
        try {
            // Create or get the user's cart
            $cart = Cart::firstOrCreate(['users_id' => $userId], ['total_price' => 0]);

            // Find the cart detail for the given product in this user's cart
            $cartDetail = CartDetail::where('cart_id', $cart->cart_id)
                ->where('product_id', $productId)
                ->first();

            if ($cartDetail) {
                // If the product is already in the cart, update the quantity
                $cartDetail->quantity += $quantity;
                $cartDetail->save();
            } else {
                // Otherwise, add it as a new item
                $cartDetail = new CartDetail([
                    'cart_id' => $cart->cart_id,
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'price' => $price
                ]);
                $cartDetail->save();
            }

            // Update the cart's total price
            $cart->total_price += $quantity * $price;
            $cart->save();

            DB::commit();

            return redirect()->back()->with('success', 'Đã thêm sản phẩm vào giỏ hàng.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Lỗi: ' . $e->getMessage()]);
        }
    }

    // Update quantity
    public function updateQuantity(Request $request)
    {
        $productId = $request->product_id;
        $delta = $request->delta;

        // Lấy user hiện tại
        $userId = auth()->id();

        // Tìm giỏ hàng dựa trên users_id
        $cart = Cart::where('users_id', $userId)->first();

        if (!$cart) {
            return response()->json(['success' => false, 'message' => 'Giỏ hàng không tồn tại.']);
        }

        // Tìm sản phẩm trong giỏ hàng (bảng cart_details)
        $cartDetail = CartDetail::where('cart_id', $cart->cart_id)
            ->where('product_id', $productId)
            ->first();

        if (!$cartDetail) {
            return response()->json(['success' => false, 'message' => 'Sản phẩm không tồn tại trong giỏ hàng.']);
        }

        // Cập nhật số lượng sản phẩm
        $cartDetail->quantity += $delta;

        // Nếu số lượng < 1, không cho phép giảm thêm
        if ($cartDetail->quantity < 1) {
            return response()->json(['success' => false, 'message' => 'Số lượng không hợp lệ.']);
        }

        // Lưu thay đổi vào bảng cart_details
        $cartDetail->save();

        // Tính lại tổng giá trị giỏ hàng
        $cart->total_price = CartDetail::where('cart_id', $cart->cart_id)
            ->sum(\DB::raw('quantity * price'));
        $cart->save();

        return response()->json([
            'success' => true,
            'quantity' => $cartDetail->quantity,
            'total_price' => $cart->total_price,
        ]);
    }
    // Delete a single product
    public function removeProduct(Request $request)
    {
        $productId = $request->product_id;

        // Lấy user hiện tại
        $userId = auth()->id();

        // Tìm giỏ hàng của user
        $cart = Cart::where('users_id', $userId)->first();

        if (!$cart) {
            return response()->json(['success' => false, 'message' => 'Giỏ hàng không tồn tại.']);
        }

        // Tìm sản phẩm trong giỏ hàng (bảng cart_details)
        $cartDetail = CartDetail::where('cart_id', $cart->cart_id)
            ->where('product_id', $productId)
            ->first();

        if (!$cartDetail) {
            return response()->json(['success' => false, 'message' => 'Sản phẩm không tồn tại trong giỏ hàng.']);
        }

        // Xóa sản phẩm khỏi bảng cart_details
        $cartDetail->delete();

        // Tính lại tổng giá trị của giỏ hàng
        $cart->total_price = CartDetail::where('cart_id', $cart->cart_id)
            ->sum(\DB::raw('quantity * price'));
        $cart->save();

        return response()->json([
            'success' => true,
            'total_price' => $cart->total_price,
        ]);
    }
    // Clear all items
    public function clearCart()
    {
        Cart::where('users_id', auth()->id())->delete();

        return response()->json(['status' => 'success']);
    }
    public function applyCoupon(Request $request)
    {
        $total = $request->input('total');
        $coupon = Coupon::where('code', $request->input('coupon_code'))->first();
        // Lấy giỏ hàng từ session hoặc tạo mới nếu chưa có

        if (!$coupon) {
            return back()->with('error', 'Mã giảm giá không tồn tại');
        }

        if ($coupon->isExpired()) {
            return back()->with('error', 'Mã giảm giá đã hết hạn');
        }

        // Tính toán giảm giá
        if ($coupon->discount_percentage) {
            $discount = $total * ($coupon->discount_percentage / 100);
        } else {
            $discount = $coupon->discount_amount;
        }

        $discountedTotal = $total - $discount;
        // Lưu dữ liệu vào session
        session([
            'total' => $total,
            'discount' => $discount,
            'discountedTotal' => $discountedTotal,
            'couponCode' => $coupon->code
        ]);

        return redirect()->back()->with([
            'total' => $total,
            'discount' => $discount,
            'discountedTotal' => $discountedTotal,
            'couponCode' => $coupon->code
        ]);
    }
}