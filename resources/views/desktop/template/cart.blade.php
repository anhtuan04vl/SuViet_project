@extends('desktop.master')
<meta name="csrf-token" content="{{ csrf_token() }}">
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
                    <a href="#" class="text-gray-700 hover:text-gray-900">Giỏ hàng</a>
                </li>
            </ol>
        </nav>
    </div>
    <!-- END BREADCRUMD -->

    <!-- GIO HÀNG -->

    <div class="cart_page pb-10">
        <div class="tlt_r flex justify-center">
            <h4 class="text-2xl 800:text-[28px] text-cmain font-el font-semibold mb-6">Giỏ hàng của bạn</h4>
        </div>
        <hr>
        <div class="container-main px-[5%] lg:px-0">
            <div class="tiltle_cart flex justify-center">
                @if (isset($cart) && $cart && $cart->details->isNotEmpty())
                    <table class="table-auto mt-5">
                        <thead>
                            <tr>
                                <th>Hình ảnh</th>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Giá</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart->details as $detail)
                                <tr>
                                    <td class="px-2 900:px-10 py-2 w-[200px]">
                                        <img src="{{ asset('img/images/' . $detail->product->img) }}"
                                            alt="{{ $detail->product->name }}"
                                            style="width: 150px; height: 150px; object-fit: cover;">
                                    </td>
                                    <td class="px-2 900:px-10 py-3 w-[calc(100%-250px-20px)]">
                                        {{ $detail->product->name }}
                                    </td>
                                    <td class="px-2 900:px-10 py-2 ">
                                        <div class="flex gap-5 items-center group border rounded-[20px] border-gray-300">
                                            <button onclick="updateQuantity({{ $detail->products_id }}, -1)"
                                                class="px-3 rounded-full 800:px-5 py-3 bg-gray-300 hover:bg-gray-400">-</button>
                                            <span id="quantity-{{ $detail->product_id }}">{{ $detail->quantity }}</span>
                                            <button onclick="updateQuantity({{ $detail->products_id }}, 1)"
                                                class="px-3 rounded-full 800:px-5 py-3 bg-gray-300 hover:bg-gray-400">+</button>
                                        </div>
                                    </td>
                                    <td class="px-10 py-2 ">{{ number_format($detail->price) }} VNĐ</td>
                                    <td class="px-10 py-2 ">
                                        <!-- Delete button (SVG icon) -->
                                        <button onclick="deleteItem({{ $detail->products_id }})"><svg width="26"
                                                height="26" viewBox="0 0 26 26" fill="none"
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
                                            </svg></button>

                                    </td>

                                </tr>
                            @endforeach
                            <td>
                                <button class="btn_coupon w-full rounded-[10px] py-2 bg-cmain text-white hover:bg-cmain2"
                                    onclick="clearCart()">Xóa tất cả</button>
                            </td>
                        </tbody>
                    </table>
                @else
                    <div class="text-center mt-5">
                        <p> Giỏ hàng trống</p>
                    </div>
                @endif
            </div>
            <hr>
            <div class="cart_sp">
                <a href="{{ route('product') }}" class="back_cart pt-8 flex group">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M19 12H5" stroke="#0F0F0F" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M12 19L5 12L12 5" stroke="#0F0F0F" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    <p class="text-base text-cmain3 hover:text-cmain font-el font-semibold">Tiếp tục mua hàng</p>
                </a>
                <div class="form_cp_info mt-5 flex flex-col md:flex-row gap-5 800:gap-20 justify-between">
                    <!-- insert coupon -->
                    <form action="/apply-coupon" method="POST" class="coupon w-full md:w-[40%] /border-1 /border-black /rounded-[15px] p-3 800:p-8 flex flex-col gap-3 800:gap-5">
                                @csrf
                                <div class="tlt flex gap-2">
                                    <svg width="24" height="25" viewBox="0 0 24 25" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M10.59 21.09L3.42 13.92C3.23405 13.7343 3.08653 13.5137 2.98588 13.2709C2.88523 13.0281 2.83343 12.7678 2.83343 12.505C2.83343 12.2422 2.88523 11.9819 2.98588 11.7391C3.08653 11.4963 3.23405 11.2757 3.42 11.09L12 2.5L22 2.5L22 12.5L13.41 21.09C13.0353 21.4625 12.5284 21.6716 12 21.6716C11.4716 21.6716 10.9647 21.4625 10.59 21.09Z"
                                            stroke="#515151" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M17 7.5L17 7.51" stroke="#515151" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                    <h5 class="text-lg text-cmain font-el font-semibold">Mã giảm giá</h5>
                                </div>
                                <input type="hidden" name="total" value="
                                @if (isset($cart))
                                {{$cart->total_price}}
                                @else
                                0
                                @endif
                                " >
                                <input type="text" name="coupon_code" placeholder="Nhập mã giảm giá" class="rounded-[10px] border px-2 py-2" />
                                @if(session('error'))
                                    <div class="text-red-500 text-sm" role="alert">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                @if(session('discountedTotal'))
                                    <div class="text-green-500 text-sm" role="alert">
                                        Mã giảm giá "{{ session('couponCode') }}" đã được áp dụng thành công!
                                    </div>
                                @endif

                                
                                <button type="submit" class="btn_coupon w-full rounded-[10px] py-2 bg-cmain text-white hover:bg-cmain2">ÁP DỤNG</button>
                            </form>



                    <!-- thong tin  -->
                    <div class="info w-full md:w-[50%] border-2 rounded-[15px] p-3 800:p-8 flex flex-col gap-8 800:gap-6">
                        <h2 class="text-xl font-semibold mb-6">Đơn hàng tạm tính</h2>

                        <div class="mb-2 flex justify-between">
                            <span class="text-sm text-gray-600">Thông tin sản phẩm</span>
                            <span class="text-sm text-gray-800">Tạm tính:</span>
                        </div>
                        @if ($cart && $cart->details)
                        @foreach ($cart->details as $detail)
                            <div class="mb-2 flex justify-between">
                                <span class="text-sm text-gray-600 ">{{ $detail->product->name }} * {{ $detail->quantity }}
                                    cái</span>
                                <span class="text-sm text-gray-800">{{ number_format($detail->price) }} VNĐ</span>
                            </div>
                        @endforeach
                        @endif

                        <div class="mb-6 flex justify-between">
                            <span class="text-lg font-semibold text-gray-800">Tạm tính thanh toán:</span>
                            @if (isset($cart) && $cart->total_price)
                                <input type="text" class="text-lg font-semibold text-gray-800 text-end" value="{{ number_format($cart->total_price) }} VNĐ">
                            @else
                                0 VNĐ
                            @endif
                            
                        </div>
                        <div class="mb-2 flex justify-between">
                            <span class="text-sm text-gray-600">Đã giảm giá</span>
                            <span class="text-sm text-green-600" >
                            @if (isset($cart))
                            {{ session('discount') ? number_format(session('discount'), 0) . ' VNĐ' : '0 VNĐ' }}
                            @else
                            0 VNĐ
                            @endif
                            </span>
                            
                        </div>

                        <div class="border-t border-gray-300 my-4"></div>

                        <div class="mb-6 flex justify-between">
                            <span class="text-lg font-semibold text-gray-800">Tạm tính thanh toán:</span>
                            <span class="text-lg font-semibold text-gray-800">
                            @if (isset($cart))
                            {{ session('discountedTotal') ? number_format(session('discountedTotal'), 0) . ' VNĐ' : number_format($cart->total_price, 0) . ' VNĐ' }}
                            @else
                            0 VNĐ
                            @endif
                            </span>
                        </div>
                        
                                <input type="hidden" name="discount" id="discount" value="
                                    @if (isset($cart))
                                    {{session('discount')}}
                                    @endif
                                ">
                                <input type="hidden" name="discountedTotal" id="discountedTotal" value="
                                    @if (isset($cart))
                                    {{session('discountedTotal')}}
                                    @endif
                                ">
                        <a href="{{ route('order', ['users_id' => Auth::id()]) }}" class="w-full bg-cmain text-white py-2 text-center rounded-lg">Tiến hành thanh toán</a>

                        <!-- <p class="text-sm text-gray-600 mt-4">Nhấn "Đặt hàng" đồng nghĩa với việc bạn đồng ý tuân theo <a href="#" class="text-blue-600">Điều khoản Sứ Việt.</a></p> -->
                       </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let price = {
            discount: document.getElementById('discount').value,
            discountedTotal: document.getElementById('discountedTotal').value
        };
        console.log(price);
        localStorage.setItem('DISCOUNT', JSON.stringify(price));
    </script>
    <script>
        const routes = {
            updateQuantity: "{{ route('cart.updateQuantity') }}",
            deleteItem: "{{ route('cart.deleteItem') }}",
            clearCart: "{{ route('cart.clear') }}"
        };

        function updateQuantity(productId, change) {
            fetch(routes.updateQuantity, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({
                        products_id: productId,
                        change: change
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        location.reload(); // Reload page to reflect changes
                    }
                });
        }

        function deleteItem(productId) {
            fetch(routes.deleteItem, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({
                        products_id: productId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        location.reload(); // Reload page to reflect changes
                    }
                });
        }

        function clearCart() {
            fetch(routes.clearCart, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        location.reload(); // Reload page to reflect changes
                    }
                });
        }
    </script>

    <!-- END GIO HANG -->

@endsection
