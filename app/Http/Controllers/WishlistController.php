<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    // Hiển thị trang wishlist
    public function index()
    {
        // Lỗi người dùng
        $userId = auth()->id();

        // Kiểm tra nếu người dùng đã đăng nhập
        if (!$userId) {
            return redirect()->route('loginUsers')->with('error', 'Bạn cần đăng nhập để xem danh sách yêu thích.');
        }

        // Lấy danh sách sản phẩm từ wishlist của người dùng
        $wishlistItems = Wishlist::where('user_id', $userId)
            ->with('product')  // Đảm bảo quan hệ được định nghĩa đúng
            ->get();


        return view('desktop.template.wishlist', compact('wishlistItems'));
    }

    // Thêm sản phẩm vào danh sách yêu thích
    public function store(Request $request)
    {
        // Xử lý thêm sản phẩm vào wishlist
        $productId = $request->input('product_id');
        $userId = auth()->id();  // Lấy ID của người dùng đã đăng nhập

        // Kiểm tra xem sản phẩm đã có trong wishlist chưa
        $existingWishlist = Wishlist::where('user_id', $userId)->where('product_id', $productId)->first();
        if ($existingWishlist) {
            return redirect()->back()->with('error', 'Sản phẩm đã tồn tại trong danh sách yêu thích.');
        }

        // Thêm sản phẩm vào wishlist
        Wishlist::create([
            'user_id' => $userId,
            'product_id' => $productId
        ]);

        return redirect()->back()->with('success', 'Đã thêm sản phẩm vào Wishlist.');
    }

    // Xóa sản phẩm khỏi danh sách yêu thích
    public function removeProduct(Request $request)
    {
        // Kiểm tra sản phẩm có tồn tại hay không
        $productId = $request->product_id;
        $userId = auth()->id();

        // Xác thực rằng product_id là hợp lệ
        $request->validate([
            'product_id' => 'required|exists:products,id', // Điều kiện product_id phải tồn tại
        ]);

        // Kiểm tra nếu sản phẩm không tồn tại trong wishlist của người dùng
        $wishlistItem = Wishlist::where('user_id', $userId)->where('product_id', $productId)->first();

        if (!$wishlistItem) {
            // Nếu không tìm thấy, trả về lỗi 422 (Không thể xử lý)
            return response()->json(['error' => 'Sản phẩm không có trong danh sách yêu thích.'], 422);
        }

        // Nếu có, xóa sản phẩm khỏi wishlist
        $wishlistItem->delete();

        // Trả về thông báo thành công
        return response()->json(['success' => true, 'message' => 'Sản phẩm đã được xóa khỏi danh sách yêu thích.']);
    }
}