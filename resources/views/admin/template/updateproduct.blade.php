@extends('admin.master')

@section('title', 'Dashboard')

@section('content')
<div class="container mt-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Bảng điều khiển</a></li>
            <!-- <li class="breadcrumb-item"><a href="#">Tài Khoản</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cập nhật tài khoản</li> -->
        </ol>
    </nav>
    <div class="row justify-content-center">
        <!-- Form Cập nhật tài khoản -->
        <div class="col-lg-7 col-md-12 col-sm-12">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Thêm sản phẩm</h4>
                </div>
                <div class="card-body">
                    <form action="#" method="POST">
                        <!-- Tên đăng nhập -->
                        <!-- <div class="mb-3">
                            <label for="username" class="form-label">Tên đăng nhập</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Nhập tên đăng nhập" required>
                        </div> -->
                        <!-- Tên người dùng -->
                        <div class="mb-3">
                            <label for="namesp" class="form-label">Nhập tên sản phẩm</label>
                            <input type="text" class="form-control" id="namesp" name="namesp" placeholder="Nhập tên sản phẩm" required>
                        </div>
                        <!-- Mô tả sản phẩm -->
                        <div class="mb-3">
                            <label for="mota" class="form-label">Nhập mô tả</label>
                            <input type="text" class="form-control" id="mota" name="mota" placeholder="Nhập tên sản phẩm" required>
                        </div>
                        <div class="mb-3">
                            <label for="gia" class="form-label">Nhập giá sản phẩm</label>
                            <input type="text" class="form-control" id="gia" name="gia" placeholder="Nhập tên sản phẩm" required>
                        </div>
                        <div class="mb-3">
                            <label for="gia_cu" class="form-label">Nhập giá cũ</label>
                            <input type="text" class="form-control" id="gia_cu" name="gia_cu" placeholder="Nhập tên sản phẩm" required>
                        </div>
                        <!-- Email -->
                        <!-- <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email" required>
                        </div> -->
                        <!-- Mật khẩu Cũ -->
                        <!-- <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu hiện tại</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu" required>
                        </div> -->
                        <!-- Mật khẩu Mới-->
                        <!-- <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu mới</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu mới" required>
                        </div> -->
                        <!-- Trạng thái -->
                        <div class="mb-3">
                            <label for="status" class="form-label">Trạng thái</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="active">Hiện</option>
                                <option value="inactive">Ẩn</option>
                            </select>
                        </div>
                        <!-- Nút Lưu và Quay lại -->
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Lưu thay đổi</button>
                            <a href="{{route ('listproduct')}}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Quay lại</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Form Cập nhật hình ảnh -->
        <div class="col-lg-5 col-md-12 col-sm-12 ">
            <!-- Hinh anh chinh -->
            <div class="card shadow-sm">
                <div class="card-header bg-secondary text-white">
                    <h4 class="mb-0">Cập nhật hình ảnh</h4>
                </div>
                <div class="card-body text-center">
                    <!-- Hình ảnh hiện tại -->
                    <img src="https://via.placeholder.com/150" alt="Hình ảnh tài khoản" class="img-fluid rounded mb-3" id="current-image">
                    
                    <!-- Form chọn ảnh mới -->
                    <form action="#" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="profileImage" class="form-label">Chọn hình ảnh mới</label>
                            <input class="form-control" type="file" id="profileImage" name="profileImage" accept="image/*" required>
                        </div>
                        <!-- Nút cập nhật hình ảnh -->
                        <button type="submit" class="btn btn-success"><i class="fas fa-upload"></i> Cập nhật hình ảnh</button>
                    </form>
                </div>
            </div>
            <!-- Hinh anh phu -->
            <div class="card shadow-sm mt-5">
                <div class="card-header bg-secondary text-white">
                    <h4 class="mb-0">Cập nhật hình ảnh</h4>
                </div>
                <div class="card-body text-center">
                    <!-- Hình ảnh hiện tại -->
                    <img src="https://via.placeholder.com/150" alt="Hình ảnh tài khoản" class="img-fluid rounded mb-3" id="current-image">
                    
                    <!-- Form chọn ảnh mới -->
                    <form action="#" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="profileImage" class="form-label">Chọn hình ảnh mới</label>
                            <input class="form-control" type="file" id="profileImage" name="profileImage" accept="image/*" required>
                        </div>
                        <!-- Nút cập nhật hình ảnh -->
                        <button type="submit" class="btn btn-success"><i class="fas fa-upload"></i> Cập nhật hình ảnh</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection