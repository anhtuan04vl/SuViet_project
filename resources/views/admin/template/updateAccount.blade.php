@extends('admin.master')

@section('title', 'Dashboard')


@section('content')
<div class="container my-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="#">Danh sách tài khoản</a></li>
            <li class="breadcrumb-item"><a href="#">cập nhật tài khoản tài khoản</a></li>
        </ol>
    </nav>
    <div class="row">
      <!-- Left Panel -->
        

      <!-- Right Panel -->
        <div class="col-lg-12">
            <div class="card">  
                <div class="card-body">
                    <h5 class="text-primary mb-4">Cập nhật tài khoản</h5>
                    <form action="{{ route('user.updateAdminUser', ['users_id' => $formupdateuser->users_id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="fullName" class="form-label">Họ và tên</label>
                            <input type="text" class="form-control" id="fullName" name="fullname" value="{{ old('fullname', $formupdateuser->fullname) }}" placeholder="Enter full name">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{old('email', $formupdateuser->email)}}"placeholder="Enter email ID">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Tên tài khoản</label>
                            <input type="text" class="form-control" id="username" name="username" value="{{ old('username', $formupdateuser->username) }}" placeholder="Enter phone number">
                        </div>
                        <div class="col-md-6 mb-3">
                        <label for="role" class="form-label">Vai trò</label>
                            <select class="form-select" id="role" name="role">
                                <option value="1" {{ $formupdateuser->role == 1 ? 'selected' : '' }}>Người quản trị</option>
                                <option value="0" {{ $formupdateuser->role == 0 ? 'selected' : '' }}>Người dùng</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">Mật khẻu</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                        </div>
                    </div>

                    <h5 class="text-primary mt-4 mb-3">Hình ảnh đại diện</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="avatar" class="form-label"></label>
                                <img src="{{ asset('img/images/' . $formupdateuser->images) }}" width="250" alt="Preview" class="img-thumbnail m-3 mx-0">
                                <input type="file" class="form-control" id="images" name="images">
                            </div>
                        </div>
                    <h5 class="text-primary mt-4 mb-3">Vị trí </h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="street" class="form-label">Đường/số nhà</label>
                                <input type="text" class="form-control" id="street" name="address" value="{{ $formupdateuser->contacts->first()->address ?? '' }}" placeholder="Enter Street">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="city" class="form-label">Thành phố</label>
                                <input type="text" class="form-control" id="city" name="city" value="{{ $formupdateuser->contacts->first()->city ?? '' }}" placeholder="Enter City">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="state" class="form-label">Số điện thoại</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ $formupdateuser->contacts->first()->phone ?? '' }}" placeholder="Enter State">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="zip" class="form-label">Zip Code</label>
                                <input type="text" class="form-control" id="zip" placeholder="Zip Code">
                            </div>
                        </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('listaccount') }}" type="button" class="btn btn-secondary me-2">Hủy</a>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection