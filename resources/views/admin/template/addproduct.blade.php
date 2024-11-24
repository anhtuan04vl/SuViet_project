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
        <div class="col-lg-12 col-md-12 col-sm-12">
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
                        <!-- Giá cũ -->
                        <div class="mb-3">
                            <label for="gia_cu" class="form-label">Nhập giá cũ</label>
                            <input type="text" class="form-control" id="gia_cu" name="gia_cu" placeholder="Nhập giá cũ sản phẩm">
                        </div>
                        <!-- Số lượng -->
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Nhập số lượng sản phẩm</label>
                            <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Nhập số lượng sản phẩm">
                        </div>
                        <!-- Danh mục sản phẩm -->
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Danh mục sản phẩm</label>
                            <select class="form-control" id="category_id" name="category_id" required>
                                <option value="">Chọn danh mục</option>  <!-- Tuỳ chọn mặc định -->
                                @foreach($categories as $category)
                                    <option value="{{ $category->category_id }}" 
                                            {{ old('category_id') == $category->category_id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="img" class="form-label">Hình ảnh sản phẩm</label>
                            <input type="file" class="form-control" id="img" name="img" placeholder="Nhập hình ảnh sản phẩm" required>
                        </div>
                        <!-- Trạng thái -->
                        <div class="mb-3">
                            <label for="is_show" class="form-label">Trạng thái</label>
                            <select class="form-select" id="is_show" name="is_show" required>
                                <option value="1" {{ old('is_show') == 1 ? 'selected' : '' }}>Hiện</option>
                                <option value="0" {{ old('is_show') == 0 ? 'selected' : '' }}>Ẩn</option>
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

       
    </div>
</div>
@endsection