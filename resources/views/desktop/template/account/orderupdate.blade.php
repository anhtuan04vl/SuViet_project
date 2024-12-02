@extends('desktop.master')

@section('content')
<div class="container-main px-[5%] lg:px-0">
    <div class="flex justify-between gap-5 py-10">
        <!-- Thanh bên trái -->
        <div class="w-1/4 bg-white p-4 shadow-md rounded-lg">
            <div class="flex items-center mb-6">
                <img src="{{ Auth::user()->images ? asset(Auth::user()->images) : '../img/user.png' }}" alt="User profile picture"
                class="w-20 h-20 rounded-full mb-4 shadow-md"
                id="profile-image">
                <div class="ml-4">
                    <h2 class="text-lg font-semibold">{{ auth()->user()->fullname }}</h2>
                    <a href="{{ route('update.showUser', ['users_id' => Auth::user()->users_id]) }}" class="text-blue-500 text-sm hover:underline">Sửa Hồ Sơ</a>
                </div>
            </div>
            <ul class="flex flex-col gap-5">
                <li><a href="#" class="flex items-center text-gray-700 hover:text-blue-500"><span class="mr-2">🔥</span>Ưu Đãi Dành Riêng Cho Bạn</a></li>
                <li><a href="#" class="flex items-center text-gray-700 hover:text-blue-500"><span class="mr-2">🎉</span>11.11 Sale Khủng Nhất Năm</a></li>
                <li><a href="#" class="flex items-center text-gray-700 hover:text-blue-500"><span class="mr-2">👤</span>Tài Khoản Của Tôi</a></li>
                <li><a href="{{ route('update.showoderdetail') }}" class="flex items-center text-red-500 font-semibold"><span class="mr-2">📦</span>Đơn Mua</a></li>
                <li><a href="#" class="flex items-center text-gray-700 hover:text-blue-500"><span class="mr-2">🔔</span>Thông Báo</a></li>
                <li><a href="#" class="flex items-center text-gray-700 hover:text-blue-500"><span class="mr-2">🎟️</span>Kho Voucher</a></li>
            </ul>
        </div>

        <!-- Khu vực chính -->
        <div class="w-3/4 bg-white p-6 shadow-md rounded-lg">
            <!-- Thanh điều hướng trạng thái -->
            <select id="status-select" class="py-2 px-4 border rounded w-full max-w-sm">
                <option value="" disabled {{ request('order_status_id') == '' ? 'selected' : '' }}>Chọn trạng thái</option>
                @foreach ($statuses as $status)
                    <option value="{{ $status->id }}" {{ request('order_status_id') == $status->id ? 'selected' : '' }}>
                        {{ $status->name }}
                    </option>
                @endforeach
            </select>



            <!-- Nội dung danh sách đơn hàng -->
            <div id="order-list" class="mt-6">
                <p class="text-center text-gray-500">Đang tải dữ liệu...</p>
            </div>
            <div class="flex justify-center items-center gap-4 mt-8">
                {{ $orders->links() }}
            </div>

        </div>
    </div>
</div>

<script>
    const apiUrl = "{{ route('filter.orders') }}";
    const initialStatusId = "{{ request('order_status_id') }}";  // Lấy giá trị order_status_id từ query string

    // Hàm lấy dữ liệu từ API và hiển thị vào HTML
    async function fetchOrderData(order_status_id = '') {
        try {
            const url = order_status_id ? `${apiUrl}?order_status_id=${order_status_id}` : apiUrl;
            const response = await fetch(url);

            if (!response.ok) throw new Error('Failed to fetch data');

            const data = await response.json();

            // Gọi hàm để hiển thị các trạng thái đơn hàng
            renderStatusOptions(data.statuses || [], order_status_id);

            // Hiển thị đơn hàng
            renderOrders(data.orders || []);
        } catch (error) {
            console.error('Error fetching data:', error);
            document.getElementById('order-list').innerHTML = '<p class="text-center text-red-500">Lỗi tải dữ liệu. Vui lòng thử lại.</p>';
        }
    }

    // Hàm hiển thị các trạng thái đơn hàng
    function renderStatusOptions(statuses, selectedStatus) {
        const statusSelect = document.getElementById('status-select');
        statusSelect.innerHTML = '<option value="" disabled {{ request('order_status_id') == '' ? 'selected' : '' }}>Chọn trạng thái</option>';  // Reset dropdown

        statuses.forEach(status => {
            const option = document.createElement('option');
            option.value = status.order_status_id;
            option.textContent = status.name;

            // Đảm bảo trạng thái đã chọn được giữ lại
            if (status.order_status_id == selectedStatus) {
                option.selected = true;
            }

            statusSelect.appendChild(option);
        });
    }

    // Hàm hiển thị danh sách đơn hàng
    function renderOrders(orders) {
        const orderListContainer = document.getElementById('order-list');
        orderListContainer.innerHTML = ''; // Xóa danh sách cũ trước khi hiển thị

        if (orders && Array.isArray(orders) && orders.length > 0) {
            orders.forEach(order => {
                const orderDiv = document.createElement('div');
                orderDiv.classList.add('flex', 'items-center', 'gap-x-5', 'mb-5');

                // Hình ảnh sản phẩm (nếu có) hoặc ảnh mặc định
                const image = document.createElement('img');
                image.src = '/img/Logo.png'; // Thay bằng ảnh mặc định (nếu cần hiển thị)
                image.alt = 'Product Image';
                image.classList.add('w-20', 'h-20', 'object-cover', 'rounded-md');
                orderDiv.appendChild(image);

                // Thông tin đơn hàng
                const orderInfo = document.createElement('div');

                const orderId = document.createElement('p');
                orderId.textContent = `Mã đơn hàng: #${order.order_id}`;
                orderId.classList.add('font-semibold');
                orderInfo.appendChild(orderId);

                const userName = document.createElement('p');
                userName.textContent = `Người đặt: ${order.user?.fullname || 'N/A'}`;
                userName.classList.add('text-gray-600');
                orderInfo.appendChild(userName);

                const total = document.createElement('p');
                total.textContent = `Tổng tiền: ${new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(order.total)}`;
                total.classList.add('text-gray-600');
                orderInfo.appendChild(total);

                const statusName = document.createElement('p');
                statusName.textContent = `Trạng thái: ${order.status?.name || 'Chưa xác định'}`;
                statusName.classList.add('text-gray-600');
                orderInfo.appendChild(statusName);

                orderDiv.appendChild(orderInfo);

                // Thêm phần tử đơn hàng vào container
                orderListContainer.appendChild(orderDiv);
            });
        } else {
            const noOrdersElement = document.createElement('p');
            noOrdersElement.textContent = 'Không có đơn hàng nào.';
            noOrdersElement.classList.add('text-center', 'text-gray-500');
            orderListContainer.appendChild(noOrdersElement);
        }
    }

    // Lắng nghe sự kiện thay đổi trạng thái
    document.getElementById('status-select').addEventListener('change', (event) => {
        fetchOrderData(event.target.value);  // Gửi yêu cầu với order_status_id
    });

    // Tải dữ liệu ban đầu, với trạng thái đã chọn nếu có
    fetchOrderData(initialStatusId);
</script>
@endsection
