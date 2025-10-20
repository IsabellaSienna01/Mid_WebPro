<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Perpustakaan Digital</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 flex flex-col min-h-screen">

  <header class="bg-white shadow-md p-4 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-blue-600">📚 Perpustakaan Digital</h1>
    <div>
      <a href="{{ url('/login') }}" class="text-sm font-semibold text-gray-700 hover:text-blue-600 mx-3">Login</a>
      <a href="{{ url('/register') }}" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 text-sm font-semibold">Daftar</a>
    </div>
  </header>

  <section class="text-center bg-gradient-to-r from-blue-500 to-indigo-600 text-white py-16 px-4">
    <h2 class="text-4xl font-bold mb-4">Selamat Datang di Sistem Perpustakaan Digital</h2>
    <p class="text-lg mb-6">Temukan, jelajahi, dan baca buku dari berbagai kategori — langsung dari browser Anda.</p>
    <a href="#books" class="bg-white text-blue-600 font-semibold px-5 py-2 rounded hover:bg-gray-100">Lihat Koleksi Buku</a>
  </section>

  <main id="books" class="flex-1 container mx-auto p-6">
    <h3 class="text-2xl font-semibold mb-4 text-center">📖 Koleksi Buku Kami</h3>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
      @foreach ($books as $book)
        <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-4 flex flex-col">
          <img src="{{ $book->cover_url ?? 'https://via.placeholder.com/150' }}" class="rounded-md mb-3 h-48 w-full object-cover">
          <h4 class="font-bold text-lg mb-1">{{ $book->title }}</h4>
          <p class="text-sm text-gray-600 mb-3">{{ Str::limit($book->author, 40) }}</p>
          <a href="{{ route('landing.detail', $book->id) }}" class="mt-auto bg-blue-600 text-white py-1 rounded text-center hover:bg-blue-700">Lihat Detail</a>
        </div>
      @endforeach
    </div>
  </main>

  <footer class="bg-white text-center py-3 text-gray-600 text-sm border-t">
    &copy; {{ date('Y') }} Perpustakaan Digital — Dibuat dengan ❤️ menggunakan Laravel & TailwindCSS
  </footer>

</body>
</html>
