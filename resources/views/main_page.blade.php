@extends('app')

@section('page_title', 'Главная - ')

@section('content')
<div class="container mx-auto bg-white flex-grow flex items-center">
    <div class="container flex justify-between items-center">
        <div>
            <img src="{{ asset('img/tennis-main2.jpg') }}" alt="" class="m-4 rounded-lg">
        </div>
        <div class="w-1/2 p-8">
            <h1 class="text-3xl font-bold mb-4">Добро пожаловать в JTT!</h1>
            <p class="text-gray-700 mb-4">
                Академия тенниса JTT предлагает тренировки для всех уровней - от профессионалов до любителей.
                У нас есть группы для детей, и мы стремимся привить любовь к спорту через наши тренировки.
            </p>
            <a class="bg-black text-white py-2 px-4 rounded" href="{{ route('about')}}">Подробнее</a>
        </div>
    </div>
</div>
@endsection