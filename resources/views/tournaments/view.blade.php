@extends('app')

@section('page_title', 'Просмотр турнира - ' . $tournament->name)
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

    <div class="container mx-auto bg-white p-8 rounded-lg shadow-lg" >
        <div class="flex items-center justify-between mb-2 p-9" style="background-image: url('{{ asset('img/tennis-main.jpg') }}'); background-size: cover; background-position: center;">
            <h1 class="text-4xl font-bold pl-4" style="color: rgb(255, 255, 255);">{{ $tournament->name }}</h1>
        </div>
        <div class="border-b border-gray-400 mb-8"></div>
        <div class="flex justify-between mb-4">
            <div class="w-1/2">
                <p>Начало: {{ strftime("%d.%m.%Y", strtotime($tournament->start_date)) }}</p>
                <p>Конец: {{ strftime("%d.%m.%Y", strtotime($tournament->end_date)) }}</p>
            </div>
            <div class="w-1/2">
            <div class="flex justify-between items-center">
                <p></p>
                @if(strtotime($tournament->deadline) < time())
                    <p class="text-red-500">Регистрация закрыта</p>
                @else
                    @guest
                        <a href="{{ route('tournaments.create_registration', ['tournament_id' => $tournament->id]) }}" class="block bg-purple-900 text-white py-2 px-4 rounded-full hover:bg-purple-600 transition-all duration-300 w-1/4 text-center">Заявиться</a>
                    @endguest
                    @auth
                    <a href="{{ route('tournaments.edit', ['tournament_id' => $tournament->id]) }}" class="block bg-yellow-500 text-white py-2 px-4 rounded-full hover:bg-yellow-700 transition-all duration-300 w-1/4 text-center">Изменить</a>
                    @endauth
                @endif
            </div>
            @if(strtotime($tournament->deadline) < time())
                <p class="mt-0 text-right">Последний день подачи заявок: {{ strftime("%d.%m.%Y", strtotime($tournament->deadline)) }}</p>
            @endif
        </div>
    </div>

    <div class="border-b border-gray-400 mb-8"></div>
    <div class="mb-8">
        <p class="font-bold mb-2">О турнире</p>
        <div class="p-4 bg-gray-100 rounded-lg mb-4">
            <p><span class="font-bold">Место проведения:</span> гостиница Интерконтиненталь Желтокстан 181, г. Алматы</p>
            <p><span class="font-bold">Главный судья:</span> Бекметова Лариса Керимбаевна +77017579043</p>
            <p><span class="font-bold">Последний день подачи заявок:</span> {{ strftime("%d.%m.%Y", strtotime($tournament->deadline)) }}</p>
        </div>
        <div class="p-4 bg-gray-100 rounded-lg mb-4">
            <p><span class="font-bold">Формат проведения:</span> групповой с розыгрышем всех мест. С последующим выходом двух лучших игроков из группы на стыковые матчи. Играют один тай-брейк до 10.</p>
            <p><span class="font-bold">Возрастная категория:</span> {{ $tournament->category->name }}</p>
        </div>
        <div class="p-4 bg-gray-100 rounded-lg mb-4">
            <p><span class="font-bold">Обеспечение:</span> Судейство, мячи. Все участники награждаются сувенирами, победители кубками и призами.</p>
            <p><span class="font-bold">Вступительный взнос:</span> 6000 ₸</p>
        </div>
    </div>
    <div class="flex mb-4">
        <button id="listBtn" class="bg-slate-100 hover:bg-lime-500 text-black hover:text-slate-100 font-bold py-2 px-4 rounded mr-4">Списки</button>
        <button id="fileBtn" class="bg-slate-100 hover:bg-lime-500 text-black hover:text-slate-100 font-bold py-2 px-4 rounded">Файлы</button>
    </div>
    <div class="mb-8" id="listView">
        <p class="font-bold mb-2">Список участников</p>
        <div class="flex mb-4">
            <button id="boysBtn" class="bg-blue-400 bg-blue-600 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mr-4">Мальчики</button>
            <button id="girlsBtn" class="bg-pink-400 hover:bg-pink-600 text-white font-bold py-2 px-4 rounded">Девочки</button>
        </div>
        <div id="boysList">
            <h2 class="font-bold text-lg mb-2">Мальчики</h2>
            @if($participants->where('gender', 'М')->count() == 0)
                <p>Список недоступен</p>
            @else
                <table class="w-full border-collapse border border-gray-400">
                    <thead>
                        <tr>
                            <th class="border border-gray-400 px-4 py-2">#</th>
                            <th class="border border-gray-400 px-4 py-2">ФИО</th>
                            <th class="border border-gray-400 px-4 py-2">Дата рождения</th>
                            <th class="border border-gray-400 px-4 py-2">Телефон</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($participants->where('gender', 'М') as $participant)
                            <tr>
                                <td class="border border-gray-400 px-4 py-2">{{ $loop->iteration }}</td>
                                <td class="border border-gray-400 px-4 py-2">{{ $participant->fio }}</td>
                                <td class="border border-gray-400 px-4 py-2">{{ strftime("%d.%m.%Y", strtotime($participant->birth_date))}}</td>
                                <td class="border border-gray-400 px-4 py-2">{{ $participant->phone }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        <div id="girlsList" style="display: none;">
            <h2 class="font-bold text-lg mb-2">Девочки</h2>
            @if($participants->where('gender', 'Ж')->count() == 0)
                <p>Список недоступен</p>
            @else
                <table class="w-full border-collapse border border-gray-400">
                    <thead>
                        <tr>
                            <th class="border border-gray-400 px-4 py-2">#</th>
                            <th class="border border-gray-400 px-4 py-2">ФИО</th>
                            <th class="border border-gray-400 px-4 py-2">Дата рождения</th>
                            <th class="border border-gray-400 px-4 py-2">Телефон</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($participants->where('gender', 'Ж') as $participant)
                            <tr>
                                <td class="border border-gray-400 px-4 py-2">{{ $loop->iteration }}</td>
                                <td class="border border-gray-400 px-4 py-2">{{ $participant->fio }}</td>
                                <td class="border border-gray-400 px-4 py-2">{{ strftime("%d.%m.%Y", strtotime($participant->birth_date))}}</td>
                                <td class="border border-gray-400 px-4 py-2">{{ $participant->phone }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
    <div class="mb-8 display:none" id="fileView">
        <p class="font-bold mb-2">Файлы турнира</p>
        @if($files->isEmpty())
            <p>Файлы недоступны</p>
        @else
            @foreach($files as $file)
                <div>
                    <h3 class="mt-3 mb-3"><a class="hover:text-green-500" href="{{ $file->file_path }}" download="{{ $file->file_name }}">скачать файл {{ $file->file_name }}</a></h3>
                    <iframe src="{{ $file->file_path }}" width="100%" height="400px"></iframe>
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const boysBtn = document.getElementById('boysBtn');
        const girlsBtn = document.getElementById('girlsBtn');
        const boysList = document.getElementById('boysList');
        const girlsList = document.getElementById('girlsList');
        
        const listBtn = document.getElementById('listBtn');
        const fileBtn = document.getElementById('fileBtn');
        const listView = document.getElementById('listView');
        const fileView = document.getElementById('fileView');

        listView.style.display = 'block';
        fileView.style.display = 'none';
        listBtn.classList.add('bg-lime-500');

        boysBtn.addEventListener('click', function () {
            boysList.style.display = 'block';
            girlsList.style.display = 'none';
            boysBtn.classList.add('bg-blue-600');
            girlsBtn.classList.remove('bg-pink-600');
        });

        girlsBtn.addEventListener('click', function () {
            boysList.style.display = 'none';
            girlsList.style.display = 'block';
            girlsBtn.classList.add('bg-pink-600');
            boysBtn.classList.remove('bg-blue-600');
        });

        listBtn.addEventListener('click', function(){
            listView.style.display = 'block';
            fileView.style.display = 'none';
            listBtn.classList.add('bg-lime-500');
            fileBtn.classList.remove('bg-lime-500');
        });

        fileBtn.addEventListener('click', function(){
            listView.style.display = 'none';
            fileView.style.display = 'block';
            fileBtn.classList.add('bg-lime-500');
            listBtn.classList.remove('bg-lime-500');
        });
    });
</script>

