@extends('layouts.app')
<title>Borrow Records</title>

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">

    <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
        <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Borrow Records</h1>
        <a href="{{ route('admin.dashboard') }}" 
           class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-lg font-semibold shadow text-sm sm:text-base">
           Back to Dashboard
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-5 text-sm sm:text-base">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-md rounded-2xl overflow-x-auto">
        <table class="w-full min-w-[800px] border-collapse text-sm sm:text-base">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-3 text-left">Member</th>
                    <th class="px-4 py-3 text-left">Books</th>
                    <th class="px-4 py-3 text-left">Loan Date</th>
                    <th class="px-4 py-3 text-left">Due Date</th>
                    <th class="px-4 py-3 text-left">Return Date</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-left">Total Fine</th>
                    <th class="px-4 py-3 text-left">Paid?</th>
                    <th class="px-4 py-3 text-left">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($loans as $loan)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium">{{ $loan->member->login->name ?? '-' }}</td>
                        <td class="px-4 py-3">
                            @foreach($loan->loanDetails as $detail)
                                <div class="text-gray-700">{{ $detail->book->title ?? '-' }} (x{{ $detail->quantity }})</div>
                            @endforeach
                        </td>
                        <td class="px-4 py-3 text-gray-700">{{ $loan->loan_date->format('d M Y') }}</td>
                        <td class="px-4 py-3 text-gray-700">{{ $loan->due_date->format('d M Y') }}</td>
                        <td class="px-4 py-3 text-gray-700">{{ $loan->return_date ? $loan->return_date->format('d M Y') : '-' }}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 text-xs sm:text-sm rounded-xl
                                @switch($loan->status)
                                    @case('borrowed') bg-yellow-100 text-yellow-700 @break
                                    @case('returned') bg-green-100 text-green-700 @break
                                    @case('late') bg-red-100 text-red-700 @break
                                    @default bg-gray-100 text-gray-700
                                @endswitch">
                                {{ ucfirst($loan->status) ?? 'Unknown' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-gray-700">
                            Rp.{{ number_format($loan->fines->sum('amount'), 2) }}
                        </td>
                        <td class="px-4 py-3">
                            @php
                                $allPaid = $loan->fines->every(fn($fine) => $fine->paid);
                            @endphp
                            <span class="px-2 py-1 text-xs sm:text-sm rounded-xl 
                                  {{ $allPaid ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $allPaid ? 'Yes' : 'No' }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            @if($loan->fines->count())
                                <a href="{{ route('admin.loans.edit', $loan->fines->first()->id) }}" 
                                class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1 rounded text-xs sm:text-sm whitespace-nowrap">
                                    Edit Paid
                                </a>
                            @else
                                <span class="text-gray-400 text-xs sm:text-sm">No fines</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="px-4 py-4 text-center text-gray-500">No borrow records found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $loans->links() }}
    </div>
</div>
@endsection
