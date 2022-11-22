<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            タグ編集画面
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form action="{{ route('admin.tag.update', ['tag' => $tag->id]) }}" method="POST">
                        @csrf
                        @method('put')
                        <section class="text-gray-600 body-font relative w-full">
                            <div class="py-5">
                                <div class="lg:w-2/3 md:w-5/6 mx-auto">
                                    <div class="flex flex-wrap justify-center -m-2">
                                        <div class="p-2 w-full mx-auto">
                                            <div class="relative w-2/3 mx-auto">
                                                <div class="flex">
                                                    <label for="name" class="leading-7 text-sm text-gray-600">タグ名</label>
                                                    @if ($errors->has('name'))
                                                        <ul>
                                                            <li class="text-red-500 ml-4 mt-1 text-sm">{{ $errors->first('name') }}</li>
                                                        </ul>
                                                    @endif
                                                </div>
                                                <x-text-input class="" id="name" name="name" value="{{ old('name') ?? $tag->name }}" />
                                            </div>
                                        </div>
                                        <div class="p-2 w-full">
                                            <x-submit-button title="更新する" class="bg-indigo-500 hover:bg-indigo-600" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
