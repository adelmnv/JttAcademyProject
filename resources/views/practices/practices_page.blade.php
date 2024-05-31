@extends('app')

@section('page_title', 'Тренировки - ')


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
            @foreach ($types as $type)
                <a href="{{route ('practices.by_type', ['type_id'=>$type->id]) }}" class="rounded-full py-2 px-6 border text-sm transition-all duration-300 hover:bg-green-500 hover:text-white mr-4 mb-4 inline-flex items-center bg-white text-black">
                    {{ $type->name }}
                    <span class="ml-2">{{ $type->practices()->count() }}</span>
                </a>
            @endforeach
        </div>
        @foreach ($types as $type)
            <div class="py-4 text-2xl font-bold mb-4">{{ $type->name }}</div>
            <div class="flex flex-wrap">
                @foreach ($type->practices as $practice)
                    <div class="p-4 w-full border mb-4 rounded-lg shadow-md bg-white">
                        <div class="flex items-center mb-4">
                            <div class="text-2xl font-bold mr-4  text-{{ $loop->index % 2 == 0 ? 'purple' : 'blue' }}-900">{{ $practice->type }}</div>
                            <div class="text-{{ $loop->index % 2 == 0 ? 'purple' : 'blue' }}-900">{{ $practice->description }}</div>
                        </div>
                        <div class="flex justify-between items-center bg-{{ $loop->index % 2 == 0 ? 'purple' : 'blue' }}-100 rounded p-4">
                            <div>
                                <p class="text-sm font-semibold mb-2">{{ $practice->payment_type }}</p>
                                <p class="text-lg font-bold">{{ $practice->price }} тг</p>
                            </div>
                            @guest
                                <a href="{{ route('practices.create_application', ['practice_id' => $practice->id, 'type_id' => $type->id]) }}" class="bg-{{ $loop->index % 2 == 0 ? 'purple' : 'blue' }}-900 text-white py-2 px-4 rounded-full hover:bg-{{ $loop->index % 2 == 0 ? 'purple' : 'blue' }}-600 transition-all duration-300">
                                    Хочу играть!
                                </a>
                            @endguest
                            @auth
                            <a href="{{ route('practices.edit', ['practice_id' => $practice->id]) }}" class="bg-{{ $loop->index % 2 == 0 ? 'purple' : 'blue' }}-900 text-white py-2 px-4 rounded-full hover:bg-{{ $loop->index % 2 == 0 ? 'purple' : 'blue' }}-600 transition-all duration-300">
                                    Изменить
                                </a>
                            @endauth
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
@endsection