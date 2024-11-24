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
        $statuses = OrderStatus::all(); // Lấy danh sách trạng thái
        $statusId = $request->get('order_status_id', null);

        // Truy vấn các đơn hàng theo trạng thái
        $orders = Order::query()
            ->where('users_id', auth()->id())
            ->when($statusId, function ($query) use ($statusId) {
                return $query->where('order_status_id', $statusId);
            })
            ->with(['user', 'status', 'orderItems.product'])
            ->get();

        return view('desktop.template.account.orderupdate', compact('statuses', 'statusId', 'orders'));
    }


    public function filterByStatus($statusId)
    {
        $userId = auth()->id();

        // Kiểm tra xem user đã đăng nhập chưa
        if (!$userId) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Lọc đơn hàng theo userId và statusId
        $orders = Order::where('users_id', $userId)
                    ->where('order_status_id', $statusId)
                    ->with(['user', 'status', 'orderItems.product'])
                    ->get();

        if ($orders->isEmpty()) {
            return response()->json(['message' => 'Không có đơn hàng nào cho trạng thái này.'], 200);
        }

        return response()->json(['orders' => $orders], 200);
    }


}
