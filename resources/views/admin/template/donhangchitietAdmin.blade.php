@extends('admin.master')

@section('title', 'Dashboard')

@section('content')
<div class="container py-5">
    <h4 class="mb-3">Hóa đơn</h4>
    <div class="card">
       
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">HÓA ĐƠN</h5>
                <span class="badge bg-primary">{{ $showorderdetail->status->name }}</span>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-1"><strong>Ngày:</strong> {{ $showorderdetail->created_at }}</p>
                    <p class="mb-1"><strong>Số hóa đơn:</strong> {{ $showorderdetail->order_id }}</p>
                </div>
                <!-- <div class="col-md-6 text-end">
                    <p class="mb-1">59 Station Rd, Purls Bridge, Vương quốc Anh</p>
                    <p class="mb-1">kachabazar@gmail.com</p>
                </div> -->
            </div>
            <div class="row mt-3">
                <div class="col-md-6">
                    <p class="mb-1"><strong>Hóa đơn cho:</strong></p>
                    <p class="mb-1">{{ $showorderdetail->user->fullname }}</p>
                    <p class="mb-1">{{ $showorderdetail->user->email }}</p>
                    <p class="mb-1">271, Đông Bắc Tân Chánh Hiệp Quận 12, Hồ Chí Minh</p>
                </div>
            </div>
            <div class="table-responsive mt-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá sản phẩm</th>
                            <th>Tổng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($showorderdetail->OrderItems->isNotEmpty()) <!-- Kiểm tra nếu có sản phẩm -->
                            @foreach ($showorderdetail->OrderItems as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td> <!-- Số thứ tự -->
                                <td>{{ $item->product->name ?? 'Sản phẩm không tồn tại' }}</td> <!-- Tên sản phẩm -->
                                <td>{{ $item->quantity }}</td> <!-- Số lượng -->
                                <td>{{ number_format($item->price, 2) }} VND</td> <!-- Giá sản phẩm -->
                                <td class="text-danger">{{ number_format($item->quantity * $item->price, 2) }} VND</td> <!-- Tổng cộng -->
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center">Không có sản phẩm trong đơn hàng.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="row mt-3">
                <div class="col-md-6">
                    <p>
                        <strong>Phương thức thanh toán:</strong>
                        @if ($showorderdetail->payment_method_id == 2)
                        <span class="badge bg-success">Thanh toán khi nhận hàng</span>
                        @else
                        @if ($showorderdetail->payment_method_id == 1)
                        <span class="badge bg-primary">Thanh toán online</span>
                        @endif
                    @endif
                    </p>
                </div>
                <div class="col-md-6 text-end">
                    <p><strong>Chi phí vận chuyển: </strong>{{ number_format($showorderdetail->price_ship) }} VNĐ</p>
                    <p><strong>Giảm giá:</strong>None</p>
                    <p class="fs-5 text-danger"><strong>Tổng số tiền:</strong> {{ number_format($showorderdetail->total) }} VNĐ</p>
                </div>
            </div>
        </div>
        
    </div>
    <div class="mt-3 d-flex justify-content-between">
        <button class="btn btn-success">
            <i class="bi bi-cloud-download"></i> Tải xuống hóa đơn
        </button>
        <button class="btn btn-outline-secondary">
            <i class="bi bi-printer"></i> In hóa đơn
        </button>
    </div>
</div>
@endsection