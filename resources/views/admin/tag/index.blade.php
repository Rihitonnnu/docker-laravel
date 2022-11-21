<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            タグ
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-2 bg-white border-b border-gray-200">
                    <div class="px-3 mx-auto w-5/6 mt-4">
                        <h1 class="text-2xl font-bold">タグ登録</h1>
                    </div>

                    <section class="text-gray-600 body-font relative mb-8">
                        <div class="container px-5 pt-3 mx-auto">
                            <div class="w-5/6 mx-auto">
                                <div class="flex flex-wrap -m-2">
                                    <div class="p-2 w-1/3">
                                        <div class="relative">
                                            <label for="name" class="leading-7 text-sm text-gray-600">タグ名</label>
                                            <input type="text" id="name" name="name"
                                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                        </div>
                                    </div>
                                    <div class="p-2 w-1/6 mt-7">
                                        <x-submit-button title="登録" class="bg-indigo-500 hover:bg-indigo-600" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <div class="px-3 mx-auto w-5/6 mt-8 mb-5">
                        <h1 class="text-2xl font-bold">タグ一覧</h1>
                    </div>

                    <section class="text-gray-600 body-font">
                        <div class="container px-3 pb-12 w-full">
                            <div class="w-2/3 overflow-auto mx-auto">
                                <table class="table-auto w-full text-left whitespace-no-wrap">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-center w-1/2 px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">
                                                タグ名
                                            </th>
                                            <th
                                                class="w-1/6 px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                            </th>
                                            <th
                                                class="w-1/6 px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                            </th>
                                        </tr>
                                    </thead>
                                    @foreach ($tags as $tag)
                                        <tbody class="mt-2">
                                            <tr>
                                                <td class="px-2 py-3 text-center text-sm">{{ $tag->name }}</td>
                                                <td class="py-3 w-1/6">
                                                    <x-anchor-button route="" title="編集"
                                                        class="bg-green-500 hover:bg-green-600 w-2/3" />
                                                </td>
                                                <td class="py-3 w-1/6">
                                                    <x-submit-button title="削除"
                                                        class="bg-red-500 hover:bg-red-600" />
                                                </td>
                                            </tr>
                                        </tbody>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
