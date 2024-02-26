<x-admin.layout>
    <x-admin.elements.header>
        {{ __('Удалить категорию') }}
    </x-admin.elements.header>

    <x-admin.elements.form>
        <x-admin.elements.header>
         {{ __('Выерете категорию из списка:') }}
        </x-admin.elements.header>


        @foreach($subjects as $subject)
            <x-admin.elements.radio name="subId" value="{{$subject->id}}">  
                    {{$subject->name}}
            </x-admin.elements.radio> 
        @endforeach

        <x-admin.elements.inputSubmit value="Удалить" onclick="return confirm('Вы уверены, что хотите удалить категорию?');"/>

        @if (Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif

    </x-admin.elements.form>

    

 
</x-admin.layout>