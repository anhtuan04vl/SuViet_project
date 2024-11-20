@extends('admin.master')

@section('title', 'Dashboard')

@section('content')
<div class="container mt-5">
        <h2 class="mb-4">Quản lý hóa đơn</h2>
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
                <!-- Dòng dữ liệu mẫu -->
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
                        @endif
                    </td>
                    <td>
                        <select class="form-select form-select-sm" onchange="updateStatus({{ $v->order_id }}, this)">
                            <option>Xử lý</option>
                            <option value="Đã giao hàng" {{ $v->status == 'Đã giao hàng' ? 'selected' : '' }}>Đã giao hàng</option>
                            <option value="Hủy bỏ" {{ $v->status == 'Hủy bỏ' ? 'selected' : '' }}>Hủy bỏ</option>
                            <option value="Chưa giải quyết" {{ $v->status == 'Chưa giải quyết' ? 'selected' : '' }}>Chưa giải quyết</option>
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

    <!-- <script>
        function updateStatus(orderId, selectElement) {
            const status = selectElement.value;  // Lấy giá trị chọn từ dropdown
            
            // Gửi yêu cầu AJAX đến server
            $.ajax({
            url: '/admin/donhang/update-status/' + orderId,  // Đảm bảo thêm 'admin' vào URL
            method: 'POST',
            data: {
            status: status,
            _token: $('meta[name="csrf-token"]').attr('content')  // Thêm CSRF token
        },
        success: function(response) {
            if (response.success) {
                alert(response.message);
            } else {
                alert(response.message);
                selectElement.value = selectElement.dataset.previousValue;
            }
        },
        error: function(xhr, status, error) {
            console.error("XHR:", xhr);
            console.error("Status:", status);
            console.error("Error:", error);
            alert('Đã xảy ra lỗi khi cập nhật trạng thái.');
            selectElement.value = selectElement.dataset.previousValue;
        }
        });

            
            // Lưu lại trạng thái trước đó để có thể phục hồi nếu có lỗi
            selectElement.dataset.previousValue = selectElement.value;
        }
    </script> -->


