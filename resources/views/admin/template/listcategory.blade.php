@extends('admin.master')

@section('title', 'Dashboard')

@section('content')
<div class="container my-4">
    <h1>List Category</h1>

    <!-- Add New and Delete All buttons -->
    <div class="d-flex gap-2 mb-3 justify-content-end">
        <a href="{{ route('addcategory') }}" class="btn btn-success btn-sm d-flex align-items-center"><i
                class="bi bi-plus-lg me-2"></i>Add new</a>
        <button class="btn btn-danger btn-sm d-flex align-items-center"><i class="bi bi-trash me-2"></i>Delete
            all</button>
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
                            class="product-image d-block mx-auto" style="width: 20%;">
                    </td>
                    <td>{{ $v->name }}</td>
                    <td>{{ $v->products_count }}</td>
                    <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" checked>
                        </div>
                    </td>
                    <td>
                        <button class="btn btn-link p-0 text-decoration-none"><i class="bi bi-pencil"></i></button>
                        <button class="btn btn-link p-0 text-decoration-none"><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
                @endforeach
                <!-- Thêm các dòng khác tương tự -->
            </tbody>
        </table>
    </div>
</div>

@endsection