@extends('desktop.master')

@section('content')
<div class="container-main bg-form bg-cover bg-center" >
<div class="flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-md rounded-lg flex w-4/5 max-w-4xl">
        <!-- Left Section -->
        <div class="w-1/2 bg-gray-100 flex flex-col items-center justify-center p-8">
            <div class="mb-6">
                <img src="https://via.placeholder.com/100" alt="Logo" class="mb-4">
                <h1 class="text-2xl font-bold">TailAdmin</h1>
                <p class="text-gray-600 mt-2 text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit suspendisse.</p>
            </div>
            <img src="https://via.placeholder.com/150" alt="Illustration" class="w-40 h-40">
        </div>

        <!-- Right Section -->
        <div class="w-1/2 p-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Sign In to TailAdmin</h2>
            <form action="#" method="POST" class="space-y-6">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <div class="mt-1 relative">
                        <input id="email" name="email" type="email" required class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-600">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H8m0 0l4-4m-4 4l4 4m-4-4h8" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Re-type Password</label>
                    <div class="mt-1 relative">
                        <input id="password" name="password" type="password" required class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-600">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11V9m0 4v-2m4 2h-8" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div>
                    <button type="submit" class="w-full bg-blue-600 text-white rounded-lg py-3 font-semibold hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600">Sign In</button>
                </div>

                <div class="flex items-center justify-center">
                    <button class="w-full bg-gray-100 text-gray-700 rounded-lg py-3 font-semibold flex items-center justify-center hover:bg-gray-200">
                        <img src="https://via.placeholder.com/20" alt="Google" class="mr-2">
                        Sign in with Google
                    </button>
                </div>

                <p class="text-center text-sm text-gray-600 mt-4">
                    Don't have any account? <a href="#" class="text-blue-600 font-semibold">Sign Up</a>
                </p>
            </form>
        </div>
    </div>
</div>
</div>



@endsection