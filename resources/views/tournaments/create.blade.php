@extends('app')

@section('page_title', 'Добавление Турнира - ')

@section('content')
<div class="container mx-auto bg-white p-4">
    <div class="w-3/4 mx-auto bg-white p-8">
        <h1 class="text-2xl font-bold mb-4">Добавить турнир</h1>
        <form action="{{ route('tournaments.save') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="type" class="block text-gray-700 font-bold">Название турнира</label>
                <input type="text" name="name" id="name" class="form-input mt-1 block w-full border rounded-md py-2 px-4">
            </div>

            <div class="flex flex-col mb-2">
                <label for="tournament_category_id" class="font-bold">Возрастная категория:</label>
                <select id="tournament_category_id" name="tournament_category_id" class="border rounded-md py-2 px-4" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="start_date" class="block text-gray-700 font-bold">Дата начала турнира</label>
                <input type="date" name="start_date" id="start_date" class="form-input mt-1 block w-full border rounded-md py-2 px-4">
            </div>


            <div class="mb-4">
                <label for="end_date" class="block text-gray-700 font-bold">Дата окончания турнира</label>
                <input type="date" name="end_date" id="end_date" class="form-input mt-1 block w-full border rounded-md py-2 px-4">
            </div>

            <div class="mb-4">
                <label for="deadline" class="block text-gray-700 font-bold">Дедлайн</label>
                <input type="date" name="deadline" id="deadline" class="form-input mt-1 block w-full border rounded-md py-2 px-4">
            </div>

            <div class="mb-4">
                <label for="status" class="block text-gray-700 font-bold">Статус</label>
                <select name="status" id="status" class="form-select mt-1 block w-full border rounded-md py-2 px-4">
                    <option value="1">Проводится</option>
                    <option value="0">Отменен</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="files" class="block text-gray-700 font-bold">Загрузить новые файлы</label>
                <input type="file" name="files[]" id="files" multiple class="form-input mt-1 block w-full">
            </div>

            <div class="flex justify-end">
                <input type="submit" name="tournament_save" value="Сохранить" class="bg-green-500 text-white px-4 py-2 rounded-full hover:bg-green-600 transition-all duration-300 cursor-pointer mr-6">
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

        @if (session('error'))
            <div class="text-red-500 mt-6">
                {{ session('error') }}
            </div>
        @endif
    </div>
</div>
@endsection