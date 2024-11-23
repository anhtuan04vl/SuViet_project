@extends('desktop.master')

@section('content')
    <!-- BREADCRUMD -->
    <div class="container-main py-5 px-[5%] lg:px-0">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="/inline-flex flex gap-2 items-center space-x-1">
                <li class="inline-flex items-center">
                    <a href="#" class="text-teal-500 hover:text-teal-700">Trang chủ</a>
                </li>
                <li>
                    <span class="flex w-1 h-1 bg-cmain rounded-full "></span>
                </li>
                <li>
                    <a href="#" class="text-gray-700 hover:text-gray-900">Danh sách yêu thích</a>
                </li>
            </ol>
        </nav>
    </div>
    <!-- END BREADCRUMD -->

    <div class="cart_page pb-10">
        <div class="tlt_r flex justify-center">
            <h4 class="text-2xl 800:text-[28px] text-cmain font-el font-semibold mb-6">Danh sách yêu thích của bạn</h4>
        </div>
        <hr>
        <div class="container-main px-[5%] lg:px-0">
            <div class="tiltle_cart flex justify-center">
                <table class="table-auto mt-5">
                    @if ($wishlistItems->isEmpty())
                        <tr>
                            <td colspan="6" class="text-center">Danh sách yêu thích của bạn hiện tại trống. Hãy thêm sản
                                phẩm vào wishlist!</td>
                        </tr>
                    @else
                        <thead>
                            <tr>
                                <th>Hình ảnh</th>
                                <th>Tên sản phẩm</th>
                                <th>Giá</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($wishlistItems as $item)
                                <tr>
                                    <td class="px-2 900:px-10 py-2 w-[250px]">
                                        <img src="{{ asset('img/images/' . $item->product->img) }}"
                                            alt="{{ $item->product->name }}" class="w-full h-24 object-cover">
                                    </td>
                                    <td class="px-2 900:px-10 py-3 w-[calc(100%-250px-20px)]">
                                        {{ $item->product->name }}
                                    </td>
                                    <td class="px-10 py-2 hidden 900:table-cell">
                                        {{ number_format($item->product->price) }} VNĐ
                                    </td>
                                    <td class="px-10 py-2 hidden 900:table-cell">
                                        <form action="{{ route('add_to_cart') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id"
                                                value="{{ $item->product->product_id }}">
                                            <input type="hidden" name="price" value="{{ $item->product->price }}">
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit"
                                                class="border group border-cmain hover:border-cmain7 hover:bg-cmain7 flex py-3 px-5 rounded-[39px] /w-full mt-3 items-center justify-center transition duration-300 ease-in-out">
                                                <p class="text-cmain group-hover:text-white">Thêm vào giỏ hàng</p>
                                            </button>
                                        </form>
                                    </td>
                                    <td class="px-10 py-2 hidden 900:table-cell">
                                        <button onclick="removeFromWishlist({{ $item->product->id }})"
                                            class="btn btn-danger">
                                            <svg width="26" height="26" viewBox="0 0 26 26" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1.85547 6.5H24.1412" stroke="black" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path
                                                    d="M4.64062 6.5H21.3549V23.2143C21.3549 23.7068 21.1592 24.1793 20.811 24.5275C20.4627 24.8757 19.9903 25.0714 19.4978 25.0714H6.49777C6.00522 25.0714 5.53285 24.8757 5.18456 24.5275C4.83629 24.1793 4.64062 23.7068 4.64062 23.2143V6.5Z"
                                                    stroke="black" stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M8.35547 6.50014V5.57157C8.35547 4.34021 8.84462 3.15927 9.71532 2.28857C10.586 1.41787 11.767 0.928711 12.9983 0.928711C14.2297 0.928711 15.4106 1.41787 16.2813 2.28857C17.152 3.15927 17.6412 4.34021 17.6412 5.57157V6.50014"
                                                    stroke="black" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M10.2109 12.0742V19.5057" stroke="black" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path d="M15.7852 12.0742V19.5057" stroke="black" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function removeFromWishlist(productId) {
            // Thử với productId không hợp lệ để kiểm tra lỗi 422
            productId = -1; // Giả sử ID này không tồn tại trong database

            if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi danh sách yêu thích?')) {
                $.ajax({
                    url: '{{ route('wishlist.remove') }}',
                    type: 'POST',
                    data: {
                        product_id: productId, // Gửi productId không hợp lệ
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            window.location.reload(); // Làm mới trang sau khi xóa thành công
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr) {
                        alert('Có lỗi xảy ra. Vui lòng thử lại.');
                        console.error(xhr.responseText); // Ghi log lỗi server
                    }
                });
            }
        }
    </script>



@endsection
