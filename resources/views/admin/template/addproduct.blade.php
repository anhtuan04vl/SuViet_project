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
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card-body">
                    <form action="{{ route('store.product') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Tên người dùng -->
                        <div class="mb-3">
                            <label for="namesp" class="form-label">Nhập tên sản phẩm</label>
                            <input type="text" class="form-control" id="namesp" name="name" placeholder="Nhập tên sản phẩm" required>
                        </div>
                        <!-- Mô tả sản phẩm -->
                        <div class="mb-3">
                            <label for="mota" class="form-label">Nhập mô tả</label>
                            <!-- <input type="text" class="form-control" id="mota" name="mota" placeholder="Nhập tên sản phẩm" required> -->
                             <textarea type="text" class="form-control" id="mota" name="short_description" placeholder="Nhập mô tả sản phẩm"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="gia" class="form-label">Nhập giá sản phẩm</label>
                            <input type="text" class="form-control" id="price" name="price" placeholder="Nhập giá sản phẩm" required>
                        </div>
                        <div class="mb-3">
                            <label for="gia_cu" class="form-label">Nhập giá cũ</label>
                            <input type="text" class="form-control" id="gia_cu" name="gia_cu" placeholder="Nhập giá cũ sản phẩm">
                        </div>
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Danh mục sản phẩm</label>
                            <input type="text" class="form-control" id="category_id" name="category_id" placeholder="Nhập danh mục sản phẩm" required>
                        </div>
                        <div class="mb-3">
                            <label for="img" class="form-label">Hình ảnh sản phẩm</label>
                            <input type="file" class="form-control" id="img" name="img" placeholder="Nhập hình ảnh sản phẩm" required>
                        </div>
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