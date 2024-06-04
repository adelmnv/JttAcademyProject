@extends('app')

@section('page_title', 'Редактирование Поста - ')

@section('content')
    <div class="container mx-auto bg-white flex-grow flex items-center">
        <div class="container flex justify-between items-start">
            <div class="w-2/5">
                <img id="post-image" src="{{ $post->main_photo_url }}" alt="" class="m-4 rounded-lg w-full h-auto p-2">
            </div>
            <div class="w-3/5 p-8">
                <h2 class="text-lg font-bold mb-2">Редактировать Пост</h2>
                <form method="post" action="{{ route('posts.update', ['post_id'=>$post->id]) }}" class="mb-4" enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-col mb-2">
                        <label for="title" class="font-bold">Заголовок:</label>
                        <input type="text" id="title" name="title" value="{{ $post->title }}" class="border rounded-md py-2 px-4" />
                    </div>
                    <div class="flex flex-col mb-2">
                        <label for="category_id" class="font-bold">Категория:</label>
                        <select id="category_id" name="category_id" class="border rounded-md py-2 px-4" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" @if($post->category_id == $category->id) selected @endif>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col mb-2">
                        <label for="description" class="font-bold">Текст:</label>
                        <textarea id="description" name="description" class="border rounded-md py-2 px-4 resize-y" rows="15">{{ $post->description }}</textarea>
                    </div>
                    <div class="flex flex-col mb-2">
                        <label for="photo" class="font-bold">Фото:</label>
                        <input id="photo" name="photo" type="file" class="border rounded-md py-2 px-4" accept="image/*">
                    </div>
                    <div class="flex flex-col">
                        <label for="is_visible" class="font-bold mb-2">Видимость:</label>
                        <select id="is_visible" name="is_visible" class="border rounded-md py-2 px-4">
                            <option value="1" @if($post->is_visible) selected @endif>Показывать</option>
                            <option value="0" @if(!$post->is_visible) selected @endif>Скрыть</option>
                        </select>
                    </div>
                    <div class="mt-6">
                        <input type="submit" name="post_update" value="Сохранить" class="bg-green-500 text-white px-4 py-2 rounded-full hover:bg-green-600 transition-all duration-300 cursor-pointer">
                        <a href="{{ route('posts.view', ['post_id'=>$post->id]) }}" class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600 transition-all duration-300 cursor-pointer">Отменить</a>
                    </div>
                </form>
                @if ($errors->any())
                    <div class="text-red-500 mt-6">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.getElementById('photo').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const reader = new FileReader();
            
            reader.onload = function(e) {
                document.getElementById('post-image').src = e.target.result;
            };
            
            reader.readAsDataURL(file);
        });
    </script>
@endsection
