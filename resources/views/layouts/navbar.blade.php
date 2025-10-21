<nav id="navbar" class="fixed top-0 left-0 w-full bg-white shadow-md p-4 flex justify-between items-center border-b transition-transform duration-300 z-50">
    <h1 class="text-2xl font-bold text-emerald-500">
        <a href="#" class="hover:underline">
            Libry
        </a>
    </h1>
    
    @auth
        @if (Auth::user()->role === 'user')
        <ul class="flex space-x-6 text-lg items-center">
            <li><a href="{{ route('user.dashboard') }}" class="text-sm font-semibold text-gray-700 hover:text-emerald-500 mx-3">
                Home
            </a></li>
            <li><a href="{{ route('user.books.index') }}" class="text-sm font-semibold text-gray-700 hover:text-emerald-500 mx-3">
                Books
            </a></li>
            <li><a href="{{ route('user.histories') }}" class="text-sm font-semibold text-gray-700 hover:text-emerald-500 mx-3">
                Histories
            </a></li>
            <li class="relative group">
                <button class="text-sm font-semibold text-gray-700 hover:text-emerald-500 mx-3 flex items-center">
                    Profile
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div class="absolute left-0 top-full h-3 w-full bg-transparent"></div>

                <div class="absolute right-0 mt-2 w-44 bg-white border border-gray-200 rounded-lg shadow-lg opacity-0 group-hover:opacity-100 group-hover:visible invisible transition duration-200">
                    <div class="px-4 py-2 border-b border-gray-100 text-gray-600 text-sm cursor-default">
                        <p class="font-semibold">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-400">{{ Auth::user()->email }}</p>
                    </div>

                    <a href="{{ route('user.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-emerald-50 hover:text-emerald-600">
                        Edit Profile
                    </a>
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-emerald-50 hover:text-emerald-600">
                            Logout
                        </button>
                    </form>
                </div>
            </li>
        </ul>

        @elseif (Auth::user()->role === 'admin')
        <ul class="flex space-x-6 text-lg pr-6">
            <li><a href="{{ route ('admin.dashboard') }} " class="text-sm font-semibold text-gray-700 hover:text-emerald-500 mx-3">
                Dashboard
            </a></li>
            <li><a href="{{ route ('admin.categories.index') }}" class="text-sm font-semibold text-gray-700 hover:text-emerald-500 mx-3">
                Categories
            </a></li>
            <li><a href="{{ route ('admin.books') }}" class="text-sm font-semibold text-gray-700 hover:text-emerald-500 mx-3">
                Books
            </a></li>
            <li><a href="{{ route('admin.members.index') }}" class="text-sm font-semibold text-gray-700 hover:text-emerald-500 mx-3">
                Members
            </a></li>
            <li><a href="#" class="text-sm font-semibold text-gray-700 hover:text-emerald-500 mx-3">
                Borrows
            </a></li>

            <li>
            <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button type="submit"
                class="text-sm font-semibold text-gray-700 hover:text-emerald-500 focus:outline-none">
                Logout
            </button>
             </form>
            </li>
        </ul>
        @endif
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