<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            自分の投稿一覧
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-white border-b border-gray-200">

                    @foreach($articles as $article)
                    <section class="text-gray-600 body-font overflow-hidden border-b-2 border-gray-200">
                        <div class="container px-10 pt-8 mx-auto">
                            <a href="" class="-my-8">
                                <div class="py-4 flex flex-wrap md:flex-nowrap">
                                    <div class="md:flex-grow">
                                        <h2 class="text-2xl font-medium text-gray-900 title-font mb-2">{{ $article->title }}</h2>
                                        <p class="leading-relaxed">{{Str::limit($article->content, 200, '...') }}</p>
                                    </div>
                                </div>
                                <div class="md:w-64 text-center ml-auto mb-6 flex">
                                    <span class="mt-1 text-gray-500 text-md ml-auto">投稿日 {{\Carbon\Carbon::parse($article->created_at)}}</span>
                                </div>
                            </a>
                        </div>
                    </section>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
