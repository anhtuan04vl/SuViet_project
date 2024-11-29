<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\User;
use App\Models\OrderItem;

class OrderAdminController extends Controller
{
    public function showlistorders()
    {
        $showlistorders = Order::with('status')->latest()->paginate(5); // Lấy danh sách đơn hàng kèm trạng thái, phân trang 10 đơn hàng mỗi trang
        $statuses = OrderStatus::all(); // Lấy tất cả trạng thái từ bảng order_statuses
        return view('admin.template.donhang', compact('showlistorders', 'statuses'));
    }
    public function showorderdetail($id)
    {
        // Lấy chi tiết đơn hàng với thông tin người dùng, trạng thái đơn hàng, và các sản phẩm trong đơn hàng
        $showorderdetail = Order::with(['user', 'status', 'orderItems.product']) // Lấy dữ liệu liên quan
                                ->findOrFail($id); // Lấy đơn hàng duy nhất
        // Nếu không tìm thấy đơn hàng, trả về lỗi hoặc trang khác
        if (!$showorderdetail) {
            return redirect()->route('admin.donhang')->with('error', 'Không tìm thấy đơn hàng.');
        }

        // Trả về view và truyền dữ liệu đơn hàng vào
        return view('admin.template.donhangchitietAdmin', compact('showorderdetail'));
    }

    // Cập nhật trạng thái đơn hang
    public function updateStatus(Request $request, $orderId)
    {
        // Tìm đơn hàng theo ID
        $order = Order::findOrFail($orderId);

        // Kiểm tra trạng thái hiện tại của đơn hàng, ví dụ trạng thái "đã giao" có order_status_id là 3
    if ($order->order_status_id == 4) { // 4 là trạng thái "đã giao"
        // Trả về thông báo lỗi nếu đơn hàng đã giao
        return response()->json([
            'status' => 'error',
            'message' => 'Không thể cập nhật trạng thái vì đơn hàng đã được giao.'
        ], 400); // Trả về mã lỗi 400
    }


        // Kiểm tra trạng thái mới có tồn tại không
        $status = OrderStatus::find($request->order_status_id);
        if (!$status) {
            // Lưu thông báo vào session flash
            session()->flash('alert', [
                'type' => 'warning',
                'title' => 'Cảnh báo!',
                'message' => 'Trạng thái không hợp lệ!'
            ]);
    
            // Trả về thông báo flash trong response JSON
            return response()->json([
                'alert' => session('alert'),
                'message' => 'Trạng thái không hợp lệ!'
            ], 400);
        }

        // Cập nhật trạng thái
        $order->order_status_id = $request->order_status_id;
        $order->updated_at = now(); // Cập nhật thời gian
        $order->save();

        // Lưu thông báo thành công vào session flash
        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Thành công!',
            'message' => 'Cập nhật trạng thái thành công!'
        ]);

        // Trả về thông báo flash trong response JSON
        return response()->json([
            'alert' => session('alert'),
            'message' => 'Cập nhật trạng thái thành công!'
        ]);
    }



    
}
