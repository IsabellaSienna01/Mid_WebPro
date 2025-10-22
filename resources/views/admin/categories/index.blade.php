@extends('layouts.app')
<title>Manage Categories</title>

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 py-8">

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4 sm:gap-0">
        <h1 class="text-2xl font-bold text-emerald-600">Manage Categories</h1>
        <button onclick="document.getElementById('addCategoryModal').classList.remove('hidden')"
                class="bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-lg font-semibold shadow">
            + Add Category
        </button>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-5 text-sm sm:text-base">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-x-auto">
        <table class="w-full min-w-[600px] border-collapse text-sm sm:text-base">
            <thead class="bg-emerald-500 text-white uppercase text-xs sm:text-sm">
                <tr>
                    <th class="px-3 py-2 text-left">#</th>
                    <th class="px-3 py-2 text-left">Category Name</th>
                    <th class="px-3 py-2 text-left">Description</th>
                    <th class="px-3 py-2 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-3 py-2 text-gray-700">{{ $loop->iteration }}</td>
                        <td class="px-3 py-2 font-medium text-gray-900">{{ $category->name }}</td>
                        <td class="px-3 py-2 text-gray-700">{{ $category->description ?? '-' }}</td>
                        <td class="px-3 py-2 text-center flex flex-col sm:flex-row justify-center items-center gap-2">
                            <button onclick="openEditModal({{ $category->id }}, '{{ addslashes($category->name) }}', '{{ addslashes($category->description ?? '') }}')"
                                    class="inline-block bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded-lg text-sm w-full sm:w-auto">
                                Edit
                            </button>
                            <button type="button"
                                    onclick="openDeleteModal({{ $category->id }})"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm w-full sm:w-auto">
                                Delete
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-gray-500 py-4">No categories yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Add Category Modal -->
    <div id="addCategoryModal" class="fixed inset-0 bg-black/30 backdrop-blur-sm flex items-center justify-center p-4 sm:p-6 hidden">
        <div class="bg-white rounded-lg shadow-lg w-full sm:max-w-md p-4 sm:p-6 relative">
            <h2 class="text-lg sm:text-xl font-bold mb-4 text-emerald-600">Add Category</h2>
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2 font-medium">Category Name</label>
                    <input type="text" name="name" class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2 font-medium">Description</label>
                    <textarea name="description" class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500" rows="3"></textarea>
                </div>
                <div class="flex flex-col sm:flex-row justify-end gap-2">
                    <button type="button" onclick="document.getElementById('addCategoryModal').classList.add('hidden')"
                            class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-700 rounded-lg w-full sm:w-auto">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-lg w-full sm:w-auto">
                        Add
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Category Modal -->
    <div id="editCategoryModal" class="fixed inset-0 bg-black/30 backdrop-blur-sm flex items-center justify-center p-4 sm:p-6 hidden">
        <div class="bg-white rounded-lg shadow-lg w-full sm:max-w-md p-4 sm:p-6 relative">
            <h2 class="text-lg sm:text-xl font-bold mb-4 text-emerald-600 ">Edit Category</h2>
            <form id="editCategoryForm" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2 font-medium">Category Name</label>
                    <input type="text" name="name" id="editCategoryName" class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2 font-medium">Description</label>
                    <textarea name="description" id="editCategoryDescription" class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500" rows="3"></textarea>
                </div>
                <div class="flex flex-col sm:flex-row justify-end gap-2">
                    <button type="button" onclick="document.getElementById('editCategoryModal').classList.add('hidden')"
                            class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-700 rounded-lg w-full sm:w-auto">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-lg w-full sm:w-auto">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteConfirmModal" class="fixed inset-0 bg-black/30 backdrop-blur-sm flex items-center justify-center p-4 hidden z-50">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-sm p-6 text-center">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Delete Confirmation</h2>
            <p class="text-gray-600 mb-6">Are you sure you want to delete this category?</p>
            <form id="deleteCategoryForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="flex justify-center gap-4">
                    <button type="button" 
                            onclick="document.getElementById('deleteConfirmModal').classList.add('hidden')"
                            class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-700 rounded-lg">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg">
                        Delete
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="mt-6">
        <a href="{{ route('admin.dashboard') }}" 
           class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-lg font-semibold shadow">
            Back to Dashboard
        </a>
    </div>

</div>

<script>
function openEditModal(id, name, description) {
    document.getElementById('editCategoryModal').classList.remove('hidden');
    document.getElementById('editCategoryName').value = name;
    document.getElementById('editCategoryDescription').value = description;
    document.getElementById('editCategoryForm').action = '{{ route("admin.categories.update", ":id") }}'.replace(':id', id);
}

function openDeleteModal(id) {
    document.getElementById('deleteConfirmModal').classList.remove('hidden');
    document.getElementById('deleteCategoryForm').action = '{{ route("admin.categories.destroy", ":id") }}'.replace(':id', id);
}
</script>
@endsection
