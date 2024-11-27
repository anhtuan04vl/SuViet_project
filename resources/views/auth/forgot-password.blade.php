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
                    <h3 class="text-3xl font-bold text-gray-800 mb-6">Vui lòng nhập địa chỉ email của bạn.</h3>
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div>
                            <div class="mt-1 relative">
                                <input id="email" name="email" type="email" required class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Vui lòng nhập Email" value="{{ old('email') }}">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H8m0 0l4-4m-4 4l4 4m-4-4h8" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-blue-600 text-white rounded-lg py-3 font-semibold hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600">Gửi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

