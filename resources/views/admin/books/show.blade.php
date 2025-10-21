@extends('layouts.app')
<title>Book Details</title>

@section('content')
<div class="max-w-4xl mx-auto px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-emerald-700">Book Details</h1>
        <a href="{{ route('admin.books') }}" 
           class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-lg font-semibold shadow">
            Back to List
        </a>
    </div>

    <div class="bg-emerald-50 shadow-lg rounded-xl p-6 border border-emerald-200">
        <div class="md:flex md:gap-6">
            @if($book->image)
                <div class="md:w-1/3 flex justify-center items-center mb-6 md:mb-0">
                    <img src="{{ asset('storage/' . $book->image) }}" 
                         alt="{{ $book->title }}" class="rounded-lg object-cover max-h-64 w-full border border-emerald-200">
                </div>
            @endif

            <div class="md:flex-1 space-y-4">
                <div class="flex">
                    <span class="font-semibold text-emerald-700 w-32">Title:</span>
                    <span class="text-gray-900">{{ $book->title }}</span>
                </div>
                <div class="flex">
                    <span class="font-semibold text-emerald-700 w-32">Author:</span>
                    <span class="text-gray-900">{{ $book->author }}</span>
                </div>
                <div class="flex">
                    <span class="font-semibold text-emerald-700 w-32">Publisher:</span>
                    <span class="text-gray-900">{{ $book->publisher ?? '-' }}</span>
                </div>
                <div class="flex">
                    <span class="font-semibold text-emerald-700 w-32">Year:</span>
                    <span class="text-gray-900">{{ $book->year ?? '-' }}</span>
                </div>
                <div class="flex">
                    <span class="font-semibold text-emerald-700 w-32">Stock:</span>
                    <span class="text-gray-900">{{ $book->stock ?? '-' }}</span>
                </div>
                <div class="flex">
                    <span class="font-semibold text-emerald-700 w-32">Category:</span>
                    <span class="text-gray-900">{{ $book->category->name ?? '-' }}</span>
                </div>
                <div class="flex">
                    <span class="font-semibold text-emerald-700 w-32">Description:</span>
                    <p class="text-gray-900">{{ $book->description ?? '-' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
