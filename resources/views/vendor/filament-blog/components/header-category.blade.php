<div class="top-20 min-w-[15rem] origin-left transition duration-200 translate-y-0">
    <div class="relative z-0  border-gray-300 bg-gray-200 py-4 shadow-md">
        <div class="max-h-[65vh] list-none overflow-y-auto transition-all duration-300 translate-y-0 opacity-100">
            @foreach($categories as $category)
                <a href="{{ route('filamentblog.category.post', ['category' => $category->slug]) }}"
                   class="block px-6 py-2 text-sm font-medium capitalize transition-all duration-200 hover:bg-gray-300 hover:text-primary-600">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>
    </div>
</div>
