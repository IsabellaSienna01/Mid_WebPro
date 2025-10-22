@extends('layouts.app')

@section('content')
<div class="p-6 bg-gray-50 min-h-screen">

    @if(session('success'))
        <div class="max-w-3xl mx-auto mb-4">
            <div class="bg-green-100 text-green-800 px-4 py-3 rounded-lg shadow">
                {{ session('success') }}
            </div>
        </div>
    @endif

    <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow p-8">
        <div class="flex flex-col items-center mb-6">
            @php
                $profilePic = ($member && $member->profile_picture)
                    ? asset('storage/profile_pictures/' . $member->profile_picture)
                    : asset('default-avatar.png');
            @endphp

            <img src="{{ $profilePic }}" alt="Profile Picture"
                 class="w-32 h-32 rounded-full border-4 border-indigo-100 shadow mb-4 object-cover">

            <h2 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h2>
            <p class="text-gray-500">{{ $user->email }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div class="bg-gray-50 p-4 rounded-xl">
                <h3 class="text-sm text-gray-500 font-semibold uppercase">Address</h3>
                <p class="text-gray-800 mt-1">{{ $member->address ?? '-' }}</p>
            </div>
            <div class="bg-gray-50 p-4 rounded-xl">
                <h3 class="text-sm text-gray-500 font-semibold uppercase">Phone</h3>
                <p class="text-gray-800 mt-1">{{ $member->phone ?? '-' }}</p>
            </div>
        </div>

        <div class="text-center">
            <a href="{{ route('user.profile.edit') }}"
               class="bg-indigo-600 text-white px-6 py-2 rounded-xl hover:bg-indigo-700 transition shadow">
                Edit Profile
            </a>
        </div>
    </div>

</div>
@endsection
