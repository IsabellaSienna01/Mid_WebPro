@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="flex justify-center items-center min-h-[70vh]">
    <div class="bg-white shadow-lg rounded-xl p-8 w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center text-blue-600">Login ke Akun</h2>

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

            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
                Masuk
            </button>
        </form>

        <p class="text-center text-sm text-gray-600 mt-4">
            Belum punya akun? <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Daftar di sini</a>
        </p>
    </div>
</div>
@endsection
