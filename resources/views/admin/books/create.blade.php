@extends('layouts.app')
<title>Add New Book</title>

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-3">
        <h1 class="text-xl sm:text-2xl font-bold text-emerald-600">Add New Book</h1>
        <a href="{{ route('admin.books') }}" 
           class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-lg font-semibold shadow text-sm sm:text-base">
            Back to List
        </a>
    </div>

    @if ($errors->any())
        <div class="mb-5 p-4 bg-red-100 text-red-700 rounded-lg text-sm sm:text-base">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data" 
          class="bg-white p-4 sm:p-6 rounded-lg shadow-md space-y-4 sm:space-y-6">
        @csrf

        <div>
            <label class="block text-gray-700 mb-2 font-medium text-sm sm:text-base">Title</label>
            <input type="text" name="title" value="{{ old('title') }}" 
                   class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm sm:text-base" required>
        </div>

        <div>
            <label class="block text-gray-700 mb-2 font-medium text-sm sm:text-base">Author</label>
            <input type="text" name="author" value="{{ old('author') }}" 
                   class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm sm:text-base" required>
        </div>

        <div>
            <label class="block text-gray-700 mb-2 font-medium text-sm sm:text-base">Publisher</label>
            <input type="text" name="publisher" value="{{ old('publisher') }}" 
                   class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm sm:text-base">
        </div>

        <div>
            <label class="block text-gray-700 mb-2 font-medium text-sm sm:text-base">Year</label>
            <input type="number" name="year" value="{{ old('year') }}" 
                   class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm sm:text-base">
        </div>

        <div>
            <label class="block text-gray-700 mb-2 font-medium text-sm sm:text-base">Stock</label>
            <input type="number" name="stock" value="{{ old('stock') }}" min="0"
                   class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm sm:text-base">
        </div>

        <div>
            <label class="block text-gray-700 mb-2 font-medium text-sm sm:text-base">Category</label>
            <select name="category_id" 
                    class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm sm:text-base">
                <option value="">-- Select Category --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-gray-700 mb-2 font-medium text-sm sm:text-base">Description</label>
            <textarea name="description" rows="4" 
                      class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm sm:text-base">{{ old('description') }}</textarea>
        </div>

        <div>
            <label class="block text-gray-700 mb-2 font-medium text-sm sm:text-base">Book Cover Image</label>
            <input type="file" name="image" class="w-full text-sm sm:text-base">
        </div>

        <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 mt-6">
            <button type="submit" class="w-full sm:w-auto bg-emerald-500 text-white px-4 py-2 rounded-lg font-semibold shadow hover:bg-emerald-600 transition text-sm sm:text-base">
                Add Book
            </button>
            <a href="{{ route('admin.books') }}" class="w-full sm:w-auto bg-gray-300 text-gray-700 px-4 py-2 rounded-lg font-semibold shadow hover:bg-gray-400 transition text-sm sm:text-base text-center">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
