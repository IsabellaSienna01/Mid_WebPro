@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-10 p-6 bg-white shadow-lg rounded-2xl">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Borrowing History</h1>

    @if ($loans->isEmpty())
        <div class="text-center py-16 text-gray-500">
            <p>You haven't borrowed any books yet.</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-left border border-gray-200 rounded-lg">
                <thead class="bg-gray-100 text-gray-700 text-sm uppercase">
                    <tr>
                        <th class="px-4 py-3">Loan Date</th>
                        <th class="px-4 py-3">Due Date</th>
                        <th class="px-4 py-3">Books</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Fine</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 divide-y divide-gray-200">
                    @foreach ($loans as $loan)
                        <tr>
                            <td class="px-4 py-3">{{ \Carbon\Carbon::parse($loan->loan_date)->format('d M Y') }}</td>
                            <td class="px-4 py-3">{{ \Carbon\Carbon::parse($loan->due_date)->format('d M Y') }}</td>
                            <td class="px-4 py-3">
                                {{ $loan->loanDetails->book->title ?? 'Unknown Book' }}
                                <span class="text-sm text-gray-500">x{{ $loan->loanDetails->quantity }}</span>
                            </td>
                            <td class="px-4 py-3">
                                @if (is_null($loan->return_date))
                                    <span class="bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full text-sm font-semibold">Borrowed</span>
                                @else
                                    @if ($loan->is_overdue)
                                        <span class="bg-red-200 text-red-700 px-3 py-1 rounded-full text-sm font-semibold">Overdue</span>
                                    @else
                                        <span class="bg-gray-200 text-gray-700 px-3 py-1 rounded-full text-sm font-semibold">Returned</span>
                                    @endif
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                @if ($loan->fine > 0)
                                    <span class="text-red-500 font-semibold">Rp {{ number_format($loan->fine, 0, ',', '.') }}</span>
                                @else
                                    <span class="text-gray-500">-</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
