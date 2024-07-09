@extends('app')

@section('page_title', 'Панель - Расписание - ')

@section('content')

@if(session('success'))
            <div id="successMessage" class="bg-green-500 text-white p-4 mb-4 rounded-md shadow-md">
                {{ session('success') }}
            </div>

            <script>
                setTimeout(function() {
                    document.getElementById('successMessage').style.display = 'none';
                }, 5000);
            </script>
@endif

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
        <div class="rounded-full py-2 px-6 border text-sm bg-white text-black inline-flex items-center mr-4 mb-4">
            <span class="ml-2 font-bold">Расписание</span>
        </div>
        <div class="rounded-full py-2 px-6 border text-sm transition-all duration-300 hover:bg-green-500 hover:text-white mr-4 mb-4 inline-flex items-center bg-white text-black">
            <a href="{{ route('admin.menu') }}">
                <span>Меню по созданию</span>
            </a>
        </div>
    </div>
   
    <div class="container mx-auto py-8">
        <div class="flex justify-between items-center mb-4">
            <div>
                <h1 class="text-3xl font-bold">Расписание</h1>
                <p class="text-lg text-gray-600">{{ $currentMonthName }} {{ $currentYear }}</p>
            </div>
            <div>
                <a href="{{ route('admin.schedule', ['month' => $prevMonth, 'year' => $prevYear]) }}" class="px-2 py-1 rounded bg-gray-200 text-gray-700">&lt; Назад</a>
                <a href="{{ route('admin.schedule', ['month' => $nextMonth, 'year' => $nextYear]) }}" class="px-2 py-1 rounded bg-gray-200 text-gray-700">Вперед &gt;</a>
            </div>
        </div>

        <div class="grid grid-cols-7 gap-2 bg-gray-100 text-center mb-4">
            @foreach ($weekdays as $weekday)
                <div>{{ $weekday }}</div>
            @endforeach
        </div>

        <div class="grid grid-cols-7 gap-4">
            @foreach ($dates as $date)
                <div class="border p-4">
                    <a href="{{ route('admin.daily_schedule', ['date' => $date['date']]) }}">
                        <div class="font-bold mb-2">{{ $date['day'] }}</div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection