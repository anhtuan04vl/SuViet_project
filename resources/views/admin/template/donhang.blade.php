@extends('admin.master')

@section('title', 'Dashboard')

@section('content')
<div class="container my-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Bảng điều khiển</a></li>
            <li class="breadcrumb-item"><a href="#">Đơn hàng</a></li>
            <!-- <li class="breadcrumb-item active" aria-current="page">Danh sách tài khoản</li> -->
        </ol>
    </nav>
    <button class="btn btn-danger mb-3"><i class="fa fa-trash-alt"></i> Xóa tất cả</button>
    
    <ul class="nav nav-pills mb-3 /px-2 flex space-x-2">
        <li>
            <a href="#" class="nav-link px-4 py-2 rounded-md bg-blue-500 text-white transition-all duration-300 ease-in-out active border-r border-black" onclick="setActive(this)">Tất cả (3)</a>
        </li>
        <li>
            <a href="#" class="nav-link px-4 py-2 rounded-md text-blue-500 hover:bg-blue-500 hover:text-white transition-all duration-300 ease-in-out border-r border-black" onclick="setActive(this)">Mới đặt (3)</a>
        </li>
        <li>
            <a href="#" class="nav-link px-4 py-2 rounded-md text-blue-500 hover:bg-blue-500 hover:text-white transition-all duration-300 ease-in-out border-r border-black" onclick="setActive(this)">Đã xác nhận (0)</a>
        </li>
        <li>
            <a href="#" class="nav-link px-4 py-2 rounded-md text-blue-500 hover:bg-blue-500 hover:text-white transition-all duration-300 ease-in-out border-r border-black" onclick="setActive(this)">Đang giao (0)</a>
        </li>
        <li>
            <a href="#" class="nav-link px-4 py-2 rounded-md text-blue-500 hover:bg-blue-500 hover:text-white transition-all duration-300 ease-in-out border-r border-black" onclick="setActive(this)">Đang chuyển (0)</a>
        </li>
        <li>
            <a href="#" class="nav-link px-4 py-2 rounded-md text-blue-500 hover:bg-blue-500 hover:text-white transition-all duration-300 ease-in-out border-r border-black" onclick="setActive(this)">Đã chuyển hoàn toàn (0)</a>
        </li>
        <li>
            <a href="#" class="nav-link px-4 py-2 rounded-md text-blue-500 hover:bg-blue-500 hover:text-white transition-all duration-300 ease-in-out border-r border-black" onclick="setActive(this)">Đã giao (0)</a>
        </li>
        <li>
            <a href="#" class="nav-link px-4 py-2 rounded-md text-blue-500 hover:bg-blue-500 hover:text-white transition-all duration-300 ease-in-out" onclick="setActive(this)">Đã hủy (0)</a>
        </li>
    </ul>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th><input class="form-check-input" type="checkbox"></th>
                    <th>STT</th>
                    <th>Thông tin khách hàng</th>
                    <th>Thông tin liên hệ</th>
                    <th>Thông tin sản phẩm</th>
                    <th>Phương thức thanh toán</th>
                    <th>Ngày đặt hàng</th>
                    <th>Tông tiền</th>
                    <th>Trạng thái</th>
                    <th>Tùy chỉnh</th>
                </tr>
            </thead>
            <tbody class="text-center ">
                <tr>
                    <td><input class="form-check-input" type="checkbox"></td>
                    <td>1</td>
                    <td>
                        <strong >Bùi Anh Tuấn</strong><br>
                        <span>241008N2UDI6</span><br>
                    </td>
                    <td>
                       <span>địa chỉ: Đông bắc Chương trình</span>
                    </td>
                    <td>
                       <span>Chén sứ cao cấp</span>
                    </td>
                    <td>Thanh toán trên website</td>
                    <td>03:10<br>08-10-2024</td>
                    <td class="text-red">$225,00</td>
                    <td>
                        <span class="status-badge just-ordered">Đã xác nhận</span><br>

                        <span class="status-badge unpaid">Đang giao hàng</span>
                    </td>
                    <td><i class="fas fa-ellipsis-v"></i></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection

<!-- // js trang -->
<script>
    function setActive(element) {
        // Lấy tất cả các phần tử có class 'nav-link'
        var links = document.querySelectorAll('.nav-link');
        
        // Xóa class 'active' của tất cả các phần tử
        links.forEach(link => link.classList.remove('bg-blue-500', 'text-white', 'active'));

        // Thêm class 'active' cho phần tử vừa được bấm
        element.classList.add('bg-blue-500', 'text-white', 'active');
    }
</script>