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
            <h1 class="text-lg font-bold">ユーザーログイン</h1>
        </div>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        

        <form method="POST" action="{{ route('user.login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />

                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('admin.login') }}">
                        管理者ログイン
                </a>
            </div>

            <div class="text-center mt-4 ">
                <button type="button" onclick="location.href='{{route('user.register')}}'" class="ml-3 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150'">
                    新規登録
                <button>
                <x-primary-button class="ml-3">
                    ログイン
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
