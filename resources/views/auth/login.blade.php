@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="flex justify-center items-center min-h-[70vh]">
    <div class="bg-white shadow-lg rounded-xl p-8 w-full max-w-md">

        {{-- Tombol Kembali --}}
        <div class="mb-4">
            <a href="{{ url('/') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-blue-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali
            </a>
        </div>

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
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Daftar di sini</a>
        </p>
    </div>
</div>
@endsection
