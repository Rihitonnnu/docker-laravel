<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            投稿作成画面
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form action="{{ route('user.article.store') }}" method="POST">
                        @csrf
                        <section class="text-gray-600 body-font relative w-full">
                            <div class="py-8">
                                <div class="lg:w-2/3 md:w-5/6 mx-auto">
                                    <div class="flex flex-wrap -m-2">
                                        <div class="p-2 w-full">
                                            <div class="relative">
                                                <div class="flex">
                                                    <label for="title" class="leading-7 text-sm text-gray-600">タイトル</label>
                                                    @if ($errors->has('title'))
                                                        <ul>
                                                            <li class="text-red-500 ml-4 mt-1 text-sm">{{$errors->first('title')}}</li>
                                                        </ul>
                                                    @endif
                                                </div>
                                                <input type="text" id="title" name="title" value="{{ old('title') }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            </div>
                                        </div>
                                        <div class="p-2 w-full">
                                            <div class="relative">
                                                <div class="flex">
                                                    <label for="content" class="leading-7 text-sm text-gray-600">本文</label>
                                                    @if ($errors->has('content'))
                                                        <ul>
                                                            <li class="text-red-500 ml-4 mt-1 text-sm">{{$errors->first('content')}}</li>
                                                        </ul>
                                                    @endif
                                                </div>
                                                <textarea id="content" name="content" class="w-full whitespace-pre-wrap bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">{{ old('content') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="p-2 w-full">
                                            <x-submit-button title="投稿する" class="bg-indigo-500 hover:bg-indigo-600" />
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
