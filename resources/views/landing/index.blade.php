<!DOCTYPE html>
<html class="scroll-smooth" lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Libry - Knowledge at Your Fingertips</title>
	@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="pt-16 bg-gray-100 text-gray-800 flex flex-col min-h-screen">

	<header id="navbar" class="fixed top-0 left-0 w-full bg-white shadow-md p-4 flex justify-between items-center transition-transform duration-300 z-50">
		<h1 class="text-2xl font-bold text-blue-600">Libry</h1>
		<div>
			<a href="{{ url('/login') }}" class="text-sm font-semibold text-gray-700 hover:text-blue-600 mx-3">Login</a>
			<a href="{{ url('/register') }}" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 text-sm font-semibold">Daftar</a>
		</div>
	</header>


	<section class="text-center bg-gradient-to-r from-blue-500 to-indigo-600 text-white py-32 px-4">
		<h2 class="text-4xl font-bold mb-4">Knowledge at Your Fingertips</h2>
		<p class="text-lg mb-6">Libry is your personal digital library. Explore millions of curated titles, journals, and resources, available anytime, anywhere.</p>
		<a href="#books" class="bg-white text-blue-600 font-semibold px-5 py-2 rounded hover:bg-gray-100">Browse Collections</a>
	</section>

	<main id="books" class="flex-1 flex flex-col items-center p-6">
	<h3 class="text-2xl font-semibold mb-6 text-center">Our Book Collections</h3>

	<div class="relative w-full max-w-4xl overflow-hidden">
		<button id="prev" class="absolute left-3 top-1/2 -translate-y-1/2 bg-white shadow-md p-3 rounded-full hover:bg-blue-100 z-10">
		‹
		</button>

		<div id="book-carousel" class="flex transition-transform duration-700 ease-in-out">
		@foreach ($books as $book)
		<div class="min-w-full flex-shrink-0 bg-white rounded-2xl shadow-lg p-6 flex flex-col sm:flex-row items-center gap-6">
			<img src="{{ $book->cover_url ?? 'https://via.placeholder.com/200x300' }}" class="rounded-xl w-48 h-64 object-cover flex-shrink-0">
			<div class="ml-4 flex flex-col justify-between h-full text-center sm:text-left">
			<div>
				<h4 class="font-bold text-2xl mb-2 break-words leading-tight">{{ $book->title }}</h4>
				<p class="text-gray-600 text-sm mb-4">{{ Str::limit($book->author, 80) }}</p>
				<p class="text-gray-700 text-base mb-4 break-words">
				{{ Str::limit($book->description ?? 'Tidak ada deskripsi untuk buku ini.', 200) }}
				</p>
			</div>
			<a href="{{ route('landing.detail', $book->id) }}" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 text-sm sm:w-40 mx-auto sm:mx-0 text-center">
				View Details
			</a>
			</div>
		</div>
		@endforeach
		</div>

		<button id="next" class="absolute right-3 top-1/2 -translate-y-1/2 bg-white shadow-md p-3 rounded-full hover:bg-blue-100 z-10">
		›
		</button>
	</div>
	</main>




	@include('layouts.footer')

</body>

</html>