@extends('app')

@section('page_title', 'Редактирование Турнира - ')

@section('content')
<div class="container mx-auto bg-white p-4">
    <div class="w-3/4 mx-auto bg-white p-8">
        <h1 class="text-2xl font-bold mb-4">Редактировать турнир</h1>
        <form action="{{ route('tournaments.update', $tournament->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="type" class="block text-gray-700 font-bold">Название турнира</label>
                <input type="text" name="name" id="name" value="{{ old('name', $tournament->name) }}" class="form-input mt-1 block w-full border rounded-md py-2 px-4">
            </div>

            <div class="mb-4">
                <p><span class="font-bold text-gray-700">Возрастная категория:</span> {{ $tournament->category->name }}</p>
            </div>

            <div class="mb-4">
                <label for="start_date" class="block text-gray-700 font-bold">Дата начала турнира</label>
                <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $tournament->start_date) }}" class="form-input mt-1 block w-full border rounded-md py-2 px-4">
            </div>


            <div class="mb-4">
                <label for="end_date" class="block text-gray-700 font-bold">Дата окончания турнира</label>
                <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $tournament->end_date) }}" class="form-input mt-1 block w-full border rounded-md py-2 px-4">
            </div>

            <div class="mb-4">
                <label for="deadline" class="block text-gray-700 font-bold">Дедлайн</label>
                <input type="date" name="deadline" id="deadline" value="{{ old('deadline', $tournament->deadline) }}" class="form-input mt-1 block w-full border rounded-md py-2 px-4">
            </div>

            <div class="mb-4">
                <label for="status" class="block text-gray-700 font-bold">Статус</label>
                <select name="status" id="status" class="form-select mt-1 block w-full border rounded-md py-2 px-4">
                    <option value="1" {{ $tournament->status == 1 ? 'selected' : '' }}>Проводится</option>
                    <option value="0" {{ $tournament->status != 1 ? 'selected' : '' }}>Отменен</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="text-gray-700"><b>Загруженные файлы</b> (Отметьте те файлы которые нужно удалить)</label>
                <ul>
                    @foreach ($files as $file)
                        <li>
                            <input type="checkbox" name="selected_files[]" value="{{ $file->id }}">
                            <a class="hover:text-green-500" href="{{ $file->file_path }}" target="_blank">открыть файл {{ $file->file_name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="mb-4">
                <label for="files" class="block text-gray-700 font-bold">Загрузить новые файлы</label>
                <input type="file" name="files[]" id="files" multiple class="form-input mt-1 block w-full">
            </div>

            <div class="flex justify-end">
                <input type="submit" name="tournament_update" value="Сохранить" class="bg-green-500 text-white px-4 py-2 rounded-full hover:bg-green-600 transition-all duration-300 cursor-pointer mr-6">
                <a href="{{ route('tournaments') }}" class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600 transition-all duration-300 cursor-pointer">Отменить</a>
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
@endsection