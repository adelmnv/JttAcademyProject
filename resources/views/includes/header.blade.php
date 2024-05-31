<header class="flex items-center justify-between p-4 bg-black">
  <div class="flex items-center">
      <img src="{{ asset('img/logo2.png') }}" alt="Логотип" class="h-16 w-auto mr-2">
      <a class="text-xl text-white font-bold" href="{{route ('main') }}">Junior Tennis Team</a>
  </div>
    <nav class="flex space-x-4 mr-20">
        <a href="{{ route('about') }}" class="menu-item text-lg text-white hover:text-green-500 font-semibold">О нас</a>
        <a href="{{ route('coaches') }}" class="menu-item text-lg text-white hover:text-green-500 font-semibold">Тренеры</a>
        <a href="{{ route('practices') }}" class="menu-item text-lg text-white hover:text-green-500 font-semibold">Тренировки</a>
        <a href="{{ route('tournaments') }}" class="menu-item text-lg text-white hover:text-green-500 font-semibold">Календарь турниров</a>
        <a href="{{ route('players') }}" class="menu-item text-lg text-white hover:text-green-500 font-semibold">Наши игроки</a>
        <a href="{{ route('posts') }}" class="menu-item text-lg text-white hover:text-green-500 font-semibold">Наш блог</a>
        @auth
            <a href="{{ route('user.dash') }}" class="menu-item text-lg text-white hover:text-green-500 font-semibold">Панель</a>
            <a href="{{route ('user.logout') }}" class="menu-item text-lg text-white hover:text-green-500 font-semibold">Logout</a>
        @endauth
    </nav>
    </div>
</header>

