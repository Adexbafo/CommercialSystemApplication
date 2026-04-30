<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Admin Portal</h2>
        <p class="text-sm text-gray-600 mt-2">Secure access for administrators only</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('admin.login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Admin Email')" class="text-xs uppercase tracking-wider font-semibold text-gray-500" />
            <div class="mt-1 relative">
                <x-text-input id="email" class="block w-full bg-gray-50 border-gray-200 focus:ring-indigo-500 focus:border-indigo-500 rounded-xl transition-all duration-200" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-xs uppercase tracking-wider font-semibold text-gray-500" />
            <div class="mt-1 relative">
                <x-text-input id="password" class="block w-full bg-gray-50 border-gray-200 focus:ring-indigo-500 focus:border-indigo-500 rounded-xl transition-all duration-200"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded-md border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 h-4 w-4 transition duration-150 ease-in-out" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Stay signed in') }}</span>
            </label>
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200 transform hover:scale-[1.02] active:scale-[0.98]">
                {{ __('Authenticate') }}
            </button>
        </div>
    </form>

    <div class="mt-8 pt-6 border-t border-gray-100 text-center">
        <a href="{{ route('login') }}" class="text-sm text-indigo-600 hover:text-indigo-500 font-medium transition-colors duration-200">
            &larr; Switch to Customer Login
        </a>
    </div>
</x-guest-layout>
