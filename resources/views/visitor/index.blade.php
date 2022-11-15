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
                            <a href="" class="-my-8">
                                <div class="pt-2 pb-9 flex items-center w-full">
                                    <div class="md:flex-grow w-11/12">
                                        <div class="mb-2">
                                            <p>{{ App\Models\User::find($article->user_id)->name }}</p>
                                        </div>
                                        <h2 class="text-2xl font-medium text-gray-900 title-font">{{ $article->title }}</h2>
                                        <span class="text-gray-500 text-sm">投稿日 {{\Carbon\Carbon::parse($article->created_at)}}</span>
                                        <p class="leading-relaxed mt-4">{{Str::limit($article->content, 200, '...') }}</p>
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
