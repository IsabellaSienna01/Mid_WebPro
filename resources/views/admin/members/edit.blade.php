@extends('layouts.app')
<title>Edit Member</title>

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">
    <h1 class="text-xl sm:text-2xl font-bold text-emerald-600 mb-6">Edit Member</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-5 text-sm sm:text-base">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.members.update', $member->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700 mb-2 font-medium">Name</label>
            <input type="text" name="name" value="{{ $member->login->name ?? '' }}" 
                   class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm sm:text-base" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 mb-2 font-medium">Email</label>
            <input type="email" name="email" value="{{ $member->login->email ?? '' }}" 
                   class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm sm:text-base" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 mb-2 font-medium">Phone</label>
            <input type="text" name="phone" value="{{ $member->phone ?? '' }}" 
                   class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm sm:text-base">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 mb-2 font-medium">Address</label>
            <textarea name="address" rows="3"
                      class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm sm:text-base">{{ $member->address ?? '' }}</textarea>
        </div>

        <div class="flex flex-col sm:flex-row justify-end gap-2 mt-4">
            <a href="{{ route('admin.members.index') }}" 
               class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-700 rounded-lg text-sm sm:text-base text-center">
                Cancel
            </a>
            <button type="submit" 
                    class="px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-lg text-sm sm:text-base">
                Update
            </button>
        </div>
    </form>
</div>
@endsection
