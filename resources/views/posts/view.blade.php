@extends('app')

@section('page_title', 'Новости - ')


@section('content')
    <div class="container mx-auto bg-white flex-grow flex items-center">
        <div class="container flex justify-between items-center">
            <div class="w-2/5">
            <img src="{{ $post->main_photo_url }}" alt="" class="m-4 rounded-lg w-full h-auto p-2">
            </div>
            <div class="w-3/5 p-8">
                <h1 class="text-3xl font-bold mb-4">{{ $post->title }}</h1>
                <div class="text-gray-700 mb-4">
                    {!! nl2br(e($post->description)) !!}
                </div>
                <div class="flex items-center mb-4">
                    <a href="{{ route('posts.by_category', ['category_id' => $post->category->id]) }}" class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-green-600 transition-all duration-300 mr-4">Назад</a>
                    @auth
                        <a href="{{ route('posts.edit', ['post_id' => $post->id]) }}" class="bg-yellow-500 text-white 4ml- px-4 py-2 rounded-full hover:bg-yellow-600 transition-all duration-300">Редактировать</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
@endsection