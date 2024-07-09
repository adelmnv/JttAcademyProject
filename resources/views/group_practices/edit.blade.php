@extends('app')

@section('page_title', 'Групповая тренировка - Редактирование')

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
                <h1 class="text-3xl font-bold mb-6">Редактирование групповой тренировки</h1>
                <form action="{{ route('group_practices.update', ['id' => $group->id]) }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="coach_id" class="block text-sm font-medium text-gray-700">Выберите тренера:</label>
                        @foreach ($coaches as $coach)
                            <div class="flex items-center">
                                <input type="radio" id="coach_{{ $coach->id }}" name="coach_id" value="{{ $coach->id }}" {{ $group->coach_id == $coach->id ? 'checked' : '' }} class="mr-2">
                                <label for="coach_{{ $coach->id }}" class="text-sm font-medium text-gray-900">{{ $coach->fio }}</label>
                            </div>
                        @endforeach
                    </div>

                    <div class="mb-4">
                        <span class="text-gray-500 text-xs">Профессиональные тренировки 2ч, Обычные 1ч</span>
                        <label for="practice_id" class="block text-sm font-medium text-gray-700">Выберите тип тренировки:</label>
                        @foreach ($practices as $practice)
                            <div class="flex items-center">
                                <input type="radio" id="practice_{{ $practice->id }}" name="practice_id" value="{{ $practice->id }}" {{ $group->practice_id == $practice->id ? 'checked' : '' }} class="mr-2">
                                <label for="practice_{{ $practice->id }}" class="text-sm font-medium text-gray-900">{{ $practice->type }} {{$practice->practice_type_name}} | {{$practice->payment_type}} ({{$practice->price}} тг)</label>
                            </div>
                        @endforeach
                    </div>

                    <div class="mb-4">
                        <label for="days_of_week" class="block text-sm font-medium text-gray-700">
                            Дни тренировок: <span class="text-gray-500 text-xs">(зажмите Ctrl/Cmd для выбора нескольких)</span>
                        </label>
                        <select id="days_of_week" name="days_of_week[]" class="form-multiselect block w-full mt-1" multiple>
                            @php
                                $selectedDays = explode(',', $group->days_of_week); // assuming days are stored as comma-separated string
                            @endphp
                            <option value="1" {{ in_array('1', $selectedDays) ? 'selected' : '' }}>Понедельник</option>
                            <option value="2" {{ in_array('2', $selectedDays) ? 'selected' : '' }}>Вторник</option>
                            <option value="3" {{ in_array('3', $selectedDays) ? 'selected' : '' }}>Среда</option>
                            <option value="4" {{ in_array('4', $selectedDays) ? 'selected' : '' }}>Четверг</option>
                            <option value="5" {{ in_array('5', $selectedDays) ? 'selected' : '' }}>Пятница</option>
                            <option value="6" {{ in_array('6', $selectedDays) ? 'selected' : '' }}>Суббота</option>
                        </select>
                        @error('days_of_week')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="time" class="block text-sm font-medium text-gray-700">Время начала тренировки:</label>
                        <input type="time" id="time" name="time" value="{{ old('time', $group->time) }}" class="form-input block w-full mt-1">
                        @error('time')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="court_number" class="block text-sm font-medium text-gray-700">Выбор корта:</label>
                        <select id="court_number" name="court_number" class="form-select block w-full mt-1">
                            <option value="1" {{ $group->court_number == 1 ? 'selected' : '' }}>1 корт</option>
                            <option value="2" {{ $group->court_number == 2 ? 'selected' : '' }}>2 корт</option>
                        </select>
                        @error('court')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="capacity" class="block text-sm font-medium text-gray-700">Максимальное количество участников:</label>
                        <input type="number" id="capacity" name="capacity" value="{{ old('capacity', $group->capacity) }}" class="form-input block w-full mt-1">
                        @error('capacity')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="flex items-center justify-end mb-4">
                        <a href="{{ route('admin.applications') }}" class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600 transition-all duration-300">Назад</a>
                        <button type="submit" class="bg-yellow-500 text-white ml-4 px-4 py-2 rounded-full hover:bg-yellow-600 transition-all duration-300">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection