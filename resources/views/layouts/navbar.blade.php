<nav id="navbar" class="fixed top-0 left-0 w-full bg-white shadow-md p-4 flex justify-between items-center transition-transform duration-300 z-50">
    <h1 class="text-2xl font-bold text-emerald-500">Libry</h1>
    @auth
    <ul class="flex space-x-6 text-lg">
        <li><a href="/dashboard" class="text-sm font-semibold text-gray-700 hover:text-emerald-500 mx-3">
            Home
        </a></li>
        <li><a href="/books" class="text-sm font-semibold text-gray-700 hover:text-emerald-500 mx-3">
            Books
        </a></li>
        <li><a href="/profile" class="text-sm font-semibold text-gray-700 hover:text-emerald-500 mx-3">
            Profile
        </a></li>
    </ul>
    @endauth

    @guest
    <div>
        <a href="{{ url('/login') }}" class="text-sm font-semibold text-gray-700 hover:text-emerald-500 mx-3">
            Login
        </a>
        <a href="{{ url('/register') }}" class="bg-emerald-500 text-white px-3 py-1 rounded hover:bg-emerald-600 text-sm font-semibold">
            Register
        </a>
    </div>
    @endguest
</nav>