@extends('app')

@section('page_title', 'Тренер - ')


@section('content')
    <div class="container mx-auto bg-white flex-grow flex items-center">
        <div class="container flex justify-between items-center">
            <div class="w-2/5">
            <img src="{{ $coach->main_photo_url }}" alt="" class="m-4 rounded-lg w-full h-auto p-2">
            </div>
            <div class="w-3/5 p-8">
                <h1 class="text-3xl font-bold mb-4">{{ $coach->fio }}</h1>
                <h3 class="text-xl font-bold mb-4">Стаж тренерской деятельности: {{ $coach->experience_years }} лет</h3>
                <h3 class="text-l font-bold mb-4">Дата рождения: {{ strftime("%d.%m.%Y", strtotime($coach->date_of_birth))}}</h3>
                <div class="text-gray-700 mb-4">
                    {!! nl2br(e($coach->description)) !!}
                </div>
                <div class="flex items-center mb-4">
                    <a href="{{ route('coaches') }}" class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-green-600 transition-all duration-300">Назад</a>
                    @auth
                        <a href="{{ route('coaches.edit', ['coach_id' => $coach->id]) }}" class="bg-yellow-500 text-white ml-4 px-4 py-2 rounded-full hover:bg-yellow-600 transition-all duration-300">Редактировать</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
@endsection