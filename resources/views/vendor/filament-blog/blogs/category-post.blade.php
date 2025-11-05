<x-blog-layout>
    <section>
        <header class="container mx-auto mb-4 max-w-[800px] px-4 sm:px-6 pb-4 mt-6 sm:mt-10 text-center">
            <p class="inherits-color text-balance leading-tighter relative z-10 text-2xl sm:text-3xl font-semibold tracking-tight">
                Danh Mục: {{ $category->name }}
            </p>
        </header>
    </section>

    <section class="pb-12 pt-6 sm:pb-16 sm:pt-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Responsive grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-6 sm:gap-x-10 gap-y-10 sm:gap-y-14">
                @forelse ($posts as $post)
                    <x-blog-card :post="$post" />
                @empty
                    <div class="mx-auto col-span-1 sm:col-span-2 lg:col-span-3">
                        <div class="flex items-center justify-center">
                            <p class="text-xl sm:text-2xl font-semibold text-gray-400">Không có bài viết nào</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-12 sm:mt-20 flex justify-center">
                {{ $posts->links() }}
            </div>
        </div>
    </section>
</x-blog-layout>
