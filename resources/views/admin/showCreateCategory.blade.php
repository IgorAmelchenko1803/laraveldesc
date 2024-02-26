<x-admin.layout>
    <x-admin.elements.header>
        {{ __('Содать категорию') }}
    </x-admin.elements.header>

    <x-admin.elements.form>{{-- Создаем форму ввода для новой категории --}}
        <x-admin.elements.input name="name">
            Название категории:<br>
        </x-admin.elements.input>

        <x-admin.elements.inputSubmit />

    </x-admin.elements.form>

    @error('name'){{-- Если поле менее 4 или более 255 символов - вывод ошибки --}}
        <div class="text-red-600">{{ $message }}</div>
    @enderror

    @if (Session::has('success')){{-- при успешном добавлении новой категории выводим флеш соощение --}}
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif

    <x-admin.elements.header>
        {{ __('Список соданых категорий:') }}
    </x-admin.elements.header>

    <x-admin.elements.ul>
       @foreach($subjects as $subject)
            <x-admin.elements.ul>
                {{$subject->name}}
            </x-admin.elements.ul>
       @endforeach
    </x-admin.elements.ul>
</x-admin.layout>