@extends('admin.master')

@section('title', 'Dashboard')


 
@section('content')
<div class="container-fluid pt-4 /px-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Bảng điều khiển</a></li>
            <li class="breadcrumb-item active" aria-current="page">Danh sách tài khoản</li>
        </ol>
    </nav>
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Danh sách tài khoản</h6>
            <!-- Nút thêm mới tài khoản -->
            <a class="btn btn-success" href=""><i class="fas fa-plus"></i> Thêm mới</a>
        </div>
        @if (session('alert'))
        <script>
            const alert = @json(session('alert'));

            // Kiểm tra loại thông báo và hiển thị bằng SweetAlert2
            Swal.fire({
                icon: alert.type,  // success, error, warning, info, ...
                title: alert.title, // Tiêu đề thông báo
                text: alert.message, // Nội dung thông báo
                timer: 3000, // Tự động đóng sau 3 giây
                showConfirmButton: false // Ẩn nút xác nhận
            });
            console.log(Swal); 

        </script>
        @endif
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col"><input class="form-check-input" type="checkbox" id="select-all"></th>
                        <th scope="col">STT</th>
                        <th scope="col">Ngày Tạo</th>
                        <th scope="col">Ngày Cập Nhật</th>
                        <th scope="col">Tên Đăng Nhập</th>
                        <th scope="col">Tên Người Dùng</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Chỉnh sửa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $v)
                    <tr>
                        <td><input class="form-check-input" type="checkbox"></td>
                        <td>{{ $v->users_id }}</td>
                        <td>{{ $v->created_at->format('d/m/Y') }}</td>
                        <td>{{ $v->updated_at->format('d/m/Y') }}</td>
                        <td>{{ $v->email }}</td>
                        <td>{{ $v->fullname}}</td>
                        <td><span class="{{ $v->role == 1 ? 'text-blue-600 fw-bold' : 'text-secondary' }}">
                            {{ $v->role == 1 ? 'Quản trị viên' : 'Người dùng' }}
                        </span></td>
                        <td><a class="btn btn-sm w-100 btn-primary" href="{{ route('updateaccount', $v->users_id) }}">Cập Nhật</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- Nút xóa các tài khoản đã chọn -->
        <div class="d-flex justify-content-end mt-3">
            <button class="btn btn-danger" id="delete-selected"><i class="fas fa-trash-alt"></i> Xóa tài khoản đã chọn</button>
        </div>
    </div>
    </div>
@endsection