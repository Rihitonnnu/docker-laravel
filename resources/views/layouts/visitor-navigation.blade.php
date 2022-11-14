<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex h-16">
            <div class="flex w-full">
                <!-- Logo --> 
                <div class="flex w-full items-center">
                    <a href="{{ route('visitor.article.index') }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                    </a>
                    <div class="ml-auto flex">
                        <div>
                            <x-anchor-button route="{{ route('user.login') }}" title="ユーザーログイン" class="bg-indigo-500 hover:bg-indigo-600" />
                        </div>
                        <div class="ml-3">
                            <x-anchor-button route="{{ route('admin.login') }}" title="管理者ログイン" class="bg-red-500 hover:bg-red-600" />
                        </div>
                        <div class="ml-3">
                            <x-anchor-button route="{{ route('user.register') }}" title="新規登録" class="bg-blue-500 hover:bg-blue-600" />
                        </div>
                    </div>
                </div>

            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">

        </div>
    </div>
</nav>
