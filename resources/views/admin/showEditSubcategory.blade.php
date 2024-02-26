<x-admin.layout>
    <x-admin.elements.header>
        {{ __('Редактировать подкатегорию') }}
    </x-admin.elements.header>

    <x-admin.elements.form>
        <x-admin.elements.input name="name">
            Новое наименование выбраной подкатегории:<br>
        </x-admin.elements.input>

        <x-admin.elements.header>
         {{ __('Выерете подкатегорию из списка:') }}
        </x-admin.elements.header>


        @foreach($subSubjects as $subSubject)
            <x-admin.elements.radio name="subId" value="{{$subSubject->id}}">  
                    {{$subSubject->name}}
            </x-admin.elements.radio> 
        @endforeach

        <x-admin.elements.inputSubmit />

    </x-admin.elements.form>

    @error('name'){{-- Если поле менее 4 или более 255 символов - вывод ошибки --}}
        <div class="text-red-600">{{ $message }}</div>
    @enderror

    @if (Session::has('success')){{-- при успешном добавлении новой категории выводим флеш соощение --}}
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif

 
</x-admin.layout>