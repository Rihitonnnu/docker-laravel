<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ユーザー詳細
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <table class="table-auto w-full text-left whitespace-no-wrap mb-4">
                            <tr class="border-2 border-gray-300">
                                <div class="flex">
                                    <th class="w-1/6 text-center px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">
                                        ID
                                    </th>
                                    <td class="px-4 py-3 text-center w-1/4">{{ $user->id }}</td>
                                </div>
                            </tr>
                            <tr class="border-2 border-gray-300">
                                <div class="flex">
                                    <th class="w-1/6 text-center px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                        名前
                                    </th>
                                    <td class="px-4 py-3 text-center w-1/4">{{ $user->name }}</td>
                                </div>
                            </tr>
                            <tr class="border-2 border-gray-300">
                                <div class="flex">
                                    <th class="w-1/6 text-center px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                        メールアドレス
                                    </th>
                                    <td class="px-4 py-3 text-center w-1/4">{{ $user->email }}</td>
                                </div>
                            </tr>
                            <tr class="border-2 border-gray-300">
                                <div class="flex">
                                    <th class="w-1/6 text-center px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                        アカウント作成日
                                    </th>
                                    <td class="px-4 py-3 text-center w-1/4">{{ \Carbon\Carbon::parse($user->created_at)->toDateString() }}</td>
                                </div>
                            </tr>
                    </table>

                    {{-- 戻るボタン --}}
                    <div class="flex justify-center">
                        <x-anchor-button route="{{ route('admin.user.index') }}" title="戻る" class="bg-indigo-500 hover:bg-indigo-600" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
