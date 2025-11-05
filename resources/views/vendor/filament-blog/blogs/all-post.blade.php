<x-blog-layout>
    <section class="py-10">
        <header class="container mx-auto px-4 sm:px-6">
            <h4 class="inherits-color uppercase text-balance leading-tighter relative z-10 text-2xl sm:text-3xl font-semibold tracking-tight text-center sm:text-left">
                Kỹ thuật nuôi
            </h4>
        </header>
    </section>

    <section class="pb-16 pt-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-x-6 sm:gap-x-10 gap-y-10 sm:gap-y-14">
                @forelse ($posts as $post)
                    <div class="rounded-xl overflow-hidden shadow hover:shadow-xl transition-all duration-300 bg-white">
                        <x-blog-card :post="$post" />
                    </div>
                @empty
                    <div class="mx-auto col-span-1 sm:col-span-2 lg:col-span-4">
                        <div class="flex items-center justify-center">
                            <p class="text-xl sm:text-2xl font-semibold text-gray-400">Không có bài viết nào</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="mt-12 sm:mt-20 flex justify-center">
                {{ $posts->links() }}
            </div>
        </div>
    </section>
</x-blog-layout>
