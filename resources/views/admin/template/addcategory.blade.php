@extends('admin.master')

@section('title', 'Dashboard')


 
@section('content')
<div class="container my-5">
    <!-- Form Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Thêm mới Danh mục</h3>
        <a href="{{ route('listcategory') }}" class="btn btn-secondary d-flex align-items-center"><i class="bi bi-x-sm me-2"></i>quay lại</a>
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
            <form action="{{ route('store.category') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Title Field -->
                <div class="mb-3">
                    <label for="title" class="form-label">Tên danh mục</label>
                    <input type="text" class="form-control" id="name" name="name"required>
                </div>

                <!-- Image Field -->
                <div class="mb-3">
                    <label for="image" class="form-label">Hình ảnh</label>
                    <input type="file" class="form-control" id="images" name="images" required>
                    <!-- <div class="mt-2">
                        <img src="" alt="Preview" class="img-thumbnail">
                    </div> -->
                </div>

                <!-- Display Checkbox -->
                <!-- <div class=" mb-3">
                <label class="form-check-label" for="display">Trạng thái</label>
                    <select class="form-select" id="is_active" name="is_active" required>
                        <option value="1" {{ old('is_active') == 1 ? 'selected' : '' }}>Hiện</option>
                        <option value="0" {{ old('is_active') == 0 ? 'selected' : '' }}>Ẩn</option>
                    </select>
                </div> -->

                <!-- Action Buttons -->
                <div class="d-flex justify-content-between">
                    <button class="btn btn-primary btn-md"><i class="bi bi-save me-2"></i>Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection