@extends('app')

@section('page_title', 'Панель - Абонементы -')

@section('content')
<div class="container mx-auto bg-white flex-grow p-4">
    <div class="flex flex-wrap items-center">
        <div class="rounded-full py-2 px-6 border text-sm transition-all duration-300 hover:bg-green-500 hover:text-white mr-4 mb-4 inline-flex items-center bg-white text-black">
            <a href="{{ route('admin.applications') }}">
                <span>Заявки</span>
            </a>
        </div>
        <div class="rounded-full py-2 px-6 border text-sm bg-white text-black inline-flex items-center mr-4 mb-4">
            <span class="ml-2 font-bold">Абонементы</span>
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
        <div class="row m-10">
            <h1 class="text-4xl font-bold text-center my-8">Абонементы</h1>
            <h2 class="text-xl font-bold mb-3" style="color: #84cc16">Действующие</h2>
            @if($memberships->isEmpty())
                <p>Список пуст</p>
            @else
                <table class="w-4/5 border-collapse border border-gray-400 mx-auto">
                    <thead>
                        <tr style="background-color: #d9f99d; color: #4d7c0f;">
                            <th class="border border-gray-400 px-4 py-2 w-1/16">#</th>
                            <th class="border border-gray-400 px-4 py-2 w-2/16">Оплачен до</th>
                            <th class="border border-gray-400 px-4 py-2 w-3/16">Имя</th>
                            <th class="border border-gray-400 px-4 py-2 w-3/16">Телефон</th>
                            <th class="border border-gray-400 px-4 py-2 w-5/16">Тип</th>
                            <th class="border border-gray-400 px-4 py-2 w-2/16"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($memberships as $membership)
                            <tr @if($membership->days_left <= 3) style="background-color: #fef08a;" @endif>
                                <td class="border border-gray-400 px-4 py-2">{{ $loop->iteration }}</td>
                                <td class="border border-gray-400 px-4 py-2">{{ strftime("%d.%m.%Y", strtotime($membership->paid_until))}}</td>
                                <td class="border border-gray-400 px-4 py-2">{{$membership->name}}</td>
                                <td class="border border-gray-400 px-4 py-2"><a href="https://wa.me/{{$membership->phone}}" target="_blank" style="text-decoration: underline; color: #65a30d;">{{$membership->phone}}</a></td>
                                <td class="border border-gray-400 px-4 py-2">{{$membership->group->practice->type}} {{$membership->practice_type_name}}</td>
                                <td class="border border-gray-400 px-4 py-2 text-center"><a href="{{ route('memberships.view', ['membership_id' => $membership->id]) }}" class="change-status-link text-black px-2 py-1 rounded transition-all duration-300 bg-gray-200 duration-300 ease-in-out transform hover:bg-gray-300">Подробнее</a></td>
                            </tr> 
                        @endforeach
                    </tbody>
                </table>
            @endif

            <h2 class="text-xl font-bold mb-2 mt-3">Просроченные</h2>
            @if($expired_memberships->isEmpty())
                <p>Список пуст</p>
            @else
                <table class="w-4/5 border-collapse border border-gray-400 mx-auto">
                    <thead>
                        <tr class="bg-red-200" style="color:#991b1b;">
                            <th class="border border-gray-400 px-4 py-2 ">#</th>
                            <th class="border border-gray-400 px-4 py-2 ">Оплачен до</th>
                            <th class="border border-gray-400 px-4 py-2 ">Имя</th>
                            <th class="border border-gray-400 px-4 py-2 ">Телефон</th>
                            <th class="border border-gray-400 px-4 py-2 ">Тип</th>
                            <th class="border border-gray-400 px-4 py-2 "></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($expired_memberships as $membership)
                            <tr>
                                <td class="border border-gray-400 px-4 py-2">{{ $loop->iteration }}</td>
                                <td class="border border-gray-400 px-4 py-2 text-red-500">{{ strftime("%d.%m.%Y", strtotime($membership->paid_until))}}</td>
                                <td class="border border-gray-400 px-4 py-2">{{$membership->name}}</td>
                                <td class="border border-gray-400 px-4 py-2"><a href="https://wa.me/{{$membership->phone}}" target="_blank" style="text-decoration: underline;">{{$membership->phone}}</a></td>
                                <td class="border border-gray-400 px-4 py-2">{{$membership->group->practice->type}} {{$membership->practice_type_name}}</td>
                                <td class="border border-gray-400 px-4 py-2 text-center"><a href="{{ route('memberships.view', ['membership_id' => $membership->id]) }}" class="change-status-link text-black px-2 py-1 rounded transition-all duration-300 bg-gray-200 duration-300 ease-in-out transform hover:bg-gray-300">Подробнее</a></td>
                            </tr> 
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection