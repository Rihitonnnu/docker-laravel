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
                                                <x-text-input id="title" name="title" value="{{ old('title') }}"/>
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
                                                <x-textarea id="content" name="content">{{ old('content') }}</x-textarea>
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
