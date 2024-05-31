@extends('app')
@section('page_title', 'Admin Dash')

@section('styles')

<style>

    .container {

        min-height: 750px

    }

</style>

@endsection


@section('content')
    <div class='container mx-auto'>
        <div class="flex flex-wrap">
            @foreach ($posts as $post)
                <div class="p-4 border w-1/5">
                     <div>
                        <img src="{{$post->main_photo_url}}" class = "w-full aspect-square">
                    </div>
                    <div>
                        <a href="{{ route('posts.edit', ['post_id'=>$post->id]) }}">{{ $post->title }}</a>
                    </div>
                    <div>{{ $post->category->title }}</div>
                    <div>{{ $post->description }}</div>
                    <div>{{ $post->updated_at }}</div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
