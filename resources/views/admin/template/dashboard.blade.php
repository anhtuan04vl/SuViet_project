@extends('admin.master')

@section('title', 'Dashboard')

@section('content')
<!-- Sale & Revenue Start -->
<div class="container-fluid pt-4 px-4">
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="#"></a></li>
                    </ol>
                </nav>

                <!--  -->
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-layer-group fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Tổng danh mục</p>
                                <h6 class="mb-0">{{count($categoriess)}}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-boxes fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Tổng sản phẩm</p>
                                <h6 class="mb-0">{{count($listproductss)}}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-cash-register fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Tổng Doanh thu</p>
                                <h6 class="mb-0">{{ number_format($totalRevenue, 0, ',', '.') }} VND</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-truck fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Tổng đơn hàng</p>
                                <h6 class="mb-0">{{ $totalOrders }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sale & Revenue End -->

            <!-- Sales Chart Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">   
                    <!-- Biểu đồ đường -->
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-light text-center rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Doanh thu theo ngày</h6>
                            </div>
                            <canvas id="ordersChart" width="400" height="200"></canvas>
                        </div>
                    </div>
                    <!-- Biểu đồ tròn -->
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light text-center rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Doanh thu theo tuần</h6>
                            </div>
                            <canvas id="weeklyRevenueChart" width="400" height="200"></canvas>
                        </div>
                    </div>
                    <!-- don hang moi nhat -->
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light text-center rounded p-4 pb-0">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Đơn hàng mới nhất</h6>
                            </div>
                            <div class="table-responsive">
                            <table class="table text-start align-middle table-bordered table-hover mb-0">
                                <thead>
                                    <tr class="text-dark">
                                        <th scope="col">Mã số đơn</th>
                                        <th scope="col">Khách hàng</th>
                                        <th scope="col">Tổng tiền</th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col">Ngày đặt hàng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($donhangnew as $order)
                                        <tr>
                                            <td>{{ $order->order_id }}</td>
                                            <td>{{ $order->user->fullname }}</td>
                                            <td>{{ number_format($order->total, 0, ',', '.') }} VNĐ</td>
                                            <td>
                                            @if ($order->status->name == 'Chờ xác nhận')
                                                    <span class="badge bg-warning">{{ $order->status->name }}</span>
                                                @elseif ($order->status->name == 'Đã xác nhận')
                                                    <span class="badge bg-primary">{{ $order->status->name }}</span>
                                                @elseif ($order->status->name == 'Đang giao hàng')
                                                    <span class="badge bg-lam">{{ $order->status->name }}</span>
                                                @elseif ($order->status->name == 'Đã hủy')
                                                    <span class="badge bg-black">{{ $order->status->name }}</span>
                                                @elseif ($order->status->name == 'Đã giao hàng')
                                                    <span class="badge bg-danger">{{ $order->status->name }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $order->created_at->format('d/m/Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- Thêm phân trang dưới bảng -->
                            <div class="pagination d-flex justify-content-end mt-3">
                                {{ $donhangnew->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sales Chart End -->

            <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Sản phẩm mới</h6>
                            <a href=""><i class="fa fa-trash-alt text-primary"></i></a>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    <!-- <th scope="col"><input class="form-check-input" type="checkbox"></th> -->
                                    <th scope="col">Ngày Thêm</th>
                                    <th scope="col">STT</th>
                                    <th scope="col">Hình ảnh</th>
                                    <th scope="col">Tên Sản phẩm</th>
                                    <th scope="col">Danh mục</th>
                                    <th scope="col">Giá tiền</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Chỉnh sửa</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($sanphamnew as $product)
                                <tr class="text-center">
                                    <!-- <td><input class="form-check-input" type="checkbox"></td> -->
                                    <td>{{ $product->created_at->format('d/m/Y') }}</td>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><img src="{{ asset('img/images/' . $product->img) }}" alt="Product Image" class="product-image d-block mx-auto" style="width: 40%;"></td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>{{ number_format($product->price, 0, ',', '.') }}</td>
                                    <td>{{ $product->is_show ? 'Hiển thị' : 'Ẩn' }}</td>
                                    <td><a class="btn btn-sm w-100 btn-primary" href="{{ route('updateproduct', $product->product_id) }}">Cập nhật</a></td>
                                </tr>
                            @endforeach

                            </tbody>
                            
                        </table>
                        <!-- Thêm phân trang dưới bảng -->
                        <div class="pagination d-flex justify-content-end mt-3">
                                {{ $sanphamnew->links('pagination::bootstrap-4') }}
                            </div>
                    </div>
                </div>
            </div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const revenueData = @json($revenueByDate);

        const labels = revenueData.map(item => item.date);
        const data = revenueData.map(item => item.revenue);

        const ctx = document.getElementById('ordersChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Doanh thu',
                    data: data,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 2,
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Ngày'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Doanh thu (VND)'
                        }
                    }
                }
            }
        });

        // Biểu đồ tròn: Doanh thu theo tuần
const revenueByWeek = @json($revenueByWeek); // Dữ liệu doanh thu theo tuần

// Lấy nhãn cho các tuần (hiển thị Tuần X, Năm Y)
const weeklyLabels = revenueByWeek.map(item => `Tuần ${item.week}, Năm ${item.year}`);

// Lấy dữ liệu doanh thu của các tuần
const weeklyData = revenueByWeek.map(item => item.revenue);

// Vẽ biểu đồ tròn
const weeklyCtx = document.getElementById('weeklyRevenueChart').getContext('2d');
new Chart(weeklyCtx, {
    type: 'doughnut',
    data: {
        labels: weeklyLabels,
        datasets: [{
            label: 'Doanh thu (VND)',
            data: weeklyData,
            backgroundColor: [
                'rgba(255, 99, 132, 0.7)',
                'rgba(54, 162, 235, 0.7)',
                'rgba(255, 206, 86, 0.7)',
                'rgba(75, 192, 192, 0.7)',
                'rgba(153, 102, 255, 0.7)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { position: 'top' },
            tooltip: {
                callbacks: {
                    label: function (context) {
                        let value = context.raw || 0;
                        return `Doanh thu ${context.label}: ${new Intl.NumberFormat('vi-VN').format(value)} VND`;
                    }
                }
            }
        }
    }
});

    });


    
</script>
@endsection