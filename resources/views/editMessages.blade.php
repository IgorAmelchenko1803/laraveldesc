<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Мои сообщения
        </h2>
        <hr>
    </x-slot>
@if (Session::has('success')){{-- при успешном добавлении новой категории выводим флеш соощение --}}
     <div class="alert alert-success">{{ Session::get('success') }}</div>
@endif

@foreach($messages as $message)
    @if(Gate::allows('show-my-message', $message))
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
           
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <h1 class="font-semibold text-xl text-gray-800 leading-tight" style="padding: 15px;">
                <x-admin.elements.a href="{{route('show.message' , $message->id)}}">
                       {{$message->name}}
                </x-admin.elements.a>
            </h1><hr>
                <p  style="padding: 15px;"> {{ $message->text }}</p><hr>
                <div style="display: flex">
                    <div><p  style="padding: 15px;">Автор: {{ $message->user->name }}</p></div>
                    <div> <p style="padding: 15px;">Дата создания: {{ $message->created_at->format('d.m.Y H:i:s') }}</p></div>
                </div>
                <div style="display: flex">
                   <div><x-admin.elements.a href="/edit/message/{{$message->id}}">Редактировать сообщение</x-admin.elements.a></div>
                   <div>
                        <x-admin.elements.form action="{{ route('show.messages') }}"  >
                         @method('DELETE')
                            <input type="hidden" name="delete" value="{{$message->id}}" />
                            <x-admin.elements.inputSubmit  value="Удалить сообщение" onclick="return confirm('Вы уверены, что хотите удалить это сообщение?');"/>
                        </x-admin.elements.form></div>
                </div>
            </div>
        </div>
    </div>
    @endif
@endforeach


{{--
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
           
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <h1 class="font-semibold text-xl text-gray-800 leading-tight" style="padding: 15px;">
                {{$message->name}}
            </h1><hr>
                
                <p  style="padding: 15px;"> {{ $message->text }}</p><hr>
                <p  style="padding: 15px;">Автор: {{ $message->user->name }}</p><hr>
                <p  style="padding: 15px;">Дата создания: {{ $message->created_at->format('d.m.Y H:i:s') }}</p><hr>
            </div>
        </div>
    </div>
    --}}


    

  

    
               
</x-app-layout>
