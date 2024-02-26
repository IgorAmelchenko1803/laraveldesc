<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Категория: {{$message->category->name}}
        </h2>
        <hr>
        <h3 class="font-semibold text-xl text-gray-800 leading-tight">
           Подкатегория: {{$message->subcategory->name}}
        </h3>
        
    </x-slot>


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


    

  

    
               
</x-app-layout>
