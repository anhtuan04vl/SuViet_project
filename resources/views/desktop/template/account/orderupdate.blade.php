@extends('desktop.master')

@section('content')
<div class="container-main px-[5%] lg:px-0">
    <div class="flex justify-between gap-5 py-10">
        <!-- Thanh bên trái -->
        <div class="w-1/4 bg-white p-4 shadow-md rounded-lg">
            <div class="flex items-center mb-6">
                <img src="{{ asset('img/user.png') }}" alt="User Avatar" class="w-12 h-12 rounded-full">
                <div class="ml-4">
                    <h2 class="text-lg font-semibold">{{ auth()->user()->fullname }}</h2>
                    <a href="{{ route('update.showUser', ['users_id' => Auth::user()->users_id]) }}" class="text-blue-500 text-sm hover:underline">Sửa Hồ Sơ</a>
                </div>
            </div>
            <ul class="flex flex-col gap-5">
                <li><a href="#" class="flex items-center text-red-500 font-semibold"><span class="mr-2">📦</span>Đơn Mua</a></li>
            </ul>
        </div>

        <!-- Khu vực chính -->
        <div class="w-3/4 bg-white p-6 shadow-md rounded-lg">
            <!-- Thanh điều hướng trạng thái -->
            <select id="status-select" class="py-2 px-4 border rounded">
                <option value="" disabled {{ is_null($statusId) ? 'selected' : '' }}>Chọn trạng thái</option>
                @foreach ($statuses as $status)
                    <option value="{{ $status->id }}"
                        {{ $status->id == ($statusId ?? null) ? 'selected' : '' }}>
                        {{ $status->name }}
                    </option>
                @endforeach
            </select>



            <!-- Nội dung danh sách đơn hàng -->
            <div id="order-list">
                @forelse ($orders as $order)
                    <div class="flex items-center gap-x-5 mb-5">
                        <img src="/img/Logo.png" alt="Product Image" class="w-20 h-20 object-cover rounded-md">
                        <div>
                            <p class="font-semibold">Mã đơn hàng: #{{ $order->id }}</p>
                            <p class="text-gray-600">Người đặt: {{ $order->user->fullname ?? 'N/A' }}</p>
                            <p class="text-gray-600">Tổng tiền: {{ number_format($order->total, 0, ',', '.') }}₫</p>
                            <p class="text-gray-600">Trạng thái: {{ $order->status->name ?? 'Chưa xác định' }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-600">Không có đơn hàng nào cho trạng thái này.</p>
                @endforelse
            </div>

        </div>
    </div>
</div>
@endsection

<script>
document.addEventListener('DOMContentLoaded', function () {
    const statusSelect = document.getElementById('status-select');

    // Lắng nghe sự kiện thay đổi trên select
    statusSelect.addEventListener('change', function () {
        const statusId = this.value;  // Lấy giá trị statusId từ option đã chọn

        // Kiểm tra xem người dùng có chọn trạng thái hay không
        if (!statusId) {
            alert("Vui lòng chọn trạng thái để lọc.");
            return;  // Không làm gì nếu không có giá trị hợp lệ
        }

        // Gọi API để lọc đơn hàng theo statusId đã chọn
        fetch(`/orders/filter/${statusId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Không thể tải danh sách đơn hàng.');
            }
            return response.json();
        })
        .then(data => {
            const orderList = document.getElementById('order-list');
            orderList.innerHTML = ''; // Xóa nội dung cũ

            if (data.orders.length === 0) {
                orderList.innerHTML = '<p class="text-gray-600">Không có đơn hàng nào cho trạng thái này.</p>';
            } else {
                data.orders.forEach(order => {
                    const orderHtml = `
                        <div class="flex items-center gap-x-5 mb-5">
                            <img src="/img/Logo.png" alt="Product Image" class="w-20 h-20 object-cover rounded-md">
                            <div>
                                <p class="font-semibold">Mã đơn hàng: #${order.id}</p>
                                <p class="text-gray-600">Người đặt: ${order.user ? order.user.fullname : 'N/A'}</p>
                                <p class="text-gray-600">Tổng tiền: ${new Intl.NumberFormat('vi-VN').format(order.total)}₫</p>
                                <p class="text-gray-600">Trạng thái: ${order.status ? order.status.name : 'Chưa xác định'}</p>
                            </div>
                        </div>
                    `;
                    orderList.innerHTML += orderHtml;
                });
            }
        })
        .catch(error => {
            console.error('Lỗi:', error.message);
            alert(`Không thể tải danh sách đơn hàng. Lỗi: ${error.message}`);
        });
    });
});


</script>
