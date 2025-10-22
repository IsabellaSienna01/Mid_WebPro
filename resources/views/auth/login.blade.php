@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="flex justify-center items-center min-h-[70vh]">
    <div class="bg-white shadow-lg rounded-xl p-8 w-full max-w-md">
        
        <div class="mb-4">
            <a href="{{ url('/') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-emerald-500 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Back
            </a>
        </div>
        
        @auth
        <div>
            Already logged in.
            <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button type="submit"
                class="text-sm font-semibold text-gray-700 hover:text-emerald-500 focus:outline-none">
                Logout
            </button>
            </form>
            ?
        </div>
        @endauth
        @guest

            <h2 class="text-2xl font-bold mb-6 text-center text-emerald-500">Login to account</h2>

            <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" required class="mt-1 w-full border rounded-lg p-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" required class="mt-1 w-full border rounded-lg p-2">
                </div>

                @error('email')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror

                <button type="submit" class="w-full bg-emerald-500 text-white py-2 rounded-lg hover:bg-emerald-600 transition">
                    Masuk
                </button>
            </form>

            <p class="text-center text-sm text-gray-600 mt-4">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-emerald-500 hover:underline">Register</a>
            </p>
        </div>
    @endguest
</div>
@endsection
