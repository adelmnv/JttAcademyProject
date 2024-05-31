@extends('app')

@section('page_title', 'О нас - ')


@section('content')
    <div class="container mx-auto bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-3xl font-bold mb-6">Добро пожаловать в наш теннисный клуб и школу!</h2>

        <p class="text-lg mb-4">
            Мы рады приветствовать вас в нашем теннисном клубе и школе, расположенных в живописном месте по адресу:
            <strong>Желтокстан 181, г. Алматы.</strong> Наш клуб предоставляет уникальные услуги как для начинающих, так
            и для опытных игроков.
        </p>

        <p class="text-lg mb-4">
            Теннисный клуб предлагает высококачественные теннисные корты с современным покрытием, идеальными для тренировок
            и соревнований. Мы гордимся нашим коллективом профессиональных тренеров, которые работают с игроками всех
            уровней и возрастов.
        </p>

        <p class="text-lg mb-4">
            Местоположение наших кортов в окружении гостиницы Интерконтиненталь создает удивительную атмосферу, что делает
            наш клуб местом, где можно не только развивать свои теннисные навыки, но и наслаждаться природой и красотой
            окружающего мира.
        </p>

        <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-8">
            <img src="{{ asset('img/hotel.jpeg') }}" alt="Гостиница" class="w-full h-auto rounded-lg h-full">
            <img src="{{ asset('img/courts.jpg') }}" alt="Теннисный корт" class="w-full h-auto rounded-lg">
        </div>

        <p class="text-lg mb-4">
            Наши профессиональные тренеры обеспечивают индивидуальный и групповой подход к обучению, помогая каждому игроку
            развивать свои уникальные навыки. В нашем теннисном клубе вы не только научитесь играть в теннис, но также
            погрузитесь в атмосферу командного сотрудничества и соревнований.
        </p>

        <p class="text-lg mb-4">
            Местоположение нашего клуба обеспечивает легкий доступ из разных частей города, что делает его удобным для
            посещения. Приглашаем вас стать частью нашего теннисного сообщества!
        </p>

        <div class="bg-gray-100 p-6 rounded-lg mb-8">
            <h3 class="text-2xl font-bold mb-4">Контакты и Адрес</h3>

            <p class="text-lg mb-2">Телефон 1 (Макеев Дмитрий Федорович): +7 123 456-7890</p>
            <p class="text-lg mb-2">Телефон 2 (Карамауллин Руслан Рашитович): +7 987 654-3210</p>
            <p class="text-lg mb-2">Адрес: Желтокстан 181, г. Алматы</p>

            <a href="https://www.instagram.com/jtt_junior_tennis_team/" target="_blank" class="flex items-center text-lg mt-4">
                <i class="fab fa-instagram-square text-2xl mr-2"></i> Мы в соцсетях
            </a>
        </div>

        <div class="mb-4 flex justify-center">
        <a class="dg-widget-link" href="http://2gis.kz/almaty/firm/9429940000787810/center/76.93978786468507,43.23626149064871/zoom/16?utm_medium=widget-source&utm_campaign=firmsonmap&utm_source=bigMap">Посмотреть на карте Алматы</a><div class="dg-widget-link"><a href="http://2gis.kz/almaty/firm/9429940000787810/photos/9429940000787810/center/76.93978786468507,43.23626149064871/zoom/17?utm_medium=widget-source&utm_campaign=firmsonmap&utm_source=photos">Фотографии компании</a></div><div class="dg-widget-link"><a href="http://2gis.kz/almaty/center/76.939798,43.235954/zoom/16/routeTab/rsType/bus/to/76.939798,43.235954╎InterContinental Almaty, гостиничный комплекс?utm_medium=widget-source&utm_campaign=firmsonmap&utm_source=route">Найти проезд до InterContinental Almaty, гостиничный комплекс</a></div><script charset="utf-8" src="https://widgets.2gis.com/js/DGWidgetLoader.js"></script><script charset="utf-8">new DGWidgetLoader({"width":640,"height":600,"borderColor":"#a3a3a3","pos":{"lat":43.23626149064871,"lon":76.93978786468507,"zoom":16},"opt":{"city":"almaty"},"org":[{"id":"9429940000787810"}]});</script><noscript style="color:#c00;font-size:16px;font-weight:bold;">Виджет карты использует JavaScript. Включите его в настройках вашего браузера.</noscript>
        </div>

        <div class="flex justify-between">
            <a href="{{ route('coaches') }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition duration-300">
                Полный состав тренеров
            </a>
            <a href="{{ route('posts') }}" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600 transition duration-300">
                Наш блог
            </a>
        </div>
    </div>
@endsection