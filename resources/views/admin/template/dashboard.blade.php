@extends('admin.master')

@section('title', 'Dashboard')

@section('content')
<!-- Sale & Revenue Start -->
<div class="container-fluid pt-4 px-4">
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="#"></a></li>
                    </ol>
                </nav>
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-layer-group fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Tổng danh mục</p>
                                <h6 class="mb-0">1234</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-boxes fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Tổng sản phẩm</p>
                                <h6 class="mb-0">1234</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-newspaper fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Tổng bài viết</p>
                                <h6 class="mb-0">1234</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-pie fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Tổng đơn hàng</p>
                                <h6 class="mb-0">9999</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sale & Revenue End -->

            <!-- Sales Chart Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-light text-center rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Doanh thu</h6>
                                <a href="">Xem chi tiết</a>
                            </div>
                            <canvas id="worldwide-doanhthu"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sales Chart End -->

            <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Sản phẩm mới</h6>
                            <a href=""><i class="fa fa-trash-alt text-primary"></i></a>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    <th scope="col"><input class="form-check-input" type="checkbox"></th>
                                    <th scope="col">Ngày Thêm</th>
                                    <th scope="col">ID</th>
                                    <th scope="col">Người Thêm</th>
                                    <th scope="col">Giá tiền</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Chỉnh sửa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input class="form-check-input" type="checkbox"></td>
                                    <td>21 07 2024</td>
                                    <td>CE-0123</td>
                                    <td>Henry Bui</td>
                                    <td>123000 vnđ</td>
                                    <td>Kích hoạt</td>
                                    <td><a class="btn btn-sm w-100 btn-primary" href="">Xem chi tiết</a></td>
                                </tr>
                                <tr>
                                    <td><input class="form-check-input" type="checkbox"></td>
                                    <td>21 07 2024</td>
                                    <td>CE-0123</td>
                                    <td>Henry Bui</td>
                                    <td>123000 vnđ</td>
                                    <td>Kích hoạt</td>
                                    <td><a class="btn btn-sm w-100 btn-primary" href="">Xem chi tiết</a></td>
                                </tr>
                                <tr>
                                    <td><input class="form-check-input" type="checkbox"></td>
                                    <td>21 07 2024</td>
                                    <td>CE-0123</td>
                                    <td>Henry Bui</td>
                                    <td>123000 vnđ</td>
                                    <td>Đóng</td>
                                    <td><a class="btn btn-sm w-100 btn-primary" href="">Xem chi tiết</a></td>
                                </tr>
                                <tr>
                                    <td><input class="form-check-input" type="checkbox"></td>
                                    <td>21 07 2024</td>
                                    <td>CE-0123</td>
                                    <td>Henry Bui</td>
                                    <td>123000 vnđ</td>
                                    <td>Đóng</td>
                                    <td><a class="btn btn-sm w-100 btn-primary" href="">Xem chi tiết</a></td>
                                </tr>
                                <tr>
                                    <td><input class="form-check-input" type="checkbox"></td>
                                    <td>21 07 2024</td>
                                    <td>CE-0123</td>
                                    <td>Henry Bui</td>
                                    <td>123000 vnđ</td>
                                    <td>Đóng</td>
                                    <td><a class="btn btn-sm w-100 btn-primary" href="">Xem chi tiết</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
@endsection
