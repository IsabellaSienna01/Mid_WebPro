@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto bg-white rounded-2xl shadow-lg overflow-hidden mt-10">
    <div class="grid md:grid-cols-2">
        <div class="p-6 flex justify-center items-center bg-gray-100">
            <img src="{{ asset('storage/books/' . $book->cover_image) }}" 
                 alt="{{ $book->title }}" 
                 class="rounded-xl w-72 h-96 object-cover shadow-md">
        </div>

        <div class="p-8 flex flex-col justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">{{ $book->title }}</h1>
                <p class="text-gray-500 mt-1">oleh <span class="font-semibold">{{ $book->author }}</span></p>

                <div class="mt-4 space-y-2">
                    <p><span class="font-semibold text-gray-700">Kategori:</span> {{ $book->category->name ?? '-' }}</p>
                    <p><span class="font-semibold text-gray-700">Tahun Terbit:</span> {{ $book->year }}</p>
                    <p><span class="font-semibold text-gray-700">Deskripsi:</span></p>
                    <p class="text-gray-600 text-sm leading-relaxed">{{ $book->description ?? 'Tidak ada deskripsi.' }}</p>
                </div>
            </div>

            <div class="mt-8">
                @auth
                    <form action="#" method="POST">
                        @csrf
                        <button type="submit" 
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition duration-200">
                            📚 Ajukan Peminjaman
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" 
                       class="block w-full bg-gray-400 hover:bg-gray-500 text-white font-semibold py-2 rounded-lg transition">
                       🔒 Login untuk meminjam
                    </a>
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection
