<x-admin.layout>
    <x-admin.elements.header>
        {{ __('Содать подкатегорию') }}
    </x-admin.elements.header>

    <x-admin.elements.form>{{-- Создаем форму ввода для новой подкатегории --}}
        <x-admin.elements.input name="name">
            Название подкатегории:<br>
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
        {{ __('Список соданых подкатегорий:') }}
    </x-admin.elements.header>

    <x-admin.elements.ul>
       @foreach($subSubjects as $subSubject)
            <x-admin.elements.ul>
                {{$subSubject->name}}
            </x-admin.elements.ul>
       @endforeach
    </x-admin.elements.ul>
    
</x-admin.layout>