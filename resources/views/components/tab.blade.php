@props(['product', 'formattedPhone'])

<div class="mt-2 bg-white rounded-xl shadow p-4 sm:p-6">
    <div class="flex justify-center border-b border-gray-200 mb-3 overflow-x-auto">
        <div
            class="py-1.5 font-semibold text-primary-600  min-w-[150px] px-3 rounded-t bg-primary-50 text-center text-lg uppercase">
            Thông tin chi tiết
        </div>
    </div>

    <div class="text-gray-700 text-sm sm:text-base">
        <div class="prose max-w-none space-y-2 sm:space-y-3">
            {!! $product->body !!}
        </div>
    </div>
</div>
