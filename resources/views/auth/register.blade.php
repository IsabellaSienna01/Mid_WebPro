@extends('layouts.auth')

@section('content')
<div class="flex justify-center items-center min-h-screen">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">
        
        <div class="mb-4">
            <a href="{{ url('/') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-emerald-500 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Back
            </a>
        </div>
        
        <h2 class="text-2xl font-bold text-center text-emerald-500 mb-6">Register new account</h2>

        @if ($errors->any())
            <div class="mb-4 bg-red-100 text-red-700 p-3 rounded-lg">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">
                    Full Name
                </label>
                <input type="text" id="name" name="name" value="{{ old('name') }}"required autofocus class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-emerald-200 focus:outline-none">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">
                    Email
                </label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-emerald-200 focus:outline-none">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">
                    Password
                </label>
                <input type="password" id="password" name="password" required class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-emerald-200 focus:outline-none">
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                    Confirm Password
                </label>
                <input type="password" id="password_confirmation" name="password_confirmation" required class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-emerald-200 focus:outline-none">
            </div>

            <div class="border-t border-gray-300 pt-4 mt-4">
                <p class="text-sm text-gray-600 mb-2">Additional Information (optional)</p>

                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700">
                        Address
                    </label>
                    <input type="text" id="address" name="address" value="{{ old('address') }}" class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-emerald-200 focus:outline-none">
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">
                        Phone Number
                    </label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone') }}" class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-emerald-200 focus:outline-none">
                </div>
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full bg-emerald-500 text-white py-2 rounded-lg hover:bg-emerald-600 transition">
                    Register
                </button>
            </div>
        </form>

        <p class="text-center text-sm text-gray-600 mt-6">
            Already have an account?
            <a href="{{ route('login') }}" class="text-emerald-500 hover:underline font-medium">Login</a>
        </p>
    </div>
</div>
@endsection
