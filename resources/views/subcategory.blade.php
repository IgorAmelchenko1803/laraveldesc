<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Категория:') }} {{$category}}
        </h2>
        <h3 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Подкатегория:') }} {{$subcategory}}
        </h3>
    </x-slot>

    @foreach ($messages as $message)
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
           
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <p  style="padding: 15px;">Автор: {{ $message->user->name ?? 'Неизвестный' }}</p><hr>
                
                    <a href="/message/{{$message->id}}" class="text-blue-700 hover:text-blue-900 block py-2 px-4 cursor-pointer hover:underline">
                        {{$message->name}}
                    </a><hr>
                 
                <p  style="padding: 15px;">Дата создания: {{ $message->created_at->format('d.m.Y H:i:s') }}</p>
                @if(Gate::allows('delete-admin-message'))
                <div style="display: flex">
                    <div><x-admin.elements.a href="/edit/message/{{$message->id}}">Редактировать сообщение</x-admin.elements.a></div>
                    <div>
                            <x-admin.elements.form action="{{ route('show.messages') }}"  >
                            @method('DELETE')
                                <input type="hidden" name="delete" value="{{$message->id}}" />
                                <x-admin.elements.inputSubmit  value="Удалить сообщение" onclick="return confirm('Вы уверены, что хотите удалить это сообщение?');"/>
                            </x-admin.elements.form></div>
                    </div> 
            @endif
            </div>
        </div>
    </div>
@endforeach
    {{ $messages->links() }}

   

    
               
</x-app-layout>
