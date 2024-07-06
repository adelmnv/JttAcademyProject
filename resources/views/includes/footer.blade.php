<footer class="bg-black">
    <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
        <div class="sm:flex sm:items-center sm:justify-between">
            <a href="{{route ('main') }}" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">
                <img src="{{ asset('img/logo2.png') }}" class="h-8" alt="Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap text-white">Junior Tennis Team</span>
            </a>
            <ul class="flex flex-wrap items-center mb-6 text-sm font-medium text-white sm:mb-0">
                <li>
                    <a href="{{ route('about') }}" class="hover:text-green-500 me-4 md:me-6">О нас</a>
                </li>
                <li>
                    <a href="{{ route('coaches') }}" class="hover:text-green-500 me-4 md:me-6">Тренеры</a>
                </li>
                <li>
                    <a href="{{ route('practices') }}" class="hover:text-green-500 me-4 md:me-6">Тренировки</a>
                </li>
                <li>
                    <a href="{{ route('tournaments') }}" class="hover:text-green-500 me-4 md:me-6">Календарь турниров</a>
                </li>
                <li>
                    <a href="{{ route('players') }}" class="hover:text-green-500 me-4 md:me-6">Наши игроки</a>
                </li>
                <li>
                    <a href="{{ route('posts') }}" class="hover:text-green-500 me-4 md:me-6">Наш блог</a>
                </li>
                @guest
                    <li>
                        <a href="{{ route('user.login') }}" class="hover:text-green-500 me-4 md:me-6">Войти</a>
                    </li>
                @endguest
                @auth
                    <li>
                        <a href="{{ route('admin.applications') }}" class="hover:text-green-500 me-4 md:me-6">Панель</a>
                    </li>
                    <li>
                        <a href="{{route ('user.logout') }}" class="hover:text-green-500 me-4 md:me-6">Выйти</a>
                    </li>
                @endauth
                <!-- <li>
                    <a href="#" class="hover:text-green-500 me-4 md:me-6">Privacy Policy</a>
                </li>
                <li>
                    <a href="#" class="hover:text-green-500 me-4 md:me-6">Licensing</a>
                </li> -->
            </ul>
        </div>
        <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
        <span class="block text-sm text-white sm:text-center">© 2024 <a href="{{route ('main') }}" class="hover:text-green-500">JTT™</a>. Adel Malgonussova</span>
    </div>
</footer>