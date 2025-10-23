<!DOCTYPE html>
<html class="scroll-smooth" lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Libry - Knowledge at Your Fingertips</title>
	@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="pt-16 bg-gray-100 text-gray-800 flex flex-col min-h-screen">

	@include('layouts.navbar')

	<section class="text-center bg-gradient-to-r from-green-400 to-emerald-500 text-white py-32 px-4">
		<h2 class="text-4xl font-bold mb-4">Knowledge at Your Fingertips</h2>
		<p class="text-lg mb-6">Libry is your personal digital library. Explore millions of curated titles, journals, and resources, available anytime, anywhere.</p>
		<a href="#books" class="bg-white text-emerald-500 font-semibold px-5 py-2 rounded hover:bg-gray-100">Browse Collections</a>
	</section>

	<main id="books" class="flex-1 container mx-auto p-6">
		<h3 class="text-2xl font-semibold mb-4 text-center">Our Book Collections</h3>
		<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
			@foreach ($books as $book)
			<div class="bg-white rounded-xl shadow hover:shadow-lg transition p-4 flex flex-col">
				<img src="{{ asset('storage/books/' . $book->image) }}" class="rounded-md mb-3 h-48 w-full object-cover">
				<h4 class="font-bold text-lg mb-1">{{ $book->title }}</h4>
				<p class="text-sm text-gray-600 mb-3">{{ Str::limit($book->author, 40) }}</p>
				<a href="{{ route('landing.detail', $book->id) }}" class="mt-auto bg-emerald-500 text-white font-semibold py-1 rounded text-center hover:bg-emerald-600">
					View Details
				</a>
			</div>
			@endforeach
		</div>
	</main>

	@include('layouts.footer')

</body>

</html>