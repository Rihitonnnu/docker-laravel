<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ユーザー一覧
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <section class="text-gray-600 body-font">
                        <div class="container px-5 py-6 mx-auto">
                            <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                                <table class="table-auto w-full text-left whitespace-no-wrap">
                                    <thead>
                                        <tr>
                                            <th class="text-center px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">
                                                ID
                                            </th>
                                            <th class="text-center px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                名前
                                            </th>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100"></th>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100"></th>
                                        </tr>
                                    </thead>
                                    @foreach ($users as $user)
                                        <tbody>
                                            <tr>
                                                <td class="px-4 py-3 text-center w-1/4">{{ $user->id }}</td>
                                                <td class="px-4 py-3 text-center w-1/4">{{ $user->name }}</td>
                                                <td class="px-4 py-3 w-1/4">
                                                    <div class="flex pl-4 w-full mx-auto">
                                                        <button class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">
                                                            詳細
                                                        </button>
                                                    </div>
                                                </td>
                                                <td class="px-4 py-3 w-1/4">
                                                    <div class="flex pl-4 w-full mx-auto">
                                                        <button class="flex mx-auto text-white bg-red-500 border-0 py-2 px-6 focus:outline-none hover:bg-red-600 rounded">
                                                            削除
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    @endforeach
                                </table>
                                {{ $users->links() }}
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
