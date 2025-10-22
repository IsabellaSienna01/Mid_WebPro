@extends('layouts.app')
<title>Manage Books</title>
@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-3">
        <h1 class="text-xl sm:text-2xl font-bold text-emerald-600">Manage Books</h1>
        <a href="{{ route('admin.books.create') }}" 
           class="bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-lg font-semibold shadow text-sm sm:text-base">
            + Add Book
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-5 text-sm sm:text-base">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-x-auto">
        <table class="w-full min-w-[700px] border-collapse text-sm sm:text-base">
            <thead class="bg-emerald-500 text-white text-xs sm:text-sm uppercase">
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
                                <span class="px-2 py-1 text-xs sm:text-sm rounded-xl bg-green-100 text-green-700 whitespace-nowrap">
                                    Available
                                </span>
                            @else
                                <span class="px-2 py-1 text-xs sm:text-sm rounded-xl bg-red-100 text-red-600 whitespace-nowrap">
                                    Out of Stock
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-gray-700">{{ $book->stock ?? '-' }}</td>
                        <td class="px-4 py-3 text-center flex flex-wrap justify-center gap-2">
                            <a href="{{ route('admin.books.edit', $book->id) }}" 
                               class="inline-block bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded-lg text-xs sm:text-sm whitespace-nowrap">
                                Edit
                            </a>   
                            <a href="{{ route('admin.books.show', $book->id) }}" 
                               class="inline-block bg-blue-400 hover:bg-blue-500 text-white px-3 py-1 rounded-lg text-xs sm:text-sm whitespace-nowrap">
                                Details
                            </a>
                            <button type="button" 
                                onclick="openDeleteModal({{ $book->id }})"
                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-xs sm:text-sm whitespace-nowrap">
                                Delete
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-gray-500 py-4 text-sm sm:text-base">No books available yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $books->links() }}
    </div>

    <div class="mt-4">
        <a href="{{ route('admin.dashboard') }}" 
           class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-lg font-semibold shadow text-sm sm:text-base">
            Back to Dashboard
        </a>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteBookModal" class="fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center p-4 hidden">
    <div class="bg-white rounded-lg shadow-lg w-full sm:max-w-sm p-6 text-center">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Delete Confirmation</h2>
        <p class="text-gray-600 mb-6">Are you sure you want to delete this book?</p>
        <form id="deleteBookForm" method="POST">
            @csrf
            @method('DELETE')
            <div class="flex flex-col sm:flex-row justify-center gap-3">
                <button type="button"
                    onclick="document.getElementById('deleteBookModal').classList.add('hidden')"
                    class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-lg w-full sm:w-auto">
                    Cancel
                </button>
                <button type="submit"
                    class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg w-full sm:w-auto">
                    Delete
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openDeleteModal(id) {
    const modal = document.getElementById('deleteBookModal');
    const form = document.getElementById('deleteBookForm');
    form.action = '{{ route("admin.books.destroy", ":id") }}'.replace(':id', id);
    modal.classList.remove('hidden');
}
</script>
@endsection
