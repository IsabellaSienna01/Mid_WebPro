@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto">
    <h1 class="text-2xl font-bold mb-4 text-emerald-600">Book Requests</h1>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">{{ session('error') }}</div>
    @endif

    <div class="bg-white rounded-2xl shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="p-4">#</th>
                    <th class="p-4">User</th>
                    <th class="p-4">Title</th>
                    <th class="p-4">Author</th>
                    <th class="p-4">Publisher</th>
                    <th class="p-4">Reason</th>
                    <th class="p-4">Status</th>
                    <th class="p-4">Requested At</th>
                    <th class="p-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($requests as $req)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="p-4 align-top">{{ $loop->iteration + ($requests->currentPage()-1) * $requests->perPage() }}</td>

                        <td class="p-4 align-top">
                            {{ $req->member?->login?->name ?? 'Member #' . $req->member_id }}
                            <div class="text-sm text-gray-500">{{ $req->member?->login?->email ?? '' }}</div>
                        </td>

                        <td class="p-4 align-top">{{ $req->title }}</td>
                        <td class="p-4 align-top">{{ $req->author }}</td>
                        <td class="p-4 align-top">{{ $req->publisher }}</td>
                        <td class="p-4 align-top max-w-xs">
                            <div class="text-sm text-gray-700">{{ $req->reason ?? '-' }}</div>
                        </td>

                        <td class="p-4 align-top">
                            @if($req->status === 'pending')
                                <span class="px-2 py-1 rounded text-sm bg-yellow-100 text-yellow-800">Pending</span>
                            @elseif($req->status === 'approved')
                                <span class="px-2 py-1 rounded text-sm bg-green-100 text-green-800">Approved</span>
                            @else
                                <span class="px-2 py-1 rounded text-sm bg-red-100 text-red-800">Rejected</span>
                            @endif
                        </td>

                        <td class="p-4 align-top text-sm text-gray-500">{{ $req->created_at->format('d M Y H:i') }}</td>

                        <td class="p-4 align-top">
                            @if($req->status === 'pending')
                                <div class="flex gap-2">
                                    <button type="button" 
                                            class="px-3 py-1 bg-emerald-500 hover:bg-emerald-600 text-white rounded text-sm transition"
                                            onclick="openActionModal('approve', {{ $req->id }})">
                                        Approve
                                    </button>

                                    <button type="button" 
                                            class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded text-sm transition"
                                            onclick="openActionModal('reject', {{ $req->id }})">
                                        Reject
                                    </button>

                                    <form id="actionForm-{{ $req->id }}-approve" 
                                          action="{{ route('admin.request-book.update', $req->id) }}" 
                                          method="POST" class="hidden">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="action" value="approved">
                                    </form>

                                    <form id="actionForm-{{ $req->id }}-reject" 
                                          action="{{ route('admin.request-book.update', $req->id) }}" 
                                          method="POST" class="hidden">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="action" value="rejected">
                                    </form>
                                </div>
                            @else
                                <div class="text-sm text-gray-500">No actions</div>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="p-6 text-center text-gray-500">No requests found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="p-4">
            {{ $requests->links() }}
        </div>
    </div>
</div>

<!-- Custom Action Modal -->
<div id="actionModal" class="hidden fixed inset-0 flex items-center justify-center bg-black/30 backdrop-blur-sm z-50 transition-opacity duration-200">
    <div class="bg-white rounded-2xl shadow-xl max-w-sm w-full mx-4 p-6 text-center transform scale-100 transition-transform duration-200">
        <h2 id="modalTitle" class="text-lg font-semibold text-gray-800 mb-2">Confirm Action</h2>
        <p id="modalMessage" class="text-sm text-gray-600 mb-6">Are you sure?</p>
        <div class="flex justify-center gap-3">
            <button onclick="closeActionModal()" 
                    class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg font-medium transition">
                Cancel
            </button>
            <button id="confirmActionBtn" 
                    class="px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-lg font-medium transition">
                Confirm
            </button>
        </div>
    </div>
</div>

<script>
    let currentAction = null;
    let currentRequestId = null;

    function openActionModal(action, id) {
        currentAction = action;
        currentRequestId = id;

        const modal = document.getElementById('actionModal');
        const title = document.getElementById('modalTitle');
        const message = document.getElementById('modalMessage');
        const confirmBtn = document.getElementById('confirmActionBtn');

        if (action === 'approve') {
            title.textContent = 'Approve Request?';
            message.textContent = 'Are you sure you want to approve this book request?';
            confirmBtn.textContent = 'Approve';
            confirmBtn.className = 'px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-lg font-medium transition';
        } else {
            title.textContent = 'Reject Request?';
            message.textContent = 'Are you sure you want to reject this book request?';
            confirmBtn.textContent = 'Reject';
            confirmBtn.className = 'px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg font-medium transition';
        }

        modal.classList.remove('hidden');
        setTimeout(() => modal.classList.add('opacity-100', 'scale-100'), 10);
    }

    function closeActionModal() {
        const modal = document.getElementById('actionModal');
        modal.classList.add('hidden');
        currentAction = null;
        currentRequestId = null;
    }

    document.getElementById('confirmActionBtn').addEventListener('click', function() {
        if (currentAction && currentRequestId) {
            document.getElementById(`actionForm-${currentRequestId}-${currentAction}`).submit();
        }
    });

    document.getElementById('actionModal').addEventListener('click', function(e) {
        if (e.target === this) closeActionModal();
    });
</script>
@endsection
