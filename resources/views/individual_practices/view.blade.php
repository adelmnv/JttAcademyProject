@extends('app')

@section('page_title', 'Индивидуальная Тренировка - Просмотр')

@section('content')
<div class="container mx-auto bg-white flex-grow p-4">
    <div class="flex flex-wrap items-center">
        <div class="rounded-full py-2 px-6 border text-sm transition-all duration-300 hover:bg-green-500 hover:text-white mr-4 mb-4 inline-flex items-center bg-white text-black">
            <a href="{{ route('admin.applications') }}">
                <span>Заявки</span>
            </a>
        </div>
        <div class="rounded-full py-2 px-6 border text-sm transition-all duration-300 hover:bg-green-500 hover:text-white mr-4 mb-4 inline-flex items-center bg-white text-black">
            <a href="{{ route('memberships') }}">
                <span>Абонементы</span>
            </a>
        </div>
        <div class="rounded-full py-2 px-6 border text-sm transition-all duration-300 hover:bg-green-500 hover:text-white mr-4 mb-4 inline-flex items-center bg-white text-black">
            <a href="{{ route('admin.schedule') }}">
                <span>Расписание</span>
            </a>
        </div>
        <div class="rounded-full py-2 px-6 border text-sm transition-all duration-300 hover:bg-green-500 hover:text-white mr-4 mb-4 inline-flex items-center bg-white text-black">
            <a href="{{ route('admin.menu') }}">
                <span>Меню по созданию</span>
            </a>
        </div>
    </div>
    <div class="mb-8">
        <div class="container mx-auto mt-10">
            <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg p-6">
                <h1 class="text-3xl font-bold mb-6">{{ $indv_practice->name }}</h1>
                <div class="mb-4">
                    <p><strong>Телефон:</strong> <a href="tel:{{ $indv_practice->phone }}" class="text-green-600">{{ $indv_practice->phone }}</a></p>
                </div>
                <div class="mb-4">
                    <h2 class="text-xl font-bold mb-2">Информация об индивидуальной тренировке</h2>
                    <p><strong>Тип тренировки:</strong> {{ $indv_practice->practice->type }} {{ $indv_practice->type_name }}</p>
                    <p><strong>Тренер:</strong> <a href="{{ route('coaches.view', ['coach_id' => $indv_practice->coach->id]) }}" class="text-green-600 hover:text-green-800 transition-colors duration-300">{{ $group->coach->fio }}</a></p>
                    <p><strong>Дата тренировки:</strong>{{ strftime("%d.%m.%Y", strtotime($indv_practice->date))}}</p>
                    <p><strong>Время начало тренировки:</strong> {{ $indv_practice->time }} - {{$indv_practice->duration}} ч.</p>
                    <p><strong>Номер корта:</strong> {{ $indv_practice->court_number }} корт </p>
                    <p><strong>Стоимость:</strong> {{ $indv_practice->practice->price }} тг час</p>
                </div>
                <div class="flex items-center justify-end  mb-4">
                    <a href="{{ route('admin.schedule') }}" class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600 transition-all duration-300">Назад</a>
                    <a href="{{ route('individual_practices.edit', ['id' => $indv_practice->id]) }}" class="bg-yellow-500 text-white ml-4 px-4 py-2 rounded-full hover:bg-yellow-600 transition-all duration-300">Редактировать</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection