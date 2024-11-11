@extends('admin.master')

@section('title', 'Dashboard')


 
@section('content')

<div class="container my-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Danh sách sản phẩm</h4>
            <div class="btnn d-flex gap-3">
                <a href="#" class="btn btn-danger" id="delete-selected"><i class="fas fa-trash-alt"></i> Xóa tài sản phẩm đã chọn</a>
                <a href="{{route ('addproduct')}}" class="btn btn-primary">Thêm sản phẩm</a>
            </div>
           
        </div>
        <p>Tổng số lượng sản phẩm: 300 sản phẩm.</p>
        {{-- Hiển thị thông báo thành công --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr class="text-center">
                        <th scope="col"></th>
                        <th scope="col">Stt</th>
                        <th scope="col">Thông tin sản phẩm</th>
                        <!-- <th scope="col">Mã sản phẩm</th> -->
                        <th scope="col">Gía</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Danh mục</th>
                        <th scope="col">Chỉnh sửa</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Row 2 -->
                    @foreach($products as $product)
                    <tr class="text-center">
                        <td><input type="checkbox"></td>
                        <td>{{ $product->product_id }}</td>
                        <td >
                            <img src="{{ asset('img/images/' . $product->img) }}" alt="Hình sản phẩm" class="product-image d-block mx-auto" style="width: 40%;">
                            <p>{{ $product->name }}</p>
                        </td>
                        <!-- <td>UY3750</td> -->
                        <td>{{ number_format($product->price, 0, ',', '.') }} VNĐ</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->is_show }}</td>
                        <td>{{ $product->category_id }}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-light dropdown-toggle actions-menu" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="{{route ('updateproduct')}}"><i class="bi bi-pencil"></i> Chỉnh sửa</a></li>
                                    <!-- <li><a class="dropdown-item" href="#"><i class="bi bi-box-seam"></i> Product Orders</a></li> -->
                                    
                                    <li>
                                    
                                        <form action="{{ route('product.destroy', $product->product_id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                                                <i class="bi bi-trash"></i> Xóa sản phẩm
                                            </a>
                                        </form>
                                    </li>

                                </ul>
                            </div>
                        </td>
                    </tr>
                    @endforeach  
                    
                    <!-- phan trang -->
            

                </tbody>
            </table>
        </div>
    </div>
@endsection