<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Support\Facades\Auth;


class UsersController extends Controller
{

    /**
     * Hiển thị thông tin chi tiết của một người dùng.
     *
     * @param int $users_id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function showUser($users_id)
    {
        // Lấy thông tin người dùng từ bảng `users`
        $userupdate = User::where('users_id',$users_id)->first();

        // Kiểm tra nếu không tìm thấy người dùng
        if (!$userupdate) {
            return redirect()->route('home')->with('error', 'Người dùng không tồn tại.');
        }
        // Kiểm tra nếu người dùng đăng nhập và không phải là người dùng đó
        // if (Auth::gruad('web')->id() !== $userupdate->users_id) {
        //     return redirect()->route('home')->with('error', 'Bạn không có quyền xem thông tin này.');
        // }
        // Trả về view với biến $user
        return view('desktop.template.account.userupdate',  compact('userupdate'));
    }
    /**
     * Update user information.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateUser(Request $request, $id)
    {
        // Validate incoming data
        $validatedData = $request->validate([
            'fullname' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users,email,' . $id . ',users_id',
            'password' => 'nullable|string|min:8',
            'profile_image' => 'nullable|file|mimes:jpg,jpeg,png|max:2048', // Chỉ cho phép ảnh
        ]);

        // Tìm User theo ID
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Chuẩn bị dữ liệu để cập nhật
        $updateData = [];
        if (!empty($validatedData['fullname']) && $validatedData['fullname'] !== $user->fullname) {
            $updateData['fullname'] = $validatedData['fullname'];
        }



        if (!empty($validatedData['email']) && $validatedData['email'] !== $user->email) {
            $updateData['email'] = $validatedData['email'];
        }

        if (!empty($validatedData['password'])) {
            $updateData['password'] = bcrypt($validatedData['password']);
        }

        // Xử lý ảnh nếu có upload
        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('img'), $imageName); // Lưu ảnh vào public/img
            $updateData['images'] = 'img/' . $imageName;

            // Xóa ảnh cũ nếu có
            if ($user->images && file_exists(public_path($user->images))) {
                unlink(public_path($user->images));
            }
        }

        // Cập nhật User
        if (!empty($updateData) && $user->update($updateData)) {
            return back()->with('success', 'Cập nhập thông tin thành công!');
        }

        return back()->with('error', 'No changes were made.');
    }

    public function showOrderDetail(Request $request)
    {
        $userId = Auth::id();
        $statuses = OrderStatus::all(); // Get list of statuses
        $order_status_id = $request->get('order_status_id', null);

        // Fix column name (assuming it's 'user_id', not 'users_id')
        $query = Order::where('users_id', $userId); // Adjust column name if necessary

        if ($order_status_id !== null) {
            $query->where('order_status_id', $order_status_id); // Only filter by status if it's not null
        }

        // Eager load relationships
        $orders = $query->with(['user', 'status', 'orderItems.product'])->get();

       /*  return response()->json([
            'statuses' => $statuses,
            'order_status_id' => $order_status_id,
            'orders' => $orders
        ]); */
        return view('desktop.template.account.orderupdate', compact('statuses', 'order_status_id', 'orders'));
    }



    public function filterOrders(Request $request)
    {

        $userId = Auth::id();
        $statuses = OrderStatus::all();
        $order_status_id = $request->get('order_status_id', null);
        $query = Order::where('users_id', $userId);

        // If an order status ID is provided, filter by status
        if ($order_status_id !== null) {
            $query->where('order_status_id', $order_status_id);
        }

        // Eager load relationships to avoid N+1 queries
        $orders = $query->with(['user', 'status', 'orderItems.product'])->get();

        return response()->json([
            'statuses' => $statuses,
            'order_status_id' => $order_status_id,
            'orders' => $orders
        ]);
    }






}
