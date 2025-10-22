@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-10 space-y-8">
    <div class="bg-white shadow-md rounded-2xl p-6 text-center">
        <h1 class="text-3xl font-bold text-emerald-600 mb-2">
            Hi, {{ Auth::user()->name }}!
        </h1>
        <p class="text-gray-600 text-lg">
            Good to see you back. Let's continue reading!
        </p>

        <p class="text-sm text-gray-500 mt-5">
            Can't find the book you're looking for?
            <a href="{{ route('user.book.request') }}" class="text-emerald-500 font-semibold hover:underline">
                Let us know!
            </a>
        </p>
    </div>

    <div class="grid md:grid-cols-3 gap-6">
        <div class="bg-emerald-50 p-6 rounded-xl shadow">
            <h3 class="text-gray-600 text-sm">Total Borrowed Books</h3>
            <p class="text-3xl font-bold text-emerald-600">{{ $totalBorrowedBooks }}</p>
        </div>

        <div class="bg-blue-50 p-6 rounded-xl shadow">
            <h3 class="text-gray-600 text-sm">Active Loans</h3>
            <p class="text-3xl font-bold text-blue-600">{{ $activeLoans->count() }}</p>
        </div>

        <div class="bg-red-50 p-6 rounded-xl shadow">
            <h3 class="text-gray-600 text-sm">Nearest Due Date</h3>
            @if($nearestDue)
                <p class="text-lg font-semibold text-red-600">
                    {{ $nearestDue->due_date->format('d M Y') }}
                </p>
            @else
                <p class="text-gray-500 text-sm">No active loans</p>
            @endif
        </div>
    </div>

    <div class="bg-white p-6 rounded-xl shadow">
        <h2 class="text-lg font-semibold mb-3">Books Currently Borrowed</h2>
        @if ($activeLoans->isEmpty())
            <p class="text-gray-500">You have no active loans.</p>
        @else
            <ul class="space-y-3">
                @foreach ($activeLoans as $loan)
                    <li class="flex justify-between items-center border-b border-gray-100 pb-2">
                        <div>
                            <span class="font-semibold">{{ $loan->loanDetails->book->title ?? 'Unknown Book' }}</span>
                            <span class="text-sm text-gray-500">
                                — due {{ $loan->due_date->format('d M Y') }}
                            </span>
                        </div>
                        <div class="flex gap-3 mt-3">
                            <a href="{{ route('user.book.detail', $loan->loanDetails->book_id) }}" 
                            class="px-3 py-2 bg-blue-50 text-blue-600 rounded-lg text-sm font-medium hover:bg-blue-100 transition">
                                View Details
                            </a>

                            <form action="{{ route('user.book.return', $loan->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to return this book?');">
                                @csrf
                                @method('PUT')
                                <button type="submit" 
                                        class="px-3 py-2 bg-red-50 text-red-600 rounded-lg text-sm font-medium hover:bg-red-100 transition">
                                    Return
                                </button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <div class="bg-white shadow-md rounded-2xl p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">
            Recent Borrowing History
        </h2>

        @if ($recentLoans->isEmpty())
            <div class="text-gray-500 text-center py-6">
                <p>No recent borrowing activity.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border border-gray-200 rounded-lg">
                    <thead class="bg-gray-100 text-gray-700 text-sm uppercase">
                        <tr>
                            <th class="px-4 py-3">Loan Date</th>
                            <th class="px-4 py-3">Due Date</th>
                            <th class="px-4 py-3">Return Date</th>
                            <th class="px-4 py-3">Books</th>
                            <th class="px-4 py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 divide-y divide-gray-200">
                        @foreach ($recentLoans as $loan)
                            <tr>
                                <td class="px-4 py-3">
                                    {{ \Carbon\Carbon::parse($loan->loan_date)->format('d M Y') }}
                                </td>
                                <td class="px-4 py-3">
                                    {{ \Carbon\Carbon::parse($loan->due_date)->format('d M Y') }}
                                </td>
                                <td class="px-4 py-3">
                                    {{ $loan->return_date ? \Carbon\Carbon::parse($loan->return_date)->format('d M Y') : '-' }}
                                </td>
                                <td class="px-4 py-3">
                                    <div>
                                        {{ $loan->loanDetails->book->title ?? 'Unknown Book' }}
                                        <span class="text-sm text-gray-500">x{{ $loan->loanDetails->quantity }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    @if (is_null($loan->return_date))
                                        @if ($loan->is_overdue ?? false)
                                            <span class="bg-red-200 text-red-700 px-3 py-1 rounded-full text-sm font-semibold">
                                                Overdue
                                            </span>
                                        @else
                                            <span class="bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full text-sm font-semibold">
                                                Borrowed
                                            </span>
                                        @endif
                                    @else
                                        <span class="bg-gray-200 text-gray-700 px-3 py-1 rounded-full text-sm font-semibold">
                                            Returned
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="text-left mt-4">
                <a href="{{ route('user.histories') }}" class="text-emerald-600 font-semibold hover:underline">
                    View full history →
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
