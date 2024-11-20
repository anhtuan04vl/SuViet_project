@extends('desktop.master')

@section('content')
<div class="container-main py-5 px-[5%] lg:px-0">
    <div class="flex justify-center mt-10 mb-10">
        <article class="text-wrap text-center">
            <h1 class="text-xl font-semibold font-el">Danh mục theo sản phẩm "{{$category->name}}"</h1>
        </article>
    </div>
    <div class="relative z-10 mt-10 mb-10">
        <div class="flex flex-wrap gap-y-10 md:gap-y-20 justify-between /absolute top-0 gap-x-6 800:gap-x-2 cursor-pointer">
            @foreach ($product as $value)
            <div class="box1 w-[40%] md:w-[30%] 800:w-[23%] flex flex-col items-center">
                <a  href="{{route('product_detail', ['product_id' => $value->product_id])}}"><img class="h-48 w-auto lg:object-cover object-contain" src="{{ asset('img/images/' . $value->img) }}" alt=""></a>
                <div class="ttl_1 flex flex-col items-center">
                    <a href="{{route('product_detail', ['product_id' => $value->product_id])}}" class="font-el font-extrabold text-base text-center">{{$value->name}}</a>
                    <p class="text-cmain3 text-sm font-el py-2 line-clamp-2 text-center h-12 overflow-hidden">{{$value->description}}</p>
                    <p class="font-el font-extrabold text-base text-cmain">{{number_format($value->price)}} VNĐ</p>
                    <div class="flex items-center justify-center gap-4">
                        <form action="{{ route('add_to_cart') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $value->product_id }}">
                            <input type="hidden" name="price" value="{{ $value->price }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit"
                                class="border group border-cmain hover:border-cmain7 hover:bg-cmain7 flex py-3 px-5 rounded-[39px] /w-full mt-3 items-center justify-center transition duration-300 ease-in-out">
                                <p class="text-cmain group-hover:text-white">Thêm vào giỏ hàng</p>
                            </button>
                        </form>
                        {{-- <span class="flex w-1 h-1 bg-cmain rounded-full "></span> --}}
                        <a href=""
                            class="group border-cmain hover:border-cmain7 hover:bg-cmain7 flex py-3 px-5 rounded-[39px] /w-full mt-3 items-center justify-center transition duration-300 ease-in-out">
                            <svg class="transition-colors duration-300 group-hover:text-white"
                                width="32" height="31" viewBox="0 0 32 31" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect width="32" height="31" rx="15.5" fill="#194569"
                                    fill-opacity="0.1" />
                                <path
                                    d="M16.434 21.9343C16.196 22.0219 15.804 22.0219 15.566 21.9343C13.536 21.2112 9 18.1949 9 13.0826C9 10.8258 10.743 9 12.892 9C14.166 9 15.293 9.6427 16 10.636C16.707 9.6427 17.841 9 19.108 9C21.257 9 23 10.8258 23 13.0826C23 18.1949 18.464 21.2112 16.434 21.9343Z"
                                    stroke="#194569" stroke-width="1.2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>

    </div>
@endsection
