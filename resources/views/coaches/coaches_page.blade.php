@extends('app')

@section('page_title', 'Тренера - ')


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
    <h1 class="text-4xl font-bold text-center my-8">Наши Тренеры</h1>
        <div class="flex flex-wrap justify-center gap-4">
            @foreach ($coaches as $coach)
                <div class=" p-4 w-1/4 border">
                    <div>
                        <img src="{{ $coach->main_photo_url }}" class="w-full h-auto max-w-full aspect-rectangular">
                    </div>
                    <div class="mt-2">
                        <a href="{{ route('coaches.view', ['coach_id' => $coach->id]) }}" class="text-lg font-semibold">{{ $coach->fio }}</a>
                    </div>
                    @auth
                        <div class="text-sm mt-4">
                            <a href="{{ route('coaches.edit', ['coach_id' => $coach->id]) }}" class="bg-gray-500 text-white px-2 py-1 rounded hover:bg-gray-600 transition-all duration-300">Редактировать</a>
                        </div>
                    @endauth
                </div>
            @endforeach
            @auth
                @if ($hidden_coaches->isNotEmpty())
                    @foreach ($hidden_coaches as $coach)
                        <div class=" p-4 w-1/4 border">
                            <div class="filter grayscale">
                                <img src="{{ $coach->main_photo_url }}" class="w-full h-auto max-w-full aspect-rectangular">
                            </div>
                            <div class="mt-2">
                                <a href="{{ route('coaches.view', ['coach_id' => $coach->id]) }}" class="text-lg font-semibold">{{ $coach->fio }}</a>
                            </div>
                            <div class="text-sm mt-4">
                                <a href="{{ route('coaches.edit', ['coach_id' => $coach->id]) }}" class="bg-gray-500 text-white px-2 py-1 rounded hover:bg-gray-600 transition-all duration-300">Редактировать</a>
                            </div>
                        </div>
                    @endforeach
                @endif
            @endauth
        </div>
    </div>
@endsection