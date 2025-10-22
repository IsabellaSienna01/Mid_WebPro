@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto mt-10 space-y-8">

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded-lg">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    <div class="text-center">
        <h1 class="text-3xl font-bold text-emerald-600 mb-2">Request a New Book</h1>
        <p class="text-gray-600 text-lg">Suggest a book you'd like to see in our library collection.</p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-md">
        <div class="mb-5">
            <a href="{{ route('user.dashboard') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-emerald-500 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Back
            </a>
        </div>

        <form action="{{ route('user.book.request.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block text-gray-700 font-semibold mb-2">Book Title <span class="text-red-500">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}" required class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                @error('title') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-2">Author <span class="text-red-500">*</span></label>
                <input type="text" name="author" value="{{ old('author') }}" required class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-emerald-500">
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-2">Publisher <span class="text-red-500">*</span></label>
                <input type="text" name="publisher" value="{{ old('publisher') }}" required class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-emerald-500">
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-2">Reason for Request <span class="text-red-500">*</span></label>
                <textarea name="reason" rows="4" required class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-emerald-500">{{ old('reason') }}</textarea>
                @error('reason') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="w-full bg-emerald-500 hover:bg-emerald-600 text-white font-semibold py-3 rounded-lg transition duration-200">
                Submit Request
            </button>
        </form>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-md">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Your Previous Requests</h2>

        @if ($requests->isEmpty())
            <p class="text-gray-500 text-center py-6">You haven't submitted any book requests yet.</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full border border-gray-200 rounded-lg text-left">
                    <thead class="bg-gray-100 text-gray-700 text-sm uppercase">
                        <tr>
                            <th class="px-4 py-3">Title</th>
                            <th class="px-4 py-3">Author</th>
                            <th class="px-4 py-3">Publisher</th>
                            <th class="px-4 py-3">Reason</th>
                            <th class="px-4 py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-gray-700">
                        @foreach ($requests as $req)
                            <tr>
                                <td class="px-4 py-3 font-semibold">{{ $req->title }}</td>
                                <td class="px-4 py-3">{{ $req->author ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $req->publisher ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $req->reason }}</td>
                                <td class="px-4 py-3">
                                    @if ($req->status === 'pending')
                                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-semibold">
                                            Pending
                                        </span>
                                    @elseif ($req->status === 'approved')
                                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">
                                            Approved
                                        </span>
                                    @elseif ($req->status === 'rejected')
                                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-semibold">
                                            Rejected
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
