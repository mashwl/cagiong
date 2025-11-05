<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.app')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register()
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

             return redirect()->route('home');
    }
}; ?>

<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-md mx-auto bg-white shadow-xl rounded-2xl p-8">
            <h2 class="text-3xl font-bold text-center text-sky-900 mb-8">
                Tạo tài khoản mới
            </h2>

            <form wire:submit="register" class="space-y-6">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Họ và tên</label>
                    <input
                        wire:model="name"
                        id="name"
                        type="text"
                        name="name"
                        required
                        autofocus
                        class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 p-3"
                    >
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500 text-sm" />
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input
                        wire:model="email"
                        id="email"
                        type="email"
                        name="email"
                        required
                        class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 p-3"
                    >
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Mật khẩu</label>
                    <input
                        wire:model="password"
                        id="password"
                        type="password"
                        name="password"
                        required
                        class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 p-3"
                    >
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Xác nhận mật khẩu</label>
                    <input
                        wire:model="password_confirmation"
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        required
                        class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 p-3"
                    >
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500 text-sm" />
                </div>

                <!-- Button -->
                <button
                    type="submit"
                    class="w-full bg-sky-700 hover:bg-sky-800 text-white font-semibold py-3 rounded-lg shadow-md transition duration-200"
                >
                    Đăng ký
                </button>

                <!-- Login Link -->
                <p class="text-center text-sm text-gray-500 mt-6">
                    Đã có tài khoản?
                    <a href="{{ route('login') }}" class="text-sky-600 hover:underline font-medium">
                        Đăng nhập ngay
                    </a>
                </p>
            </form>
        </div>
    </div>
</section>

