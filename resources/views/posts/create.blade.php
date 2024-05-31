@extends('app')

@section('styles')
    <style>
        .container{
           min-height: 750px;
        }
    </style>
@endsection


@section('page_title', 'Login')

@section('content')
    <div class='container mx-auto bg-white'>
        <div class='w-1/5 mx-auto py-16'>
            <h1 class="text-lg text-rose-500">Login</h1>
            <form method='post' action="{{ route('posts.store')}}">
                @csrf
                <div class="flex flex-col mt-2">
                    <label>Title:</label>
                    <input type='text' name='title'  class='rounded-md border py-2 px-4' />
                </div>
                <div class="flex flex-col mt-2">
                    <label>Категория:</label>
                    <select name='category_id' class='rounded-md border py-2 px-4' required>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col mt-2">
                    <label>Description:</label>
                    <textarea name='description' class='rounded-md border py-2 px-4'></textarea>
                </div>
                <div class="flex flex-col mt-2">
                    <label>Видим:</label>
                    <select name='is_visible' class='rounded-md border py-2 px-4'>
                        <option value='1' selected>Да</option>
                        <option value='0' >Нет</option>
                    </select>
                </div>
                <div class="flex flex-col mt-2">
                    <label>Views:</label>
                    <input type='number' name='views'  class='rounded-md border py-2 px-4' />
                </div>
                <div class="flex flex-col mt-2">
                    <label>Photo:</label>
                    <input name='main_photo_url' type="text" class='rounded-md border py-2 px-4'/>
                </div>
                <div class="mt-4">
                    <input type='submit' name='post_store' class='rounded-md border py-2 px-4' />
                </div>
            </form>
            @if ($errors->any())
            <div class="alert alert-danger mt-6 text-rose-500">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>

@endif
        </div>
    </div>
@endsection