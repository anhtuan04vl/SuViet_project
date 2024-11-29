@extends('admin.master')

@section('title', 'Dashboard')


 
@section('content')
<div class="container my-5">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Bảng điều khiển</a></li>
            <li class="breadcrumb-item active" aria-current="page">Quản lý slider</li>
        </ol>
    </nav>
        <!-- Add New and Delete All buttons -->
        <div class="d-flex gap-2 mb-3 justify-content-end">
            <a href="" class="btn btn-success btn-sm d-flex align-items-center"><i class="bi bi-plus-lg me-2"></i>Add new</a>
            <button class="btn btn-danger btn-sm d-flex align-items-center"><i class="bi bi-trash me-2"></i>Delete all</button>
        </div>

        <!-- Card containing search bar and table -->
        <div class="card">
            <div class="card-body">
                <!-- Search bar -->
                <div class="input-group mb-3 ">
                    <input type="text" class="form-control" placeholder="Search">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
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
                <!-- Product Table -->
                <table class="table align-middle table-borderless">
                    <thead class="table-light">
                        <tr>
                            <th><input type="checkbox"></th>
                            <th>STT</th>
                            <th>Ảnh</th>
                            <!-- <th>Tiêu đề</th>
                            <th>Mô tả</th> -->
                            <th>Trạng thái</th>
                            <th>Tùy chỉnh</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($listlogo as $v )
                        <tr class="m-4">
                            <td><input type="checkbox"></td>
                            <td>{{ $v->id }}</td>
                            <td class=""><img src="{{ asset('img/images/' . $v->img) }}" class="img-thumbnail img-fluid " width="100" alt="Product Image" ></td>
                            <td class="/text-center"><input class="form-check-input " type="checkbox" checked></td>
                            <td >
                                <div class="dropdown">
                                    <button class="btn btn-light dropdown-toggle actions-menu" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-three-dots"></i>
                                    </button>   
                                    <ul class="dropdown-menu dropdown-menu-start ">
                                        <li><a class="dropdown-item" href=""><i class="bi bi-pencil"></i> Chỉnh sửa</a></li>
                                        <li>
                                            <form action="" method="POST" style="display:inline-block;">
                                            
                                                <button class="dropdown-item" ><i class="bi bi-trash"></i>Xóa slider</button>
                                            </form>
                                            
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>                   
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Thêm phân trang dưới bảng -->
            <div class="pagination d-flex justify-content-end mt-2">
                
            </div>
        </div>
    </div>
@endsection