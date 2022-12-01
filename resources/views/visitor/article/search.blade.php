<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            検索結果
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="px-6 pb-6 bg-white border-b border-gray-200">
                    <form action="{{ route('visitor.tag.search') }}" method="post">
                        @csrf
                        <div class="my-8 w-5/6 mx-auto">
                            <div class="flex">
                                <x-input-label value="タグ検索" />
                                @if ($errors->has('keyword'))
                                    <ul>
                                        <li class="text-red-500 ml-4 text-sm">
                                            {{ $errors->first('keyword') }}
                                        </li>
                                    </ul>
                                @endif
                            </div>
                            <div class="flex">
                                <div class="w-3/4">
                                    <x-text-input id="keyword" name="keyword"
                                        value="{{ $keyword ?? old('keyword') }}" />
                                </div>
                                <x-submit-button title="検索" class="bg-indigo-500 hover:bg-indigo-600" />
                            </div>
                        </div>
                    </form>
                    <h2 class="text-2xl font-medium text-gray-900 title-font mb-4">{{ $keyword . 'の検索結果' }}</h2>
                    @foreach ($articles as $article)
                        <section class="text-gray-600 body-font overflow-hidden border-t-2 border-gray-200">
                            <div class="container px-10 pt-8 mx-auto">
                                <a href="{{ route('visitor.article.show', ['article' => $article->id]) }}"
                                    class="-my-8">
                                    <div class="pt-2 pb-9 flex items-center w-full">
                                        <div class="md:flex-grow w-11/12">
                                            <div class="mb-2">
                                                <p>{{ $article->user->name }}</p>
                                            </div>
                                            <h2 class="text-2xl font-medium text-gray-900 title-font">
                                                {{ $article->title }}
                                            </h2>
                                            <div class="flex mb-2 mt-1">
                                                @foreach ($article->tags as $tag)
                                                    <p class="mr-3 text-sm text-blue-600">#{{ $tag->name }}</p>
                                                @endforeach
                                            </div>
                                            <span class="text-gray-500 text-sm">投稿日
                                                {{ \Carbon\Carbon::parse($article->created_at) }}</span>
                                            <p class="leading-relaxed mt-4">
                                                {{ Str::limit($article->content, 200, '...') }}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </section>
                    @endforeach
                </div>
            </div>
            <div class="my-3 mx-6">
                {{ $articles->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
