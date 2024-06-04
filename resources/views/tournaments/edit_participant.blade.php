@extends('app')

@section('page_title', 'Редактирование Заявки на Турнир - ')

@section('content')
<div class="container mx-auto bg-white p-4">
    <div class="w-3/4 mx-auto bg-white p-8">
        <h1 class="text-2xl font-bold mb-4">Редактировать заявку на турнир "{{$participant->tournament->name}}"</h1>
        <form action="{{ route('tournaments.update_participant', ['participant_id'=>$participant->id]) }}" method="POST">
            @csrf
            <input type="number" name="tournament_id" id="tournament_id" value="{{ $participant->tournament_id}}" class="hidden">
            <div class="mb-4">
                <label for="fio" class="block text-gray-700">Полное имя:</label>
                <input type="text" name="fio" id="fio" value="{{ old('fio', $participant->fio) }}" class="form-input mt-1 block w-full border rounded-md py-2 px-4">
            </div>

            <div class="flex flex-col mb-2">
                <label for="birth_date" class="block text-gray-700">Дата рождения:</label>
                <input type="date" id="birth_date" name="birth_date" value="{{ $participant->birth_date }}" class="border rounded-md py-2 px-4" />
            </div>

            <div class="mb-4">
                <label for="gender" class="block text-gray-700">Пол:</label>
                <select name="gender" id="gender" class="form-select mt-1 block w-full border rounded-md py-2 px-4">
                    <option value="М" {{ $participant->gender == 'М' ? 'selected' : '' }}>Мужской</option>
                    <option value="Ж" {{ $participant->gender == 'Ж' ? 'selected' : '' }}>Женский</option>
                </select>
            </div>

            <div class="flex flex-col mb-2">
                <label for="phone" class="block text-gray-700">Контакты:</label>
                <input type="phone" id="phone" name="phone" value="{{ $participant->phone }}" class="border rounded-md py-2 px-4" />
            </div>

            <div class="mb-4">
                <label for="status" class="block text-gray-700">Статус:</label>
                <select name="status" id="status" class="form-select mt-1 block w-full border rounded-md py-2 px-4">
                    <option value="1" {{ $participant->status == 1 ? 'selected' : '' }}>Зарегистрирован</option>
                    <option value="0" {{ $participant->status == 0 ? 'selected' : '' }}>Снят</option>
                </select>
            </div>

            <div class="flex justify-end">
                <input type="submit" name="participant_update" value="Сохранить" class="bg-green-500 text-white px-4 py-2 rounded-full hover:bg-green-600 transition-all duration-300 cursor-pointer mr-6">
                <a href="{{ route('tournaments.view',['tournament_id'=>$participant->tournament->id]) }}" class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600 transition-all duration-300 cursor-pointer">Отменить</a>
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
