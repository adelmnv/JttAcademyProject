@extends('app')

@section('page_title', 'Создание Тренировки - ')

@section('content')
<div class="container mx-auto bg-white p-4">
    <div class="w-3/4 mx-auto bg-white p-8">
        <h1 class="text-2xl font-bold mb-4">Новая тренировка</h1>
        <form action="{{ route('practices.save') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="type_id" class="block text-gray-700">Тип</label>
                <select name="type_id" id="type_id" class="form-select mt-1 block w-full border rounded-md py-2 px-4">
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}">
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="type" class="block text-gray-700">Вид тренировки</label>
                <input type="text" name="type" id="type" class="form-input mt-1 block w-full border rounded-md py-2 px-4">
            </div>

            <div class="mb-4">
                <label for="payment_type" class="block text-gray-700">Тип оплаты</label>
                <input type="text" name="payment_type" id="payment_type" class="form-input mt-1 block w-full border rounded-md py-2 px-4">
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700">Описание</label>
                <textarea name="description" id="description" class="form-textarea mt-1 block w-full py-2 px-4 border rounded-md" rows="8"></textarea>
            </div>

            <div class="mb-4">
                <label for="price" class="block text-gray-700">Цена</label>
                <input type="text" name="price" id="price" class="form-input mt-1 block w-full border rounded-md py-2 px-4">
            </div>

            <div class="mb-4">
                <label for="is_visible" class="block text-gray-700">Видимость</label>
                <select name="is_visible" id="is_visible" class="form-select mt-1 block w-full border rounded-md py-2 px-4">
                    <option value="1">Видимый</option>
                    <option value="0">Скрытый</option>
                </select>
            </div>

            <div class="flex justify-end">
                <input type="submit" name="practice_update" value="Сохранить" class="bg-green-500 text-white px-4 py-2 rounded-full hover:bg-green-600 transition-all duration-300 cursor-pointer mr-6">
                <a href="{{ route('practices') }}" class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600 transition-all duration-300 cursor-pointer">Отменить</a>
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
