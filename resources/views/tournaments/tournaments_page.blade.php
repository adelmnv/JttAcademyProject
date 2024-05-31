
@extends('app')

@section('page_title', 'Турниры - ')
@section('content')
    <div class="container mx-auto bg-white flex-grow p-4">
        <h1 class="text-4xl font-bold text-center my-8">Календарь турниров</h1>
        
        @foreach($tournamentsByMonth as $month => $tournaments)
            @php
                $formattedMonth = strftime("%B %Y", strtotime($month));
            @endphp
            <h2 class="text-2xl font-bold text-center mb-4 mt-3">{{ $formattedMonth }}</h2>
            <div class="overflow-x-auto">
                <table class="table-auto border-collapse border border-gray-400 mx-auto w-3/5">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-gray-400 px-4 py-2">Дата начала</th>
                            <th class="border border-gray-400 px-4 py-2">Название турнира</th>
                            <th class="border border-gray-400 px-4 py-2">Дедлайн</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tournaments as $tournament)
                            <tr>
                                <td class="border border-gray-400 px-4 py-2">{{ strftime("%d.%m.%Y", strtotime($tournament->start_date)) }}</td>
                                <td class="border border-gray-400 px-4 py-2">
                                    <a href="{{ route('tournaments.view', ['tournament_id' => $tournament->id]) }}" class="hover:text-green-500 hover:font-semibold">{{ $tournament->name }}</a> 
                                    ({{ $tournament->category->name }})
                                </td>
                                <td class="border border-gray-400 px-4 py-2 {{ strtotime($tournament->deadline) < time() ? 'text-red-500' : '' }}">{{ strftime("%d.%m.%Y", strtotime($tournament->deadline)) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach
    </div>
@endsection


