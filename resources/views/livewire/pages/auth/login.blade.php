<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.app')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
public function login()
{
    $this->validate();

    $this->form->authenticate();

    Session::regenerate();

    return redirect()->route('home');

}


}; ?>

<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-md mx-auto bg-white shadow-xl rounded-2xl p-8">
            <h2 class="text-3xl font-bold text-center text-sky-900 mb-8">
                Đăng nhập tài khoản
            </h2>

            <form wire:submit="login" class="space-y-6">
                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input
                        wire:model="form.email"
                        type="email"
                        id="email"
                        name="email"
                        required
                        autofocus
                        class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 p-3"
                    >
                    <x-input-error :messages="$errors->get('form.email')" class="mt-2 text-red-500 text-sm" />
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Mật khẩu</label>
                    <input
                        wire:model="form.password"
                        type="password"
                        id="password"
                        name="password"
                        required
                        class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 p-3"
                    >
                    <x-input-error :messages="$errors->get('form.password')" class="mt-2 text-red-500 text-sm" />
                </div>

                <!-- Remember -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center text-sm text-gray-600">
                        <input
                            wire:model="form.remember"
                            type="checkbox"
                            class="rounded border-gray-300 text-sky-600 focus:ring-sky-500"
                        >
                        <span class="ml-2">Ghi nhớ đăng nhập</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-sky-600 hover:underline">
                            Quên mật khẩu?
                        </a>
                    @endif
                </div>

                <!-- Button -->
                <button
                    type="submit"
                    class="w-full bg-sky-700 hover:bg-sky-800 text-white font-semibold py-3 rounded-lg shadow-md transition duration-200"
                >
                    Đăng nhập
                </button>
            </form>

            <p class="text-center text-sm text-gray-500 mt-6">
                Chưa có tài khoản?
                <a href="{{ route('register') }}" class="text-sky-600 hover:underline font-medium">Đăng ký ngay</a>
            </p>
        </div>
    </div>
</section>


