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
                    <h4 class="mb-0">Cập nhật sản phẩm</h4>
                </div>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="card-body">
                    <form action="{{ route('product.update', ['product_id' => $updateproduct->product_id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') 

                        <!-- Tên sản phẩm -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên sản phẩm</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $updateproduct->name) }}" required>
                        </div>

                        <!-- Mô tả sản phẩm -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Mô tả</label>
                            <textarea class="form-control" id="description" name="short_description">{{ old('short_description', $updateproduct->short_description) }}</textarea>
                        </div>

                        <!-- Giá sản phẩm -->
                        <div class="mb-3">
                            <label for="price" class="form-label">Giá sản phẩm</label>
                            <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $updateproduct->price) }}" required>
                        </div>

                        <!-- Giá cũ -->
                        <div class="mb-3">
                            <label for="gia_cu" class="form-label">Giá cũ</label>
                            <input type="number" class="form-control" id="gia_cu" name="gia_cu" value="{{ old('gia_cu', $updateproduct->gia_cu) }}">
                        </div>

                        <!-- Số lượng sản phẩm -->
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Số lượng sản phẩm</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity', $updateproduct->quantity) }}">
                        </div>

                        <!-- Danh mục sản phẩm -->
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Danh mục sản phẩm</label>
                            <select class="form-control" id="category_id" name="category_id" required>
                                <option value="">Chọn danh mục</option>  <!-- Tuỳ chọn mặc định -->
                                @foreach($categories as $category)
                                    <option value="{{ $category->category_id }}" 
                                            {{ old('category_id', $updateproduct->category_id) == $category->category_id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Hình ảnh sản phẩm -->
                        <div class="mb-3">
                            <label for="img" class="form-label">Hình ảnh sản phẩm</label>
                            <input type="file" class="form-control" id="img" name="img" value="{{ old('img', $updateproduct->img) }}">
                            @if($updateproduct->img)
                                <img src="{{ asset('img/images/' . $updateproduct->img) }}" width="100" alt="Product Image">
                            @endif
                        </div>

                        <!-- Trạng thái sản phẩm (is_show) -->
                        <div class="mb-3">
                            <label for="is_show" class="form-label">Trạng thái</label>
                            <!-- Input ẩn gửi giá trị 0 nếu checkbox không được chọn -->
                            <input type="hidden" name="is_show" value="0">
                            <input class="form-check-input" type="checkbox" name="is_show" value="1" {{ $updateproduct->is_show ? 'checked' : '' }}>
                        </div>

                        <!-- Nút lưu -->
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Lưu thay đổi</button>
                            <a href="{{ route('listproduct') }}" class="btn btn-secondary">Quay lại</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        
    </div>
</div>
@endsection