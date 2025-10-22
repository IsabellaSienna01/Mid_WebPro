@extends('layouts.app')
<title>Edit Fine</title>

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">

    <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
        <h1 class="text-xl sm:text-2xl font-bold text-emerald-500">Edit Fine Payment</h1>
    </div>

    @if ($errors->any())
        <div class="mb-5 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm sm:text-base">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white p-4 sm:p-6 rounded-2xl shadow-lg">
        <p class="mb-4 text-gray-700 text-sm sm:text-base space-y-1">
            <span><strong>Loan ID:</strong> {{ $fine->loan_id }}</span><br>
            <span><strong>Member:</strong> {{ $fine->loan->member->login->name ?? '-' }}</span><br>
            <span><strong>Total Fine:</strong> Rp.{{ number_format($fine->amount, 2) }}</span>
        </p>

        <form action="{{ route('admin.loans.update', $fine->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-gray-700 mb-2 font-medium text-sm sm:text-base">Mark as Paid?</label>
                <select name="paid" class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm sm:text-base">
                    <option value="1" {{ $fine->paid ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ !$fine->paid ? 'selected' : '' }}>No</option>
                </select>
            </div>

            <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 mt-6">
                <button type="submit" 
                        class="w-full sm:w-auto bg-emerald-500 text-white px-4 py-2 rounded-lg font-semibold shadow hover:bg-emerald-600 transition text-sm sm:text-base">
                    Update
                </button>
                <a href="{{ route('admin.loans.index') }}" 
                   class="w-full sm:w-auto bg-gray-200 text-gray-800 px-4 py-2 rounded-lg font-semibold shadow hover:bg-gray-300 transition text-sm sm:text-base text-center">
                   Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
