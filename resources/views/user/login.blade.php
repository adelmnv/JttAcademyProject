@extends('app')

@section('styles')
    <style>
        .container{
           min-height: 750px;
        }
    </style>
@endsection

@section('page_title', 'Login - ')

@section('content')
    <div class='container mx-auto bg-white'>
        <div class='w-1/5 mx-auto py-16'>
            <h1 class="text-lg text-black-500 font-bold">Вход</h1>
            <form method='post' action="{{ route('user.auth') }}">
                @csrf
                <div class="flex flex-col mt-2">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" class='rounded-md border py-2 px-4' value="{{ old('email') }}" required autofocus>
                </div>
                <div class="flex flex-col mt-2">
                    <label for="password">Пароль:</label>
                    <input type="password" name="password" id="password" class='rounded-md border py-2 px-4' required>
                </div>
                <div class="mt-4">
                    <input type="submit" name="login_btn" value='Войти' class='rounded-md border py-2 px-4 hover:bg-green-600 hover:text-white transition-all duration-300 cursor-pointer'>
                </div>
            </form>
            @if ($errors->any())
                <div class="alert alert-danger mt-6 text-red">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
@endsection
