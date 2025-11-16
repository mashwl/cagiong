<x-blog-layout>
    <section>
        <header class="container mx-auto mb-4 max-w-[800px] px-6 pb-4 mt-10 text-center">
            <h3 class="text-3xl sm:text-4xl md:text-5xl font-semibold tracking-tight leading-tight">
                Kết quả tìm kiếm cho "{{ request()->query('query') }}"
            </h3>
        </header>
    </section>
    <section class="pb-16 pt-8">
        <div class="container mx-auto">
            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 gap-x-6 sm:gap-x-10 gap-y-10">

                @forelse ($posts as $post)
                    <x-blog-card :post="$post" />
                @empty
                    <div class="flex col-span-2 sm:col-span-2 md:col-span-3 justify-center w-full">
                        <h2 class="text-xl sm:text-2xl text-gray-300 font-semibold">Không có kết quả nào phù hợp</h2>
                    </div>
                @endforelse
            </div>
            <div class="mt-20">
                {{ $posts->links() }}
            </div>
        </div>
    </section>

</x-blog-layout>
