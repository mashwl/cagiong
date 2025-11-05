<x-blog-layout>

    @if (count($posts))


        </header>
        <section class="pb-16 pt-8">
            <header class="container mx-auto px-6">
                <h3
                    class="inherits-color text-balance leading-tighter relative z-10 text-3xl font-semibold tracking-tight">
                    Blogs
                </h3>
            </header>
            <div class="container mx-auto">
                <div class="grid sm:grid-cols-3 gap-x-14 gap-y-14">
                    @foreach ($posts as $post)
                        <x-blog-card :post="$post" />
                    @endforeach
                </div>
            </div>
        </section>
    @else
        <div class="container  mx-auto">
            <div class="flex justify-center">
                <p class="text-2xl font-semibold text-gray-300">No posts found</p>
            </div>
        </div>
    @endif
    @if (count($products))
        <section class="pb-16 pt-8">
            <div class="container mx-auto">
                <div class="grid sm:grid-cols-3 gap-x-14 gap-y-14">
                    @foreach ($products as $product)
                        <x-filament-blog::card-product :product="$product" />
                    @endforeach
                </div>
            </div>
        </section>
    @else
        <div class="container  mx-auto">
            <div class="flex justify-center">
                <p class="text-2xl font-semibold text-gray-300">No product found</p>
            </div>
        </div>
    @endif 
</x-blog-layout>

