@extends('admin.master')

@section('title', 'Dashboard')

@section('content')
<div class="container mt-5">
        <h2 class="mb-4">Quản lý hóa đơn</h2>

        @if (session('alert'))
        <script>
            const alert = @json(session('alert'));

            // Kiểm tra loại thông báo và hiển thị bằng SweetAlert2
            Swal.fire({
                icon: alert.type,  // success, error, warning, info, ...
                title: alert.title, // Tiêu đề thông báo
                text: alert.message, // Nội dung thông báo
                timer: 5000, // Tự động đóng sau 3 giây
                showConfirmButton: false // Ẩn nút xác nhận
            });
            console.log(Swal); 

        </script>
        @endif
        <table class="table table-bordered /table-hover text-center align-middle">
            <thead class="table-light">
                <tr>
                    <!-- <th>Số hóa đơn</th> -->
                    <th>Thời gian đặt hàng</th>
                    <th>Tên khách hàng</th>
                    <th>Phương Thức Thanh Toán</th>
                    <!-- <th>Số Tiền</th> -->
                    <th>Trạng thái</th>
                    <th>Hoạt động</th>
                    <th>Hóa đơn</th>
                </tr>
            </thead>
            <tbody >
                <!-- Dòng dữ liệu -->
                @foreach ($showlistorders as $v)
                <tr class="align-middle">
                    <!-- <td>{{ $v->order_id }}</td> -->
                    <td>{{ $v->order_date }}</td>
                    <td>@if ($v->user){{ $v->user->fullname }}@endif</td>
                    <td>
                    @if ($v->payment_method_id == 2)
                        <span class="badge bg-success">Thanh toán khi nhận hàng</span>
                    @else
                        @if ($v->payment_method_id == 1)
                        <span class="badge bg-secondary">Thanh toán online</span>
                        @endif
                    @endif
                    </td>
                    <!-- <td>{{ number_format($v->total, 0, ',', '.') }} VNĐ</td> -->
                    <td>
                        @if ($v->status->name == 'Chờ xác nhận')
                            <span class="badge bg-warning">{{ $v->status->name }}</span>
                        @elseif ($v->status->name == 'Đã xác nhận')
                            <span class="badge bg-primary">{{ $v->status->name }}</span>
                        @elseif ($v->status->name == 'Đang giao hàng')
                            <span class="badge bg-lam">{{ $v->status->name }}</span>
                        @elseif ($v->status->name == 'Đã hủy')
                            <span class="badge bg-danger">{{ $v->status->name }}</span>
                        @elseif ($v->status->name == 'Đã giao hàng')
                            <span class="badge bg-danger">{{ $v->status->name }}</span>
                        @endif
                    </td>
                    <!-- Dropdown cập nhật trạng thái -->
                    <td>
                        <select class="form-select form-select-sm" onchange="updateStatus({{ $v->order_id }}, this.value)">
                            <option value="">Chọn trạng thái</option>
                            @foreach ($statuses as $status)
                                <option value="{{ $status->order_status_id }}" 
                                        {{ $v->order_status_id == $status->order_status_id ? 'selected' : '' }}>
                                    {{ $status->name }}
                                </option>
                            @endforeach
                        </select>
                    </td>

                    <td class="d-flex gap-2 align-items-center">
                        <!-- <a class="btn btn-outline-secondary btn-sm"><i class="bi bi-printer"></i></a> -->
                        <a href="{{ route('admin.donhangchitiet', $v->order_id) }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-eye"></i></a>
                    </td>
                </tr>
                <!-- Thêm các dòng khác tương tự -->
                @endforeach
            </tbody>
        </table>

        <!-- Phân trang -->
        <!-- <nav>
            <ul class="pagination justify-content-end">
                <li class="page-item disabled"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">...</a></li>
                <li class="page-item"><a class="page-link" href="#">21</a></li>
            </ul>
        </nav> -->
    </div>
@endsection

<!-- // js trang -->
 <style>
    .bg-lam {
        background-color: #0066FF	;
    }
 </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   

    <script>
       function updateStatus(orderId, statusId) {
    if (!statusId) return;

    // Log ra URL để kiểm tra
    console.log(`/update-order-status/${orderId}`);

    fetch(`/admin/update-order-status/${orderId}`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify({ order_status_id: statusId }),
    })
    .then((response) => {
        if (!response.ok) throw new Error("Cập nhật thất bại");
        return response.json();
    })
    .then((data) => {
        session()->flash('alert', [
        'type' => 'success',
        'title' => 'Thành công!',
        'message' => 'Cập nhật trạng thái thành công!'
    ]);
    })
    .catch((error) => {
        console.error(error);
        alert("Có lỗi xảy ra khi cập nhật trạng thái.");
    });
}

    </script>
    


