@extends('app')

@section('page_title', 'Панель - Абонементы - Просмотр')

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
                <h1 class="text-3xl font-bold mb-6">{{ $membership->name }}</h1>
                <div class="mb-4">
                    <p><strong>Телефон:</strong> <a href="tel:{{ $membership->phone }}" class="text-green-600">{{ $membership->phone }}</a></p>
                    <p><strong>Дата рождения:</strong> {{ strftime("%d.%m.%Y", strtotime($membership->date_of_birth))}}</p>
                    <p><strong>Оплачен до:</strong> {{ strftime("%d.%m.%Y", strtotime($membership->paid_until))}}</p>
                    <p><strong>Статус:</strong> {!! $membership->status == 1 ? '<span class="text-green-600">Активный</span>' : '<span class="text-red-600">Приостановлен</span>' !!}</p>
                </div>
                <div class="mb-4">
                    <h2 class="text-xl font-bold mb-2">Информация о группе</h2>
                    <p><strong>Группа:</strong><a href=""></a> {{ $membership->group->practice->type }}</p>
                    <p><strong>Возрастная категория:</strong> {{ $membership->practice_type_name }}</p>
                    <p><strong>Тренер:</strong> <a href="{{ route('coaches.view', ['coach_id' => $coach->id]) }}" class="text-green-600 hover:text-green-800 transition-colors duration-300">{{ $group->coach->fio }}</a></p>
                    <p><strong>Дни тренировок:</strong> {{ $membership->group->days_as_names }}</p>
                    <p><strong>Время начало тренировок:</strong> {{ $membership->group->time }} - {{$membership->group->duration}} ч.</p>
                    <p><strong>Стоимость:</strong> {{ $membership->group->practice->price }} тг</p>
                </div>
                <div class="flex items-center justify-end  mb-4">
                    <a href="{{ route('memberships') }}" class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600 transition-all duration-300">Назад</a>
                    <a href="{{ route('memberships.edit', ['membership_id' => $membership->id]) }}" class="bg-yellow-500 text-white ml-4 px-4 py-2 rounded-full hover:bg-yellow-600 transition-all duration-300">Редактировать</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection