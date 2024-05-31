@extends('app')

@section('page_title', 'Заявка на турнир - ')

@section('content')
    <div class="container mx-auto bg-white flex-grow p-4">
        <div class="max-w-md mx-auto bg-white p-8 rounded-md shadow-md">
            <h2 class="text-3xl font-semibold mb-6">Хочу заявится на "{{ $tournament->name }}"</h2>
            <form action="{{ route('tournaments.store_registration', ['tournament_id' => $tournament->id]) }}" method="post">
                <input type="hidden" name="tournament_id" value="{{$tournament->id}}">
                @csrf
                <div class="mb-4">
                    <label for="fio" class="block text-sm font-medium text-gray-600">ФИО</label>
                    <input type="text" name="fio" id="fio" placeholder="Введите полное имя участника" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:border-blue-500" required>
                </div>
                <div class="mb-4">
                    <label for="birth_date" class="block text-sm font-medium text-gray-600">Дата Рождения</label>
                    <input type="date" name="birth_date" id="birth_date" placeholder="Введите дату рождения участника" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:border-blue-500" required>
                </div>
                <div class="mb-4">
                    <label for="gender" class="block text-sm font-medium text-gray-600">Пол</label>
                    <select name="gender" id="gender" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:border-blue-500" required>
                        <option value="М">Мужской</option>
                        <option value="Ж">Женский</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="phone" class="block text-sm font-medium text-gray-600">Номер телефона</label>
                    <input type="tel" name="phone" id="phone" placeholder="Введите номер телефона" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:border-blue-500" required>
                </div>
                <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded-full hover:bg-green-600 transition-all duration-300">
                    Отправить заявку
                </button>
            </form>
            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-3" role="alert">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-3" role="alert">
                    {{ session('error') }}
                </div>
            @endif
        </div>
    </div>
@endsection
