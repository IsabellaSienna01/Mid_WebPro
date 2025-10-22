@extends('layouts.app')
<title>Edit Book</title>

@section('content')
<div class="max-w-4xl mx-auto px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-emerald-600">Edit Book</h1>
    </div>

    @if ($errors->any())
        <div class="mb-5 p-4 bg-red-100 text-red-700 rounded-lg">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.books.update', $book->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700 mb-2 font-medium">Title</label>
            <input type="text" name="title" value="{{ old('title', $book->title) }}" 
                   class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 mb-2 font-medium">Author</label>
            <input type="text" name="author" value="{{ old('author', $book->author) }}" 
                   class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 mb-2 font-medium">Publisher</label>
            <input type="text" name="publisher" value="{{ old('publisher', $book->publisher) }}" 
                   class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 mb-2 font-medium">Year</label>
            <input type="number" name="year" value="{{ old('year', $book->year) }}" 
                   class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 mb-2 font-medium">Stock</label>
            <input type="number" name="stock" value="{{ old('stock', $book->stock) }}"  min = "0"
                   class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 mb-2 font-medium">Category</label>
            <select name="category_id" class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
                <option value="">-- Select Category --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 mb-2 font-medium">Description</label>
            <textarea name="description" rows="4" 
                      class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">{{ old('description', $book->description) }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 mb-2 font-medium">Book Cover Image</label>
            <input type="file" name="image" class="w-full">
            @if($book->image)
                <img src="{{ asset('storage/'.$book->image) }}" alt="Book Image" class="mt-2 h-32 object-cover rounded">
            @endif
        </div>

        <div class="flex gap-4 mt-6">
            <button type="submit" class="bg-emerald-500 text-white px-4 py-2 rounded-lg font-semibold shadow hover:bg-emerald-600 transition">
                Update
            </button>
            <a href="{{ route('admin.books') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg font-semibold shadow hover:bg-gray-400 transition">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
