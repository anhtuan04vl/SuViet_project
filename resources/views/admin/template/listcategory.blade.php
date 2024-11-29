@extends('admin.master')

@section('title', 'Dashboard')


@section('content')


<div class="container my-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Bảng điều khiển</a></li>
            <li class="breadcrumb-item active" aria-current="page">Quản lý danh mục</li>
        </ol>
    </nav>

    <!-- Add New and Delete All buttons -->
    <div class="d-flex gap-2 mb-3 justify-content-end">
        <a href="{{ route('addcategory') }}" class="btn btn-success btn-sm d-flex align-items-center"><i
                class="bi bi-plus-lg me-2"></i>Thêm mới danh mục</a>
    </div>
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

    <div class="table-responsive">
        <table class="table table-bordered text-center table-hover table-borderless align-middle">
            <thead class="table-light">
                <tr>
                    <!-- <th scope="col"><input type="checkbox" /></th> -->
                    <th scope="col">ID</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Tên danh mục</th>
                    <th scope="col">Số lượng sản phẩm</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Tùy chỉnh</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($catelist as $v)
                  <tr>
                    <!-- <td><input type="checkbox" /></td> -->
                    <td><strong>{{ $v->category_id }}</strong></td>
                    <td>
                        <img src="{{ asset('img/images/' . $v->images) }}" alt="Hình sản phẩm"
                            class="product-image d-block mx-auto" style="width: 30%;">
                    </td>
                    <td>{{ $v->name }}</td>
                    <td>{{ $v->products_count }}</td>
                    <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input toggle-status" type="checkbox"
                                data-id="{{ $v->category_id }}" {{ $v->is_active ? 'checked' : '' }}>
                        </div>
                    </td>
                    <td>
                        <a href="{{ route('updatecategory', $v->category_id) }}" class="btn btn-link p-0 text-decoration-none"><i class="bi bi-pencil"></i></a>
                        <!-- <button class="btn btn-link p-0 text-decoration-none"><i class="bi bi-trash"></i></button> -->
                    </td>
                </tr>
                @endforeach
                <!-- Thêm các dòng khác tương tự -->
            </tbody>
        </table>
    </div>
    <!-- Thêm phân trang dưới bảng -->
    <div class="pagination d-flex justify-content-end">
        {{ $catelist->links('pagination::bootstrap-4') }}
    </div>
</div>

@endsection


