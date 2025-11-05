      @props(['product', 'formattedPhone'])

      <div class="mt-12 bg-white rounded-2xl shadow p-5 sm:p-8">
          {{-- Thanh tab --}}
          <div
              class="flex flex-col sm:grid sm:grid-cols-3 text-center border-b border-gray-200 mb-5 sm:mb-6 overflow-x-auto">
              <button @click="tab = 'info'"
                  :class="tab === 'info'
                      ?
                      'border-b-2 border-primary-600 text-primary-600 bg-primary-50' :
                      'text-gray-600 hover:text-primary-600'"
                  class="py-2.5 sm:py-3 font-semibold transition flex-1 min-w-[150px]">
                  🛈 Thông tin chi tiết
              </button>

              <button @click="tab = 'guide'"
                  :class="tab === 'guide'
                      ?
                      'border-b-2 border-primary-600 text-primary-600 bg-primary-50' :
                      'text-gray-600 hover:text-primary-600'"
                  class="py-2.5 sm:py-3 font-semibold transition flex-1 min-w-[150px]">
                  📦 Hướng dẫn mua hàng
              </button>

              <button @click="tab = 'support'"
                  :class="tab === 'support'
                      ?
                      'border-b-2 border-primary-600 text-primary-600 bg-primary-50' :
                      'text-gray-600 hover:text-primary-600'"
                  class="py-2.5 sm:py-3 font-semibold transition flex-1 min-w-[150px]">
                  ⚙️ Hỗ trợ kỹ thuật
              </button>
          </div>

          <div class="text-gray-700">
              <div x-show="tab === 'info'" x-transition>
                  <div class="prose max-w-none text-gray-700 space-y-3 sm:space-y-4 text-sm sm:text-base">
                      {!! $product->body !!}
                  </div>
              </div>

              <div x-show="tab === 'guide'" x-transition>
                  <p class="text-sm sm:text-base">
                      Liên hệ hotline <strong>{{ $formattedPhone }}</strong> để được tư vấn.
                  </p>
              </div>

              <div x-show="tab === 'support'" x-transition>
                  <p class="text-sm sm:text-base">
                      Đội ngũ kỹ thuật viên sẵn sàng đồng hành cùng bạn 24/7.
                  </p>
              </div>
          </div>
      </div>
