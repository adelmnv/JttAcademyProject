@extends('app')

@section('page_title', 'Индивидуальная Тренировка - Редактирование')

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
                <h1 class="text-3xl font-bold mb-6">Редактирование индивидуальной тренировки</h1>
                <form action="{{ route('individual_practices.update', ['id' => $indv_practice->id]) }}" method="POST">
                    @csrf
                    @method('POST')
                    
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Имя:</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $indv_practice->name) }}" class="form-input block w-full mt-1">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="phone" class="block text-sm font-medium text-gray-700">Номер телефона:</label>
                        <input type="phone" id="name" name="phone" value="{{ old('phone', $indv_practice->phone) }}" class="form-input block w-full mt-1">
                        @error('phone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="coach_id" class="block text-sm font-medium text-gray-700">Выберите тренера:</label>
                        @foreach ($coaches as $coach)
                            <div class="flex items-center">
                                <input type="radio" id="coach_{{ $coach->id }}" name="coach_id" value="{{ $coach->id }}" {{ $indv_practice->coach_id == $coach->id ? 'checked' : '' }} class="mr-2">
                                <label for="coach_{{ $coach->id }}" class="text-sm font-medium text-gray-900">{{ $coach->fio }}</label>
                            </div>
                        @endforeach
                    </div>

                    <div class="mb-4">
                        <label for="practice_id" class="block text-sm font-medium text-gray-700">Выберите возрастную категорию:</label>
                        @foreach ($practices as $practice)
                            <div class="flex items-center">
                                <input type="radio" id="practice_{{ $practice->id }}" name="practice_id" value="{{ $practice->id }}" {{ $indv_practice->practice_id == $practice->id ? 'checked' : '' }} class="mr-2">
                                <label for="practice_{{ $practice->id }}" class="text-sm font-medium text-gray-900">{{ $practice->type }} {{$practice->practice_type_name}} | {{$practice->payment_type}} ({{$practice->price}} тг)</label>
                            </div>
                        @endforeach
                    </div>

                    <div class="mb-4">
                        <label for="date" class="block text-sm font-medium text-gray-700">Дата тренировки:</label>
                        <input type="date" id="date" name="date" value="{{ old('date', $indv_practice->date) }}" class="form-input block w-full mt-1">
                        @error('date')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="time" class="block text-sm font-medium text-gray-700">Время тренировки:</label>
                        <input type="time" id="time" name="time" value="{{ old('time', $indv_practice->time) }}" class="form-input block w-full mt-1">
                        @error('time')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="time" class="block text-sm font-medium text-gray-700">Продолжительность тренировки (ч.):</label>
                        <input type="number" id="duration" name="duration" value="{{ old('duration', $indv_practice->duration) }}" class="form-input block w-full mt-1">
                        @error('duration')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="court_number" class="block text-sm font-medium text-gray-700">Выбор корта:</label>
                        <select id="court_number" name="court_number" class="form-select block w-full mt-1">
                            <option value="1" {{ $indv_practice->court_number == 1 ? 'selected' : '' }}>1 корт</option>
                            <option value="2" {{ $indv_practice->court_number == 2 ? 'selected' : '' }}>2 корт</option>
                        </select>
                        @error('court')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end mb-4">
                        <a href="{{ route('admin.schedule') }}" class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600 transition-all duration-300">Назад</a>
                        <button type="submit" class="bg-yellow-500 text-white ml-4 px-4 py-2 rounded-full hover:bg-yellow-600 transition-all duration-300">Сохранить изменения</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection