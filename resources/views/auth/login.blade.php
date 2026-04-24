<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me removed as per request -->

        <div class="flex flex-col space-y-4 mt-8">
            <button type="submit" class="w-full py-4 text-lg bg-indigo-600 text-white font-black rounded-2xl uppercase tracking-widest transition btn-shiny">
                {{ __('Log in') }}
            </button>

            <div class="text-center space-y-2">
                @if (Route::has('password.request'))
                    <div>
                        <a class="text-xs text-gray-500 hover:text-indigo-400 transition" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    </div>
                @endif
                <div>
                    <a class="text-xs text-gray-500 hover:text-indigo-400 transition" href="{{ route('register') }}">
                        {{ __('Belum punya akun? Daftar Siswa Baru') }}
                    </a>
                </div>
            </div>
        </div>
    </form>
</x-guest-layout>
