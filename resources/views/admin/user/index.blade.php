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
                                            <th class="py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100"></th>
                                            <th class="py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100"></th>
                                            <th class="py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100"></th>
                                        </tr>
                                    </thead>
                                    @foreach ($users as $user)
                                        <tbody>
                                            <tr>
                                                <td class="px-4 py-3 text-center w-1/12">{{ $user->id }}</td>
                                                <td class="px-4 py-3 text-center w-1/6">{{ $user->name }}</td>
                                                <td class="py-3 w-1/12">
                                                    <div class="flex w-full mx-auto">
                                                        <x-anchor-button route="{{ route('admin.user.show', ['user' => $user->id]) }}" title="詳細" class="bg-indigo-500 hover:bg-indigo-600" />
                                                    </div>
                                                </td>
                                                <td class="py-3 w-1/12">
                                                    <div class="flex w-full mx-auto">
                                                        <x-anchor-button route="{{ route('admin.user.edit', ['user' => $user->id]) }}" title="編集" class="bg-green-500 hover:bg-green-600" />
                                                    </div>
                                                </td>
                                                <td class="py-3 w-1/12">
                                                    <div class="w-full mx-auto">
                                                        <form onsubmit="return confirm('ユーザーを削除してもよろしいですか？')" action="{{ route('admin.user.destroy', ['user' => $user->id]) }}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <x-submit-button title="削除" class="bg-red-500 hover:bg-red-600" />
                                                        </form>
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
