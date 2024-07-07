@extends('app')

@section('page_title', 'Групповая тренировка - Создание')

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
                <h1 class="text-3xl font-bold mb-6">Создание групповой тренировки</h1>
                <form action="{{ route('group_practices.save') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="coach_id" class="block text-sm font-medium text-gray-700">Выбор тренера:</label>
                        <select id="coach_id" name="coach_id" class="form-select block w-full mt-1">
                            @foreach ($coaches as $coach)
                            <option value="{{ $coach->id }}">{{ $coach->fio }}</option>
                            @endforeach
                        </select>
                        @error('coach_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="practice_id" class="block text-sm font-medium text-gray-700">Выбор типа тренировки:</label>
                        <select id="practice_id" name="practice_id" class="form-select block w-full mt-1">
                            @foreach ($practices as $practice)
                            <option value="{{ $practice->id }}">{{ $practice->type }} {{ $practice->practice_type_name }}</option>
                            @endforeach
                        </select>
                        @error('practice_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="days_of_week" class="block text-sm font-medium text-gray-700">Дни тренировок: <span class="text-gray-500 text-xs">(зажмите Ctrl/Cmd для выбора нескольких)</span></label>
                        <select id="days_of_week" name="days_of_week[]" class="form-multiselect block w-full mt-1" multiple>
                            <option value="1">Понедельник</option>
                            <option value="2">Вторник</option>
                            <option value="3">Среда</option>
                            <option value="4">Четверг</option>
                            <option value="5">Пятница</option>
                            <option value="6">Суббота</option>
                        </select>
                        @error('days_of_week')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="time" class="block text-sm font-medium text-gray-700">Время начала тренировки:</label>
                        <input type="time" id="time" name="time" class="form-input block w-full mt-1">
                        @error('time')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="court_number" class="block text-sm font-medium text-gray-700">Выбор корта:</label>
                        <select id="court_number" name="court_number" class="form-select block w-full mt-1">
                            <option value="1">1 корт</option>
                            <option value="2">2 корт</option>
                        </select>
                        @error('court_number')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="capacity" class="block text-sm font-medium text-gray-700">Максимальное количество участников:</label>
                        <input type="number" id="capacity" name="capacity" class="form-input block w-full mt-1">
                        @error('capacity')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end mb-4">
                        <a href="{{ route('admin.applications') }}" class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600 transition-all duration-300">Назад</a>
                        <button type="submit" class="bg-yellow-500 text-white ml-4 px-4 py-2 rounded-full hover:bg-yellow-600 transition-all duration-300">Сохранить изменения</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
