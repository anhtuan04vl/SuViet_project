@extends('admin.master')

@section('title', 'Dashboard')


 
@section('content')
<div class="container my-5">
    <!-- Form Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Thêm mới Bài Viết</h3>
        <a href="" class="btn btn-secondary d-flex align-items-center"><i class="bi bi-x-sm me-2"></i>quay lại</a>
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
    <!-- Card containing form -->
    <div class="card">
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Title Field -->
                <div class="mb-3">
                    <label for="title" class="form-label">Tiêu đề</label>
                    <input type="text" class="form-control" id="title" name="title"required>
                </div>

                <!-- Description Field -->
                <div class="mb-3">
                    <label for="description" class="form-label">Mô tả</label>
                    <textarea class="form-control" id="description" name="description"></textarea>
                </div>

                <!-- Image Field -->
                <div class="mb-3">
                    <label for="image" class="form-label">Hình ảnh</label>
                    <input type="file" class="form-control" id="image" name="image">
                    <!-- <div class="mt-2">
                        <img src="" alt="Preview" class="img-thumbnail">
                    </div> -->
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
                <!-- thong tin san pham -->
              
                <!-- Link Field -->
                <div class="mb-3">
                    <label for="link" class="form-label">Link</label>
                    <input type="url" class="form-control" id="link" name="link" >
                </div>

                <!-- Display Checkbox -->
                <div class=" mb-3">
                <label class="form-check-label" for="display">Trạng thái</label>
                    <select class="form-select" id="is_active" name="is_active" required>
                        <option value="1" {{ old('is_active') == 1 ? 'selected' : '' }}>Hiện</option>
                        <option value="0" {{ old('is_active') == 0 ? 'selected' : '' }}>Ẩn</option>
                    </select>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex justify-content-between">
                    <button class="btn btn-primary btn-md"><i class="bi bi-save me-2"></i>Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection