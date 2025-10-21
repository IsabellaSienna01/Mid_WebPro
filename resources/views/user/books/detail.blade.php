@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto bg-white rounded-2xl shadow-lg overflow-hidden mt-10">
    <div class="grid md:grid-cols-2">
        
        <div class="relative p-6 bg-gray-100">
            <div class="absolute top-6 left-6">
                <a href="{{ url()->previous() }}" class="inline-flex items-center text-sm text-gray-600 hover:text-emerald-500 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                    Back
                </a>
            </div>

            <div class="flex justify-center">
                <img src="{{ asset('storage/books/' . $book->cover_image) }}" alt="{{ $book->title }}" class="rounded-xl w-72 h-96 object-cover shadow-md">
            </div>
        </div>


        <div class="p-8 flex flex-col justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">{{ $book->title }}</h1>
                <p class="text-gray-500 mt-1">by <span class="font-semibold">{{ $book->author }}</span></p>

                <div class="mt-4 space-y-2">
                    <p><span class="font-semibold text-gray-700">Category {{ $book->category->name ?? '-' }}</p>
                    <p><span class="font-semibold text-gray-700">Publication year:</span> {{ $book->year }}</p>
                    <p><span class="font-semibold text-gray-700">Description:</span></p>
                    <p class="text-gray-600 text-sm leading-relaxed">{{ $book->description ?? 'Tidak ada deskripsi.' }}</p>
                </div>
            </div>

            <div class="mt-8">
                @auth
                    <form action="#" method="POST">
                        @csrf
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition duration-200">
                            Borrow this book
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="block w-full p-5 bg-gray-400 hover:bg-gray-500 text-white font-semibold py-2 rounded-lg transition">
                        Login to borrow this book
                    </a>
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection
