@extends('app')

@section('page_title', 'Панель - Абонементы - Редактирование')

@section('content')
<div class="container mx-auto bg-white flex-grow p-4">
    <div class="flex flex-wrap items-center">
        <div class="rounded-full py-2 px-6 border text-sm transition-all duration-300 hover:bg-green-500 hover:text-white mr-4 mb-4 inline-flex items-center bg-white text-black">
            <a href="{{ route('admin.applications') }}">
                <span>Заявки</span>
            </a>
        </div>
        <div class="rounded-full py-2 px-6 border text-sm transition-all duration-300 hover:bg-green-500 hover:text-white mr-4 mb-4 inline-flex items-center bg-white text-black">
            <a href="{{ route('admin.memberships') }}">
                <span>Абонементы</span>
            </a>
        </div>
        <div class="rounded-full py-2 px-6 border text-sm transition-all duration-300 hover:bg-green-500 hover:text-white mr-4 mb-4 inline-flex items-center bg-white text-black">
            <a href="{{ route('admin.menu') }}">
                <span>Меню по созданию</span>
            </a>
        </div>
    </div>
    <div class="mb-8">
        <div class="container mx-auto mt-10">
            <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg p-6">
                <h1 class="text-3xl font-bold mb-6">Редактирование абонемента</h1>
                <form action="{{ route('admin.memberships_update', ['membership_id' => $membership->id]) }}" method="POST">
                    @csrf
                    @method('POST')
                    
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Имя:</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $membership->name) }}" class="form-input block w-full mt-1">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="phone" class="block text-sm font-medium text-gray-700">Номер телефона:</label>
                        <input type="phone" id="name" name="phone" value="{{ old('phone', $membership->phone) }}" class="form-input block w-full mt-1">
                        @error('phone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Дата рождения:</label>
                        <input type="date" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $membership->date_of_birth) }}" class="form-input block w-full mt-1">
                        @error('date_of_birth')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="paid_until" class="block text-sm font-medium text-gray-700">Оплачен до:</label>
                        <input type="date" id="paid_until" name="paid_until" value="{{ old('paid_until', $membership->paid_until) }}" class="form-input block w-full mt-1">
                        @error('paid_until')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="group_id" class="block text-sm font-medium text-gray-700">Выберите группу:</label>
                        @foreach ($groups as $group)
                            <div class="bg-white rounded-lg shadow-md p-4 mb-4 flex items-center justify-between">
                                <div class="flex items-center">
                                    <input type="radio" id="group_{{ $group->id }}" name="group_id" value="{{ $group->id }}" {{ $membership->group_id == $group->id ? 'checked' : '' }} class="mr-2">
                                    <label for="group_{{ $group->id }}" class="text-sm font-medium text-gray-900">{{ $group->practice->type }} {{$group->practice_type_name}} ({{ $group->coach->fio }}) | <span class="text-gray-500">{{ $group->practice->price }} тг </span></label>
                                </div>
                                <div class="text-right text-gray-500">
                                    <span>{{ $group->time }}</span> | 
                                    <span class="ml-2 text-sm">{{ $group->days_as_names }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="flex items-center justify-end mb-4">
                        <a href="{{ route('admin.memberships') }}" class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600 transition-all duration-300">Назад</a>
                        <button type="submit" class="bg-yellow-500 text-white ml-4 px-4 py-2 rounded-full hover:bg-yellow-600 transition-all duration-300">Сохранить изменения</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
