@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto bg-white rounded-2xl shadow-lg overflow-hidden mt-10">
    <div class="grid md:grid-cols-2">
        <div class="p-6 flex justify-center items-center bg-gray-100">
            <img src="{{ asset('storage/books/' . $book->cover_image) }}" alt="{{ $book->title }}" class="rounded-xl w-72 h-96 object-cover shadow-md">
        </div>

        <div class="p-8 flex flex-col justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">{{ $book->title }}</h1>
                <p class="text-gray-500 mt-1">by <span class="font-semibold">{{ $book->author }}</span></p>

                <div class="mt-4 space-y-2">
                    <p><span class="font-semibold text-gray-700">Category:</span> {{ $book->category->name ?? '-' }}</p>
                    <p><span class="font-semibold text-gray-700">Publication year:</span> {{ $book->year }}</p>
                    <p><span class="font-semibold text-gray-700">Publisher:</span> {{ $book->publisher }}</p>
                    <p><span class="font-semibold text-gray-700">Description:</span></p>
                    <p class="text-gray-600 text-sm leading-relaxed">{{ $book->description ?? 'Tidak ada deskripsi.' }}</p>
                </div>
            </div>

            <div class="mt-8">
                @auth
                    @if(Auth::user()->role === 'user')
                        <form action="{{ route('books.request', $book->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition duration-200">
                                Borrow this book
                            </button>
                        </form>
                    @elseif(Auth::user()->role === 'admin')
                        <div class="flex gap-3">
                            <a href="{{ route('books.edit', $book->id) }}" class="flex-1 text-center bg-yellow-400 hover:bg-yellow-500 text-white font-semibold py-2 rounded-lg">✏️ Edit</a>
                            <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                    class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-2 rounded-lg">Delete</button>
                            </form>
                        </div>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="block w-full bg-gray-400 hover:bg-gray-500 text-white font-semibold py-2 rounded-lg transition">
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
            🔒 <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a> untuk memberikan ulasan.
        </p>
    @endauth
</div>
@endsection
