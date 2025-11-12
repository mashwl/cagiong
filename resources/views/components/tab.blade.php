      @props(['product', 'formattedPhone'])

      <div class="mt-12 bg-white rounded-2xl shadow p-5 sm:p-8">
          {{-- Thanh tab --}}
          <div class="flex justify-center text-center border-b border-gray-200 mb-5 sm:mb-6 overflow-x-auto">
              <button @click="tab = 'info'"
                  :class="tab === 'info'
                      ?
                      'border-b-2 border-primary-600 text-primary-600 bg-primary-50' :
                      'text-gray-600 hover:text-primary-600'"
                  class="py-2.5 sm:py-3 font-semibold transition min-w-[150px] px-4 rounded-t-lg">
                  Thông tin chi tiết
              </button>
          </div>

          <div class="text-gray-700">
              <div x-show="tab === 'info'" x-transition>
                  <div class="prose max-w-none text-gray-700 space-y-3 sm:space-y-4 text-sm sm:text-base">
                      {!! $product->body !!}
                  </div>
              </div>

          </div>
      </div>
