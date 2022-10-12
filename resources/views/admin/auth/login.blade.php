<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <div class="text-center mt-3">
            <h1 class="text-lg font-bold">管理者ログイン</h1>
        </div>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />


        <form method="POST" action="{{ route('admin.login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />

                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('user.login') }}">
                    ユーザーログイン
                </a>
            </div>

            <div class="text-center mt-4">
                <x-primary-button class="ml-3">
                    ログイン
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
