@extends('admin.master')

@section('title', 'Dashboard')


 
@section('content')
<div class="container my-5">
    <!-- Form Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Thêm mới Danh mục</h3>
        <a href="{{ route('listcategory') }}" class="btn btn-secondary d-flex align-items-center"><i class="bi bi-x-sm me-2"></i>quay lại</a>
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
    <!-- Card containing form -->
    <div class="card">
        <div class="card-body">
            <form action="{{ route('category.update', ['category_id' => $updatecategory->category_id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- Title Field -->
                <div class="mb-3">
                    <label for="title" class="form-label">Tên danh mục</label>
                    <input type="text" class="form-control" id="name" value="{{ old('name', $updatecategory->name) }}" name="name"required>
                </div>

                <!-- Image Field -->
                <div class="mb-3">
                    <label for="image" class="form-label">Hình ảnh</label>
                    <input type="file" class="form-control" id="images" name="images" value="{{ old('images', $updatecategory->images) }}" required>
                    @if($updatecategory->images)
                        <img src="{{ asset('img/images/' . $updatecategory->images) }}" width="250" alt="Preview" class="img-thumbnail m-3 mx-0">
                    @endif
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