@props(['post'])

<a href="{{ route('filamentblog.post.show', ['post' => $post->slug]) }}"
   class="block rounded-xl overflow-hidden shadow-md hover:shadow-xl bg-white transition-all duration-300 hover:-translate-y-1">
    <div class="group/blog-item flex flex-col gap-y-5">
        <!-- Hình ảnh bài viết -->
        <div class="h-[250px] w-full overflow-hidden rounded-t-xl bg-zinc-300">
            <img class="h-full w-full object-cover object-top transition-transform duration-500 group-hover/blog-item:scale-105"
                 src="{{ asset($post->featurePhoto) }}"
                 alt="{{ $post->photo_alt_text }}">
        </div>

        <!-- Nội dung -->
        <div class="flex flex-col justify-between space-y-3 px-4 pb-5">
            <div>
                <h2 title="{{ $post->title }}"
                    class="group-hover/blog-item:text-blue-600 mb-2 line-clamp-2 text-lg sm:text-xl font-semibold transition-colors duration-300">
                    {{ $post->title }}
                </h2>
                <p class="mb-3 line-clamp-3 text-gray-600">
                    {{ Str::limit($post->sub_title, 100) }}
                </p>
            </div>

            <!-- Thông tin tác giả -->
            <div class="flex items-center gap-4 mt-auto">
                <img class="h-10 w-10 overflow-hidden rounded-full bg-zinc-300 object-cover"
                     src="{{ $post->user->avatar }}" alt="{{ $post->user->name() }}">
                <div>
                    <span title="{{ $post->user->name() }}"
                          class="block max-w-[150px] overflow-hidden text-ellipsis whitespace-nowrap text-sm font-semibold">
                          {{ $post->user->name() }}
                    </span>
                    <span class="block whitespace-nowrap text-sm font-medium text-zinc-600">
                        {{ $post->formattedPublishedDate() }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</a>
