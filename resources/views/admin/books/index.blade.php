@extends('layouts.app')
<title>Manage Books</title>
@section('content')
<div class="max-w-7xl mx-auto px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-emerald-600">Manage Books</h1>
        <a href="{{ route('admin.books.create') }}" 
           class="bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-lg font-semibold shadow">
            + Add Book
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-5">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="w-full border-collapse">
            <thead class="bg-emerald-500 text-white text-sm uppercase">
                <tr>
                    <th class="px-4 py-3 text-left">#</th>
                    <th class="px-4 py-3 text-left">Title</th>
                    <th class="px-4 py-3 text-left">Author</th>
                    <th class="px-4 py-3 text-left">Category</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-left">Stock</th>
                    <th class="px-4 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books as $index => $book)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3 text-gray-700">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $book->title }}</td>
                        <td class="px-4 py-3 text-gray-700">{{ $book->author }}</td>
                        <td class="px-4 py-3 text-gray-700">{{ $book->category->name ?? '-' }}</td>
                        <td class="px-4 py-3">
                            @if($book->stock > 0)
                                <span class="px-2 py-1 text-xs rounded-xl bg-green-100 text-green-700">
                                    Available
                                </span>
                            @else
                                <span class="px-2 py-1 text-xs rounded-xl bg-red-100 text-red-600">
                                    Out of Stock
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-gray-700">{{ $book->stock ?? '-' }}</td>
                        <td class="px-4 py-3 text-center space-x-2">
                            <a href="{{ route('admin.books.edit', $book->id) }}" 
                               class="inline-block bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded-lg text-sm">
                                Edit
                            </a>   
                            <a href="{{ route('admin.books.show', $book->id) }}" 
                               class="inline-block bg-blue-400 hover:bg-blue-500 text-white px-3 py-1 rounded-lg text-sm">
                                Details
                            </a>
                            <form action="{{ route('admin.books.destroy', $book->id) }}" 
                                  method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm"
                                    onclick="return confirm('Are you sure you want to delete this book?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-gray-500 py-4">No books available yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-6">
        {{ $books->links() }}
    </div>
     <div>
        <a href="{{ route('admin.dashboard') }}" 
           class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-lg font-semibold shadow">
            Back to Dashboard
        </a>
    </div>
</div>
@endsection
