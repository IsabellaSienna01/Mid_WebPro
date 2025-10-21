@extends('layouts.app')
<title>Dashboard</title>

@section('content')
<div class="p-6 bg-gray-50 min-h-screen">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Welcome back, {{ Auth::user()->name }}</h1>
        <p class="text-gray-600 mt-1">Here’s an overview of the library’s current status.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white p-4 rounded-2xl shadow">
            <h2 class="text-gray-500 text-sm">Total Books</h2>
            <p class="text-3xl font-semibold text-indigo-600">{{ $stats['books'] }}</p>
        </div>
        <div class="bg-white p-4 rounded-2xl shadow">
            <h2 class="text-gray-500 text-sm">Total Members</h2>
            <p class="text-3xl font-semibold text-green-600">{{ $stats['members'] }}</p>
        </div>
        <div class="bg-white p-4 rounded-2xl shadow">
            <h2 class="text-gray-500 text-sm">Books Borrowed</h2>
            <p class="text-3xl font-semibold text-yellow-600">{{ $stats['borrowed'] }}</p>
        </div>
        <div class="bg-white p-4 rounded-2xl shadow">
            <h2 class="text-gray-500 text-sm">Books Returned</h2>
            <p class="text-3xl font-semibold text-blue-600">{{ $stats['returned'] }}</p>
        </div>
    </div>

    <div class="mb-8">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Recent Loan Activities</h2>
        <table class="w-full bg-white rounded-2xl shadow overflow-hidden">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="text-left p-3">Member</th>
                    <th class="text-left p-3">Books</th>
                    <th class="text-left p-3">Loan Date</th>
                    <th class="text-left p-3">Return Date</th>
                    <th class="text-left p-3">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($recentActivities as $activity)
                    <tr class="border-b">
                        <td class="p-3 font-medium">{{ $activity->member->login->name ?? '-' }}</td>
                        <td class="p-3">
                            @foreach ($activity->loanDetails as $detail)
                                <div class="text-sm text-gray-700">📘 {{ $detail->book->title ?? '-' }}</div>
                            @endforeach
                        </td>
                        <td class="p-3 text-gray-700">{{ $activity->loan_date->format('d M Y') }}</td>
                        <td class="p-3 text-gray-700">{{ $activity->return_date ? $activity->return_date->format('d M Y') : '-' }}</td>
                        <td class="p-3">
                                @php
                                    $status = $activity->status ?? 'unknown';
                                @endphp
                            <span class="px-2 py-1 text-sm rounded-xl 
                            @switch($status)
                                @case('borrowed') bg-yellow-100 text-yellow-700 @break
                                @case('returned') bg-green-100 text-green-700 @break
                                @default bg-red-100 text-red-700
                            @endswitch">
                                {{ ucfirst($activity->status) }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-4 text-center text-gray-500">No recent activities found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="flex flex-wrap gap-4 mt-6">
        <a href="{{ route('admin.books') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-xl hover:bg-indigo-700 transition">
            Manage Books
        </a>
        <a href="#" class="bg-green-600 text-white px-4 py-2 rounded-xl hover:bg-green-700 transition">
            Manage Members
        </a>
        <a href="#" class="bg-yellow-600 text-white px-4 py-2 rounded-xl hover:bg-yellow-700 transition">
            View Borrow Records
        </a>
    </div>

</div>
@endsection
