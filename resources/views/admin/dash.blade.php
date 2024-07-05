@extends('app')

@section('page_title', 'Панель - ')

@section('content')
<div class="container mx-auto bg-white flex-grow p-4">
    <div class="flex flex-wrap items-center">
        <button id='applicationsBtn' class="rounded-full py-2 px-6 border text-sm transition-all duration-300 hover:bg-green-500 hover:text-white mr-4 mb-4 inline-flex items-center bg-white text-black font-bold">
            Заявки
        </button>
        <button id='createBtn' class="rounded-full py-2 px-6 border text-sm transition-all duration-300 hover:bg-green-500 hover:text-white mr-4 mb-4 inline-flex items-center bg-white text-black ">
            Создать
        </button>
    </div>
    <div class="mb-8">
        <div id='applications' class="row m-10">
            <h4 class="text-2xl font-bold mb-4 text-center">Заявки на тренировки и аренду</h4>
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
                            <th class="border border-gray-400 px-4 py-2 w-3/12">Телефон</th>
                            <th class="border border-gray-400 px-4 py-2 w-3/12">Тип Заявки</th>
                            <th class="border border-gray-400 px-4 py-2 w-2/12"></th>
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
                            <th class="border border-gray-400 px-4 py-2 w-3/12">Телефон</th>
                            <th class="border border-gray-400 px-4 py-2 w-3/12">Тип Заявки</th>
                            <th class="border border-gray-400 px-4 py-2 w-2/12"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($processed_applications as $app)
                            <tr @if($app->status == 3) class="bg-red-200" style="color:#991b1b;" @endif>
                                <td class="border border-gray-400 px-4 py-2">{{ $loop->iteration }}</td>
                                <td class="border border-gray-400 px-4 py-2">{{$app->name}}</td>
                                <td class="border border-gray-400 px-4 py-2"><a href="https://wa.me/{{$app->phone}}" target="_blank" style="text-decoration: underline; ">{{$app->phone}}</a></td>
                                <td class="border border-gray-400 px-4 py-2">{{$app->practice->type}}</td>
                                <td class="border border-gray-400 px-4 py-2 text-center">@if($app->status == 3) отказ от услуг @else успешная обработка @endif</td>
                            </tr> 
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

    </div>

    <div id="createList" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4" style="display: none;">
        <a href="{{ route('practices.create') }}">
            <div class="bg-gray-200 p-20 rounded-lg text-center" style="background-color: #f5f5f4;">
                <h5 class="text-xl font-bold">Создать новую тренировку</h5>
            </div>
        </a>
        <a href="{{ route('posts.create') }}">
            <div class="bg-gray-200 p-20 rounded-lg text-center" style="background-color: #f5f5f4;">
                <h5 class="text-xl font-bold">Создать новый пост</h5>
            </div>
        </a>
        <a href="{{ route('tournaments.create') }}">
            <div class=" bg-gray-200 p-20 rounded-lg text-center" style="background-color: #f5f5f4;">
                <h5 class=" text-xl font-bold">Создать новый турнир</h5>
            </div>
        </a>
        <a href="{{ route('players.create') }}">
            <div class="bg-gray-200 p-20 rounded-lg text-center" style="background-color: #f5f5f4;">
                <h5 class="text-xl font-bold">Создать нового игрока</h5>
            </div>
        </a>
        <a href="{{ route('coaches.create') }}">
            <div class="bg-gray-200 p-20 rounded-lg text-center" style="background-color: #f5f5f4;">
                <h5 class="text-xl font-bold">Создать нового тренера</h5>
            </div>
        </a>
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
                    <div id="processType" style="display: none;">
                        <input type="radio" id="success" name="processType" value="success">
                        <label for="success">Успешно обработана</label><br>
                        <input type="radio" id="declined" name="processType" value="declined">
                        <label for="declined">Отказано в обработке</label><br>
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
        const createBtn = document.getElementById('createBtn');
        const applicationsBtn = document.getElementById('applicationsBtn');

        const createList = document.getElementById('createList');
        const applications = document.getElementById('applications');

        createBtn.addEventListener('click', function () {
            createList.style.display = 'grid';
            applications.style.display = 'none';

            createBtn.classList.add('font-bold');
            applicationsBtn.classList.remove('font-bold');
        });

        applicationsBtn.addEventListener('click', function () {
            createList.style.display = 'none';
            applications.style.display = 'block';

            createBtn.classList.remove('font-bold');
            applicationsBtn.classList.add('font-bold');
        });

        scheduleBtn.addEventListener('click', function(){
            createList.style.display = 'none';
            applications.style.display = 'none';

            createBtn.classList.remove('font-bold');
            applicationsBtn.classList.remove('font-bold');
        });
    });

    function ChangeStatus(id, status, name) {
        const modal = document.getElementById('confirmModal');
        const changeForm = document.getElementById('changeForm');
        const confirmMessage = document.getElementById('confirmMessage');
        const processType = document.getElementById('processType');

        changeForm.action = `/applications/edit/${id}`;

        if (status == 1) {
            confirmMessage.innerHTML = `Как закончилась обработка заявки?`;
            processType.style.display = 'block'; 
        } else {
            confirmMessage.innerHTML = `Вы уверены, что хотите изменить статус заявки?`;
            processType.style.display = 'none';
        }

        // Устанавливаем ID заявки в скрытом поле
        document.getElementById('appId').value = id;

        // Отображаем модальное окно
        modal.classList.remove('hidden');
    }
</script>