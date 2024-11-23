@extends('desktop.master')

@section('content')
    <div class="container-main bg-form bg-cover bg-center">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white shadow-md rounded-lg flex w-4/5 max-w-4xl">
                <!-- Left Section -->
                <div class="w-1/2 bg-gray-100 flex flex-col items-center justify-center p-8">
                    <div class="mb-6">
                        <img src="https://via.placeholder.com/100" alt="Logo" class="mb-4">
                        <h1 class="text-2xl font-bold">TailAdmin</h1>
                        <p class="text-gray-600 mt-2 text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit
                            suspendisse.</p>
                    </div>
                    <img src="https://via.placeholder.com/150" alt="Illustration" class="w-40 h-40">
                </div>

                <!-- Right Section -->
                <div class="w-1/2 p-8">
                    <h2 class="text-3xl font-bold text-gray-800 mb-6">Đăng Ký</h2>
                    <form method="POST" action="{{ route('register') }} " class="flex flex-col gap-3">
                        @csrf

                        <div>
                            <input id="fullname" name="fullname" type="text" value="{{ old('fullname') }}" required
                                class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-600"
                                placeholder="Họ và tên">
                            @error('fullname')
                                <div class="text-red-600 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <input id="username" name="username" type="text" value="{{ old('username') }}" required
                                class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-600"
                                placeholder="Tên tài khoản">
                            @error('username')
                                <div class="text-red-600 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <input id="email" name="email" type="email" value="{{ old('email') }}" required
                                class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-600"
                                placeholder="Email">
                            @error('email')
                                <div class="text-red-600 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <input id="password" name="password" type="password" required
                                class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-600"
                                placeholder="Mật khẩu">
                            @error('password')
                                <div class="text-red-600 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <input id="password_confirmation" name="password_confirmation" type="password" required
                                class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-600"
                                placeholder="Xác nhận mật khẩu">
                            @error('password_confirmation')
                                <div class="text-red-600 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="w-full bg-blue-600 text-white p-3 rounded-lg hover:bg-blue-700">Đăng ký</button>
                    </form>



                </div>
            </div>
        </div>
    </div>



@endsection
