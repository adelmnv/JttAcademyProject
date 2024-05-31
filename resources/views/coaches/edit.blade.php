@extends('app')

@section('page_title', 'Редактирование ')

@section('content')
    <div class="container mx-auto bg-white flex-grow flex items-center">
        <div class="container flex justify-between items-start">
            <div class="w-2/5">
                <img id="coach-image" src="{{ $coach->main_photo_url }}" alt="" class="m-4 rounded-lg w-full h-auto p-2">
            </div>
            <div class="w-3/5 p-8">
                <h2 class="text-lg font-bold mb-2">Редактировать Тренера</h2>
                <form method="post" action="{{ route('coaches.update', ['coach_id'=>$coach->id]) }}" class="mb-4" enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-col mb-2">
                        <label for="fio" class="font-bold">Полное имя:</label>
                        <input type="text" id="fio" name="fio" value="{{ $coach->fio }}" class="border rounded-md py-2 px-4" />
                    </div>
                    <div class="flex flex-col mb-2">
                        <label for="date_of_birth" class="font-bold">Дата рождения:</label>
                        <input type="date" id="date_of_birth" name="date_of_birth" value="{{ $coach->date_of_birth }}" class="border rounded-md py-2 px-4" />
                    </div>
                    <div class="flex flex-col mb-2">
                        <label for="experience_years" class="font-bold">Стаж тренерской деятельности:</label>
                        <input type="number" id="experience_years" name="experience_years" value="{{ $coach->experience_years }}" class="border rounded-md py-2 px-4" />
                    </div>
                    <div class="flex flex-col mb-2">
                        <label for="description" class="font-bold">Описание:</label>
                        <textarea id="description" name="description" class="border rounded-md py-2 px-4 resize-y" rows="6">{{ $coach->description }}</textarea>
                    </div>
                    <div class="flex flex-col mb-2">
                        <label for="photo" class="font-bold">Фото:</label>
                        <input id="photo" name="photo" type="file" class="border rounded-md py-2 px-4" accept="image/*">
                    </div>
                    <div class="flex flex-col">
                        <label for="is_visible" class="font-bold mb-2">Видимость:</label>
                        <select id="is_visible" name="is_visible" class="border rounded-md py-2 px-4">
                            <option value="1" @if($coach->is_visible) selected @endif>Показывать</option>
                            <option value="0" @if(!$coach->is_visible) selected @endif>Скрыть</option>
                        </select>
                    </div>
                    <div class="mt-6">
                        <input type="submit" name="coach_update" value="Сохранить" class="bg-green-500 text-white px-4 py-2 rounded-full hover:bg-green-600 transition-all duration-300 cursor-pointer">
                        <a href="{{ route('coaches.view', ['coach_id'=>$coach->id]) }}" class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600 transition-all duration-300 cursor-pointer">Отменить</a>
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
                document.getElementById('player-image').src = e.target.result;
            };
            
            reader.readAsDataURL(file);
        });
    </script>
@endsection