<?php

namespace App\Http\Controllers;

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
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng.');
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




    public function destroy(Request $request, $cart_id)
    {
        $cartDetail = CartDetail::find($cart_id);

        if (!$cartDetail) {
            return response()->json(['message' => 'Giỏ hàng trống'], 404);
        }

        $cart = $cartDetail->cart;
        $cart->total_price -= $cartDetail->quantity * $cartDetail->price;
        $cart->save();
        $cartDetail->delete();

        return response()->json(['message' => 'Đã xóa sản phẩm ra khỏi giỏ hàng'], 200);
    }

    public function updateCartQuantity(Request $request)
    {
        $productId = $request->input('product_id');
        $change = $request->input('change');
        $userId = Auth::id();

        if (!$userId) {
            return response()->json(['success' => false, 'message' => 'Bạn cần đăng nhập để cập nhật giỏ hàng.']);
        }

        $cart = Cart::where('users_id', $userId)->first();
        if (!$cart) {
            return response()->json(['success' => false, 'message' => 'Giỏ hàng không tồn tại.']);
        }

        $cartDetail = CartDetail::where('cart_id', $cart->cart_id)
            ->where('product_id', $productId)
            ->first();

        if ($cartDetail) {
            $newQuantity = max(1, $cartDetail->quantity + $change); // Ensure quantity is at least 1
            $cartDetail->quantity = $newQuantity;
            $cartDetail->save();

            // Optionally update the cart's total price
            $cart->total_price = CartDetail::where('cart_id', $cart->cart_id)->sum(DB::raw('quantity * price'));
            $cart->save();

            return response()->json(['success' => true, 'new_quantity' => $newQuantity]);
        }

        return response()->json(['success' => false, 'message' => 'Sản phẩm không tồn tại trong giỏ hàng.']);
    }
}
