@extends('app')

@section('page_title', 'Панель - Детальное расписание - ' . $date->format('d.m.Y'))

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
    <div class="mb-4">
        <a href="{{ route('admin.schedule') }}" class="px-2 py-1 rounded bg-gray-200 text-gray-700">&lt; Назад в календарь</a>
    </div>
    <div class="mb-4">
        <h1 class="text-3xl font-bold">Детальное расписание на {{ $date->format('d.m.Y') }}</h1>
    </div>
    @if ($tournament)
        <div class="mb-4 p-4 bg-yellow-200 text-yellow-800">
            <p>В этот день будет проходить турнир <strong><a href="{{ route('tournaments.view', ['tournament_id' => $tournament->id]) }}" style="text-decoration: underline">{{ $tournament->name }}</a></strong> дата проведения с {{ strftime("%d.%m.%Y", strtotime($tournament->start_date))}} по {{ strftime("%d.%m.%Y", strtotime($tournament->end_date))}}</p>
        </div>
    @endif

    <div class="grid grid-cols-2 gap-4">
        <div>
            <h2 class="text-xl font-bold">Корт 1</h2>
            @foreach ($schedule as $entry)
                @if ($entry->court_number == 1)
                    @if ($entry->type == 'group')
                        <a href="{{ route('group_practices.view', ['id' => $entry->id]) }}" class="border p-2 mb-2 block">
                            <span>{{ $entry->formatted_time }}</span> - 
                            <span>{{ $entry->practice->type }} - {{ $entry->coach->fio }}</span>
                        </a>
                    @elseif ($entry->type == 'individual')
                        <a href="{{ route('individual_practices.view', ['id' => $entry->id]) }}" class="border p-2 mb-2 block">
                            <span>{{ $entry->formatted_time }}</span> - 
                            <span>Индивидуальная тренировка с {{ $entry->coach->fio }}</span>
                        </a>
                    @elseif ($entry->type == 'rent')
                        <a href="{{ route('rent_courts.view', ['id' => $entry->id]) }}" class="border p-2 mb-2 block">
                            <span>{{ $entry->formatted_time }}</span> - 
                            <span>Аренда корта {{ $entry->name }}</span>
                        </a>
                    @endif
                @endif
            @endforeach
        </div>

        <div>
            <h2 class="text-xl font-bold">Корт 2</h2>
            @foreach ($schedule as $entry)
                @if ($entry->court_number == 2)
                    @if ($entry->type == 'group')
                        <a href="{{ route('group_practices.view', ['id' => $entry->id]) }}" class="border p-2 mb-2 block">
                            <span>{{ $entry->formatted_time }}</span> - 
                            <span>{{ $entry->practice->type }} - {{ $entry->coach->fio }}</span>
                        </a>
                    @elseif ($entry->type == 'individual')
                        <a href="{{ route('individual_practices.view', ['id' => $entry->id]) }}" class="border p-2 mb-2 block">
                            <span>{{ $entry->formatted_time }}</span> - 
                            <span>Индивидуальная тренировка с {{ $entry->coach->fio }}</span>
                        </a>
                    @elseif ($entry->type == 'rent')
                        <a href="{{ route('rent.view', ['id' => $entry->id]) }}" class="border p-2 mb-2 block">
                            <span>{{ $entry->formatted_time }}</span> - 
                            <span>Аренда корта {{ $entry->name }}</span>
                        </a>
                    @endif
                @endif
            @endforeach
        </div>
    </div>
</div>
@endsection
