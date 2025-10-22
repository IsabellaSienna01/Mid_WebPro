@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto bg-white rounded-2xl shadow-lg overflow-hidden mt-10">
    <div class="grid md:grid-cols-2">
        
        <div class="relative p-6 bg-gray-100">
            <div class="absolute top-6 left-6">
                <a href="{{ url('/') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-emerald-500 transition">
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
                    <p><span class="font-semibold text-gray-700">Category: {{ $book->category->name ?? '-' }}</p>
                    <p><span class="font-semibold text-gray-700">Publication year:</span> {{ $book->year }}</p>
                    <p>
                        <span class="font-semibold text-gray-700">Status:</span>
                        @if ($book->stock > 0)
                            <span class="text-green-600 font-semibold">Available</span>
                        @else
                            <span class="text-red-500 font-semibold">Unavailable</span>
                        @endif
                    </p>
                    <p><span class="font-semibold text-gray-700">Description:</span></p>
                    <p class="text-gray-600 text-sm leading-relaxed">{{ $book->description ?? '-' }}</p>
                </div>
            </div>

            <div class="mt-8">
                @auth
                    @if ($book->stock > 0)
                        @if ($alreadyBorrowed)
                            <button type="button" disabled class="w-full bg-gray-400 text-white font-semibold py-2 rounded-lg cursor-not-allowed">
                                Book Borrowed
                            </button>
                        @else
                            <form action="{{ route('user.book.borrow', $book->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full bg-emerald-500 hover:bg-emerald-600 text-white font-semibold py-2 rounded-lg transition duration-200">
                                    Borrow this book
                                </button>
                            </form>
                        @endif
                        @if (session('success'))
                            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                                {{ session('error') }}
                            </div>
                        @endif

                    @else
                        <button type="button" disabled class="w-full bg-gray-400 cursor-not-allowed text-white font-semibold py-2 rounded-lg transition duration-200">
                            Currently Unavailable
                        </button>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="block w-full p-5 bg-gray-400 hover:bg-gray-500 text-white font-semibold py-2 rounded-lg transition">
                        Login to borrow this book
                    </a>
                @endauth
            </div>
        </div>
    </div>
</div>

<div class="max-w-5xl mx-auto mt-10 bg-white p-8 rounded-xl shadow-md">
    <h2 class="text-xl font-bold mb-4 text-gray-800">💬 Ulasan Buku</h2>
    @forelse($book->reviews as $review)
        <div class="border-b border-gray-200 py-3">
            <p class="font-semibold text-gray-700">{{ $review->user->name }}</p>
            <p class="text-gray-600 text-sm mt-1">{{ $review->comment }}</p>
            <p class="text-xs text-gray-400 mt-1">{{ $review->created_at->diffForHumans() }}</p>
        </div>
    @empty
        <p class="text-gray-500">Belum ada ulasan untuk buku ini.</p>
    @endforelse

    @auth
        <form action="{{ route('reviews.store', $book->id) }}" method="POST" class="mt-6">
            @csrf
            <textarea name="comment" rows="3" 
                class="w-full border rounded-lg p-2 text-sm focus:ring focus:ring-blue-300" 
                placeholder="Tulis ulasanmu..."></textarea>
            <button type="submit" 
                class="mt-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-5 rounded-lg">
                Kirim Ulasan
            </button>
        </form>
    @else
        <p class="mt-4 text-sm text-gray-600">
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a> untuk memberikan ulasan.
        </p>
    @endauth
</div>
@endsection
