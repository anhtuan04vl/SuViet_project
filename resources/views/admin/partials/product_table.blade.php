<tbody>
                <!-- Ví dụ 1 dòng sản phẩm -->
                @foreach($listproduct as $v)
                <tr>
                    <td><input class="form-check-input" type="checkbox"></td>
                    <td>{{ $v->product_id }}</td>
                    <td>
                        <img src="{{ asset('img/images/' . $v->img) }}" alt="Hình sản phẩm" class="product-image d-block mx-auto" style="width: 40%;">
                        {{ $v->name}}
                    </td>
                    <td>
                    @if ($v->category)
                        {{ $v->category->name }}
                    @else
                        Chưa có danh mục
                    @endif
                    </td>
                    <td>{{ number_format($v->price, 0, ',', '.') }} VNĐ</td>
                    <td>{{ number_format($v->gia_cu, 0, ',', '.') }} VNĐ</td>
                    <td>{{ $v->quantity}}</td>
                    <td>
                        <div class="form-check form-switch d-flex justify-content-center">
                            <input class="form-check-input" 
                                type="checkbox" 
                                data-product_id="{{ $v->product_id }}"  
                                name="is_show" 
                                value="1" 
                                {{ $v->is_show ? 'checked' : '' }} >
                        </div>
                    </td>
                    <td class="/d-flex">
                       <!-- Thêm liên kết tới trang cập nhật -->
                        <div class="mb-3">
                            <a href="{{ route('updateproduct', $v->product_id) }}" class="btn btn-md btn-outline-secondary">
                                <i class="bi bi-pencil"></i>
                            </a>
                        </div>

                        <form action="{{ route('product.destroy', $v->product_id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                        <button class="btn btn-md btn-outline-secondary"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
                <!-- Lặp lại các dòng sản phẩm -->
            </tbody>