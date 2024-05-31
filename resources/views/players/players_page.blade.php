@extends('app')

@section('page_title', 'Наши игроки - ')

@section('content')

    <div class="container mx-auto bg-white flex-grow p-4">
    <h1 class="text-4xl font-bold text-center my-8">Наши Игроки</h1>
        <div class="flex flex-wrap justify-center gap-4">
            @foreach ($players as $player)
                <div class="p-4 w-1/4 border">
                    <div>
                        <img src="{{ $player->main_photo_url }}" class="w-full aspect-square">
                    </div>
                    <div class="mt-2">
                        <span class="text-lg font-semibold">{{ $player->fio }}</span>
                    </div>
                    <div class="text-gray-500 text-sm mt-1">
                        {!! nl2br(e($player->achievements)) !!}
                    </div>
                    @auth
                        <div class="text-sm mt-4">
                            <a href="{{ route('players.edit', ['player_id' => $player->id]) }}" class="bg-gray-500 text-white px-2 py-1 rounded hover:bg-gray-600 transition-all duration-300">Редактировать</a>
                        </div>
                    @endauth
                </div>
            @endforeach
            @auth
                @if ($hidden_players->isNotEmpty())
                    @foreach ($hidden_players as $player)
                        <div class="p-4 w-1/4 border bg-gray-200">
                            <div class="filter grayscale">
                                <img src="{{ $player->main_photo_url }}" class="w-full aspect-square">
                            </div>
                            <div class="mt-2">
                                <span class="text-lg font-semibold">{{ $player->fio }}</span>
                            </div>
                            <div class="text-gray-500 text-sm mt-1">
                                {!! nl2br(e($player->achievements)) !!}
                            </div>
                            <div class="text-sm mt-4">
                                <a href="{{ route('players.edit', ['player_id' => $player->id]) }}" class="bg-gray-500 text-white px-2 py-1 rounded hover:bg-gray-600 transition-all duration-300">Редактировать</a>
                            </div>
                        </div>
                     @endforeach
                @endif
            @endauth
        </div>
    </div>
@endsection