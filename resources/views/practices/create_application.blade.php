@extends('app')

@section('page_title', 'Заявка - ')


@section('content')
    <div class="container mx-auto bg-white flex-grow p-4">
        <div class="max-w-md mx-auto bg-white p-8 rounded-md shadow-md">
            @if($type->id == 3)
                <h2 class="text-3xl font-semibold mb-6">Хочу Арендовать корт</h2>
            @else
                <h2 class="text-3xl font-semibold mb-6">Хочу записаться на {{ $practice->type }} {{ $type->name }}</h2>
            @endif
            <form action="{{ route('practices.store_application', ['practice_id' => $practice->id, 'type_id' => $type->id]) }}" method="post">
                <input type="hidden" name="practice_id" value="{{$practice->id}}">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-600">Имя</label>
                    <input type="text" name="name" id="name" placeholder="Введите ваше имя" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:border-blue-500" required>
                </div>
                <div class="mb-4">
                    <label for="phone" class="block text-sm font-medium text-gray-600">Номер телефона</label>
                    <input type="tel" name="phone" id="phone" placeholder="Введите ваш номер телефона" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:border-blue-500" required>
                </div>
                <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded-full hover:bg-green-600 transition-all duration-300">
                    Отправить заявку
                </button>
            </form>
            <p class="mt-4 text-sm text-gray-500">Пробное занятие бесплатно!</p>
            @if($errors->any())
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </div>

        <!-- {{-- Если форма отправлена и заявка успешно создана --}}
        @if (session('success'))
            <div class="mt-8 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md">
                {{ session('success') }}
            </div>
        @endif -->
    </div>
@endsection