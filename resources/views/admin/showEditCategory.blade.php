<x-admin.layout>
    <x-admin.elements.header>
        {{ __('Редактировать категорию') }}
    </x-admin.elements.header>

    <x-admin.elements.form>
        <x-admin.elements.input name="name">
            Новое наименование выбраной категории:<br>
        </x-admin.elements.input>

        <x-admin.elements.header>
         {{ __('Выерете категорию из списка:') }}
        </x-admin.elements.header>


        @foreach($subjects as $subject)
            <x-admin.elements.radio name="subId" value="{{$subject->id}}">  
                    {{$subject->name}}
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