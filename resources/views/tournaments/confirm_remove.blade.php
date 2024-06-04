@extends('app')

@section('page_title', 'Подтверждение снятия игрока - ')

@section('content')
<div class="container mx-auto bg-white p-4">
    <div class="w-3/4 mx-auto bg-white p-8">
        <h1 class="text-2xl font-bold mb-4">Подтвердите снятие игрока</h1>
        <p>Вы действительно хотите снять игрока <strong>{{ $participant->fio }}</strong> с турнира <strong>{{ $participant->tournament->name }}</strong>?</p>
        
        <form action="{{ route('tournaments.remove', $participant->id) }}" method="POST">
            @csrf
            <div class="flex justify-end mt-4">
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-full hover:bg-red-600 transition-all duration-300 cursor-pointer">Снять игрока</button>
                <a href="{{ route('tournaments.view', $participant->tournament_id) }}" class="bg-gray-500 text-white px-4 py-2 rounded-full hover:bg-gray-600 transition-all duration-300 cursor-pointer ml-4">Отменить</a>
            </div>
        </form>
    </div>
</div>
@endsection