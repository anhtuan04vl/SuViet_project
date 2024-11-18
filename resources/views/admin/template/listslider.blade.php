@extends('admin.master')

@section('title', 'Dashboard')


 
@section('content')
<div class="container my-5">
        <!-- Add New and Delete All buttons -->
        <div class="d-flex gap-2 mb-3 justify-content-end">
            <a href="{{ route('addslider') }}" class="btn btn-success btn-sm d-flex align-items-center"><i class="bi bi-plus-lg me-2"></i>Add new</a>
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
                            <th>Tiêu đề</th>
                            <th>Mô tả</th>
                            <th>Trạng thái</th>
                            <th>Tùy chỉnh</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listslider as $v)
                        <tr class="m-4">
                            <td><input type="checkbox"></td>
                            <td>{{ $v->id }}</td>
                            <td class=""><img src="{{ asset('img/images/' . $v->image) }}" class="img-thumbnail img-fluid " width="100" alt="Product Image" ></td>
                            <td>{{ $v->title }}</td>
                            <td><a href="#">{{ $v->description }}</a></td>
                            <td class="text-center"><input class="form-check-input " type="checkbox" checked></td>
                            <td >
                            <div class="dropdown">
                                <button class="btn btn-light dropdown-toggle actions-menu" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots"></i>
                                </button>   
                                <ul class="dropdown-menu dropdown-menu-start ">
                                    <li><a class="dropdown-item" href="{{route ('updateslider', $v->id)}}"><i class="bi bi-pencil"></i> Chỉnh sửa</a></li>
                                    <li>
                                        <form action="{{ route('slider.destroy', $v->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
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
        </div>
    </div>
@endsection