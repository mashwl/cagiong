@props(['title' => 'Firefly Blog', 'logo' => null])

<header x-data="{ openMenu: false }" class="sticky top-0 z-50 bg-white/90 backdrop-blur border-b border-gray-100 shadow-sm">
    <div class="container mx-auto flex justify-between items-center px-6 py-4">
        {{-- Logo --}}
        <a href="{{ config('filamentblog.route.home.url') ?? config('app.url') }}" class="flex items-center gap-2">
            @if ($logo)
                <img src="{{ $logo }}" alt="{{ $title }}" class="h-10 w-auto rounded" />
            @else
                <span class="text-2xl font-bold text-primary-600">{{ $title ?: 'Firefly Blog' }}</span>
            @endif
        </a>

        {{-- Desktop Menu --}}
        <nav class="hidden md:flex items-center gap-8 text-gray-700 font-medium">
            <a href="{{ route('filamentblog.post.index') }}" class="hover:text-primary-600 transition">Blogs</a>

            {{-- Categories Dropdown --}}
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="flex items-center gap-1 hover:text-primary-600 transition">
                    <span>Categories</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6" />
                    </svg>
                </button>
                <div x-show="open" @click.away="open = false" 
                     x-transition 
                     class="absolute left-0 mt-2 w-48 bg-white border border-gray-100 rounded-xl shadow-lg overflow-hidden">
                    <x-blog-header-category />
                </div>
            </div>
        </nav>

        {{-- Search Bar --}}
        <form action="{{ route('filamentblog.post.search') }}" method="GET" class="hidden md:block relative">
            <input 
                type="text" 
                name="query"
                placeholder="Search..."
                value="{{ request()->get('query') }}"
                class="rounded-full pl-10 pr-4 py-2 w-56 text-sm text-gray-700 border border-gray-200 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition"
            />
            <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8" />
                <line x1="21" y1="21" x2="16.65" y2="16.65" />
            </svg>
        </form>

        {{-- Mobile Menu Button --}}
        <button @click="openMenu = !openMenu" class="md:hidden text-gray-600 focus:outline-none">
            <svg x-show="!openMenu" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <svg x-show="openMenu" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

{{-- Mobile Menu --}}
<div x-show="openMenu" x-transition class="md:hidden border-t border-gray-100 bg-white">
    <nav class="flex flex-col p-4 space-y-3 text-gray-700 font-medium">
        <a href="{{ route('filamentblog.post.index') }}" class="hover:text-primary-600">Blogs</a>

        {{-- Categories Dropdown --}}
        <div x-data="{ openCat: false }" class="border-t border-gray-100 pt-3">
            <button @click="openCat = !openCat" 
                    class="flex justify-between items-center w-full hover:text-primary-600">
                <span>Categories</span>
                <svg xmlns="http://www.w3.org/2000/svg" 
                     class="h-4 w-4 transform transition-transform duration-200"
                     :class="openCat ? 'rotate-180' : 'rotate-0'" 
                     fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6" />
                </svg>
            </button>

            <div x-show="openCat" x-transition class="pl-4 mt-2 space-y-2 border-l border-gray-100">
                <x-blog-header-category />
            </div>
        </div>

        {{-- Search Bar --}}
        <form action="{{ route('filamentblog.post.search') }}" method="GET" class="mt-3 relative">
            <input type="text" name="query" placeholder="Search..." value="{{ request()->get('query') }}"
                   class="w-full rounded-full pl-10 pr-4 py-2 text-sm text-gray-700 border border-gray-200 
                          focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition" />
            <svg xmlns="http://www.w3.org/2000/svg" 
                 class="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-gray-400" 
                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8" />
                <line x1="21" y1="21" x2="16.65" y2="16.65" />
            </svg>
        </form>
    </nav>
</div>
</header>
