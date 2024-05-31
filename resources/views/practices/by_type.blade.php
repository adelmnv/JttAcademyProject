@extends('app')

@section('page_title', 'Категории - ')


@section('content')
    <div class="container mx-auto bg-white flex-grow p-4">
        <div class="flex flex-wrap items-center">
            @foreach ($types as $type)
                @if ($selected_type == $type)
                    <div class="rounded-full py-2 px-6 border text-sm bg-white text-black inline-flex items-center mr-4 mb-4">
                        <span class="ml-2 font-bold">{{ $type->name }}</span>
                        <span class="ml-2 font-bold">{{ $type->practices()->count() }}</span>
                    </div>
                @else
                    <div class="rounded-full py-2 px-6 border text-sm transition-all duration-300 hover:bg-green-500 hover:text-white mr-4 mb-4 inline-flex items-center bg-white text-black">
                        <a href="{{ route('practices.by_type', ['type_id' => $type->id]) }}">
                            <span>{{ $type->name }}</span>
                            <span class="ml-2">{{ $type->practices()->count() }}</span>
                        </a>
                    </div>
                @endif  
            @endforeach
            <div class="rounded-full py-2 px-6 border text-sm transition-all duration-300 hover:bg-green-500 hover:text-white mr-4 mb-4 inline-flex items-center bg-white text-black">
                <a href="{{ route('practices') }}">
                    <span>Все</span>
                </a>
            </div>
        </div>

  
        <div class="">
            <div class="flex flex-wrap justify-center gap-4">
                @foreach ($selected_type->practices as $practice)
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
                            <a href="{{ route('practices.create_application', ['practice_id' => $practice->id, 'type_id' => $selected_type->id]) }}" class="bg-{{ $loop->index % 2 == 0 ? 'purple' : 'blue' }}-900 text-white py-2 px-4 rounded-full hover:bg-{{ $loop->index % 2 == 0 ? 'purple' : 'blue' }}-600 transition-all duration-300">
                                Хочу играть!
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection