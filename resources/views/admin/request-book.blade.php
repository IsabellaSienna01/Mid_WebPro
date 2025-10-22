@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Book Requests</h1>

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
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-4 align-top">{{ $loop->iteration + ($requests->currentPage()-1) * $requests->perPage() }}</td>

                        <td class="p-4 align-top">
                            {{ $req->member?->login?->name ?? 'Member #' . $req->member_id }}
                            <div class="text-sm text-gray-500">{{ $req->member?->login?->email ?? '' }}</div>
                        </td>

                        <td class="p-4 align-top">{{ $req->title }}</td>
                        <td class="p-4 align-top">{{ $req->author }}</td>
                        <td class="p-4 align-top">{{ $req->publisher }}</td>
                        <td class="p-4 align-top max-w-xs"><div class="text-sm text-gray-700">{{ $req->reason ?? '-' }}</div></td>

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
                                    <form action="{{ route('admin.request-book.update', $req->id) }}" method="POST" onsubmit="return confirm('Approve this request?')">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="action" value="approved">
                                        <button type="submit" class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700 text-sm">Approve</button>
                                    </form>

                                    <form action="{{ route('admin.request-book.update', $req->id) }}" method="POST" onsubmit="return confirm('Reject this request?')">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="action" value="rejected">
                                        <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-sm">Reject</button>
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

    <div class="mt-6">
        <a href="{{ route('admin.dashboard') }}" 
           class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-lg font-semibold shadow text-sm sm:text-base">
            Back to Dashboard
        </a>
    </div>
</div>
@endsection
