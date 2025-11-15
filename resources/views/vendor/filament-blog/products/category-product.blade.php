<x-blog-layout>
    {{-- Tiêu đề danh mục --}}
    <section class="pt-6 sm:pt-10">
        <header class="container mx-auto mb-4 max-w-[800px] px-4 sm:px-6 pb-4 text-center">
            <h1 class="text-xl sm:text-3xl font-semibold tracking-tight text-gray-800">
                Danh Mục: <span class="text-primary-600">{{ $category->name }}</span>
            </h1>
        </header>
    </section>

    {{-- Danh sách sản phẩm --}}
    <section class="pb-14 pt-4 sm:pb-20 sm:pt-6 bg-gray-50">
        <div class="container mx-auto px-3 sm:px-6 lg:px-8">

            {{-- Lưới sản phẩm --}}
            <div
                class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-3 sm:gap-x-6 gap-y-6 sm:gap-y-10">
                @forelse ($products as $product)
                    <div
                        class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden">
                        <x-card-product :product="$product" type="product" />
                    </div>
                @empty
                    <div class="col-span-full flex items-center justify-center py-12">
                        <p class="text-base sm:text-xl font-medium text-gray-400">Không có sản phẩm nào</p>
                    </div>
                @endforelse
            </div>

            {{-- Phân trang --}}
            <div class="mt-10 sm:mt-14 flex justify-center">
                {{ $products->links() }}
            </div>
        </div>
    </section>
</x-blog-layout>
