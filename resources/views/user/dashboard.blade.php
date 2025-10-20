@extends('layouts.app')

@section('content')
<div class="p-6 bg-gray-50 min-h-screen">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Hi, {{ Auth::user()->name }}!</h1>
        <p class="text-gray-600 mt-1">Good to see you back! Let's continue reading today.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white p-4 rounded-2xl shadow">
            <h2 class="text-gray-500 text-sm">Borrowed Books</h2>
            <p class="text-3xl font-semibold text-indigo-600">3</p>
        </div>
        <div class="bg-white p-4 rounded-2xl shadow">
            <h2 class="text-gray-500 text-sm">Nearest Due Date</h2>
            <p class="text-xl font-semibold text-red-500">22 Oct 2025</p>
        </div>
        <div class="bg-white p-4 rounded-2xl shadow">
            <h2 class="text-gray-500 text-sm">Total Histories</h2>
            <p class="text-3xl font-semibold text-green-600">15</p>
        </div>
        <div class="bg-white p-4 rounded-2xl shadow">
            <h2 class="text-gray-500 text-sm">Favourite Category</h2>
            <p class="text-lg font-semibold text-blue-600">Technology</p>
        </div>
    </div>

    <div class="mb-8">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Book Recommendations</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach ($recommendedBooks as $book)
                <div class="bg-white p-4 rounded-2xl shadow hover:shadow-md transition">
                    <h3 class="text-lg font-semibold text-indigo-700">{{ $book->title }}</h3>
                    <p class="text-sm text-gray-600 mb-2">by {{ $book->author }}</p>
                    <a href="{{ route('user.books.detail', $book->id) }}" class="text-sm text-blue-500 hover:underline">
                        View Details
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <div class="mb-8">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Recent Histories</h2>
        <table class="w-full bg-white rounded-2xl shadow overflow-hidden">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="text-left p-3">Title</th>
                    <th class="text-left p-3">Date Borrowed</th>
                    <th class="text-left p-3">Date Returned</th>
                    <th class="text-left p-3">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($recentHistories as $history)
                    <tr class="border-b">
                        <td class="p-3">{{ $history->book->title }}</td>
                        <td class="p-3">{{ $history->borrow_date }}</td>
                        <td class="p-3">{{ $history->return_date ?? '-' }}</td>
                        <td class="p-3">
                            <span class="px-2 py-1 text-sm rounded-xl 
                                {{ $history->status == 'borrowed' ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700' }}">
                                {{ ucfirst($history->status) }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="flex gap-4 mt-6">
        <a href="{{ route('user.books.index') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-xl hover:bg-indigo-700 transition">
            View Book Collections
        </a>
        <a href="{{ route('user.histories') }}" class="bg-green-600 text-white px-4 py-2 rounded-xl hover:bg-green-700 transition">
            Histories
        </a>
        <a href="{{ route('user.profile') }}" class="bg-gray-600 text-white px-4 py-2 rounded-xl hover:bg-gray-700 transition">
            Profile
        </a>
    </div>

</div>
@endsection
