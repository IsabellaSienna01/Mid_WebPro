@extends('layouts.app')

@section('content')

    <main id="books" class="flex-1 container mx-auto p-6">
		<h3 class="text-2xl font-semibold mb-4 text-center">Our Book Collections</h3>
		<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
			@foreach ($books as $book)
			<div class="bg-white rounded-xl shadow hover:shadow-lg transition p-4 flex flex-col">
				<img src="{{ asset('storage/books/' . $book->image) }}" class="rounded-md mb-3 h-48 w-full object-cover">
				<h4 class="font-bold text-lg mb-1">{{ $book->title }}</h4>
				<p class="text-sm text-gray-600 mb-3">{{ Str::limit($book->author, 40) }}</p>
				<a href="{{ route('user.book.detail', $book->id) }}" class="mt-auto bg-emerald-500 text-white font-semibold py-1 rounded text-center hover:bg-emerald-600">
					View Details
				</a>
			</div>
			@endforeach
		</div>
		<br>
	</main>
	<br>
	<div>
		<p class="text-gray-500 mt-5 text-center">
			Can't find the book you're looking for?
			<a href="{{ route('user.book.request') }}" class="text-emerald-500 font-semibold hover:underline">
				Let us know!
			</a>
		</p>
	</div>
@endsection
