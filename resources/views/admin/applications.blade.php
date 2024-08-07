@extends('app')

@section('page_title', 'Панель - Заявки -')

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
        <div class="rounded-full py-2 px-6 border text-sm bg-white text-black inline-flex items-center mr-4 mb-4">
            <span class="ml-2 font-bold">Заявки</span>
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
        <div class="rounded-full py-2 px-6 border text-sm transition-all duration-300 hover:bg-green-500 hover:text-white mr-4 mb-4 inline-flex items-center bg-white text-black">
            <a href="{{ route('admin.menu') }}">
                <span>Меню по созданию</span>
            </a>
        </div>
    </div>
    <div class="mb-8">
        <div class="row m-10">
            <h1 class="text-4xl font-bold text-center my-8">Заявки на тренировки и аренду</h1>
            <h2 class="text-xl font-bold mb-3" style="color: #84cc16">Новые</h2>
            @if($new_applications->isEmpty())
                <p>Список пуст</p>
            @else
                <table class="w-4/5 border-collapse border border-gray-400 mx-auto">
                    <thead>
                        <tr style="background-color: #d9f99d; color: #4d7c0f;">
                            <th class="border border-gray-400 px-4 py-2 w-1/12">#</th>
                            <th class="border border-gray-400 px-4 py-2 w-3/12">Имя</th>
                            <th class="border border-gray-400 px-4 py-2 w-3/12">Телефон</th>
                            <th class="border border-gray-400 px-4 py-2 w-3/12">Тип Заявки</th>
                            <th class="border border-gray-400 px-4 py-2 w-2/12"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($new_applications as $app)
                            <tr>
                                <td class="border border-gray-400 px-4 py-2">{{ $loop->iteration }}</td>
                                <td class="border border-gray-400 px-4 py-2">{{$app->name}}</td>
                                <td class="border border-gray-400 px-4 py-2"><a href="https://wa.me/{{$app->phone}}" target="_blank" style="text-decoration: underline; color: #65a30d;">{{$app->phone}}</a></td>
                                <td class="border border-gray-400 px-4 py-2">{{$app->practice->type}}</td>
                                <td class="border border-gray-400 px-4 py-2 text-center"><a href="#" onclick="ChangeStatus('{{ $app->id }}', '{{ $app->status }}', '{{ $app->name }}')"  class="change-status-link text-white px-2 py-1 rounded transition-all duration-300" style="background-color:#84cc16">Изменить статус</a></td>
                            </tr> 
                        @endforeach
                    </tbody>
                </table>
            @endif

            <h2 class="text-xl font-bold mb-2 mt-3" style="color: #eab308">В обработке</h2>
            @if($processing_applications->isEmpty())
                <p>Список пуст</p>
            @else
                <table class="w-4/5 border-collapse border border-gray-400 mx-auto">
                    <thead>
                        <tr style="background-color: #fef08a; color: #f97316">
                            <th class="border border-gray-400 px-4 py-2 w-1/12">#</th>
                            <th class="border border-gray-400 px-4 py-2 w-3/12">Имя</th>
                            <th class="border border-gray-400 px-4 py-2 w-2/12">Телефон</th>
                            <th class="border border-gray-400 px-4 py-2 w-3/12">Тип Заявки</th>
                            <th class="border border-gray-400 px-4 py-2 w-3/12"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($processing_applications as $app)
                            <tr>
                                <td class="border border-gray-400 px-4 py-2">{{ $loop->iteration }}</td>
                                <td class="border border-gray-400 px-4 py-2">{{$app->name}}</td>
                                <td class="border border-gray-400 px-4 py-2"><a href="https://wa.me/{{$app->phone}}" target="_blank" style="text-decoration: underline; color: #f97316;">{{$app->phone}}</a></td>
                                <td class="border border-gray-400 px-4 py-2">{{$app->practice->type}}</td>
                                <td class="border border-gray-400 px-4 py-2 text-center"><a href="#" onclick="ChangeStatus('{{ $app->id }}', '{{ $app->status }}', '{{ $app->name }}')"  class="change-status-link text-white px-2 py-1 rounded transition-all duration-300" style="background-color:#fb923c">Изменить статус</a></td>
                            </tr> 
                        @endforeach
                    </tbody>
                </table>
            @endif

            <h2 class="text-xl font-bold mb-2 mt-3">Обработанные</h2>
            @if($processed_applications->isEmpty())
                <p>Список пуст</p>
            @else
                <table class="w-4/5 border-collapse border border-gray-400 mx-auto">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-gray-400 px-4 py-2 w-1/12">#</th>
                            <th class="border border-gray-400 px-4 py-2 w-3/12">Имя</th>
                            <th class="border border-gray-400 px-4 py-2 w-2/12">Телефон</th>
                            <th class="border border-gray-400 px-4 py-2 w-3/12">Тип Заявки</th>
                            <th class="border border-gray-400 px-4 py-2 w-3/12"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($processed_applications as $app)
                            <tr @if($app->status == 3) class="bg-red-200" style="color:#991b1b;" @endif>
                                <td class="border border-gray-400 px-4 py-2">{{ $loop->iteration }}</td>
                                <td class="border border-gray-400 px-4 py-2">{{$app->name}}</td>
                                <td class="border border-gray-400 px-4 py-2"><a href="https://wa.me/{{$app->phone}}" target="_blank" style="text-decoration: underline; ">{{$app->phone}}</a></td>
                                <td class="border border-gray-400 px-4 py-2">{{$app->practice->type}}</td>
                                <td class="border border-gray-400 px-4 py-2 text-center">
                                    @if($app->status == 3)
                                        Отказ от услуг
                                    @elseif($app->practice->type == "Групповые тренировки" || $app->practice->type == "Профессиональные групповые тренировки")
                                        <a href="{{ route('memberships.create', ['id' => $app->id]) }}" style="text-decoration: underline;">Создать абонемент</a>
                                    @elseif($app->practice->type == "Персональные тренировки")
                                        <a href="{{ route('individual_practices.create', ['id' => $app->id]) }}" style="text-decoration: underline;">Записать на индивидуалку</a>
                                    @elseif($app->practice->type == "Аренда")
                                        <a href="{{ route('rent_courts.create', ['id' => $app->id]) }}" style="text-decoration: underline;">Забронировать корт</a>
                                    @endif
                                </td>
                            </tr> 
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

    </div>

    <div id="confirmModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50 hidden">
        <div class="bg-white p-6 rounded-lg">
            <h2 class="text-lg font-bold mb-4">Изменение статуса заявки</h2>
            <p id="confirmMessage" class="text-xl font-bold mb-4">Вы уверены, что хотите изменить статус заявки?</p>
            <div class="flex justify-between">
                <form id="changeForm" action="" method="POST">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="id" id="appId">
                    <div id="processType" class="mb-2" style="display: none;">
                        <input type="radio" id="success" name="processType" value="success">
                        <label for="success">Успешно обработана</label><br>
                        <input type="radio" id="declined" name="processType" value="declined">
                        <label for="declined">Отказ от услуг</label><br>
                    </div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Подтвердить изменение
                    </button>
                    <button id="cancelBtn" class="bg-gray-500 text-white px-4 py-2 rounded-full hover:bg-gray-600 transition-all duration-300 cursor-pointer ml-4">Отмена</button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const cancelBtn = document.getElementById('cancelBtn');
        const modal = document.getElementById('confirmModal');

        cancelBtn.addEventListener('click', function (event) {
            event.preventDefault();
            modal.classList.add('hidden');
        });

        
    });

    function ChangeStatus(id, status, name) {
        const modal = document.getElementById('confirmModal');
        const changeForm = document.getElementById('changeForm');
        const confirmMessage = document.getElementById('confirmMessage');
        const processType = document.getElementById('processType');

        changeForm.action = `applications/edit/${id}`;

        if (status == 1) {
            confirmMessage.innerHTML = `Как закончилась обработка заявки?`;
            processType.style.display = 'block'; 
        } else {
            confirmMessage.innerHTML = `Вы уверены, что хотите изменить статус заявки?`;
            processType.style.display = 'none';
        }

        //document.getElementById('appId').value = id;

        modal.classList.remove('hidden');
    } 
</script>