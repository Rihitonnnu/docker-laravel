<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            記事詳細画面
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <section class="text-gray-600 body-font">
                        <div class="container mx-auto flex flex-col">
                            <div class="lg:w-full mx-auto">
                                <div class="flex flex-col sm:flex-row mt-3">
                                    <div class="w-full sm:pl-8 border-gray-200 sm:border-t-0 border-t mt-4 pt-4 sm:mt-0 text-center sm:text-left">
                                        <div class="mb-2">
                                            <p>{{ $article->user->name }}</p>
                                        </div>
                                        <h1 class="font-bold text-3xl text-black">{{ $article->title }}</h1>
                                        <p class="text-sm mt-1">投稿日時 {{ $article->created_at }}</p>
                                        <div class="mt-4">
                                            {{-- 改行した状態で内容を表示するため改行のみエスケープ処理を無効化 --}}
                                            <p class="leading-relaxed text-md mb-4">{!! nl2br(htmlspecialchars($article->content)) !!}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <div class="flex justify-center">
                        <div class="m-2 w-32 mt-6">
                            <x-anchor-button route="{{ route('visitor.article.index') }}" title="一覧へ戻る" class="bg-indigo-500 hover:bg-indigo-600" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
