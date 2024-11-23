@extends('admin.master')

@section('title', 'Dashboard')


 
@section('content')

<div class="container mt-4">
    <h4>Products</h4>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <button class="btn btn-outline-secondary btn-sm me-2">Xuất Excel</button>
            <!-- <button class="btn btn-outline-secondary btn-sm">Import</button> -->
        </div>
        <div>
            <button class="btn btn-danger btn-sm me-2">Xóa sản phẩm</button>
            <a href="{{route ('addproduct')}}" class="btn btn-success btn-sm">Thêm sản phẩm</a>
        </div>
    </div>

    <div class="d-md-flex justify-content-between align-items-center mb-3 gap-2">
        
        <form id="sortForm" method="GET" action="{{ route('listproduct') }}">
            <select class="form-select form-select-sm me-md-2 mb-2 mb-md-0" name="sort_price" id="sort_price">
                <option value="">Sắp xếp theo giá</option>
                <option value="asc" {{ request('sort_price') == 'asc' ? 'selected' : '' }}>Thấp đến cao</option>
                <option value="desc" {{ request('sort_price') == 'desc' ? 'selected' : '' }}>Cao xuống thấp</option>
            </select>
        </form>

        <!-- <select class="form-select form-select-sm me-md-2 mb-2 mb-md-0" name="category_id" onchange="this.form.submit()">
            <option value="">Chọn danh mục</option>
            <option value="">
                dm
            </option>
        </select> -->

        <!-- <input type="text" class="form-control form-control-sm me-md-2 mb-2 mb-md-0" placeholder="Tìm kiếm..."> -->
    </div>
    {{-- Hiển thị thông báo thành công --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
    <div class="table-responsive">
        <table class="table table-bordered align-middle text-center">

            <thead class="table-light">
                <tr>
                    <!-- <th></th> -->
                    <th>STT</th>
                    <!-- <th>ID</th> -->
                    <th>Tên sản phẩm</th>
                    <th>Danh mục</th>
                    <th>Giá bán</th>
                    <th>Giá cũ</th>
                    <th>Tồn kho</th>
                    <th>Trạng thái</th>
                    <th>Tùy chỉnh</th>
                </tr>
            </thead>
            <tbody>
                <!-- Ví dụ 1 dòng sản phẩm -->
                @foreach($listproduct as $v)
                <tr>
                    <!-- <td><input class="form-check-input" type="checkbox"></td> -->
                    <td>{{ $loop->iteration }}</td>
                    <!-- <td>{{ $v->product_id }}</td> -->
                    <td>
                        <img src="{{ asset('img/images/' . $v->img) }}" alt="Hình sản phẩm" class="product-image d-block mx-auto" style="width: 40%;">
                        {{ $v->name}}
                    </td>
                    <td>
                    @if ($v->category)
                        {{ $v->category->name }}
                    @else
                        Chưa có danh mục
                    @endif
                    </td>
                    <td>{{ number_format($v->price, 0, ',', '.') }} VNĐ</td>
                    <td>{{ number_format($v->gia_cu, 0, ',', '.') }} VNĐ</td>
                    <td>{{ $v->quantity}}</td>
                    <!-- <td>
                        <div class="form-check form-switch d-flex justify-content-center">
                            <input class="form-check-input" 
                                type="checkbox" 
                                data-product_id="{{ $v->product_id }}"  
                                name="is_show" 
                                value="1" 
                                {{ $v->is_show ? 'checked' : '' }} >
                        </div>
                    </td> -->
                    <td>
                        @if ($v->is_show)
                            <span class="badge bg-success">Hiện</span>
                        @else
                            <span class="badge bg-secondary">Ẩn</span>
                        @endif
                    </td>
                    <td class="/d-flex">
                       <!-- Thêm liên kết tới trang cập nhật -->
                        <div class="mb-3">
                            <a href="{{ route('updateproduct', $v->product_id) }}" class="btn btn-md btn-outline-secondary">
                                <i class="bi bi-pencil"></i>
                            </a>
                        </div>

                        <form action="{{ route('product.destroy', $v->product_id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                        <button class="btn btn-md btn-outline-secondary"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
                <!-- Lặp lại các dòng sản phẩm -->
            </tbody>
        </table>
    </div>
    <!-- Thêm phân trang dưới bảng -->
    <div class="pagination d-flex justify-content-end">
        {{ $listproduct->links('pagination::bootstrap-4') }}
    </div>

</div>
@endsection
  <!-- Tải jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- <script>
    $(document).ready(function() {
        // Lắng nghe sự kiện thay đổi trạng thái checkbox
        $('.form-check-input').change(function() {
            var productId = $(this).data('product_id');  // Lấy id của sản phẩm
            var isShow = $(this).prop('checked') ? 1 : 0;  // Kiểm tra trạng thái checkbox

            // Gửi yêu cầu AJAX để cập nhật trạng thái is_show
            $.ajax({
                url: '{{ route("update.show.status") }}',  // URL cập nhật trạng thái
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',  // CSRF token để bảo vệ
                    product_id: productId,  // Dùng product_id để truyền đúng ID sản phẩm
                    is_show: isShow
                },
                success: function(response) {
                    if (response.success) {
                        alert('Cập nhật trạng thái thành công!');
                    } else {
                        alert('Có lỗi khi cập nhật trạng thái!');
                    }
                }
            });
        });
    });
</script> -->

<script>
   document.addEventListener('DOMContentLoaded', function () {
       const sortDropdown = document.getElementById('sort_price');
       if (sortDropdown) {
           sortDropdown.addEventListener('change', function() {
               var sortValue = this.value;
               var form = document.getElementById('sortForm');
               var actionUrl = form.action;
               
               // Sử dụng fetch để gửi AJAX request
               fetch(actionUrl + '?sort_price=' + sortValue, {
                   method: 'GET',
                   headers: {
                       'X-Requested-With': 'XMLHttpRequest',
                       'Accept': 'application/json',
                   }
               })
               .then(response => response.json())
               .then(data => {
                   // Cập nhật lại bảng dữ liệu trong trang mà không reload trang
                   document.querySelector('tbody').innerHTML = data.html;

                   // Sau khi load lại dữ liệu, gắn lại sự kiện cho các phần tử mới (nếu có)
                   attachEventListeners();
               })
               .catch(error => {
                   console.error('Error:', error);
               });
           });
       }
   });

   // Hàm để gắn sự kiện cho các phần tử
//    function attachEventListeners() {
//        const checkboxes = document.querySelectorAll('.form-check-input');
//        checkboxes.forEach(checkbox => {
//            checkbox.addEventListener('change', function() {
//                const productId = this.dataset.product_id;
//                const isShow = this.checked ? 1 : 0;
//                // Gửi AJAX request để cập nhật trạng thái is_show
//                fetch(`/admin/update-show-status`, {
//                    method: 'POST',
//                    headers: {
//                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
//                        'Content-Type': 'application/json',
//                    },
//                    body: JSON.stringify({
//                        product_id: productId,
//                        is_show: isShow,
//                    })
//                })
//                .then(response => response.json())
//                .then(data => {
//                    if (data.success) {
//                        console.log('Cập nhật trạng thái thành công!');
//                    } else {
//                        console.log('Cập nhật trạng thái thất bại.');
//                    }
//                })
//                .catch(error => {
//                    console.error('Error:', error);
//                });
//            });
//        });
//    }
</script>
