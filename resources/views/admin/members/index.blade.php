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
                            <a href="{{ route('admin.members.edit', $member->id) }}"
                               class="inline-block bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded-lg text-xs sm:text-sm">
                                Edit
                            </a>
                            <form action="{{ route('admin.members.destroy', $member->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-xs sm:text-sm"
                                        onclick="return confirm('Are you sure you want to delete this member?')">
                                    Delete
                                </button>
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
@endsection
