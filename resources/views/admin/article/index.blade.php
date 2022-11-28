<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            最新の投稿
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="px-6 pb-6 bg-white border-b border-gray-200">
                    @foreach($articles as $article)
                    <section class="text-gray-600 body-font overflow-hidden border-b-2 border-gray-200">
                        <div class="container px-10 pt-8 mx-auto">
                            <a href="{{ route('admin.article.show',['article'=>$article->id]) }}" class="-my-8">
                                <div class="pt-2 pb-9 flex items-center w-full">
                                    <div class="md:flex-grow w-11/12">
                                        <div class="mb-2">
                                            <p>{{ $article->user->name }}</p>
                                        </div>
                                        <h2 class="text-2xl font-medium text-gray-900 title-font">{{ $article->title }}</h2>
                                        <div class="flex mb-2 mt-1">
                                            @foreach($article->tags as $tag)
                                                <p class="mr-3 text-sm text-blue-600">#{{ $tag->name }}</p>
                                            @endforeach
                                        </div>
                                        <span class="text-gray-500 text-sm">投稿日 {{\Carbon\Carbon::parse($article->created_at)}}</span>
                                        <p class="leading-relaxed mt-4">{{Str::limit($article->content, 200, '...') }}</p>
                                    </div>
                                    <div class="w-1/12 text-center pl-8">
                                        <form onsubmit="return confirm('投稿を削除してもよろしいですか？')" action="{{ route('admin.article.destroy',['article'=>$article->id]) }}" method="post" >
                                            @csrf
                                            @method('delete')
                                            <button type="submit">
                                                <x-delete-icon class=""/>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </section>
                    @endforeach
                </div>
                <div class="my-3 mx-6">
                    {{ $articles->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
