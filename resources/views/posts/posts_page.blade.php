@extends('app')

@section('page_title', 'Новости - ')


@section('content')
    <div class="container mx-auto bg-white flex-grow p-4">
        <div class="flex flex-wrap items-center">
            @foreach ($categories as $category)
                <a href="{{route ('posts.by_category', ['category_id'=>$category->id]) }}" class="rounded-full py-2 px-6 border text-sm transition-all duration-300 hover:bg-green-500 hover:text-white mr-4 mb-4 inline-flex items-center bg-white text-black">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>
        <div class="flex flex-wrap justify-center gap-4">
            @foreach ($posts as $post)
                <div class="relative p-4 w-1/4 border">
                    <div>
                        <img src="{{ $post->main_photo_url }}" class="w-full aspect-square">
                    </div>
                    <div class="mt-2">
                        <a href="{{ route('posts.view', ['post_id' => $post->id]) }}" class="text-lg font-semibold">{{ $post->title }}</a>
                    </div>
                    <div class="text-gray-500 text-sm mt-1">
                        {{ $post->updated_at->format('d.m.Y') }}
                    </div>
                    @auth
                        <div class="text-sm mt-4">
                            <a href="{{ route('posts.edit', ['post_id' => $post->id]) }}" class="bg-gray-500 text-white px-2 py-1 rounded hover:bg-gray-600 transition-all duration-300">Редактировать</a>
                        </div>
                    @endauth
                </div>
            @endforeach
            @auth
                @if ($hidden_posts->isNotEmpty())
                    @foreach ($hidden_posts as $post)
                        <div class="relative p-4 w-1/4 border bg-gray-200">
                            <div class="filter grayscale">
                                <img src="{{ $post->main_photo_url }}" class="w-full aspect-square">
                            </div>
                            <div class="mt-2">
                                <a href="{{ route('posts.view', ['post_id' => $post->id]) }}" class="text-lg font-semibold">{{ $post->title }}</a>
                            </div>
                            <div class="text-gray-500 text-sm mt-1">
                                {{ $post->updated_at->format('d.m.Y') }}
                            </div>
                                <div class="text-sm mt-4">
                                    <a href="{{ route('posts.edit', ['post_id' => $post->id]) }}" class="bg-gray-500 text-white px-2 py-1 rounded hover:bg-gray-600 transition-all duration-300">Редактировать</a>
                                </div>
                            </div>
                     @endforeach
                @endif
            @endauth
        </div>
    </div>
@endsection