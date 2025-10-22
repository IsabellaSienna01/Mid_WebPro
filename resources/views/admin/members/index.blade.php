@extends('layouts.app')
<title>Manage Members</title>

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-3">
        <h1 class="text-xl sm:text-2xl font-bold text-emerald-600">Manage Members</h1>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-5 text-sm sm:text-base">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-x-auto">
        <table class="w-full min-w-[700px] border-collapse text-sm sm:text-base">
            <thead class="bg-emerald-500 text-white uppercase">
                <tr>
                    <th class="px-4 py-3 text-left">#</th>
                    <th class="px-4 py-3 text-left">Name</th>
                    <th class="px-4 py-3 text-left">Email</th>
                    <th class="px-4 py-3 text-left">Phone</th>
                    <th class="px-4 py-3 text-left">Address</th>
                    <th class="px-4 py-3 text-left">Membership Date</th>
                    <th class="px-4 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($members as $member)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 text-gray-900">{{ $member->login->name ?? '-' }}</td>
                        <td class="px-4 py-3 text-gray-700">{{ $member->login->email ?? '-' }}</td>
                        <td class="px-4 py-3 text-gray-700">{{ $member->phone ?? '-' }}</td>
                        <td class="px-4 py-3 text-gray-700">{{ $member->address ?? '-' }}</td>
                        <td class="px-4 py-3 text-gray-700">{{ $member->membership_date->format('d-m-Y') }}</td>
                        <td class="px-4 py-3 text-center flex flex-col sm:flex-row justify-center items-center gap-2">
                            <button type="button"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-xs sm:text-sm transition"
                                    onclick="openDeleteModal({{ $member->id }})">
                                Delete
                            </button>
                            <form id="deleteForm-{{ $member->id }}" 
                                  action="{{ route('admin.members.destroy', $member->id) }}" 
                                  method="POST" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-gray-500 py-4">No members found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $members->links() }}
    </div>

    <div class="mt-6">
        <a href="{{ route('admin.dashboard') }}" 
           class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-lg font-semibold shadow text-sm sm:text-base">
            Back to Dashboard
        </a>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="hidden fixed inset-0 flex items-center justify-center bg-black/30 backdrop-blur-sm z-50">
    <div class="bg-white rounded-2xl shadow-xl max-w-sm w-full mx-4 p-6 text-center">
        <h2 class="text-lg font-semibold text-gray-800 mb-2">Delete Member?</h2>
        <p class="text-sm text-gray-600 mb-6">This action cannot be undone. Are you sure you want to delete this member?</p>
        <div class="flex justify-center gap-3">
            <button onclick="closeDeleteModal()" 
                    class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg font-medium transition">
                Cancel
            </button>
            <button id="confirmDeleteBtn" 
                    class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg font-medium transition">
                Delete
            </button>
        </div>
    </div>
</div>

<script>
    let deleteMemberId = null;

    function openDeleteModal(memberId) {
        deleteMemberId = memberId;
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function closeDeleteModal() {
        deleteMemberId = null;
        document.getElementById('deleteModal').classList.add('hidden');
    }

    document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
        if (deleteMemberId) {
            document.getElementById('deleteForm-' + deleteMemberId).submit();
        }
    });

    // Tutup modal jika user klik area luar modal
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) closeDeleteModal();
    });
</script>
@endsection
