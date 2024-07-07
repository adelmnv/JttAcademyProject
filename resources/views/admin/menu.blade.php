@extends('app')

@section('page_title', 'Панель - Создание - ')

@section('content')
<div class="container mx-auto bg-white flex-grow p-4">
    <div class="flex flex-wrap items-center">
        <div class="rounded-full py-2 px-6 border text-sm transition-all duration-300 hover:bg-green-500 hover:text-white mr-4 mb-4 inline-flex items-center bg-white text-black">
            <a href="{{ route('admin.applications') }}">
                <span>Заявки</span>
            </a>
        </div>
        <div class="rounded-full py-2 px-6 border text-sm transition-all duration-300 hover:bg-green-500 hover:text-white mr-4 mb-4 inline-flex items-center bg-white text-black">
            <a href="{{ route('memberships') }}">
                <span>Абонементы</span>
            </a>
        </div>
        <div class="rounded-full py-2 px-6 border text-sm transition-all duration-300 hover:bg-green-500 hover:text-white mr-4 mb-4 inline-flex items-center bg-white text-black">
            <a href="{{ route('admin.schedule') }}">
                <span>Расписание</span>
            </a>
        </div>
        <div class="rounded-full py-2 px-6 border text-sm bg-white text-black inline-flex items-center mr-4 mb-4">
            <span class="ml-2 font-bold">Меню по созданию</span>
        </div>
    </div>
   
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        <a href="{{ route('practices.create') }}" class="group">
            <div class="bg-gray-200 p-20 rounded-lg text-center transition duration-300 ease-in-out transform hover:shadow-lg hover:border-2 hover:border-gray-300" style="background-color: #f5f5f4;">
                <h5 class="text-xl font-bold">Создать новую тренировку</h5>
            </div>
        </a>
        <a href="{{ route('posts.create') }}" class="group">
            <div class="bg-gray-200 p-20 rounded-lg text-center transition duration-300 ease-in-out transform hover:shadow-lg hover:border-2 hover:border-gray-300" style="background-color: #f5f5f4;">
                <h5 class="text-xl font-bold">Создать новый пост</h5>
            </div>
        </a>
        <a href="{{ route('tournaments.create') }}" class="group">
            <div class="bg-gray-200 p-20 rounded-lg text-center transition duration-300 ease-in-out transform hover:shadow-lg hover:border-2 hover:border-gray-300" style="background-color: #f5f5f4;">
                <h5 class="text-xl font-bold">Создать новый турнир</h5>
            </div>
        </a>
        <a href="{{ route('players.create') }}" class="group">
            <div class="bg-gray-200 p-20 rounded-lg text-center transition duration-300 ease-in-out transform hover:shadow-lg hover:border-2 hover:border-gray-300" style="background-color: #f5f5f4;">
                <h5 class="text-xl font-bold">Создать нового игрока</h5>
            </div>
        </a>
        <a href="{{ route('coaches.create') }}" class="group">
            <div class="bg-gray-200 p-20 rounded-lg text-center transition duration-300 ease-in-out transform hover:shadow-lg hover:border-2 hover:border-gray-300" style="background-color: #f5f5f4;">
                <h5 class="text-xl font-bold">Создать нового тренера</h5>
            </div>
        </a>
        <a href="{{ route('group_practices.create') }}" class="group">
            <div class="bg-gray-200 p-20 rounded-lg text-center transition duration-300 ease-in-out transform hover:shadow-lg hover:border-2 hover:border-gray-300" style="background-color: #f5f5f4;">
                <h5 class="text-xl font-bold">Создать новую группу</h5>
            </div>
        </a>
        <a href="{{ route('memberships.create') }}" class="group">
            <div class="bg-gray-200 p-20 rounded-lg text-center transition duration-300 ease-in-out transform hover:shadow-lg hover:border-2 hover:border-gray-300" style="background-color: #f5f5f4;">
                <h5 class="text-xl font-bold">Создать новой абонемент</h5>
            </div>
        </a>
        <a href="{{ route('individual_practices.create') }}" class="group">
            <div class="bg-gray-200 p-20 rounded-lg text-center transition duration-300 ease-in-out transform hover:shadow-lg hover:border-2 hover:border-gray-300" style="background-color: #f5f5f4;">
                <h5 class="text-xl font-bold">Создать запись на индивидуалку</h5>
            </div>
        </a>
        <a href="{{ route('rent_courts.create') }}" class="group">
            <div class="bg-gray-200 p-20 rounded-lg text-center transition duration-300 ease-in-out transform hover:shadow-lg hover:border-2 hover:border-gray-300" style="background-color: #f5f5f4;">
                <h5 class="text-xl font-bold">Создать запись на аренду</h5>
            </div>
        </a>
        
    </div>
</div>
@endsection